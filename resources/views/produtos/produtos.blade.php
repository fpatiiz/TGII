<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Adicionar Produto e Fornecedor') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Adicionar Produto e Fornecedor</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produtos.store') }}" method="POST">
                                @csrf
                                <!-- Fornecedor -->
                                <h5>Fornecedor</h5>
                                <div class="form-group">
                                    <label for="nome_fornecedor">Nome</label>
                                    <input type="text" name="nome_fornecedor" id="nome_fornecedor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="telefone_fornecedor">Telefone</label>
                                    <input type="text" name="telefone_fornecedor" id="telefone_fornecedor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="endereco_fornecedor">Endereço</label>
                                    <input type="text" name="endereco_fornecedor" id="endereco_fornecedor" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_fornecedor">Email</label>
                                    <input type="email" name="email_fornecedor" id="email_fornecedor" class="form-control" required>
                                </div>

                                <!-- Produto -->
                                <h5>Produto</h5>
                                <div class="form-group">
                                    <label for="nome_produto">Nome</label>
                                    <input type="text" name="nome_produto" id="nome_produto" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="descricao_produto">Descrição</label>
                                    <textarea name="descricao_produto" id="descricao_produto" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="preco_produto">Preço</label>
                                    <input type="number" name="preco_produto" id="preco_produto" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="quantidade_produto">Quantidade</label>
                                    <input type="number" name="quantidade_produto" id="quantidade_produto" class="form-control" required>
                                </div>

                                <button type="submit" class="btn btn-primary">Adicionar Produto e Fornecedor</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>