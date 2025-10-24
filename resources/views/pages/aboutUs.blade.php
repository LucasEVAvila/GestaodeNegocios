
@extends('components.layout.app')

@section('title', 'Sobre Nós - Minha Loja')

@section('content')
<h1 class="mb-4">Sobre Nós</h1>

<div class="row">
    <div class="col-md-6">
        <h3>Nossa História</h3>
        <p>Fundada na semana passada, nossa empresa nasceu com a missão de evitar a reprovação na matéria de Desenvolvimento Web. Ao longo dos dias, enfrentamos grandes bugs e erros de máquina</p>
        <p>Hoje, contamos com uma grande equipe de uma pessoa só que busca realizar o sonho de não reprovar.</p>
        
        <h3 class="mt-4">Nossa Missão</h3>
        <p>Passar na matéria</p>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Entre em Contato</h3>
                <form>
                    <div class="mb-3">
                        <label for="nome_contato" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome_contato" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_contato" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email_contato" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="mensagem" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-12">
        <h3>Onde Estamos</h3>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <address>
                            <strong>Gestão de Negócios</strong><br>
                            Rua Aurora ship, 182<br>
                            <i class="fas fa-phone me-2"></i>(31) 94546-8182<br>
                            <i class="fas fa-envelope me-2"></i>ryley.robinson4546b@alterra.com
                        </address>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <p class="text-center"><i class="fas fa-map-marker-alt fa-3x text-secondary mb-2"></i><br>Mapa da Localização</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

