# Integração de Novas Funcionalidades à Aplicação Sistema Eletrônica utilizando GitHub Actions

Nesta avaliação, o aluno deverá demonstrar seus conhecimentos sobre automação de pipelines utilizando o GitHub Actions, aplicado à aplicação _Sistema Eletrônica_, desenvolvida em PHP.

A avaliação consiste em alterar e criar funcionalidades no sistema e configurar o GitHub Actions para automatizar processos essenciais do fluxo de desenvolvimento.

## A aplicação Sistema Eletrônica deverá ser expandida com:

* Criação de Relatório
* Criação da tabela Endereço (nova)

O aluno deverá implementar as alterações, integrar as novas tabelas ao sistema e utilizar o GitHub Actions

## Tarefas a serem realizadas:
1. Inserir um novo relatório gerado pelo sistema.
2. Criar a tabela Endereco
A funcionalidade deve permitir:

* Cadastro de endereços
* Listagem de endereços
* Edição de endereços
* Exclusão de endereços

Campos mínimos:
* id
* rua
* numero
* cidade
* estado
* cep

3. Configurar um Workflow no GitHub Actions

O workflow deve:
* Ser acionado automaticamente a cada push
* Validar ou formatar o código PHP (ex.: php -l, PHPCS, ou outra ferramenta)
* Fazer deploy da aplicação no servidor linux ubuntu.

## Sobre a entrega:

O aluno deverá enviar via Moodle:

* O link do vídeo (YouTube, Drive, etc.);
* O projeto completo atualizado, contendo:
    * Código PHP das funcionalidades criadas;
    * Arquivos SQL/modelos da tabela Endereço;
    * Workflow GitHub Actions (ci.yml).