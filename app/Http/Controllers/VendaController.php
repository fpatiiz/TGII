<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    // Exibe a lista de produtos e o carrinho
    public function index(Request $request)
    {
        $produtos = Produto::all();
        $user = Auth::user();
        $carrinho = $user ? $user->vendas : collect(); // Usar coleção vazia se o usuário não estiver autenticado
        $total = $carrinho->sum('valor_total');

        // Se o usuário selecionou produtos para adicionar ao carrinho
        if ($request->has('produtos')) {
            $this->addMultipleToCart($request);
        }

        return view('vendas.index', compact('produtos', 'carrinho', 'total'));
    }

    // Adiciona múltiplos produtos ao carrinho
    public function addMultipleToCart(Request $request)
    {
        $produtosSelecionados = $request->input('produtos', []);
        $user = Auth::user();

        foreach ($produtosSelecionados as $produtoId) {
            $produto = Produto::find($produtoId);

            if ($produto) {
                $existingItem = $user->vendas()->where('produto_id', $produtoId)->first();

                if ($existingItem) {
                    $existingItem->quantidade_vendida += 1;
                    $existingItem->valor_total = $produto->preco * $existingItem->quantidade_vendida;
                    $existingItem->save();
                } else {
                    $venda = new Venda();
                    $venda->user_id = $user->id;
                    $venda->produto_id = $produtoId;
                    $venda->valor_total = $produto->preco;
                    $venda->quantidade_vendida = 1;
                    $venda->save();
                }
            }
        }

        return redirect()->route('vendas.index');
    }

    // Remove um produto do carrinho
    public function removeFromCart($id)
    {
        $user = Auth::user();
        if ($user) {
            $user->vendas()->where('produto_id', $id)->delete();
        }
        return redirect()->route('vendas.index');
    }

    // Exibe o carrinho do usuário
    public function cart()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('vendas.index')->with('error', 'Você precisa estar logado para acessar o carrinho.');
        }
        $carrinho = $user->vendas;
        $total = $carrinho->sum('valor_total');
        $produtos = Produto::all(); // Adiciona produtos para exibir na visão
        return view('vendas.index', compact('carrinho', 'total', 'produtos'));
    }

    // Finaliza a compra
    public function checkout()

    {
    
        $user = Auth::user();
    
        $carrinho = $user->vendas;
    
    
        if ($carrinho->isEmpty()) {
    
            return redirect()->route('vendas.index')->with('error', 'Seu carrinho está vazio.');
    
        }
    
    
        DB::beginTransaction();
    
        try {
    
            foreach ($carrinho as $item) {
    
                $produto = Produto::find($item->produto_id);
    
    
                if ($produto->quantidade < $item->quantidade_vendida) {
    
                    DB::rollBack();
    
                    return redirect()->route('vendas.index')->with('error', 'Quantidade insuficiente para o produto: ' . $produto->nome);
    
                }
    
    
                $produto->quantidade -= $item->quantidade_vendida;
    
                $produto->save();
    
    
                // Removi a linha que tentava salvar o campo 'data_venda'
    
                $venda = new Venda();
    
                $venda->user_id = $user->id;
    
                $venda->produto_id = $item->produto_id;
    
                $venda->valor_total = $item->valor_total;
    
                $venda->quantidade_vendida = $item->quantidade_vendida;
    
                $venda->save();
    
            }
    
    
            $user->vendas()->delete();
    
            DB::commit();
    
    
            return redirect()->route('vendas.index')->with('success', 'Compra finalizada com sucesso!');
    
        } catch (\Exception $e) {
    
            DB::rollBack();
    
            return redirect()->route('vendas.index')->with('error', 'Ocorreu um erro ao processar a compra. Tente novamente.');
    
        }
    
    }}