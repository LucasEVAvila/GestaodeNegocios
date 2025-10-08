<<<<<<< HEAD
@extends('components.layout.app')

@section('title', 'Login - Minha Loja')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Login</h3>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="lembrar">
                        <label class="form-check-label" for="lembrar">Lembrar-me</label>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>
                <hr>
                <div class="text-center">
                    <p>Não tem uma conta? <a href="{{ route('regist') }}">Cadastre-se</a></p>
                    <p><a href="#">Esqueci minha senha</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
