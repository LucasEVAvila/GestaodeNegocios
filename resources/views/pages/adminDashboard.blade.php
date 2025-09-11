<!DOCTYPE html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Painel Administrativo - Minha Loja</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .admin-card {
            transition: all 0.3s ease;
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            height: 100%;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
        }
        
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        
        .stats-card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .stats-number {
            font-size: 2rem;
            font-weight: bold;
        }
        
        .recent-activity {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .activity-item {
            border-left: 3px solid #0d6efd;
            padding-left: 1rem;
            margin-bottom: 1rem;
        }
        
        .badge-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    @extends('components.layout.app')

    @section('title', 'Painel Administrativo - Minha Loja')

    @section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Painel Administrativo</h1>
            <span class="badge bg-primary">Admin</span>
        </div>

        <!-- Cards de Navegação -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-box card-icon text-primary"></i>
                        <h5 class="card-title">Gerenciar Produtos</h5>
                        <p class="card-text">Adicione, edite ou remova produtos do catálogo</p>
                        <a href="{{ route('adminEdit') }}" class="btn btn-primary">
                            <i class="fas fa-cog me-2"></i>Gerenciar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-users card-icon text-success"></i>
                        <h5 class="card-title">Gerenciar Clientes</h5>
                        <p class="card-text">Visualize e gerencie o cadastro de clientes</p>
                        <a href="{{ route('adminClientes') }}" class="btn btn-success">
                            <i class="fas fa-cog me-2"></i>Gerenciar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-shopping-cart card-icon text-warning"></i>
                        <h5 class="card-title">Pedidos</h5>
                        <p class="card-text">Acompanhe e gerencie os pedidos realizados</p>
                        <a href="#" class="btn btn-warning">
                            <i class="fas fa-cog me-2"></i>Gerenciar
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-chart-bar card-icon text-info"></i>
                        <h5 class="card-title">Relatórios</h5>
                        <p class="card-text">Relatórios de vendas e métricas da loja</p>
                        <a href="#" class="btn btn-info">
                            <i class="fas fa-cog me-2"></i>Visualizar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-cog card-icon text-secondary"></i>
                        <h5 class="card-title">Configurações</h5>
                        <p class="card-text">Configure as opções da sua loja</p>
                        <a href="#" class="btn btn-secondary">
                            <i class="fas fa-cog me-2"></i>Configurar
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card admin-card">
                    <div class="card-body text-center">
                        <i class="fas fa-user-shield card-icon text-dark"></i>
                        <h5 class="card-title">Administradores</h5>
                        <p class="card-text">Gerencie usuários administrativos</p>
                        <a href="#" class="btn btn-dark">
                            <i class="fas fa-cog me-2"></i>Gerenciar
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </script>
    @endsection
</body>
</html>