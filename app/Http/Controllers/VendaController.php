<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class VendaController extends Controller
{
    // Exibe a lista de produtos e o carrinho
    public function index(Request $request)
    {
        $produtos = Produto::all();
        $user = Auth::user();
        $carrinho = $user ? $user->vendas : collect(); // Usar coleção vazia se o usuário não estiver autenticado
        $total = $carrinho->sum('valor_total');

        return view('vendas.index', compact('produtos', 'carrinho', 'total'));
    }

    // Adiciona múltiplos produtos ao carrinho
    public function addMultipleToCart(Request $request)
    {
        $produtosSelecionados = $request->input('produtos', []);
        $quantidades = $request->input('quantidades', []);
    
        $user = Auth::user();
    
        foreach ($produtosSelecionados as $produtoId) {
            $produto = Produto::find($produtoId);
    
            if ($produto) {
                $existingItem = $user->vendas()->where('produto_id', $produtoId)->first();
    
                if ($existingItem) {
                    $quantityToAdd = $quantidades[$produtoId];
    
                    if ($produto->quantidade >= $existingItem->quantidade_vendida + $quantityToAdd) {
                        $existingItem->quantidade_vendida += $quantityToAdd;
                        $existingItem->valor_total = $produto->preco * $existingItem->quantidade_vendida;
                        $existingItem->save();
    
                        $produto->quantidade -= $quantityToAdd;
                        $produto->save();
                    } else {
                        return redirect()->route('vendas.index')->with('error', 'Quantidade insuficiente para o produto: ' . $produto->nome);
                    }
                } else {
                    $quantityToAdd = $quantidades[$produtoId];
    
                    if ($produto->quantidade >= $quantityToAdd) {
                        $venda = new Venda();
                        $venda->user_id = $user->id;
                        $venda->produto_id = $produtoId;
                        $venda->valor_total = $produto->preco * $quantityToAdd;
                        $venda->quantidade_vendida = $quantityToAdd;
                        $venda->save();
    
                        $produto->quantidade -= $quantityToAdd;
                        $produto->save();
                    } else {
                        return redirect()->route('vendas.index')->with('error', 'Quantidade insuficiente para o produto: ' . $produto->nome);
                    }
                }
            }
        }
    
        return redirect()->route('vendas.index');
    }
    // Remove um produto do carrinho
    public function removeFromCart(Request $request, $itemId)
    {
        $user = Auth::user();
        if ($user) {
            $item = $user->vendas()->where('id', $itemId)->first();
    
            if ($item) {
                $quantityToRemove = $request->input('quantity', 1);
    
                if ($quantityToRemove < 1) {
                    return redirect()->route('vendas.index')->with('error', 'Quantidade inválida para remover.');
                }
    
                if ($quantityToRemove >= $item->quantidade_vendida) {
                    // Remove o item do carrinho
                    $user->vendas()->where('id', $itemId)->delete();
    
                    // Retorna a quantidade total para o estoque
                    $produto = Produto::find($item->produto_id);
                    if ($produto) {
                        $produto->quantidade += $item->quantidade_vendida;
                        $produto->save();
                    }
                } else {
                    // Atualiza a quantidade do item no carrinho
                    $item->quantidade_vendida -= $quantityToRemove;
                    $item->valor_total = $item->produto->preco * $item->quantidade_vendida;
                    $item->save();
    
                    // Retorna a quantidade removida para o estoque
                    $produto = Produto::find($item->produto_id);
                    if ($produto) {
                        $produto->quantidade += $quantityToRemove;
                        $produto->save();
                    }
                }
            }
        }
        return redirect()->route('vendas.index');
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
    }

    
}