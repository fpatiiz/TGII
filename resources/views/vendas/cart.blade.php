<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carrinho') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
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
            <a href="{{ route('checkout') }}" class="btn btn-primary">Finalizar Compra</a>

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
        </div>
    </div>
</x-app-layout>
