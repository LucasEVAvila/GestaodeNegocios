<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciar Produtos - Minha Loja</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .table-actions {
            white-space: nowrap;
            width: 120px;
        }
        
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
        
        .alert-auto-hide {
            animation: fadeOut 3s forwards;
            animation-delay: 2s;
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; display: none; }
        }
    </style>
</head>
<body>
    @extends('components.layout.app')

    @section('title', 'Gerenciar Produtos - Admin')

    @section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciamento de Produtos</h1>
            <button class="btn btn-primary" onclick="abrirModal()">
                <i class="fas fa-plus me-2"></i>Adicionar Produto
            </button>
        </div>

        <div id="alertContainer"></div>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Estoque</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaProdutos">
                            <!-- Produtos serão carregados aqui via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Adicionar/Editar Produto -->
    <div class="modal fade" id="produtoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Adicionar Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="produtoForm">
                        <input type="hidden" id="produtoId">
                        <div class="mb-3">
                            <label for="produtoNome" class="form-label">Nome do Produto *</label>
                            <input type="text" class="form-control" id="produtoNome" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="produtoPreco" class="form-label">Preço (R$) *</label>
                                <input type="number" step="0.01" class="form-control" id="produtoPreco" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="produtoEstoque" class="form-label">Estoque *</label>
                                <input type="number" class="form-control" id="produtoEstoque" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="produtoDescricao" class="form-label">Descrição</label>
                            <textarea class="form-control" id="produtoDescricao" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="produtoImagem" class="form-label">URL da Imagem</label>
                            <input type="url" class="form-control" id="produtoImagem" placeholder="https://...">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="salvarProduto()">Salvar Produto</button>
                </div>
            </div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Variáveis globais
        let produtos = JSON.parse(localStorage.getItem('produtos')) || [];
        let produtoModal = null;
        let editingId = null;

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            produtoModal = new bootstrap.Modal(document.getElementById('produtoModal'));
            carregarProdutos();
            
            // Inicializar alguns produtos de exemplo se estiver vazio
            if (produtos.length === 0) {
                inicializarProdutosExemplo();
            }
        });

        // Inicializar produtos de exemplo
        function inicializarProdutosExemplo() {
            produtos = [
                { 
                    id: 1, 
                    nome: "Smartphone Premium", 
                    preco: 1599.00, 
                    estoque: 15, 
                    descricao: "Smartphone de última geração com câmera de 108MP",
                    imagem: "https://via.placeholder.com/60" 
                },
                { 
                    id: 2, 
                    nome: "Notebook Gamer", 
                    preco: 3499.00, 
                    estoque: 8, 
                    descricao: "Notebook para jogos com RTX 3060",
                    imagem: "https://via.placeholder.com/60" 
                },
                { 
                    id: 3, 
                    nome: "Fones Bluetooth", 
                    preco: 299.00, 
                    estoque: 20, 
                    descricao: "Fones sem fio com cancelamento de ruído ativo",
                    imagem: "https://via.placeholder.com/60" 
                }
            ];
            salvarNoLocalStorage();
            carregarProdutos();
        }

        // Salvar produtos no localStorage
        function salvarNoLocalStorage() {
            localStorage.setItem('produtos', JSON.stringify(produtos));
        }

        // Carregar produtos na tabela
        function carregarProdutos() {
            const tabela = document.getElementById('tabelaProdutos');
            tabela.innerHTML = '';
            
            if (produtos.length === 0) {
                tabela.innerHTML = `
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            <i class="fas fa-box-open fa-2x mb-2 text-muted"></i>
                            <p class="text-muted">Nenhum produto cadastrado</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            produtos.forEach(produto => {
                const row = tabela.insertRow();
                row.innerHTML = `
                    <td>
                        <img src="${produto.imagem || 'https://via.placeholder.com/60'}" 
                             class="product-image" 
                             alt="${produto.nome}"
                             onerror="this.src='https://via.placeholder.com/60'">
                    </td>
                    <td>${produto.nome}</td>
                    <td>R$ ${produto.preco.toFixed(2)}</td>
                    <td>${produto.estoque}</td>
                    <td class="table-actions text-center">
                        <button class="btn btn-sm btn-primary me-1" onclick="editarProduto(${produto.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="excluirProduto(${produto.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            });
        }

        // Abrir modal para adicionar/editar
        function abrirModal(id = null) {
            editingId = id;
            const form = document.getElementById('produtoForm');
            const modalTitle = document.getElementById('modalTitle');
            
            if (id) {
                // Modo edição
                modalTitle.textContent = 'Editar Produto';
                const produto = produtos.find(p => p.id === id);
                if (produto) {
                    document.getElementById('produtoId').value = produto.id;
                    document.getElementById('produtoNome').value = produto.nome;
                    document.getElementById('produtoPreco').value = produto.preco;
                    document.getElementById('produtoEstoque').value = produto.estoque;
                    document.getElementById('produtoDescricao').value = produto.descricao || '';
                    document.getElementById('produtoImagem').value = produto.imagem || '';
                }
            } else {
                // Modo adição
                modalTitle.textContent = 'Adicionar Novo Produto';
                form.reset();
                document.getElementById('produtoId').value = '';
            }
            
            produtoModal.show();
        }

        // Salvar produto (criar ou atualizar)
        function salvarProduto() {
            const form = document.getElementById('produtoForm');
            const id = document.getElementById('produtoId').value;
            const nome = document.getElementById('produtoNome').value;
            const preco = parseFloat(document.getElementById('produtoPreco').value);
            const estoque = parseInt(document.getElementById('produtoEstoque').value);
            const descricao = document.getElementById('produtoDescricao').value;
            const imagem = document.getElementById('produtoImagem').value;

            // Validação
            if (!nome || isNaN(preco) || isNaN(estoque)) {
                mostrarAlerta('Por favor, preencha todos os campos obrigatórios.', 'danger');
                return;
            }

            if (id) {
                // Editar produto existente
                const index = produtos.findIndex(p => p.id == id);
                if (index !== -1) {
                    produtos[index] = { 
                        id: parseInt(id), 
                        nome, 
                        preco, 
                        estoque, 
                        descricao, 
                        imagem 
                    };
                    mostrarAlerta('Produto atualizado com sucesso!', 'success');
                }
            } else {
                // Adicionar novo produto
                const novoId = produtos.length > 0 ? Math.max(...produtos.map(p => p.id)) + 1 : 1;
                produtos.push({ 
                    id: novoId, 
                    nome, 
                    preco, 
                    estoque, 
                    descricao, 
                    imagem 
                });
                mostrarAlerta('Produto adicionado com sucesso!', 'success');
            }

            salvarNoLocalStorage();
            carregarProdutos();
            produtoModal.hide();
            form.reset();
        }

        // Editar produto
        function editarProduto(id) {
            abrirModal(id);
        }

        // Excluir produto
        function excluirProduto(id) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                produtos = produtos.filter(p => p.id !== id);
                salvarNoLocalStorage();
                carregarProdutos();
                mostrarAlerta('Produto excluído com sucesso!', 'success');
            }
        }

        // Mostrar alerta
        function mostrarAlerta(mensagem, tipo) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();
            
            alertContainer.innerHTML = `
                <div id="${alertId}" class="alert alert-${tipo} alert-auto-hide alert-dismissible fade show" role="alert">
                    ${mensagem}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            // Remover alerta após 3 segundos
            setTimeout(() => {
                const alert = document.getElementById(alertId);
                if (alert) {
                    alert.remove();
                }
            }, 3000);
        }
    </script>
    @endsection
</body>
</html>