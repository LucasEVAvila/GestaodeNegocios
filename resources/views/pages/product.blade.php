<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Produtos - Minha Loja</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .product-card {
            transition: transform 0.3s;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
        }
        
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        
        .card-body {
            display: flex;
            flex-direction: column;
        }
        
        .card-text {
            flex-grow: 1;
        }
        
        .price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #0d6efd;
        }
        
        .out-of-stock {
            opacity: 0.7;
        }
        
        .out-of-stock-badge {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
    @extends('components.layout.app')

    @section('title', 'Produtos - Minha Loja')

    @section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Nossos Produtos</h1>
        
        <!-- Filtros e Busca -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar produtos..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button" onclick="filtrarProdutos()">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="sortSelect" onchange="filtrarProdutos()">
                    <option value="">Ordenar por</option>
                    <option value="name_asc">Nome (A-Z)</option>
                    <option value="name_desc">Nome (Z-A)</option>
                    <option value="price_asc">Preço (Menor > Maior)</option>
                    <option value="price_desc">Preço (Maior > Menor)</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="stockSelect" onchange="filtrarProdutos()">
                    <option value="">Todos os produtos</option>
                    <option value="in_stock">Em estoque</option>
                    <option value="out_of_stock">Esgotados</option>
                </select>
            </div>
        </div>

        <!-- Lista de Produtos -->
        <div class="row" id="produtos-container">
            <!-- Produtos serão carregados aqui via JavaScript -->
        </div>

        <!-- Mensagem quando não há produtos -->
        <div id="no-products" class="text-center py-5" style="display: none;">
            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">Nenhum produto encontrado</h4>
            <p class="text-muted">Tente ajustar os filtros de busca</p>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script>
        // Carregar produtos ao iniciar a página
        document.addEventListener('DOMContentLoaded', function() {
            carregarProdutos();
        });

        // Carregar produtos do localStorage
        function carregarProdutos() {
            const produtos = JSON.parse(localStorage.getItem('produtos')) || [];
            const container = document.getElementById('produtos-container');
            const noProducts = document.getElementById('no-products');
            
            // Limpar container
            container.innerHTML = '';
            
            if (produtos.length === 0) {
                noProducts.style.display = 'block';
                return;
            }
            
            noProducts.style.display = 'none';
            
            // Adicionar produtos ao container
            produtos.forEach(produto => {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';
                
                const isOutOfStock = produto.estoque === 0;
                
                col.innerHTML = `
                    <div class="card product-card ${isOutOfStock ? 'out-of-stock' : ''}">
                        ${isOutOfStock ? 
                            '<span class="badge bg-danger out-of-stock-badge">Esgotado</span>' : 
                            ''
                        }
                        <img src="${produto.imagem || 'https://via.placeholder.com/300x200'}" 
                             class="card-img-top product-image" 
                             alt="${produto.nome}"
                             onerror="this.src='https://via.placeholder.com/300x200'">
                        <div class="card-body">
                            <h5 class="card-title">${produto.nome}</h5>
                            <p class="card-text">${produto.descricao || 'Descrição não disponível.'}</p>
                            <div class="mt-auto">
                                <p class="price">R$ ${produto.preco.toFixed(2)}</p>
                                <p class="card-text">
                                    <small class="text-${produto.estoque > 0 ? 'success' : 'danger'}">
                                        ${produto.estoque > 0 ? 
                                            `${produto.estoque} unidades em estoque` : 
                                            'Produto esgotado'
                                        }
                                    </small>
                                </p>
                                <div class="d-grid gap-2">
                                    ${produto.estoque > 0 ? 
                                        `<button class="btn btn-primary" onclick="adicionarAoCarrinho(${produto.id})">
                                            <i class="fas fa-shopping-cart me-2"></i>Comprar
                                         </button>` :
                                        `<button class="btn btn-outline-secondary" disabled>
                                            Produto Indisponível
                                         </button>`
                                    }
                                    <button class="btn btn-outline-secondary" onclick="verDetalhes(${produto.id})">
                                        <i class="fas fa-info-circle me-2"></i>Detalhes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.appendChild(col);
            });
        }

        // Filtrar produtos
        function filtrarProdutos() {
            const produtos = JSON.parse(localStorage.getItem('produtos')) || [];
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const sortOption = document.getElementById('sortSelect').value;
            const stockOption = document.getElementById('stockSelect').value;
            
            let produtosFiltrados = produtos.filter(produto => {
                // Filtro por busca
                const matchesSearch = produto.nome.toLowerCase().includes(searchTerm) ||
                                    (produto.descricao && produto.descricao.toLowerCase().includes(searchTerm));
                
                // Filtro por estoque
                let matchesStock = true;
                if (stockOption === 'in_stock') {
                    matchesStock = produto.estoque > 0;
                } else if (stockOption === 'out_of_stock') {
                    matchesStock = produto.estoque === 0;
                }
                
                return matchesSearch && matchesStock;
            });
            
            // Ordenação
            switch(sortOption) {
                case 'name_asc':
                    produtosFiltrados.sort((a, b) => a.nome.localeCompare(b.nome));
                    break;
                case 'name_desc':
                    produtosFiltrados.sort((a, b) => b.nome.localeCompare(a.nome));
                    break;
                case 'price_asc':
                    produtosFiltrados.sort((a, b) => a.preco - b.preco);
                    break;
                case 'price_desc':
                    produtosFiltrados.sort((a, b) => b.preco - a.preco);
                    break;
            }
            
            // Atualizar a exibição
            const container = document.getElementById('produtos-container');
            const noProducts = document.getElementById('no-products');
            
            container.innerHTML = '';
            
            if (produtosFiltrados.length === 0) {
                noProducts.style.display = 'block';
                return;
            }
            
            noProducts.style.display = 'none';
            
            // Adicionar produtos filtrados
            produtosFiltrados.forEach(produto => {
                const col = document.createElement('div');
                col.className = 'col-md-4 mb-4';
                
                const isOutOfStock = produto.estoque === 0;
                
                col.innerHTML = `
                    <div class="card product-card ${isOutOfStock ? 'out-of-stock' : ''}">
                        ${isOutOfStock ? 
                            '<span class="badge bg-danger out-of-stock-badge">Esgotado</span>' : 
                            ''
                        }
                        <img src="${produto.imagem || 'https://via.placeholder.com/300x200'}" 
                             class="card-img-top product-image" 
                             alt="${produto.nome}"
                             onerror="this.src='https://via.placeholder.com/300x200'">
                        <div class="card-body">
                            <h5 class="card-title">${produto.nome}</h5>
                            <p class="card-text">${produto.descricao || 'Descrição não disponível.'}</p>
                            <div class="mt-auto">
                                <p class="price">R$ ${produto.preco.toFixed(2)}</p>
                                <p class="card-text">
                                    <small class="text-${produto.estoque > 0 ? 'success' : 'danger'}">
                                        ${produto.estoque > 0 ? 
                                            `${produto.estoque} unidades em estoque` : 
                                            'Produto esgotado'
                                        }
                                    </small>
                                </p>
                                <div class="d-grid gap-2">
                                    ${produto.estoque > 0 ? 
                                        `<button class="btn btn-primary" onclick="adicionarAoCarrinho(${produto.id})">
                                            <i class="fas fa-shopping-cart me-2"></i>Comprar
                                         </button>` :
                                        `<button class="btn btn-outline-secondary" disabled>
                                            Produto Indisponível
                                         </button>`
                                    }
                                    <button class="btn btn-outline-secondary" onclick="verDetalhes(${produto.id})">
                                        <i class="fas fa-info-circle me-2"></i>Detalhes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                container.appendChild(col);
            });
        }

        // Buscar ao pressionar Enter
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                filtrarProdutos();
            }
        });


        function verDetalhes(produtoId) {
            alert('Ver detalhes do produto: ' + produtoId);
            // Implementar página de detalhes aqui
        }
    </script>
    @endsection
</body>
</html>