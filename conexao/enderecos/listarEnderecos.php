<?php
include '../conexao.php';

$banco = abrirBanco();

function formatarData($data)
{
  return (!empty($data)) ? DateTime::createFromFormat('Y-m-d', $data)->format('d/m/Y') : 'Não informado';
}

$sql = "SELECT * FROM enderecos";
$resultado = $banco->query($sql);

while ($row = $resultado->fetch_assoc()) {
    $dataCadastro = formatarData($row['data_cadastro']);

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

$banco->close();