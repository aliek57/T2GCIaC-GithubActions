<?php
include '../conexao.php';

if (isset($_POST['termo'])) {
    $termo = $_POST['termo'];
    $banco = abrirBanco();

    $sql = "SELECT id, rua, numero, cidade, estado, cep 
            FROM enderecos 
            WHERE rua LIKE ? OR cidade LIKE ? OR estado LIKE ? OR cep LIKE ?";
    
    $stmt = $banco->prepare($sql);
    $termoLike = "%$termo%";
    
    $stmt->bind_param("ssss", $termoLike, $termoLike, $termoLike, $termoLike);
    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$row['rua']}</td>
                <td>{$row['numero']}</td>
                <td>{$row['cidade']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['cep']}</td>
                <td class='text-center'><button type='button' class='btn btn-primary btn-sm btn-visualizar' data-id='{$row['id']}'>Visualizar</button></td>
                <td class='text-center'><button type='button' class='btn btn-success btn-sm btn-editar' data-id='{$row['id']}'>Editar</button></td>
                <td class='text-center'><button type='button' class='btn btn-danger btn-sm btn-excluir' data-id='{$row['id']}'>Excluir</button></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='8' class='text-center text-muted'>Nenhum endereço encontrado para: <strong>" . htmlspecialchars($termo) . "</strong></td></tr>";
    }

    $stmt->close();
    $banco->close();
} else {
    echo "<tr><td colspan='8' class='text-center text-danger'>Erro: Termo de pesquisa não fornecido.</td></tr>";
}
?>