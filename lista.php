<?php
include_once("conexao.php");

// Contagem de máquinas com status 'ativo'
$sql_ativo = "SELECT COUNT(*) AS ativo FROM tb_maquinas WHERE status_operacional = 'ativo'";
$res_ativo = mysqli_query($conn, $sql_ativo);
$ativo = 0;
if ($res_ativo) {
    $row = mysqli_fetch_assoc($res_ativo);
    $ativo = $row['ativo'] ?? 0;
}

// Soma total produzida
$sql_total = "SELECT SUM(qtd_produzida) AS total_produzido FROM tb_producao";
$res_total = mysqli_query($conn, $sql_total);
$total_produzido = 0;
if ($res_total) {
    $row = mysqli_fetch_assoc($res_total);
    $total_produzido = $row['total_produzido'] ?? 0;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Lista de Alunos</title>
</head>
<body>
    <div class="container">
        <h2>Máquinas Cadastradas</h2>
        <p><strong>Máquinas Ativas:</strong> <?php echo $ativo; ?> &nbsp; | &nbsp; <strong>Total Produzido:</strong> <?php echo $total_produzido; ?></p>
        <table>
            <tr>
                <th>Tag</th>
                <th>Tipo</th>
                <th>Status</th>
            </tr>
            <a href="relatorio.php" class="btn-voltar"><-- Visualizar relatório</a>
        </table>
    </div>
</body>
</html>