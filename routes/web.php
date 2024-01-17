<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AlunoController;

//////////////////////////////////// ROTAS CRIADAS AUTOMÁTICAMENTE

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

////////////////////////////////////MINHAS ROTAS CRIADAS

//PÁGINA INICIAL
Route::get('/', function () {
    return view('index');
});

//ROTAS PARA CRUD DE ALUNOS
Route::get('/alunos/create', [AlunoController::class, 'create'])->name('alunos.create');
Route::post('/alunos', [AlunoController::class, 'store'])->name('alunos.store');
Route::get('/alunos/{id}/edit', [AlunoController::class, 'edit'])->name('alunos.edit');
Route::put('/alunos/{id}', [AlunoController::class, 'update'])->name('alunos.update');
Route::get('/alunos/{id}/delete', [AlunoController::class, 'delete'])->name('alunos.delete');
//Route::delete('/alunos/{id}', [AlunoController::class, 'destroy'])->name('alunos.destroy');

//ROTA PARA LISTAGEM DE ALUNOS
Route::get('/alunos', [AlunoController::class, 'alunos'])->name('alunos.index')->middleware('auth');

//ROTA PARA DELETAR ALUNOS
Route::delete('/alunos/{aluno}', [AlunoController::class, 'destroy'])->name('alunos.destroy');
