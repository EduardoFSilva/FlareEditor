<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Models\Servico;
use App\Models\User;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $clientes = Cliente::get();
        return view('cliente.index',["servico"=>$servico,"clientes"=>$clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        return view("cliente.create",["servico"=>$servico]);
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
                "sobrenome"=>['required','max:255','string'],
                "email"=>['required','max:255','email'],
                "endereco"=>['required','max:511','string'],
                "servicoId"=>['required']
            ]
        );
        $servico = Servico::find($request->input('servicoId'));
        if($servico == null){
            return redirect()->back();
        }else{
            $cliente = new Cliente();
            $cliente->nome = $request->input('nome');
            $cliente->sobrenome = $request->input('sobrenome');
            $cliente->email = $request->input('email');
            $cliente->endereco = $request->input('endereco');
            $cliente->servico_id = $request->input('servicoId');
            $cliente->save();
            $request->session()->flash('mensagemSucessoAdicionar', "Cliente Adicionado Com Sucesso");
            return redirect()->route("cliente.index");
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $servico = $cliente->servico;
        if($cliente == null){
            return redirect()->back;
        }else{
            return view('cliente.edit',['cliente'=>$cliente,'servico'=>$servico]);
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
        $cliente = Cliente::find($id);
        if($cliente == null){
            return redirect()->back();
        }else{
            $request->validate(
                [   
                    "nome"=>['required','max:255','string'],
                    "sobrenome"=>['required','max:255','string'],
                    "email"=>['required','max:255','email'],
                    "endereco"=>['required','max:511','string'],
                ]
            );
            $servico = Servico::find($request->input('servicoId'));
            if($servico == null){
                return redirect()->back();
            }else{
                $cliente->nome = $request->input('nome');
                $cliente->sobrenome = $request->input('sobrenome');
                $cliente->email = $request->input('email');
                $cliente->endereco = $request->input('endereco');
                $cliente->save();
                $request->session()->flash('mensagemSucessoAtualizar', "Cliente Atualizado Com Sucesso");
                return redirect()->route("cliente.index");
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
        $cliente = Cliente::find($id);
        if($cliente == null){
            return redirect()->back();
        }else{
            $nomeCliente = $cliente->nome." ".$cliente->sobrenome;
            $cliente->delete();
            $request->session()->flash('mensagemSucessoApagar', "Cliente \"".$nomeCliente."\" apagado com sucesso");
            return redirect()->route("cliente.index");
        }


    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $clientes = $servico->cliente;
        return response()->json($clientes);
    }
}
