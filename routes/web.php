<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('master');
});

Route::get('/dashboard', function () {
    $vendas = App\Models\Venda::all();
    $produtos = App\Models\Produto::all();
    return view('dashboard', compact('vendas', 'produtos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Product routes
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::patch('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

    // Sales routes
    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
    Route::post('/vendas/add', [VendaController::class, 'addMultipleToCart'])->name('vendas.add');
    Route::delete('/vendas/remove/{itemId}', [VendaController::class, 'removeFromCart'])->name('vendas.remove');
    Route::patch('/vendas/update/{itemId}', [VendaController::class, 'updateItemQuantity'])->name('vendas.update');
    Route::get('/vendas/checkout', [VendaController::class, 'checkout'])->name('vendas.checkout');
});

require __DIR__.'/auth.php';