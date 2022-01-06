<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\User;
use App\Models\Vendedor;
use App\Models\Produto;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $produtos = $servico->produto;
        return view('produto.index',['produtos'=>$produtos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        $vendedores = $servico->vendedor;
        return view('produto.create',['servico'=>$servico,'vendedores'=>$vendedores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(
            [
                "servicoId"=>['required'],
                "vendedor"=>['required'],
                "descricao"=>['required','max:255','string'],
                "preco"=>['required'],
                "link"=>['required']
            ]
        );

        if($request->input('servicoId') == null || $request->input('vendedor') == null){
            return redirect()->back();
        }else{
            $produto = new Produto();
            $produto->link = $request->input('link');
            $produto->servico_id = $request->input('servicoId');
            $produto->vendedor_id = $request->input('vendedor');
            $produto->descricao = $request->input('descricao');
            $produto->preco = str_replace(",",".",$request->input('preco'));
            $produto->save();
            $request->session()->flash('mensagemSucessoAdicionar', "Produto Adicionado Com Sucesso");
            return redirect()->route("produto.index");
        }
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
        $produto = Produto::find($id)->with(['vendedor'])->get()[0];
        $servico = $produto->servico;
        $vendedores = $servico->vendedor;
       if($produto == null){
           return redirect()->back();
       }else{
            return view('produto.edit',["produto"=>$produto,"servico"=>$servico,"vendedores"=>$vendedores]);
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
        $produto = Produto::find($id)->with(['vendedor'])->get()[0];
       if($produto == null){
           return redirect()->back();
       }else{
        request()->validate(
            [
                "servicoId"=>['required'],
                "vendedor"=>['required'],
                "descricao"=>['required','max:255','string'],
                "preco"=>['required'],
                "link"=>['required']
            ]
        );

        if($request->input('servicoId') == null || $request->input('vendedor') == null){
            return redirect()->back();
        }else{
            $produto->link = $request->input('link');
            $produto->servico_id = $request->input('servicoId');
            $produto->vendedor_id = $request->input('vendedor');
            $produto->descricao = $request->input('descricao');
            $produto->preco = str_replace(",",".",$request->input('preco'));
            $produto->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Produto Atualizado Com Sucesso");
            return redirect()->route("produto.index");
        }
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
        $produto = Produto::find($id);
        if($produto == null){
            return redirect()->back();
        }else{
            $descProduto = $produto->descricao."";
            $produto->delete();
            $request->session()->flash('mensagemSucessoApagar', "Produto \"".$descProduto."\" apagado com sucesso");
            return redirect()->route("produto.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $produtos = Produto::where('servico_id',$servico->id)->with(['vendedor'])->get();
        return response()->json($produtos);
    }
}
