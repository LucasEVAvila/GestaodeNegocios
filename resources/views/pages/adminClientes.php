<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerenciar Clientes - Minha Loja</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .table-actions {
            white-space: nowrap;
            width: 140px;
        }
        
        .customer-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .status-badge {
            font-size: 0.8em;
            padding: 0.35em 0.65em;
        }
        
        .alert-auto-hide {
            animation: fadeOut 3s forwards;
            animation-delay: 2s;
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; display: none; }
        }
        
        .search-box {
            max-width: 300px;
        }
    </style>
</head>
<body>

    @extends('components.layout.app')

    @section('title', 'Gerenciar Clientes - Admin')

    @section('content')
    
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Gerenciamento de Clientes</h1>
            <button class="btn btn-primary" onclick="abrirModalCliente()">
                <i class="fas fa-plus me-2"></i>Adicionar Cliente
            </button>
        </div>

        <div id="alertContainer"></div>
        
        <!-- Barra de Pesquisa e Filtros -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Buscar clientes..." id="searchInput" onkeyup="filtrarClientes()">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="statusFilter" onchange="filtrarClientes()">
                            <option value="">Todos os status</option>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="sortFilter" onchange="filtrarClientes()">
                            <option value="recentes">Mais recentes</option>
                            <option value="antigos">Mais antigos</option>
                            <option value="nome_asc">Nome (A-Z)</option>
                            <option value="nome_desc">Nome (Z-A)</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>E-mail</th>
                                <th>Telefone</th>
                                <th>Status</th>
                                <th>Data Cadastro</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="tabelaClientes">
                            <!-- Clientes serão carregados aqui via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Adicionar/Editar Cliente -->
    <div class="modal fade" id="clienteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalClienteTitle">Adicionar Novo Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="clienteForm">
                        <input type="hidden" id="clienteId">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="clienteNome" class="form-label">Nome Completo *</label>
                                <input type="text" class="form-control" id="clienteNome" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="clienteEmail" class="form-label">E-mail *</label>
                                <input type="email" class="form-control" id="clienteEmail" required>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="clienteTelefone" class="form-label">Telefone *</label>
                                <input type="tel" class="form-control" id="clienteTelefone" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="clienteCpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="clienteCpf">
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="clienteStatus" class="form-label">Status *</label>
                                <select class="form-select" id="clienteStatus" required>
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="clienteDataNascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="clienteDataNascimento">
                            </div>
                        </div>
                        
                        <h6 class="mt-4 mb-3">Endereço</h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="clienteCep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="clienteCep">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="clienteEstado" class="form-label">Estado</label>
                                <select class="form-select" id="clienteEstado">
                                    <option value="">Selecione...</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <label for="clienteCidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="clienteCidade">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="clienteNumero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="clienteNumero">
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="clienteEndereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="clienteEndereco">
                        </div>
                        
                        <div class="mb-3">
                            <label for="clienteComplemento" class="form-label">Complemento</label>
                            <input type="text" class="form-control" id="clienteComplemento">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" onclick="salvarCliente()">Salvar Cliente</button>
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
        let clientes = JSON.parse(localStorage.getItem('clientes')) || [];
        let clienteModal = null;
        let editingClienteId = null;

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            clienteModal = new bootstrap.Modal(document.getElementById('clienteModal'));
            carregarClientes();
            
            // Inicializar alguns clientes de exemplo se estiver vazio
            if (clientes.length === 0) {
                inicializarClientesExemplo();
            }
        });

        // Inicializar clientes de exemplo
        function inicializarClientesExemplo() {
            clientes = [
                { 
                    id: 1, 
                    nome: "João Silva", 
                    email: "joao.silva@email.com", 
                    telefone: "(11) 99999-9999", 
                    cpf: "123.456.789-00",
                    status: "ativo",
                    dataNascimento: "1990-05-15",
                    dataCadastro: "2023-01-15",
                    endereco: {
                        cep: "01234-567",
                        estado: "SP",
                        cidade: "São Paulo",
                        endereco: "Rua das Flores",
                        numero: "123",
                        complemento: "Apto 45"
                    }
                },
                { 
                    id: 2, 
                    nome: "Maria Santos", 
                    email: "maria.santos@email.com", 
                    telefone: "(11) 98888-8888", 
                    cpf: "987.654.321-00",
                    status: "ativo",
                    dataNascimento: "1985-08-22",
                    dataCadastro: "2023-02-20",
                    endereco: {
                        cep: "04567-890",
                        estado: "SP",
                        cidade: "São Paulo",
                        endereco: "Avenida Paulista",
                        numero: "1000",
                        complemento: "Sala 30"
                    }
                },
                { 
                    id: 3, 
                    nome: "Pedro Oliveira", 
                    email: "pedro.oliveira@email.com", 
                    telefone: "(11) 97777-7777", 
                    cpf: "456.789.123-00",
                    status: "inativo",
                    dataNascimento: "1992-12-03",
                    dataCadastro: "2023-03-10",
                    endereco: {
                        cep: "07890-123",
                        estado: "RJ",
                        cidade: "Rio de Janeiro",
                        endereco: "Rua do Catete",
                        numero: "456",
                        complemento: ""
                    }
                }
            ];
            salvarClientesNoLocalStorage();
            carregarClientes();
        }

        // Salvar clientes no localStorage
        function salvarClientesNoLocalStorage() {
            localStorage.setItem('clientes', JSON.stringify(clientes));
        }

        // Carregar clientes na tabela
        function carregarClientes() {
            const tabela = document.getElementById('tabelaClientes');
            tabela.innerHTML = '';
            
            if (clientes.length === 0) {
                tabela.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-users fa-2x mb-2 text-muted"></i>
                            <p class="text-muted">Nenhum cliente cadastrado</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            clientes.forEach(cliente => {
                const iniciais = cliente.nome.split(' ').map(n => n[0]).join('').toUpperCase();
                const row = tabela.insertRow();
                row.innerHTML = `
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="customer-avatar me-3">
                                ${iniciais.substring(0, 2)}
                            </div>
                            <div>
                                <div class="fw-bold">${cliente.nome}</div>
                                <small class="text-muted">ID: ${cliente.id}</small>
                            </div>
                        </div>
                    </td>
                    <td>${cliente.email}</td>
                    <td>${cliente.telefone}</td>
                    <td>
                        <span class="badge ${cliente.status === 'ativo' ? 'bg-success' : 'bg-secondary'} status-badge">
                            ${cliente.status === 'ativo' ? 'Ativo' : 'Inativo'}
                        </span>
                    </td>
                    <td>${formatarData(cliente.dataCadastro)}</td>
                    <td class="table-actions text-center">
                        <button class="btn btn-sm btn-primary me-1" onclick="editarCliente(${cliente.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-info me-1" onclick="verDetalhesCliente(${cliente.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="excluirCliente(${cliente.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            });
        }

        // Formatador de data
        function formatarData(dataString) {
            const data = new Date(dataString);
            return data.toLocaleDateString('pt-BR');
        }

        // Filtrar clientes
        function filtrarClientes() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const statusFilter = document.getElementById('statusFilter').value;
            const sortFilter = document.getElementById('sortFilter').value;
            
            let clientesFiltrados = clientes.filter(cliente => {
                const matchesSearch = cliente.nome.toLowerCase().includes(searchTerm) ||
                                    cliente.email.toLowerCase().includes(searchTerm) ||
                                    cliente.telefone.includes(searchTerm);
                
                const matchesStatus = !statusFilter || cliente.status === statusFilter;
                
                return matchesSearch && matchesStatus;
            });
            
            // Ordenação
            switch(sortFilter) {
                case 'recentes':
                    clientesFiltrados.sort((a, b) => new Date(b.dataCadastro) - new Date(a.dataCadastro));
                    break;
                case 'antigos':
                    clientesFiltrados.sort((a, b) => new Date(a.dataCadastro) - new Date(b.dataCadastro));
                    break;
                case 'nome_asc':
                    clientesFiltrados.sort((a, b) => a.nome.localeCompare(b.nome));
                    break;
                case 'nome_desc':
                    clientesFiltrados.sort((a, b) => b.nome.localeCompare(a.nome));
                    break;
            }
            
            // Atualizar a tabela
            const tabela = document.getElementById('tabelaClientes');
            tabela.innerHTML = '';
            
            if (clientesFiltrados.length === 0) {
                tabela.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-search fa-2x mb-2 text-muted"></i>
                            <p class="text-muted">Nenhum cliente encontrado</p>
                        </td>
                    </tr>
                `;
                return;
            }
            
            clientesFiltrados.forEach(cliente => {
                const iniciais = cliente.nome.split(' ').map(n => n[0]).join('').toUpperCase();
                const row = tabela.insertRow();
                row.innerHTML = `
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="customer-avatar me-3">
                                ${iniciais.substring(0, 2)}
                            </div>
                            <div>
                                <div class="fw-bold">${cliente.nome}</div>
                                <small class="text-muted">ID: ${cliente.id}</small>
                            </div>
                        </div>
                    </td>
                    <td>${cliente.email}</td>
                    <td>${cliente.telefone}</td>
                    <td>
                        <span class="badge ${cliente.status === 'ativo' ? 'bg-success' : 'bg-secondary'} status-badge">
                            ${cliente.status === 'ativo' ? 'Ativo' : 'Inativo'}
                        </span>
                    </td>
                    <td>${formatarData(cliente.dataCadastro)}</td>
                    <td class="table-actions text-center">
                        <button class="btn btn-sm btn-primary me-1" onclick="editarCliente(${cliente.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-info me-1" onclick="verDetalhesCliente(${cliente.id})">
                            <i class="fas fa-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="excluirCliente(${cliente.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                `;
            });
        }

        // Abrir modal para adicionar/editar cliente
        function abrirModalCliente(id = null) {
            editingClienteId = id;
            const form = document.getElementById('clienteForm');
            const modalTitle = document.getElementById('modalClienteTitle');
            
            if (id) {
                // Modo edição
                modalTitle.textContent = 'Editar Cliente';
                const cliente = clientes.find(c => c.id === id);
                if (cliente) {
                    document.getElementById('clienteId').value = cliente.id;
                    document.getElementById('clienteNome').value = cliente.nome;
                    document.getElementById('clienteEmail').value = cliente.email;
                    document.getElementById('clienteTelefone').value = cliente.telefone;
                    document.getElementById('clienteCpf').value = cliente.cpf || '';
                    document.getElementById('clienteStatus').value = cliente.status;
                    document.getElementById('clienteDataNascimento').value = cliente.dataNascimento || '';
                    
                    // Endereço
                    if (cliente.endereco) {
                        document.getElementById('clienteCep').value = cliente.endereco.cep || '';
                        document.getElementById('clienteEstado').value = cliente.endereco.estado || '';
                        document.getElementById('clienteCidade').value = cliente.endereco.cidade || '';
                        document.getElementById('clienteEndereco').value = cliente.endereco.endereco || '';
                        document.getElementById('clienteNumero').value = cliente.endereco.numero || '';
                        document.getElementById('clienteComplemento').value = cliente.endereco.complemento || '';
                    }
                }
            } else {
                // Modo adição
                modalTitle.textContent = 'Adicionar Novo Cliente';
                form.reset();
                document.getElementById('clienteId').value = '';
                document.getElementById('clienteStatus').value = 'ativo';
                document.getElementById('clienteDataCadastro').value = new Date().toISOString().split('T')[0];
            }
            
            clienteModal.show();
        }

        // Salvar cliente (criar ou atualizar)
        function salvarCliente() {
            const form = document.getElementById('clienteForm');
            const id = document.getElementById('clienteId').value;
            const nome = document.getElementById('clienteNome').value;
            const email = document.getElementById('clienteEmail').value;
            const telefone = document.getElementById('clienteTelefone').value;
            const cpf = document.getElementById('clienteCpf').value;
            const status = document.getElementById('clienteStatus').value;
            const dataNascimento = document.getElementById('clienteDataNascimento').value;
            
            // Validação
            if (!nome || !email || !telefone) {
                mostrarAlerta('Por favor, preencha todos os campos obrigatórios.', 'danger');
                return;
            }

            // Validar email
            if (!validarEmail(email)) {
                mostrarAlerta('Por favor, insira um email válido.', 'danger');
                return;
            }

            const endereco = {
                cep: document.getElementById('clienteCep').value,
                estado: document.getElementById('clienteEstado').value,
                cidade: document.getElementById('clienteCidade').value,
                endereco: document.getElementById('clienteEndereco').value,
                numero: document.getElementById('clienteNumero').value,
                complemento: document.getElementById('clienteComplemento').value
            };

            if (id) {
                // Editar cliente existente
                const index = clientes.findIndex(c => c.id == id);
                if (index !== -1) {
                    clientes[index] = { 
                        ...clientes[index],
                        id: parseInt(id), 
                        nome, 
                        email, 
                        telefone, 
                        cpf,
                        status, 
                        dataNascimento,
                        endereco
                    };
                    mostrarAlerta('Cliente atualizado com sucesso!', 'success');
                }
            } else {
                // Adicionar novo cliente
                const novoId = clientes.length > 0 ? Math.max(...clientes.map(c => c.id)) + 1 : 1;
                clientes.push({ 
                    id: novoId, 
                    nome, 
                    email, 
                    telefone, 
                    cpf,
                    status, 
                    dataNascimento,
                    dataCadastro: new Date().toISOString().split('T')[0],
                    endereco
                });
                mostrarAlerta('Cliente adicionado com sucesso!', 'success');
            }

            salvarClientesNoLocalStorage();
            carregarClientes();
            clienteModal.hide();
            form.reset();
        }

        // Validar email
        function validarEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // Editar cliente
        function editarCliente(id) {
            abrirModalCliente(id);
        }

        // Ver detalhes do cliente
        function verDetalhesCliente(id) {
            const cliente = clientes.find(c => c.id === id);
            if (cliente) {
                alert(`Detalhes do Cliente:\n\nNome: ${cliente.nome}\nEmail: ${cliente.email}\nTelefone: ${cliente.telefone}\nStatus: ${cliente.status}\nData de Cadastro: ${formatarData(cliente.dataCadastro)}`);
            }
        }

        // Excluir cliente
        function excluirCliente(id) {
            if (confirm('Tem certeza que deseja excluir este cliente?')) {
                clientes = clientes.filter(c => c.id !== id);
                salvarClientesNoLocalStorage();
                carregarClientes();
                mostrarAlerta('Cliente excluído com sucesso!', 'success');
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