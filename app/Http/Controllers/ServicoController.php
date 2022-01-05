<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Servico;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('servico.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servico.create',["user"=>Auth::user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            "reason"=>['required','string','max:255'],
            "name"=>['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            "telephone"=>['required','max:255'],
            "usersId"=>['required']
        ];
        $mensagens = [
            "reason.required"=>"O Campo \"Razão Social\" é obrigatório",
            "reason.string"=>"O Campo \"Razão Social\" precisa ser to tipo texto",
            "reason.max"=>"O Campo \"Razão Social\" pode ter no maximo 255 caracteres",
            "name.required"=>"O Campo \"Nome Fantasia\" é obrigatório",
            "name.string"=>"O Campo \"Nome Fantasia\" precisa ser to tipo texto",
            "name.max"=>"O Campo \"Nome Fantasia\" pode ter no maximo 255 caracteres",
            "email.required"=>"O Campo \"Email SAC\" é obrigatório",
            "email.string"=>"O Campo \"Email SAC\" precisa ser to tipo texto",
            "email.max"=>"O Campo \"Email SAC\" pode ter no maximo 255 caracteres",
            "email.email"=>"O Campo \"Email SAC\" precisa ser um email válido",
            "telephone.required"=>"O Campo \"Telefone SAC\" é obrigatório",
            "telephone.max"=>"O Campo \"Telefone SAC\" pode ter no maximo 255 caracteres",
            'usersId.required'=>"O Campo \"User ID\" é obrigatório"
        ];
        $request->validate($regras,$mensagens);

        $servico = new Servico();
        $servico->users_id = $request->input('usersId');
        $servico->email = $request->input('email');
        $servico->telefone = $request->input('telephone');
        $servico->razaoSocial = $request->input('reason');
        $servico->nomeFantasia = $request->input('name');
        $servico->save();
        
        return redirect()->route('dashboard');
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
        $servico = Servico::find($id);
        if($servico == null){
            return redirect()->back();
        }else{
            $regras = [
                "reason"=>['required','string','max:255'],
                "name"=>['required','string','max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                "telephone"=>['required','max:255']
            ];
            $mensagens = [
                "reason.required"=>"O Campo \"Razão Social\" é obrigatório",
                "reason.string"=>"O Campo \"Razão Social\" precisa ser to tipo texto",
                "reason.max"=>"O Campo \"Razão Social\" pode ter no maximo 255 caracteres",
                "name.required"=>"O Campo \"Nome Fantasia\" é obrigatório",
                "name.string"=>"O Campo \"Nome Fantasia\" precisa ser to tipo texto",
                "name.max"=>"O Campo \"Nome Fantasia\" pode ter no maximo 255 caracteres",
                "email.required"=>"O Campo \"Email SAC\" é obrigatório",
                "email.string"=>"O Campo \"Email SAC\" precisa ser to tipo texto",
                "email.max"=>"O Campo \"Email SAC\" pode ter no maximo 255 caracteres",
                "email.email"=>"O Campo \"Email SAC\" precisa ser um email válido",
                "telephone.required"=>"O Campo \"Telefone SAC\" é obrigatório",
                "telephone.max"=>"O Campo \"Telefone SAC\" pode ter no maximo 255 caracteres"
            ];
            $request->validate($regras,$mensagens);
            $servico->email = $request->input('email');
            $servico->telefone = $request->input('telephone');
            $servico->razaoSocial = $request->input('reason');
            $servico->nomeFantasia = $request->input('name');
            $servico->save();
            $request->session()->flash('mensagemSucesso', "Os dados de serviço foram atualizados com sucesso");
            return redirect()->route("servico.index");
        }
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
