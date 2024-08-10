<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venda;

class VendaController extends Controller
{
    public function index()

    {

        $vendas = Venda::all();

        return view('vendas.index', compact('vendas'));

    }


    public function create()

    {

        return view('vendas.create');

    }


    public function store(Request $request)

    {

        $venda = new Venda();

        $venda->data_venda = $request->data_venda;

        $venda->user_id = $request->user_id;

        $venda->produto_id = $request->produto_id;

        $venda->valor_total = $request->valor_total;

        $venda->quantidade_vendida = $request->quantidade_vendida;

        $venda->save();

        return redirect()->route('vendas.index');

    }


    public function edit($id)

    {

        $venda = Venda::find($id);

        return view('vendas.edit', compact('venda'));

    }


    public function update(Request $request, $id)

    {

        $venda = Venda::find($id);

        $venda->data_venda = $request->data_venda;

        $venda->user_id = $request->user_id;

        $venda->produto_id = $request->produto_id;

        $venda->valor_total = $request->valor_total;

        $venda->quantidade_vendida = $request->quantidade_vendida;

        $venda->save();

        return redirect()->route('vendas.index');

    }


    public function destroy($id)

    {

        $venda = Venda::find($id);

        $venda->delete();

        return redirect()->route('vendas.index');

    }

    
}
