<?php
include_once('conexao.php');
$sql_total = "SELECT SUM(qtd_produzida) AS total_produzido FROM tb_producao";
$res_total = mysqli_query($conn, $sql_total);
$total_produzido = 0;
if ($res_total) {
    $row = mysqli_fetch_assoc($res_total);
    $total_produzido = $row['total_produzido'] ?? 0;
}
$sql_media = "SELECT AVG(tb_producao.qtd_produzida) AS media_por_lote FROM tb_producao";
$res_media = mysqli_query($conn, $sql_media);
$media_por_lote = 0;
if ($res_media) {
    $row = mysqli_fetch_assoc($res_media);
    $media_por_lote = $row['media_por_lote'] ?? 0;
}
// Consulta de relatório: máquinas + produção ordenada por data desc
$sql = "SELECT m.tag_maquina, m.tipo_maquina, p.qtd_produzida, p.data_producao, SUM(p.qtd_produzida) AS total_produzido, AVG(p.qtd_produzida) AS media_por_lote
        FROM tb_maquinas m
        JOIN tb_producao p ON m.id_maquina = p.id_maquina
        ORDER BY p.data_producao DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Relatório de Produção</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Relatório de Produção</h1>
        <table>
            <thead>
                <tr>
                    <th>Tag Máquina</th>
                    <th>Tipo Máquina</th>
                    <th>Quantidade Produzida</th>
                    <th>Data Produção</th>
                    <th>Total Produzido</th>
                    <th>Média por lote</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['tag_maquina']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['tipo_maquina']) . '</td>';
                        echo '<td>' . intval($row['qtd_produzida']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['data_producao']) . '</td>';
                        echo '<td>' . intval($row['total_produzido']) . '</td>';
                        echo '<td>' . number_format($row['media_por_lote'], 2, ',', '.') . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Nenhum registro encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <p><a href="lista.php" class="btn-voltar">&larr; Voltar para Lista</a></p>
    </div>
</body>

</html>