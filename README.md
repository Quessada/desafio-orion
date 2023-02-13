<p align="center"><img src="https://d28hb748xidqca.cloudfront.net/520x520x0/N2gRj9y7xPU3j0gyOYW4eiiG5EQI3UjZ9xStYObXBKfzQSVwq5HHM5aeUK5pkMCG/WhatsApp_Image_2023-01-02_at_10.30.30.jpeg" width="200" alt="Logo supera"></p>



# Desafio Laravel

Para testar o projeto, seguir os seguintes passos:

## Download do Projeto

```
git clone git@github.com:Quessada/desafio-orion.git
```

Entre no diretório do projeto e execute os seguintes comandos:

```bash
cd desafio-orion/
```

```bash
cp .env.example .env
```

```bash
composer install
```

```bash
php artisan key:generate
```

Executar o comando para executar o sail e dar início ao ambiente Docker:

```bash
.\vendor\bin\sail up -d
```

Execute o comando para criar as tabelas e popular o banco de dados com o usuário padrão:

```bash
sail artisan migrate --seed
```

## Métodos
Requisições para a API:

| Método | Endpoint | Descrição |
|---|---| --- |
| `POST` | /clienteCadastro | Cadastro de um novo cliente. |
| `PUT`  | /cliente/{id} | Edição de um cliente. |
| `DELETE` |  /cliente/{id} | Remoção de um cliente. |
| `GET`  |  /cliente/{id} | Consulta os dados de um cliente. |
| `GET`  |  /consulta/final-placa/{numero} | Consulta todos os clientes, onde
o último número da placa é igual
o número informado. |


