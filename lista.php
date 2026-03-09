<?php
include_once("conexao.php");
session_start();

// Contagem de máquinas com status 'ativo'
$sql_ativo = "SELECT COUNT(*) AS ativo FROM tb_maquinas WHERE status_operacional = 'ativo'";
$res_ativo = mysqli_query($conn, $sql_ativo);
$ativo = 0;
if ($res_ativo) {
    $row = mysqli_fetch_assoc($res_ativo);
    $ativo = $row['ativo'] ?? 0;
}

// Soma total produzida
$sql_tipos = "SELECT COUNT(DISTINCT tipo_maquina) AS Total_Tipos_Maquinas FROM tb_maquinas;";
$res_tipos = mysqli_query($conn, $sql_tipos);
$total_tipos = 0;
if ($res_tipos) {
    $row = mysqli_fetch_assoc($res_tipos);
    $total_tipos = $row['Total_Tipos_Maquinas'] ?? 0;
}

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
    <title>Informações das máquinas</title>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <ul>
                <li>Usuário: <?php echo $_SESSION['nome_usuario'] ?? ''; ?></li>
                <li>Nível de Acesso: <?php echo $_SESSION['nivel_acesso'] ?? 'Desconhecido'; ?></li>
                <li><a href="logout.php" class="btn-voltar">Sair</a></li>
            </ul>
            <hr/>
        </nav>
        <nav>
            <?php include_once('menu.php'); ?>
        </nav>
        <h2>Máquinas Cadastradas</h2>
        <p><strong>Máquinas Ativas:</strong> <?php echo $ativo; ?> &nbsp; | &nbsp; <strong>Total Produzido:</strong> <?php echo $total_produzido; ?> &nbsp; | &nbsp; <strong>Total de Tipos de Máquinas:</strong> <?php echo $total_tipos; ?></p>
            <?php 
            if ($_SESSION['nivel_acesso'] === 'admin' || $_SESSION['nivel_acesso'] === 'gerente') {
                echo "<a href='cadastro.php' class='btn-voltar'>Cadastrar usuário</a>";
                echo "&nbsp; | &nbsp;";
                echo "<a href='cadastro_maquina.php' class='btn-voltar'>Cadastrar máquina</a>";
                echo "&nbsp; | &nbsp;";
                echo "<a href='cadastro_producao.php' class='btn-voltar'>Cadastrar produção</a>";
            }
            ?>
            <hr/>
            <nav>
                <?php include_once('grafico_maquinas.php'); ?>
            </nav>
            <hr/>
            <nav>
                <?php include_once('grafico_producao.php'); ?>
            </nav>
    </div>
</body>
</html>