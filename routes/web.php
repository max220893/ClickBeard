<?php

use App\Http\Controllers\AgendamentoController;
use App\Http\Controllers\EspecialidadeController;
use App\Http\Controllers\BarbeiroController;
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
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [AgendamentoController::class, 'index'])->middleware(['auth'])
    ->name('dashboard');

Route::resource('especialidades', EspecialidadeController::class)->middleware(['auth', 'admin']);
Route::resource('barbeiros', BarbeiroController::class)->middleware(['auth', 'admin']);

Route::get('/agendamentos/barbeiro-disponivel', [AgendamentoController::class, 'barbeiroDisponivel'])->middleware(['auth']);
Route::resource('agendamentos', AgendamentoController::class)->middleware(['auth']);



require __DIR__ . '/auth.php';
