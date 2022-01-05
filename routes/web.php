<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\RastreamentoController;
use App\Http\Controllers\RemessaController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendedorController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Pagina Inicial
Route::get('/', function () {
    return view('landing');
});

Route::get('/dashboard', function () {
    if(Auth::user()->servico == null){
        return redirect()->route('servico.create');
    }else{
        return view('dashboard');
    }
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::post('/modelo/process', "App\Http\Controllers\ModeloController@process")->name('modelo.process')->middleware(['auth']);

Route::resource('cliente', ClienteController::class)->middleware(['auth']); //Rotas De Cliente
Route::resource('compra', CompraController::class)->middleware(['auth']); //Rotas De Compra
Route::resource('modelo', ModeloController::class)->middleware(['auth']); //Rotas De Compra
Route::resource('produto', ProdutoController::class)->middleware(['auth']); //Rotas De Produto
Route::resource('rastreamento', RastreamentoController::class)->middleware(['auth']); //Rotas De Rastreamento
Route::resource('remessa', RemessaController::class)->middleware(['auth']); //Rotas De Remessaa
Route::resource('servico', ServicoController::class)->middleware(['auth']); //Rotas De Servico
Route::resource('users', UserController::class)->middleware(['auth']); //Rotas De User
Route::resource('vendedor',VendedorController::class)->middleware(['auth']); //Rotas De Vendedor

//Rota De Geracao De Modelos

//Rotas De Datatable
Route::prefix('/api')->group(function (){ //// endereco/api
    Route::prefix('/datatables')->group(function () { //// endereco/api/datatables
        Route::get('/cliente', "App\Http\Controllers\ClienteController@datatableProvider")->name('datatables.cliente')->middleware(['auth']); //Cliente
        Route::get('/compra', "App\Http\Controllers\CompraController@datatableProvider")->name('datatables.compra')->middleware(['auth']); //Compra
        Route::get('/modelo', "App\Http\Controllers\ModeloController@datatableProvider")->name('datatables.modelo')->middleware(['auth']); //Modelo
        Route::get('/produto', "App\Http\Controllers\ProdutoController@datatableProvider")->name('datatables.produto')->middleware(['auth']); //Produto
        Route::get('/rastreamento', "App\Http\Controllers\RastreamentoController@datatableProvider")->name('datatables.rastreamento')->middleware(['auth']); //Rastreamento
        Route::get('/remessa', "App\Http\Controllers\RemessaController@datatableProvider")->name('datatables.remessa')->middleware(['auth']); //Remessa
        Route::get('/vendedor', "App\Http\Controllers\VendedorController@datatableProvider")->name('datatables.vendedor')->middleware(['auth']); //Vendedor
    });
});

//Rota De Sobre
Route::get('/sobre', function () {
    return view('outros.sobre');
})->name('sobre')->middleware(['auth']);

Route::get('/instrucoes', function () {
    return view('outros.comousar');
})->name('instrucoes')->middleware(['auth']);














//Pagina Testes Editor
Route::get('/editor', function () {
    return view('editor');
})->name("editor");

//Rota De Testes De Função
Route::get('/teste', function () {
    $compra = App\Models\Compra::where('id',1)->with(['servico','cliente','produto','produto.vendedor','remessa','remessa.rastreamento'])->get()[0];
    $caminho = ['remessa','linkRastreamento'];
    $copiaCompra = $compra;
    for($i = 0; $i < count($caminho); $i++){
        $copiaCompra = $copiaCompra[$caminho[$i]];
    }
    echo $copiaCompra;
    //return response($compra, 200, ["Content-Type"=>"text/plain"]);
})->middleware(['auth'])->name('teste');


Route::any('/receber', function (Request $request) {
    $textInput = $request->input("rawHtml");
    $pattern = "/({'[a-z\X+\.?]+'})/mi"; // Formato {'variavel'} aceita pontos para separar variaveis
    $repPatt = "/{|}|'/mi"; //Regex de remoção de chaves e aspas simples
    $matches = []; // Array de seleção de chaves pelo preg_match_all
    //Hardcode de teste
    $replacers = [
        "cliente.primeironome" => "Eduardo",
        "cliente.nomecompleto" => "Eduardo Fernandes Silva",
        "cliente.email" => "cliente@provedor.com",
        "produto.descricao" => "Produto Genérico",
        "produto.preco" => "R$200,00",
        "produto.quantidade" => "2",
        "produto.link.rast" => "link rastreamento",
        "produto.link.prod" => "link produto",
        "produto.pais" => "Brasil",
        "vendedor.nome"=>"Loja Genérica Nº 1"
    ];
    //Preg Match
    preg_match_all($pattern,$textInput,$matches);
    //Copia do Texto Recebido No Request Para processamento
    $proc = $textInput;
    /*Percorrendo array matches
    Key = Indice do array
    Value = chave da variavel a ser substituida */
    foreach ($matches[0] as $key => $value) {
        /* Percorrendo array de hardcoded replaces 
        chave = chave da variavel a ser substituida
        valor = valor que será posto no local da variavel
        */
        foreach($replacers as $chave => $valor){
            //Se o lowercase de valor for igual a chave
            if(str_contains(mb_strtolower($value, "UTF-8"), $chave)){
                //Altere
                $proc = str_replace($value,$valor,$proc);
            }
        }
    }
    echo"<html><head><meta charset='UTF-8'><title>Teste</title></head><body><div style='width: 50%; background-color: #ddd; margin: auto; padding: 10px; border-radius: 5px;'>";
    echo $proc;
    echo "</div></body></html>";
})->name("receber");

