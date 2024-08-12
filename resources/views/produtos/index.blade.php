<!-- resources/views/produtos/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Botão para criar produto -->
                    <div class="mb-4">
                        <a href="{{ route('produtos.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle"></i> Criar produto
                        </a>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Fornecedor</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->preco }}</td>
                                <td>{{ $produto->quantidade }}</td>
                                <td>{{ $produto->fornecedor->nome }}</td>
                                <td>
                                   <!-- Formulário para editar o produto -->
                                   <form action="{{ route('produtos.edit', $produto->id) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-pencil-square"></i>
                                        </button>
                                    </form>

                                    <!-- Formulário para excluir o produto -->
                                    <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <!-- Links de paginação -->
                    <div class="mt-4">
                        {{ $produtos->links() }}
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>