
# Tasks Api

Este projeto consiste em uma API que permite a criação de tarefas, com a possibilidade de o cliente definir o status de cada uma delas.


## Tech Stack

**Server:** Laravel, Sanctum


## Installation

Para implantar este projeto, execute

```bash
  composer install
```
Cria o banco de dados MySql
```Bash
    docker-compose up -d
```
Copie o arquivo .env-example e cole em um novo arquivo chamado .env.

Em seguida, gere uma chave para a aplicação Laravel
```Bash
    php artisan key:generate
```
Por fim, execute as migrações e o seed.
```Bash
    php artisan migrate --seed
```
