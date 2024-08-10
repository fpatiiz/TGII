<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use App\Models\Venda;


class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::MaisVendidos()->get();
        

        return view('produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $produto = new Produto();
        $produto->fill($request->all());
        $produto->save();

        return redirect()->route('produtos.index')->with('success', 'Produto criado com sucesso!');
    }

    public function edit($id)
    {
        $produto = Produto::find($id);

        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required',
            'descricao' => 'required',
            'preco' => 'required|numeric',
            'quantidade' => 'required|integer',
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