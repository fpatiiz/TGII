<!-- resources/views/vendas/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos e Carrinho') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <!-- Coluna de Produtos -->
                <div class="col-md-6">
                    <h4>Lista de Produtos</h4>
                    <form action="{{ route('addMultipleToCart') }}" method="POST">
    @csrf
    <div class="list-group">
        @foreach($produtos as $produto)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1">{{ $produto->nome }}</h5>
                    <p class="mb-1">{{ $produto->descricao }}</p>
                    <p class="mb-1">Preço: R$ {{ $produto->preco }}</p>
                </div>
                <input type="checkbox" name="produtos[]" value="{{ $produto->id }}">
            </div>
        @endforeach
    </div>
    <button type="submit" class="btn btn-primary mt-3">Adicionar ao Carrinho</button>
</form>

                </div>

                <!-- Coluna do Carrinho -->
                <div class="col-md-6">
                    <h4>Seu Carrinho</h4>
                    <ul class="list-group mb-3">
                        @foreach($carrinho as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">{{ $item->produto->nome }}</h6>
                                    <small class="text-body-secondary">{{ $item->produto->descricao }}</small>
                                </div>
                                <span class="text-body-secondary">R$ {{ $item->produto->preco }}</span>
                                <a href="{{ route('removeFromCart', $item->produto->id) }}" class="btn btn-danger">Remover</a>
                            </li>
                        @endforeach
                    </ul>
                    <p>Total: R$ {{ $total }}</p>
                    <a href="{{ route('vendas.checkout') }}" class="btn btn-primary">Finalizar Compra</a>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
