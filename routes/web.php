<?php

use App\Http\Controllers\ContatoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SobreNosController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminClientesController;
use App\Http\Controllers\AdminEditController;
use App\Http\Controllers\AdminInsertController;
use App\Http\Controllers\CadastroController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

route::get('/', [HomeController::class, 'home'])->name('index');

route::get('/sobre-nos', [SobreNosController::class, 'aboutUs'])->name('about');

route::get('/contato', [ContatoController::class, 'contact' ])->name('contact');

route::get('/listaprodutos', [ProdutoController::class, 'produtos_list' ])->name('produtos_list');

route::get('/cadastro', [CadastroController::class, 'regist' ])->name('regist');

route::get('/login', [LoginController::class, 'login' ])->name('login');

route::get('/admin', [AdminController::class, 'adminLogin' ])->name('admin');

Route::prefix('admin')->group(function () {
route::get('/clientes', [AdminClientesController::class, 'adminClientes' ])->name('adminClientes');
route::get('/insert', [AdminInsertController::class, 'adminInsert' ])->name('adminInsert');
route::get('/editprodutos', [AdminEditController::class, 'adminEdit' ])->name('adminEdit');
route::get('/dashboard', [AdminDashboardController::class, 'adminDashboard' ])->name('adminDashboard');
});

