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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rotas para produtos
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{id}/edit', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::patch('/produtos/{id}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{id}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');

     // Rotas para vendas
     Route::get('/vendas', [VendaController::class, 'index'])->name('vendas.index');
     Route::post('/vendas/add-to-cart/{id}', [VendaController::class, 'addToCart'])->name('addToCart');
     Route::get('/vendas/remove-from-cart/{id}', [VendaController::class, 'removeFromCart'])->name('removeFromCart');
     Route::post('/vendas/checkout', [VendaController::class, 'checkout'])->name('vendas.checkout');
     Route::post('/vendas/add-multiple-to-cart', [VendaController::class, 'addMultipleToCart'])->name('addMultipleToCart');
 });

require __DIR__.'/auth.php';
