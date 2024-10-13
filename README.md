![alt text](https://res.cloudinary.com/dcwdff5pu/image/upload/v1728849906/Screenshot_46_hdpaew.png)
# SPASSU BOOKSTORE API REST - PHP 8.3

## Tecnologias utilizadas

- Framework Laravel V.11.9
- Docker com Laravel Sail
- PHP 8.3.11
- MySql 8.0
- PHP Standards Recommendations

## DER (Diagrama Entidade-Relacionamento)

![alt text](https://res.cloudinary.com/dcwdff5pu/image/upload/v1728850174/DER_mxula1.png)


## Iniciando o projeto

- Clonar repositório
```shell
git clone https://github.com/FredericoSFerreira/spassu-bookstore
````

- Após clonar o repositorio, basta rodar o comando abaixo, para subir os container. Obs: Foi utilizado o *Laravel Sail*, desenvolvimento do mesmo, por se tratar de uma configuração rápida com Docker:
```shell
./vendor/bin/sail up
````

- Executar composer:
```shell
sail composer install
````

- Gerar Key Laravel:
```shell
sail artisan key:generate
````

- Rodar Migrates:
```shell
sail artisan migrate
````

- Rodar Testes:
```shell
sail artisan test
````

### Acesso ao Projeto
```bash
http://localhost
````


### Documentação Endpoints
**Na pasta postman-collection encontra-se as requsições de exemplo para todos os endpoints.**
```bash
Spassu-bookstore.postman_collection.json
````

url para acesso da documentação publica:

https://documenter.getpostman.com/view/516445/2sAXxS9CGF


![alt text](https://res.cloudinary.com/dcwdff5pu/image/upload/v1728851255/Screenshot_47_r6uuv8.png)


