<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Venda;
use App\Models\Produto;
use App\Models\Fornecedor;
use App\Models\User;
use App\Models\Dashboard;
use App\Models\CartItem;


class ProdutoController extends Controller
{
    public function index()
    {
       
        $produtos = Produto::with('fornecedor')->paginate(12); // 12 produtos por página

        return view('produtos.index', compact('produtos'));
    }
    
    public function create()
{
    $fornecedores = Fornecedor::all();
    return view('produtos.create', compact('fornecedores'));
}

public function store(Request $request)
{
    // Verificar se o usuário selecionou um fornecedor existente
    if ($request->has('fornecedor_id')) {
        $fornecedor_id = $request->input('fornecedor_id');
        $fornecedor = Fornecedor::find($fornecedor_id);
        if (!$fornecedor) {
            // Se o fornecedor não existe, criar um novo
            $fornecedor = new Fornecedor();
            $fornecedor->nome = $request->input('fornecedor_nome');
            $fornecedor->save();
        }
    } else {
        // Criar um novo fornecedor
        $fornecedor = new Fornecedor();
        $fornecedor->nome = $request->input('fornecedor_nome');
        $fornecedor->save();
        $fornecedor_id = $fornecedor->id;
    }

    // Criar o produto
    $produto = new Produto();
    $produto->fill($request->all());
    $produto->fornecedor_id = $fornecedor_id;
    $produto->save();

    return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
}

    public function edit($id)
    {
        $produto = Produto::find($id);
        $fornecedores = Fornecedor::all();
        return view('produtos.edit', compact('produto', 'fornecedores'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
            'fornecedor_id' => 'required|exists:fornecedores,id',
        ]);

        $produto = Produto::find($id);
        $produto->fill($request->all());
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);
        $produto->delete();

        return redirect()->route('produtos.index')->with('success', 'Produto excluído com sucesso!');
    }
}
