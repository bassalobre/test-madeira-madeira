# test-madeira-madeira

Teste para empresa MadeiraMadeira.

Como pré-requisito para rodar o projeto é necessário ter instalado o Docker e Docker Compose em sua maquina.

Para rodar o projeto em sua maquina execute os seguintes comandos em seu terminal:
```
 - cp .env.example .env
 - docker-compose up -d
 - docker-compose exec app composer install
 ```

 Antes de executar o comando abaixo, verifique se os dados para conexão com o banco de dados, no arquivo .env, estão corretos de acordo com seu ambiente.
 Verifique principalmente a variável de ambiente 'MYSQL_HOST'.
 ```
 - docker-compose exec app php commands/migrate.php
 - docker-compose exec app php commands/seed.php
```

Para rodar os testes execute o seguinte comando em seu terminal:
```
 - docker-compose exec app composer test
```
