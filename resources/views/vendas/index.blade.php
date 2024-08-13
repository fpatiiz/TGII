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
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body ">
                            <form action="{{ route('vendas.add') }}" method="POST">
                                @csrf
                                <div class="table-responsive">
                                    <table class="table small my-2 ">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Produto</th>
                                                <th>Descrição</th>
                                                <th>Preço(R$)</th>
                                                <th>Disponível</th>
                                                <th>Quantidade</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($produtos as $produto)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="produtos[]" value="{{ $produto->id }}">
                                                    </td>
                                                    <td>{{ $produto->nome }}</td>
                                                    <td>{{ $produto->descricao }}</td>
                                                    <td>{{ number_format($produto->preco, 2, ',', '.') }}</td>                                                    <td>{{ $produto->quantidade }} un.</td>
                                                    <td>
                                                        <input type="number" name="quantidades[{{ $produto->id }}]" value="1" min="1" max="{{ $produto->quantidade }}" class="form-control form-control-sm" size="3" style="width: 8ch;">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Adicionar ao Carrinho</button>
                            </form>

                            <!-- Links de paginação -->
                            <div class="mt-4">
                                {{ $produtos->render('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carrinho -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Seu Carrinho</h4>
                        </div>
                        <div class="card-body">
                            @include('vendas.cart', ['carrinho' => $carrinho, 'total' => $total])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>