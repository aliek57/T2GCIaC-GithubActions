<?php
require '../dompdf/autoload.inc.php'; 
include 'conexao.php';

use Dompdf\Dompdf;

$filtroPor = $_GET['filtroPor'] ?? null;
$valorFiltro = $_GET['valorFiltro'] ?? null;

function gerarHTML($filtroPor = null, $valorFiltro = null) {
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
        }
    }
    
    $sql .= " ORDER BY cidade ASC";
    $resultado = $banco->query($sql);

    date_default_timezone_set('America/Sao_Paulo');
    $dataGeracao = date('d/m/Y H:i');

    $html = "
    <div style='text-align: center; font-family: sans-serif;'>
        <h2>Relatório de Endereços Cadastrados</h2>
        <p style='font-size: 12px;'>Gerado em: <strong>{$dataGeracao}</strong></p>
    </div>
    <table border='1' width='100%' style='border-collapse: collapse; font-family: sans-serif; font-size:12px;'>
        <thead style='background-color: #f2f2f2;'>
            <tr>
                <th>Rua</th>
                <th>Número</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>CEP</th>
                <th>Cadastro</th>
            </tr>
        </thead>
        <tbody>
    ";

    if ($resultado && $resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $dataCadastro = date('d/m/Y', strtotime($row['data_cadastro']));

            $html .= "<tr>
                <td>{$row['rua']}</td>
                <td>{$row['numero']}</td>
                <td>{$row['cidade']}</td>
                <td>{$row['estado']}</td>
                <td>{$row['cep']}</td>
                <td>{$dataCadastro}</td>
            </tr>";
        }
    } else {
        $html .= "<tr><td colspan='6' style='text-align:center'>Nenhum registro encontrado.</td></tr>";
    }

    $html .= "</tbody></table>";
    $banco->close();
    return $html;
}

$dompdf = new Dompdf();
$dompdf->loadHtml(gerarHTML($filtroPor, $valorFiltro));
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_enderecos.pdf", array("Attachment" => true));
?>