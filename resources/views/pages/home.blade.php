@extends('components.layout.app')

@section('title', 'Home - Gestão de Negócios')

@section('content')
<div class="hero-section rounded mb-5 text-center">
    <h1 class="display-4 fw-bold">Bem-vindo à Gestão de Negócios</h1>
    <p class="lead">Encontre os melhores produtos com os melhores preços</p>
    <a href="{{ route('produtos_list') }}" class="btn btn-primary btn-lg">Ver Produtos</a>
</div>

<div class="row mt-5">
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-truck fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Entrega Rápida</h5>
                <p class="card-text">Entregamos em todo o Brasil</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-shield fa-3x text-primary mb-3"></i> 
                <h5 class="card-title">Compra Segura</h5>
                <p class="card-text">Seus dados protegidos</p>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card text-center">
            <div class="card-body">
                <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                <h5 class="card-title">Suporte 24/7</h5>
                <p class="card-text">Atendimento especializado</p>
            </div>
        </div>
    </div>
</div>
@endsection