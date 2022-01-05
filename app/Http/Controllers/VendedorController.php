<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\Vendedor;

class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $vendedores = $servico->vendedor;
        return view('vendedor.index',["servico"=>$servico,"vendedores"=>$vendedores]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        return view('vendedor.create',['servico'=>$servico]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [   
                "nome"=>['required','max:255','string'],
                "telefone"=>['nullable','max:255'],
                "email"=>['required','max:255','email'],
                "pais"=>['required','max:255','string'],
                "servicoId"=>['required']
            ]
        );
        $vendedor = new Vendedor();
        $vendedor->servico_id = $request->input('servicoId');
        if($request->input('telefone') != null){
            $vendedor->telefone = $request->input('telefone');
        }
        $vendedor->pais = $request->input('pais');
        $vendedor->email = $request->input('email');
        $vendedor->nome = $request->input('nome');
        $vendedor->save();
        $request->session()->flash('mensagemSucessoAdicionar', "Vendedor Adicionado Com Sucesso");
        return redirect()->route("vendedor.index");
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
        $vendedor = Vendedor::find($id);
        $servico = $vendedor->servico;
        if($vendedor == null){
            return redirect()->back;
        }else{
            return view('vendedor.edit',['vendedor'=>$vendedor,'servico'=>$servico]);
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
        $vendedor = Vendedor::find($id);
        if($vendedor == null){
            return redirect()->back();
        }else{
            $request->validate(
                [   
                    "nome"=>['required','max:255','string'],
                    "telefone"=>['nullable','max:255'],
                    "email"=>['required','max:255','email'],
                    "pais"=>['required','max:255','string'],
                    "servicoId"=>['required']
                ]
            );
            if($request->input('telefone') != null){
                $vendedor->telefone = $request->input('telefone');
            }
            $vendedor->pais = $request->input('pais');
            $vendedor->email = $request->input('email');
            $vendedor->nome = $request->input('nome');
            $vendedor->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Vendedor Atualizado Com Sucesso");
            return redirect()->route("vendedor.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $vendedor = Vendedor::find($id);
        if($vendedor == null){
            return redirect()->back();
        }else{
            $nomeVendedor = $vendedor->nome."";
            $vendedor->delete();
            $request->session()->flash('mensagemSucessoApagar', "Vendedor \"".$nomeVendedor."\" apagado com sucesso");
            return redirect()->route("vendedor.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $vendedores = $servico->vendedor;
        return response()->json($vendedores);
    }
}
