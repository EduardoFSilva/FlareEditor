<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\User;
use App\Models\Modelo;
use App\Models\Compra;


class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $modelos = $servico->modelo;
        return view("modelo.index",['modelos'=>$modelos]);
    }

    public function process(Request $request)
    {
        $request->validate([
            "modeloId"=>['required'],
            'compraId'=>['required']
        ]);
        $compra = Compra::where('id',$request->input('compraId'))->with(['servico','cliente','produto','produto.vendedor','remessa','remessa.rastreamento'])->get()[0];
        $modelo = Modelo::find($request->input('modeloId'));
        if($modelo == null || $compra == null){
            return redirect()->back();
        }else{
            $textInput = $modelo->conteudo;
            $pattern = "/({'[a-z\X+\.?]+'})/mi"; // Formato {'variavel'} aceita pontos para separar variaveis
            $repPatt = "/{|}|'/mi"; //Regex de remoção de chaves e aspas simples
            $matches = []; // Array de seleção de chaves pelo preg_match_all
            preg_match_all($pattern,$textInput,$matches);
            $proc = $textInput; // Input Do HTML De Conteudo pois o processo é destrutivo
            foreach ($matches[0] as $index => $key) {
                //Variavel Limpa só dividida por pontos
                $noVarSignString = preg_replace($repPatt,"",$key);
                //Substituição De Variavel por valor
                $proc = str_replace($key,$this->valorVariavel($noVarSignString,$compra),$proc);
            }
            return view('modelo.process',["parsedHtml"=>$proc]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        $teste = '<b><span style="font-size: 48px;"><font color="#0000ff">EEEEEEEEEÉÉÉÉÉÉE</font></span></b>';
        return view("modelo.create",['servico'=>$servico,"teste"=>$teste])->withFields(['mensagem']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'=>['required','string','max:255'],
            'descricao'=>['nullable','max:511'],
            'mensagem'=>['required'],
            'servicoId'=>['required']
        ]);
        $modelo = new Modelo();
        $modelo->servico_id = $request->input('servicoId');
        $modelo->conteudo = $request->input('mensagem');
        $modelo->descricao = $request->input('descricao');
        $modelo->titulo = $request->input('titulo');
        $modelo->save();
        $request->session()->flash('mensagemSucessoAdicionar', "Modelo Criado Com Sucesso");
        return redirect()->route("modelo.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = Modelo::find($id);
        $servico = $modelo->servico;
        if($modelo == null){
            return redirect()->back;
        }else{
            return view('modelo.show',['modelo'=>$modelo,'servico'=>$servico]);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modelo = Modelo::find($id);
        $servico = $modelo->servico;
        if($modelo == null){
            return redirect()->back;
        }else{
            return view('modelo.edit',['modelo'=>$modelo,'servico'=>$servico]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = Modelo::find($id);
        $servico = $modelo->servico;
        if($modelo == null){
            return redirect()->back;
        }else{
            $request->validate([
                'titulo'=>['required','string','max:255'],
                'descricao'=>['nullable','max:511'],
                'mensagem'=>['required'],
                'servicoId'=>['required']
            ]);
            $modelo->servico_id = $request->input('servicoId');
            $modelo->conteudo = $request->input('mensagem');
            $modelo->descricao = $request->input('descricao');
            $modelo->titulo = $request->input('titulo');
            $modelo->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Modelo Editado Com Sucesso");
            return redirect()->route("modelo.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $modelo = Modelo::find($id);
        if($modelo == null){
            return redirect()->back();
        }else{
            $tituloModelo = $modelo->titulo."";
            $modelo->delete();
            $request->session()->flash('mensagemSucessoApagar', "Modelo \"".$tituloModelo."\" apagado com sucesso");
            return redirect()->route("modelo.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $remessa = $servico->modelo;
        return response()->json($remessa);
    }

    /**
     * Função Responsavel Por Traduzir o Eloquent de Compras em valores substituiveis
     */
    private function valorVariavel($chave,$compra){
        //Dicionario De Tradução de chave para seletor do array
        //As Unicas Excessões A Regra São Nome Completo e Data De Entrega
        if($chave == "cliente.nomeCompleto"){
            return $compra->cliente->nome." ".$compra->cliente->sobrenome;
        }else if($chave == "remessa.dataDeEntrega"){
            //Converte a data em Time
            $time = strtotime($compra->remessa->dataDeEntrega);
            //Dicionario De Meses. O mês é seu número - 1. Exemplo: Janeiro index 0, Fevereiro index 1 e assim por diante
            $meses = ["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
            //Seleciona o mês
            $mes = $meses[date('m',$time)-1];
            //Escreve <Dia> de <Mes por Extensao> de <Ano>
            $retorno = date('d',$time)." de ".$mes." de ".date('Y',$time);
        }
        $dicionario = [
            "cliente.primeiroNome" => ["cliente","nome"],
            "cliente.email" => ["cliente","email"],
            "cliente.endereco" => ["cliente","endereco"],
            "produto.descricao" => ["produto","descricao"],
            "produto.preco" => ["produto","preco"],
            "produto.quantidade" => ["quantidade"],
            "produto.link" => ["produto","link"],
            "vendedor.nome" => ['produto',"vendedor","nome"],
            "vendedor.email" => ['produto',"vendedor","email"],
            "vendedor.telefone" => ['produto',"vendedor","telefone"],
            "vendedor.pais" => ['produto',"vendedor","pais"],
            "servico.nome" => ["servico","nomeFantasia"],
            "servico.razao" => ["servico","razaoSocial"],
            "servico.email" => ["servico","email"],
            "servico.telefone" => ["servico","telefone"],
            "rastreamento.telefone" => ['remessa',"rastreamento","telefone"],
            "rastreamento.email" => ['remessa',"rastreamento","email"],
            "rastreamento.site" => ['remessa',"rastreamento","site"],
            "rastreamento.nomeEmpresa" => ['remessa',"rastreamento","nomeEmpresa"],
            "rastreamento.telefone" => ["servico","telefone"],
            "remessa.codigo" => ["remessa","codigoRastreamento"],
            "remessa.linkRastreamento" => ["remessa","linkRastreamento"],
            "remessa.tipoRemessa" => ["remessa","tipoRemessa"],
            "remessa.statusRastreamento" => ["remessa","progressoRastreamento"]
        ];
        $path = $dicionario[$chave];
        if($path != null){
            //Copia o Objeto pois a operação é destrutiva
            $copiaCompra = $compra;
            //Procura Recursivamente Nos Index
            for($index = 0; $index < count($path); $index++){
                $copiaCompra = $copiaCompra[$path[$index]];
            }
            //Retorna Resultado se o dado for diferente de nulo
            return ($copiaCompra == null) ? "" : $copiaCompra;
        }
    }
    
}
