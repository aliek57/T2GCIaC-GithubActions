<?php
include '../conexao/conexao.php';
require '../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;

$banco = abrirBanco();

$sql = "SELECT 
            u.nome AS nome_usuario,
            COUNT(e.id) AS total_emprestimos,
            SUM(e.quantidade) AS total_itens
        FROM emprestimo e
        JOIN usuarios u ON e.requisitante = u.id
        GROUP BY u.id, u.nome
        ORDER BY total_emprestimos DESC
        LIMIT 50";

$resultado = $banco->query($sql);

$html = '
<html>
<head>
    <style>
        body { font-family: sans-serif; color: #333; }
        h1 { text-align: center; margin-bottom: 5px; }
        p.sub { text-align: center; color: #666; font-size: 12px; margin-top: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 25px; }
        th { background-color: #0d6efd; color: white; padding: 10px; text-align: left; }
        td { border-bottom: 1px solid #ddd; padding: 8px; font-size: 14px; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .center { text-align: center; }
        .destaque { font-weight: bold; color: #0d6efd; }
    </style>
</head>
<body>
    <h1>Ranking de Usuários</h1>
    <p class="sub">Relatório de frequência de uso do almoxarifado (Top Users)</p>
    
    <table>
        <thead>
            <tr>
                <th class="center" width="50">#</th>
                <th>Nome do Usuário</th>
                <th class="center">Empréstimos Realizados</th>
                <th class="center">Total de Itens</th>
            </tr>
        </thead>
        <tbody>';

if ($resultado && $resultado->num_rows > 0) {
    $posicao = 1;
    while ($row = $resultado->fetch_assoc()) {
        $html .= '<tr>';
        $html .= '<td class="center"><b>' . $posicao . 'º</b></td>';
        $html .= '<td>' . $row['nome_usuario'] . '</td>';
        $html .= '<td class="center destaque">' . $row['total_emprestimos'] . '</td>';
        $html .= '<td class="center">' . $row['total_itens'] . '</td>';
        $html .= '</tr>';
        $posicao++;
    }
} else {
    $html .= '<tr><td colspan="4" class="center">Nenhum registro encontrado.</td></tr>';
}

$html .= '
        </tbody>
    </table>
    
    <div style="position: fixed; bottom: 0; width: 100%; text-align: right; font-size: 10px; color: #aaa; border-top: 1px solid #eee; padding-top: 5px;">
        Gerado pelo Sistema TSI em: ' . date('d/m/Y H:i') . '
    </div>
</body>
</html>';

$banco->close();

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("relatorio_top_usuarios.pdf", array("Attachment" => false));
