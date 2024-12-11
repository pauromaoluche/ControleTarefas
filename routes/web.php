<?php

use App\Http\Controllers\TarefaController;
use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]);

Route::resource('tarefa', TarefaController::class)->middleware(['auth', 'verified']);

Route::get('/tarefa-export', [TarefaController::class, 'export'])->name('tarefa-export')->middleware(['auth', 'verified']);

Route::get('/email-teste', function(){
    return new MensagemTesteMail();
});
