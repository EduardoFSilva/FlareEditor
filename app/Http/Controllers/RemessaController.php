<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\User;
use App\Models\Rastreamento;
use App\Models\Remessa;

class RemessaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $remessas = $servico->remessa;
        return view('remessa.index',["servico"=>$servico,"remessas"=>$remessas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        $rastreamentos = $servico->rastreamento;
        return view('remessa.create',['servico'=>$servico,"rastreamentos"=>$rastreamentos]);
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
            "codigoRastreamento"=>['required','max:255','string'],
            "linkRastreamento"=>['required','nullable','max:511'],
            "tipoRemessa"=>['required','max:255','string'],
            "dataEntrega"=>['required','max:255','date'],
            "progressoRastreamento"=>['required','max:255','string'],
            "servicoId"=>['required'],
            "rastreamentoId"=>['required','numeric']
        ]);
        $remessa = new Remessa();
        $remessa->rastreamento_id = $request->input('rastreamentoId');
        $remessa->codigoRastreamento = $request->input('codigoRastreamento');
        $remessa->tipoRemessa = $request->input('tipoRemessa');
        $remessa->linkRastreamento = $request->input('linkRastreamento');
        $remessa->dataDeEntrega = $request->input('dataEntrega');
        $remessa->progressoRastreamento = $request->input('progressoRastreamento');
        $remessa->servico_id = $request->input('servicoId');
        $remessa->save();
        $request->session()->flash('mensagemSucessoAdicionar', "Remessa Adicionada Com Sucesso");
        return redirect()->route("remessa.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $servico = Auth::user()->servico;
        $remessa = Remessa::find($id)->with(['rastreamento'])->get()[0];
        $rastreamentos = $servico->rastreamento;
        if($remessa == null){
            return redirect()->back();
        }else{
            return view('remessa.edit',['servico'=>$servico,'rastreamentos'=>$rastreamentos,"remessa"=>$remessa]);
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
        $remessa = Remessa::find($id)->with(['rastreamento'])->get()[0];
        if($remessa == null){
            return redirect()->back();
        }else{
            $request->validate([
                "codigoRastreamento"=>['required','max:255','string'],
                "linkRastreamento"=>['required','nullable','max:511'],
                "tipoRemessa"=>['required','max:255','string'],
                "dataEntrega"=>['required','max:255','date'],
                "progressoRastreamento"=>['required','max:255','string'],
                "servicoId"=>['required'],
                "rastreamentoId"=>['required','numeric']
            ]);
            $remessa->rastreamento_id = $request->input('rastreamentoId');
            $remessa->codigoRastreamento = $request->input('codigoRastreamento');
            $remessa->tipoRemessa = $request->input('tipoRemessa');
            $remessa->linkRastreamento = $request->input('linkRastreamento');
            $remessa->dataDeEntrega = $request->input('dataEntrega');
            $remessa->progressoRastreamento = $request->input('progressoRastreamento');
            $remessa->servico_id = $request->input('servicoId');
            $remessa->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Remessa Atualizar Com Sucesso");
            return redirect()->route("remessa.index");
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
        $remessa = Remessa::find($id);
        if($remessa == null){
            return redirect()->back();
        }else{
            $remessaCodigo = $remessa->codigoRastreamento."";
            $remessa->delete();
            $request->session()->flash('mensagemSucessoApagar', "Remessa \"".$remessaCodigo."\" apagada com sucesso");
            return redirect()->route("remessa.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $remessa = Remessa::where('servico_id',$servico->id)->with(['rastreamento'])->get();
        return response()->json($remessa);
    }
}
