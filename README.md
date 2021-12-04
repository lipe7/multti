# Desafio Multti

## Descrição do Projeto

-   Versão Laravel 8.74.0
-   Versão PHP 7.4.9
-   Versão MySQL 5.7

### Executando o projeto

Clone o projeto:

```
git clone https://github.com/lipe7/multti
```

O arquivo `.env.example` possuem dados genéricos para configuração da aplicação. Faça uma copia do `.env.example` e renomeie para `.env`.

Instale as dependências:

```
composer install
```

Gere o APP_KEY executando:

```
php artisan key:generate
```

Crie um banco e configure no .env:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE='nome_do_banco'
DB_USERNAME=root
DB_PASSWORD=
```

Rode as migrations :

```
php artisan migrate
```

Rode o comando :

```
php artisan optimize
```

Rode o servidor :

```
php artisan serve
```

## Autor

> [Filipi Campos](https://www.linkedin.com/in/7lipe/)
>
> [felipec165@gmail.com](mailto:felipec165@gmail.com)

### EndPoints

`Arquivo insomnia `InsomniaCrud` na raiz do projeto.`

version:

Index

```
GET:
http://127.0.0.1:8000/api
```

ListAll:

```
GET:
http://127.0.0.1:8000/api/users
```

Create

```
POST:
http://127.0.0.1:8000/api/users
{
	"name":"Felipe",
	"email":"felipe@mail.com",
	"password":"123",
	"phone":"77900000000"
}
```

Read

```
GET:
http://127.0.0.1:8000/api/users/1
```

Update:

```
PUT:
http://127.0.0.1:8000/api/users/1
{
    "name":"Felipe",
    "email":"felipe@mail.com.br",
    "password":"123",
    "phone":"77900001111"
}

```

Delete:

```
DELETE:
http://127.0.0.1:8000/api/users/1


```
