<?php
include_once("conexao.php");
session_start();

$sql = "SELECT m.tag_maquina AS 'Equipamento', m.tipo_maquina AS 'Tipo', SUM(p.qtd_produzida) AS 'Volume_Total', COUNT(p.id_registro) AS 'Vezes_Operada' FROM tb_maquinas m INNER JOIN tb_producao p ON m.id_maquina = p.id_maquina GROUP BY m.tag_maquina, m.tipo_maquina ORDER BY Volume_Total DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Relatório de Operação</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Relatório de Operação</h1>
        <table>
            <thead>
                <tr>
                    <th>Tag Máquina</th>
                    <th>Tipo Máquina</th>
                    <th>Volume Total</th>
                    <th>Vezes Operada</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['Equipamento']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Tipo']) . '</td>';
                        echo '<td>' . intval($row['Volume_Total']) . '</td>';
                        echo '<td>' . intval($row['Vezes_Operada']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">Nenhum dado encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <p><a href="lista.php" class="btn-voltar">&larr; Voltar para Lista</a></p>
    </div>
</body>

</html>