<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if($id == null || $request->input('editType') == null){
            dd("Volta 1");
            return redirect()->back();
        }else{
            //Varivel de mensagem
            $mensagemSucesso = "";
            //Procura o usuario
            $user = User::find($id);
            //Se Nao encontrar, envia de volta para de onde veio
            if($user == null){
                return redirect()->back();
            //Se foi encontrado entra no else
            }else{
                /*Se O Modo de edição for nome então entra neste if e faz a validação e modificação de nome
                Onde o nome é obrigatório e não pode passar 255 caracteres*/
                if($request->input('editType') == "name"){
                    $request->validate([
                        'userName' => ['required', 'string', 'max:255']
                    ]);
                    $user->name = $request->input('userName');
                    $mensagemSucesso = "O Nome de usuário foi alterado com sucesso";
                /* Se O Modo de edição for senha então entra neste if e faz a validação e modificação de senha
                Onde a senha tem que ser confirmada e não pode ser igual a anterior
                */
                }else if($request->input('editType') == "password"){
                    $request->validate([
                        'password' => ['required', 'confirmed', Rules\Password::defaults()],
                        'oldPassword'=>['required','different:password', Rules\Password::defaults()]
                    ]);
                    $user->password = Hash::make($request->password);
                    $mensagemSucesso = "A Senha de usuário foi alterada com sucesso";
                //Se for qualquer outro tipo de edição, volta para onde veio
                }else{
                    return redirect()->back();
                }
                //Salva Alterações
                $user->save();
                //Reloga
                Auth::login($user);
                //Grava Sessão
                $request->session()->flash('mensagemSucesso', $mensagemSucesso);
                //Volta para index com mensagem de sucesso
                return redirect()->route("servico.index");
            }
        }
        return "";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}