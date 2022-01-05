<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Servico;
use App\Models\User;
use App\Models\Rastreamento;

class RastreamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servico = Auth::user()->servico;
        $rastreamentos = $servico->rastreamento;
        return view('rastreamento.index',["servico"=>$servico,"rastreamentos"=>$rastreamentos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servico = Auth::user()->servico;
        return view('rastreamento.create',['servico'=>$servico]);
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
                "nomeEmpresa"=>['required','max:255','string'],
                "site"=>['required','nullable','max:511'],
                "email"=>['required','max:255','email'],
                "telefone"=>['required','max:255','string'],
                "servicoId"=>['required']
            ]
        );
        $rastreamento = new Rastreamento();
        $rastreamento->nomeEmpresa = $request->input('nomeEmpresa');
        $rastreamento->servico_id = $request->input('servicoId');
        $rastreamento->email = $request->input('email');
        $rastreamento->telefone = $request->input('telefone');
        $rastreamento->site = $request->input('site');
        $rastreamento->save();
        $request->session()->flash('mensagemSucessoAdicionar', "Empresa De Entregas Adicionada Com Sucesso");
        return redirect()->route("rastreamento.index");
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
        $rastreamento = Rastreamento::find($id);
        if($rastreamento == null){
            return redirect()->back();
        }else{
            return view('rastreamento.edit',['servico'=>$servico,'rastreamento'=>$rastreamento]);
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
        $rastreamento = Rastreamento::find($id);
        if($rastreamento == null){
            return redirect()->back();
        }else{
            $request->validate(
                [   
                    "nomeEmpresa"=>['required','max:255','string'],
                    "site"=>['required','nullable','max:511'],
                    "email"=>['required','max:255','email'],
                    "telefone"=>['required','max:255','string'],
                    "servicoId"=>['required']
                ]
            );
            $rastreamento->nomeEmpresa = $request->input('nomeEmpresa');
            $rastreamento->servico_id = $request->input('servicoId');
            $rastreamento->email = $request->input('email');
            $rastreamento->telefone = $request->input('telefone');
            $rastreamento->site = $request->input('site');
            $rastreamento->save();
            $request->session()->flash('mensagemSucessoAtualizar', "Empresa De Entregas Atualizada Com Sucesso");
            return redirect()->route("rastreamento.index");
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
        $rastreamento = Rastreamento::find($id);
        if($rastreamento == null){
            return redirect()->back();
        }else{
            $nomeEmpresa = $rastreamento->nomeEmpresa."";
            $rastreamento->delete();
            $request->session()->flash('mensagemSucessoApagar', "Empresa de rastreamento \"".$nomeEmpresa."\" apagada com sucesso");
            return redirect()->route("rastreamento.index");
        }
    }

    public function datatableProvider(){
        $servico = Auth::user()->servico;
        $rastreamentos = $servico->rastreamento;
        return response()->json($rastreamentos);
    }
}
