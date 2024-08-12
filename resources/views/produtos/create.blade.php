<!-- resources/views/produtos/create.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criar Produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('produtos.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="nome">Nome</label>
                            <input type="text" name="nome" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" class="form-control" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input type="number" name="preco" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="quantidade">Quantidade</label>
                            <input type="number" name="quantidade" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="fornecedor_id">Fornecedor</label>
                            <select name="fornecedor_id" class="form-control" required>
                                <option value="">Selecione um fornecedor</option>
                                @foreach($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#createFornecedorModal">Criar novo fornecedor</button>
                        </div>

                        <!-- Modal para criar novo fornecedor -->
                        <div class="modal fade" id="createFornecedorModal" tabindex="-1" role="dialog" aria-labelledby="createFornecedorModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createFornecedorModalLabel">Criar novo fornecedor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="fornecedor_nome" class="form-control" placeholder="Nome do fornecedor">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Criar fornecedor</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Criar produto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>