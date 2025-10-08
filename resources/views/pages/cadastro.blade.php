<<<<<<< HEAD
@extends('components.layout.app')

@section('title', 'Cadastro - Minha Loja')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Criar Conta</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmar_senha" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Criar Conta</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                    <p>Já tem uma conta? <a href="{{ route('login') }}">Faça login</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
