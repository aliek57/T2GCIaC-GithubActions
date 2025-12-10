<?php
include 'conexao.php';

$filtroPor = $_GET['filtroPor'] ?? null;
$valorFiltro = $_GET['valorFiltro'] ?? null;

$banco = abrirBanco();

$sql = "SELECT * FROM enderecos";

if ($filtroPor && $valorFiltro) {
    $valor = $banco->real_escape_string($valorFiltro);
    
    switch ($filtroPor) {
        case 'rua':
            $sql .= " WHERE rua LIKE '%$valor%'";
            break;
        case 'cidade':
            $sql .= " WHERE cidade LIKE '%$valor%'";
            break;
        case 'estado':
            $sql .= " WHERE estado LIKE '%$valor%'";
            break;
        case 'cep':
            $sql .= " WHERE cep LIKE '%$valor%'";
            break;
        default:
            break;
    }
}

$sql .= " ORDER BY cidade ASC, rua ASC";

$resultado = $banco->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $dataCadastro = date('d/m/Y', strtotime($row['data_cadastro']));

        echo "<tr>";
        echo "<td>" . $row['rua'] . "</td>";
        echo "<td>" . $row['numero'] . "</td>";
        echo "<td>" . $row['cidade'] . "</td>";
        echo "<td>" . $row['estado'] . "</td>";
        echo "<td>" . $row['cep'] . "</td>";
        echo "<td>" . $dataCadastro . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center'>Nenhum endereço encontrado.</td></tr>";
}
$banco->close();
?>