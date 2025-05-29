<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('site');
});
Route::get('/site', [App\Http\Controllers\SiteController::class, 'index'])->name('site');

Auth::routes(['register' => true, 'reset' => false]);

Route::match(['get', 'post'],'/perfis', [App\Http\Controllers\PerfisController::class, 'index'])->name('perfis')->middleware('afterAuth:perfis');
Route::match(['get', 'post'],'/alterar-perfis', [App\Http\Controllers\PerfisController::class, 'alterar'])->name('alterar-perfis')->middleware('afterAuth:perfis');
Route::match(['get', 'post'],'/incluir-perfis', [App\Http\Controllers\PerfisController::class, 'incluir'])->name('incluir-perfis')->middleware('afterAuth:perfis');


Route::get('admin/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
Route::post('admin/alterar-senha', [App\Http\Controllers\SettingsController::class, 'edit'])->name('alterar-senha');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/pessoas', [App\Http\Controllers\PessoasController::class, 'index'])->name('pessoas')->middleware('afterAuth:pessoas');
Route::match(['get', 'post'],'/alterar-pessoas', [App\Http\Controllers\PessoasController::class, 'alterar'])->name('alterar-pessoas')->middleware('afterAuth:pessoas');
Route::match(['get', 'post'],'/incluir-pessoas', [App\Http\Controllers\PessoasController::class, 'incluir'])->name('incluir-pessoas')->middleware('afterAuth:pessoas');

Route::get('/indicacoes', [App\Http\Controllers\IndicacoesController::class, 'index'])->name('indicacoes')->middleware('afterAuth:indicacoes');
Route::match(['get', 'post'],'/alterar-indicacoes', [App\Http\Controllers\IndicacoesController::class, 'alterar'])->name('alterar-indicacoes')->middleware('afterAuth:indicacoes');
Route::match(['get', 'post'],'/incluir-indicacoes', [App\Http\Controllers\IndicacoesController::class, 'incluir'])->name('incluir-indicacoes')->middleware('afterAuth:indicacoes');

Route::get('/indicacoes-controle', [App\Http\Controllers\IndicacoesControleController::class, 'index'])->name('indicacoes-controle')->middleware('afterAuth:indicacoes-controle');
Route::match(['get', 'post'],'/alterar-indicacoes-controle', [App\Http\Controllers\IndicacoesControleController::class, 'alterar'])->name('alterar-indicacoes-controle')->middleware('afterAuth:indicacoes-controle');
Route::match(['get', 'post'],'/incluir-indicacoes-controle', [App\Http\Controllers\IndicacoesControleController::class, 'incluir'])->name('incluir-indicacoes-controle')->middleware('afterAuth:indicacoes-controle');
