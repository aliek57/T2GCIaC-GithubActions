<?php
include('../conexao.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $banco = abrirBanco();

    $rua = $_POST['ruaEndereco'];
    $numero = $_POST['numeroEndereco'];
    $cidade = $_POST['cidadeEndereco'];
    $estado = $_POST['estadoEndereco'];
    $cep = $_POST['cepEndereco'];
    $data_cadastro = $_POST['dataCadastroEndereco'];

    $stmt = $banco->prepare("SELECT COUNT(*) FROM enderecos WHERE rua = ? AND numero = ? AND cidade = ?");
    if (!$stmt) {
        echo "0|Erro na preparação da consulta de verificação: " . $banco->error;
        exit;
    }

    $stmt->bind_param("sss", $rua, $numero, $cidade);
    if (!$stmt->execute()) {
        echo "0|Erro na execução da consulta de verificação: " . $stmt->error;
        exit;
    }

    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        echo "0|Este endereço (Rua, Número e Cidade) já está cadastrado!";
        exit;
    }

    $sqlInsert = "INSERT INTO enderecos (rua, numero, cidade, estado, cep,data_cadastro) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $banco->prepare($sqlInsert);
    
    if (!$stmt) {
        echo "0|Erro na preparação da consulta de inserção: " . $banco->error;
        exit;
    }

    $stmt->bind_param("ssssss", $rua, $numero, $cidade, $estado, $cep, $data_cadastro);

    if ($stmt->execute()) {
        echo "1|Endereço cadastrado com sucesso!";
    } else {
        echo "0|Erro ao cadastrar o endereço: " . $stmt->error;
    }

    $stmt->close();
    $banco->close();

} else {
    echo "0|Método não permitido!";
    exit;
}
?>