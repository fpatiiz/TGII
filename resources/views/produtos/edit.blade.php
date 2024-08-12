<!-- resources/views/produtos/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('produtos.update', $produto->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" value="{{ $produto->nome }}" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" class="form-control" required>{{ $produto->descricao }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input type="number" name="preco" class="form-control" value="{{ $produto->preco }}" required>
                        </div>

                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" value="{{ $produto->quantidade }}" required>
                        </div>

                        <div class="form-group">
                            <label for="fornecedor_id">Fornecedor</label>
                            <select name="fornecedor_id" class="form-control" disabled>
                                @foreach($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}" {{ $produto->fornecedor_id == $fornecedor->id ? 'selected' : '' }}>{{ $fornecedor->nome }}</option>
                                @endforeach
                            </select>
                            <!-- Campo oculto para garantir que o valor do fornecedor seja enviado -->
                            <input type="hidden" name="fornecedor_id" value="{{ $produto->fornecedor_id }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
   
    
</x-app-layout>