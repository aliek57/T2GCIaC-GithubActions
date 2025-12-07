<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../conexao.php';
header('Content-Type: application/json');

date_default_timezone_set('America/Sao_Paulo');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $rua = trim($_POST['rua'] ?? '');
    $numero = trim($_POST['numero'] ?? '');
    $cidade = trim($_POST['cidade'] ?? '');
    $estado = trim($_POST['estado'] ?? '');
    $cep = trim($_POST['cep'] ?? '');
    $ultima_atualizacao = date('Y-m-d H:i:s');

    if ($id <= 0 || empty($rua) || empty($numero) || empty($cidade)) {
        echo json_encode(["error" => "Preencha os campos obrigatórios (Rua, Número e Cidade)."]);
        exit;
    }

    $banco = abrirBanco();

    if (!$banco) {
        echo json_encode(["error" => "Erro ao conectar ao banco de dados."]);
        exit;
    }

    $sql = "UPDATE enderecos 
            SET rua = ?, numero = ?, cidade = ?, estado = ?, cep = ?, ultima_atualizacao = ?
            WHERE id = ?";

    $stmt = $banco->prepare($sql);

    if (!$stmt) {
        echo json_encode(["error" => "Erro ao preparar a consulta: " . $banco->error]);
        $banco->close();
        exit;
    }

    $stmt->bind_param(
        "ssssssi",
        $rua,
        $numero,
        $cidade,
        $estado,
        $cep,
        $ultima_atualizacao,
        $id
    );

    if ($stmt->execute()) {
        echo json_encode([
            "success" => "Endereço atualizado com sucesso!",
            "ultima_atualizacao" => date('d/m/Y H:i', strtotime($ultima_atualizacao))
        ]);
    } else {
        echo json_encode(["error" => "Erro ao salvar no banco: " . $stmt->error]);
    }

    $stmt->close();
    $banco->close();

} else {
    echo json_encode(["error" => "Método de requisição inválido."]);
}
?>