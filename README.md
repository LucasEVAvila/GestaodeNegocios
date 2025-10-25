Como Executar o Projeto

1. Clone o repositório
bash
[https://github.com/LucasEVAvila/GestaodeNegocios.git]
cd gestao_empresarial


2. Instale as dependências
bash
composer install


3. Configure o ambiente
bash
cp .env.example .env
php artisan key:generate


4. Configure o banco de dados no .env
env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestao_empresarial
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. Execute as migrations
bash
php artisan migrate


6. Configure o storage link
bash
php artisan storage:link

7. Execute o servidor
bash
php artisan serve


REFERÊNCIAS:

migrations: https://laravel.com/docs/12.x/migrations#generating-migrations

Models e banco de dados:
Laravel Documentation - Eloquent ORM https://laravel.com/docs/10.x/eloquent

Criação de tabelas de banco de dados
 Laravel Documentation - Migrations
    https://laravel.com/docs/10.x/migrations

 Regras de validação
Laravel Documentation - Validation
   https://laravel.com/docs/10.x/validation


 ViaCEP - WebService gratuito
   https://viacep.com.br/

Formulários estilizados:  https://getbootstrap.com/docs/5.3/forms/overview/

 Bootstrap 5 Tables
 
Tabelas:  https://getbootstrap.com/docs/5.3/content/tables/

Tutoriais e Exemplos Práticos
 Laravel Daily - Upload Files
   https://laraveldaily.com/post/laravel-upload-file-store-public-disk
   Implementação de upload de imagens

 
Laravel Tinker  https://laravel.com/docs/10.x/artisan#tinker
