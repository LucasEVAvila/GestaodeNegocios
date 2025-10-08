<<<<<<< HEAD
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Gestão de Negócios</h5>
                <p>Oferecemos os melhores produtos com os melhores preços.</p>
            </div>
            <div class="col-md-4">
                <h5>Links Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('index') }}" class="text-decoration-none text-dark">Home</a></li>
                    <li><a href="{{ route('produtos_list') }}" class="text-decoration-none text-dark">Produtos</a></li>
                    <li><a href="{{ route('about') }}" class="text-decoration-none text-dark">Sobre Nós</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5>Contato</h5>
                <address>
                    <i class="fas fa-map-marker-alt me-2"></i> Rua Aurora ship, 182<br>
                    <i class="fas fa-phone me-2"></i> (31) 94546-8182<br>
                    <i class="fas fa-envelope me-2"></i> ryley.robinson4546b@alterra.com
                </address>
            </div>
        </div>
        <hr>
        <div class="text-center">
            <p>&copy; {{ date ('Y') }} Gestão de Negócios. Todos os direitos reservados.</p>
        </div>
    </div>
</footer>
