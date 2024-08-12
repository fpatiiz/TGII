<!-- resources/views/vendas/cart.blade.php -->
<ul class="list-group mb-3">
    @php
        // Agrupar os itens por produto
        $products = $carrinho->groupBy('produto_id');
    @endphp
    @foreach($products as $productId => $items)
        @php
            $product = $items->first()->produto;
            $quantity = $items->sum('quantidade_vendida');
            $totalPrice = $quantity * $product->preco;
        @endphp
        <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
                <h6 class="my-0">{{ $product->nome }}</h6>
                <small class="text-body-secondary">{{ $product->descricao }}</small>
            </div>
            <div>
                <span class="text-body-secondary">Preço unitário: R$ {{ $product->preco }}</span><br>
                <span class="text-body-secondary">Quantidade: {{ $quantity }}</span><br>
                <span class="text-body-secondary">Total: R$ {{ $totalPrice }}</span>
            </div>
            @foreach($items as $item)
                <form action="{{ route('vendas.remove', $item->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="number" name="quantity" value="1" min="1" max="{{ $item->quantidade_vendida }}" class="form-control" size="3" style="width: 8ch;"> 
                    <button type="submit" class="btn btn-danger">
    <i class="bi bi-trash"></i>
</button>                </form>
            @endforeach
        </li>
    @endforeach
</ul>
<p>Subtotal: R$ {{ $total }}</p>
<a href="{{ route('vendas.checkout') }}" class="btn btn-primary">Finalizar Compra</a>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
