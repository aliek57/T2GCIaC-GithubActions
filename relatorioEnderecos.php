<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Logo -->
    <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
   
    <title>Relatório de Endereços</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">

    <link rel="stylesheet" href="./emprestimo_files/css@3">
    <link href="./emprestimo_files/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="./emprestimo_files/checkout.css" rel="stylesheet">
    <link href="./home_files/bootstrap.min.css" rel="stylesheet">
    <link href="./home_files/starter-template.css" rel="stylesheet">

    <!-- CSS do Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- JavaScript do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta name="theme-color" content="#712cf9">

    <!-- Principal CSS do Bootstrap -->
    <link href="./home_files/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos customizados para esse template -->
    <link href="./home_files/starter-template.css" rel="stylesheet">
    <style>
        body {
            padding-top: 56px;
        }

        thead.thead-dark th {
            background-color: black;
            color: white;
        }

        .navbar {
            margin-bottom: 0;
        }
    </style>
</head>

<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="home.php" style="color:white">HOME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="manutencao" data-bs-toggle="dropdown" style="color:white;">Manutenção</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
                        <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
                        <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
                        <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
                        <a class="dropdown-item" href="cadastroEnderecos.php">Endereço</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="movimentacao" data-bs-toggle="dropdown" style="color:white;">Movimentação</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="devolucao.php">Devolução</a>
                        <a class="dropdown-item" href="emprestimo.php">Empréstimo</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="relatorios" data-bs-toggle="dropdown" style="color:white;">Relatórios</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="relatorioMovimentacao.php">Movimentações Gerais</a>
                        <a class="dropdown-item" href="inventario.php">Inventário</a>
                        <a class="dropdown-item" href="relatorioEnderecos.php ">Endereços</a>
                        <a class="dropdown-item" href="relatorioTopUsuarios.php">Top Usuários</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contatos.php" style="color:white;">Contatos</a>
                </li>
            </ul>

            <div class="d-flex align-items-center ms-auto">
                <form class="form-inline d-flex align-items-center">
                    <label for="selectPesquisa" style="color:white" class="mr-2 pe-2">Filtrar por: </label>
                    <select class="form-control mr-2 me-2" id="selectPesquisa">
                        <option value="" disabled selected>Selecione...</option>
                        <option value="rua">Rua</option>
                        <option value="cidade">Cidade</option>
                        <option value="estado">Estado</option>
                        <option value="cep">CEP</option>
                    </select>
                    <input type="text" class="form-control mr-2" id="valorFiltro" placeholder="Digite o valor...">
                </form>
            </div>

            <a href="#" id="btnGerarPDF" class="me-3 ms-2" title="Baixar PDF">
                <i class="bi bi-file-earmark-arrow-down-fill fs-4 text-light" style="cursor: pointer;"></i>
            </a>

            <a class="btn btn-outline-light" href="logout.php">Sair</a>
        </div>
    </nav>

    <main class="container-fluid mt-0 p-0">
        <table class="table table-striped table-hover mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Rua</th>
                    <th>Número</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>Data Cadastro</th>
                </tr>
            </thead>
            <tbody id="tabelaEnderecos">
                </tbody>
        </table>
    </main>

    <script>
        $(document).ready(function() {
            function carregarDados(filtroPor = '', valorFiltro = '') {
                $.ajax({
                    url: 'conexao/listarRelatorioEnderecos.php',
                    method: 'GET',
                    data: {
                        filtroPor: filtroPor,
                        valorFiltro: valorFiltro
                    },
                    success: function(response) {
                        $('#tabelaEnderecos').html(response);
                    },
                    error: function() {
                        alert('Erro ao carregar dados.');
                    }
                });
            }

            carregarDados();

            $('#valorFiltro').on('input', function() {
                const filtroPor = $('#selectPesquisa').val();
                const valorFiltro = $(this).val();

                if (filtroPor || valorFiltro === '') {
                    carregarDados(filtroPor, valorFiltro);
                }
            });

            $('#selectPesquisa').on('change', function() {
                const filtroPor = $(this).val();
                const valorFiltro = $('#valorFiltro').val();
                carregarDados(filtroPor, valorFiltro);
            });

            $('#btnGerarPDF').click(function() {
                const filtroPor = $('#selectPesquisa').val();
                const valorFiltro = $('#valorFiltro').val();
                const url = `conexao/gerarRelatorioEnderecosPDF.php?filtroPor=${encodeURIComponent(filtroPor)}&valorFiltro=${encodeURIComponent(valorFiltro)}`;
                window.open(url, '_blank');
            });
        });
    </script>

</body>

</html>