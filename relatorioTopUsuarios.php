<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

include 'conexao/conexao.php';
$banco = abrirBanco();

$sql = "SELECT 
            u.nome AS nome_usuario,
            u.email,
            COUNT(e.id) AS total_emprestimos,
            SUM(e.quantidade) AS total_itens
        FROM emprestimo e
        JOIN usuarios u ON e.requisitante = u.id
        GROUP BY u.id, u.nome
        ORDER BY total_emprestimos DESC
        LIMIT 20"; // Top 20

$resultado = $banco->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Logo-->
  <link rel="icon" type="image/x-icon" href="assets/img/thumbnail_logo_TSI.png" />
  <title>Relatório - Top Usuários</title>
  <!-- Principal CSS do Bootstrap -->
  <link href="./home_files/bootstrap.min.css" rel="stylesheet">
  <!-- Estilos customizados para esse template -->
  <link href="./home_files/starter-template.css" rel="stylesheet">
    <style>
        body {
            padding-top: 80px;
            background-color: #f8f9fa;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="home.php" style="color:white">HOME</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="manutencao" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="color:white;">Manutenção</a>
                    <div class="dropdown-menu" aria-labelledby="manutencao">
                        <a class="dropdown-item" href="cadastroAmbientes.php">Ambientes</a>
                        <a class="dropdown-item" href="cadastroGrupos.php">Grupo</a>
                        <a class="dropdown-item" href="cadastroInsumos.php">Insumo</a>
                        <a class="dropdown-item" href="cadastroUsuarios.php">Usuário</a>
                        <a class="dropdown-item" href="cadastroEnderecos.php">Endereço</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="movimentacao" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="color:white;">Movimentação</a>
                    <div class="dropdown-menu" aria-labelledby="movimentacao">
                        <a class="dropdown-item" href="devolucao.php">Devolução</a>
                        <a class="dropdown-item" href="emprestimo.php">Empréstimo</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="relatorios" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" style="color:white;">Relatórios</a>
                    <div class="dropdown-menu" aria-labelledby="relatorios">
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

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                <!--<a class="btn btn-outline-light" href="login.html">Sair</a>-->
                <a class="btn btn-outline-light" href="logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-primary"><i class="bi bi-people-fill"></i> Top Usuários</h2>
                <p class="text-muted">Ranking dos usuários que mais realizam empréstimos.</p>
            </div>

            <a href="conexao/gerarRelatorioTopUsuarios.php" target="_blank" class="btn btn-primary btn-lg">
                <i class="bi bi-file-earmark-pdf"></i> Baixar PDF
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-striped table-hover mb-0">
                    <thead class="table-dark">
                        <tr>

                            <th>Usuário</th>
                            <th>Email/Contato</th>
                            <th class="text-center">Vezes que Emprestou</th>
                            <th class="text-center">Total Itens Retirados</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($resultado && $resultado->num_rows > 0): ?>
                            <?php

                            while ($row = $resultado->fetch_assoc()):

                            ?>
                                <tr>

                                    <td class="fw-bold"><?php echo htmlspecialchars($row['nome_usuario']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email'] ?? '-'); ?></td>
                                    <td class="text-center fs-5 text-primary fw-bold">
                                        <?php echo $row['total_emprestimos']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $row['total_itens']; ?> un.
                                    </td>
                                </tr>
                            <?php
                            endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    Nenhum empréstimo registrado até o momento.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
<?php $banco->close(); ?>