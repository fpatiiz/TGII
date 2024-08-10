<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use App\Models\Venda;
use App\Models\Produto;

class FornecedorController extends Controller
{
    public function index()

    {

        $fornecedores = Fornecedor::all();

        return view('fornecedores.index', compact('fornecedores'));

    }


    public function create()

    {

        return view('fornecedores.create');

    }


    public function store(Request $request)

    {

        $fornecedor = new Fornecedor();

        $fornecedor->nome = $request->nome;

        $fornecedor->telefone = $request->telefone;

        $fornecedor->endereco = $request->endereco;

        $fornecedor->email = $request->email;

        $fornecedor->save();

        return redirect()->route('fornecedores.index');

    }


    public function edit($id)

    {

        $fornecedor = Fornecedor::find($id);

        return view('fornecedores.edit', compact('fornecedor'));

    }


    public function update(Request $request, $id)

    {

        $fornecedor = Fornecedor::find($id);

        $fornecedor->nome = $request->nome;

        $fornecedor->telefone = $request->telefone;

        $fornecedor->endereco = $request->endereco;

        $fornecedor->email = $request->email;

        $fornecedor->save();

        return redirect()->route('fornecedores.index');

    }


    public function destroy($id)

    {

        $fornecedor = Fornecedor::find($id);

        $fornecedor->delete();

        return redirect()->route('fornecedores.index');

    }
}
