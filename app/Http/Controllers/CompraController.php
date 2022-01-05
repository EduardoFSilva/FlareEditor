<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\User;
use App\Models\Compra;
use App\Models\Cliente;
use App\Models\Rastreamento;
use App\Models\Remessa;
use App\Models\Vendedor;
use App\Models\Produto;


class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $compras = Compra::where('servico_id',$servico->id)->with(['servico','cliente','produto','produto.vendedor','remessa','remessa.rastreamento'])->get();
        return view('compra.index',["servico"=>$servico,"compras"=>$compras]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        $remessas = Remessa::where('servico_id',$servico->id)->with(['rastreamento'])->get();
        $clientes = $servico->cliente;
        $produtos = Produto::where('servico_id',$servico->id)->with(['vendedor'])->get();
        return view("compra.create",["servico"=>$servico,"remessas"=>$remessas,"clientes"=>$clientes,"produtos"=>$produtos]);
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
            "clienteId"=>['required','numeric'],
            "produtoId"=>['required','numeric'],
            "remessaId"=>['required','numeric'],
            "servicoId"=>['required','numeric'],
            "quantidade"=>['required','numeric']
        ]);
        $compra = new Compra();
        $compra->cliente_id = $request->input("clienteId");
        $compra->produto_id = $request->input("produtoId");
        $compra->remessa_id = $request->input("remessaId");
        $compra->servico_id = $request->input("servicoId");
        $compra->quantidade = $request->input("quantidade");
        $compra->save();
        $request->session()->flash('mensagemSucessoAdicionar', "Compra Adicionada Com Sucesso");
        return redirect()->route("compra.index");
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
        $remessas = Remessa::where('servico_id',$servico->id)->with(['rastreamento'])->get();
        $clientes = $servico->cliente;
        $produtos = Produto::where('servico_id',$servico->id)->with(['vendedor'])->get();
        $compra = Compra::find($id);
        if($compra == null){
            return redirect()->back();
        }else{
            return view("compra.edit",["compra"=>$compra,"servico"=>$servico,"remessas"=>$remessas,"clientes"=>$clientes,"produtos"=>$produtos]);
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
        $compra = Compra::find($id);
        if($compra == null){
            return redirect()->back();
        }else{
            $request->validate([
                "clienteId"=>['required','numeric'],
                "produtoId"=>['required','numeric'],
                "remessaId"=>['required','numeric'],
                "servicoId"=>['required','numeric'],
                "quantidade"=>['required','numeric']
            ]);
            $compra->cliente_id = $request->input("clienteId");
            $compra->produto_id = $request->input("produtoId");
            $compra->remessa_id = $request->input("remessaId");
            $compra->servico_id = $request->input("servicoId");
            $compra->quantidade = $request->input("quantidade");
            $compra->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Compra Atualizada Com Sucesso");
            return redirect()->route("compra.index");
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
        $compra = Compra::find($id)::with(['produto'])->get();
        if($compra == null){
            return redirect()->back();
        }else{
            $compra = $compra[0];
            $compraDoQue = $compra->quantidade."x ".$compra->produto->descricao."";
            $compra->delete();
            $request->session()->flash('mensagemSucessoApagar', "Compra \"".$compraDoQue."\" apagada com sucesso");
            return redirect()->route("compra.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $compras = Compra::where('servico_id',$servico->id)->with(['servico','cliente','produto','produto.vendedor','remessa','remessa.rastreamento'])->get();
        return response()->json($compras);
    }
}
