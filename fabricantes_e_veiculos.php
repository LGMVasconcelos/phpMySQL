<?php
include_once('conexao.php');
session_start();
$sql_fabricantes = "SELECT id_fabricante, nome_fabricante, pais_origem FROM tb_fabricantes";
$res_fabricantes = mysqli_query($conn, $sql_fabricantes);
$fabricantes = 0;
if ($res_fabricantes) {
    $row = mysqli_fetch_assoc($res_fabricantes);
    $fabricantes = $row['id_fabricante'] ?? 0;
}
$result = mysqli_query($conn, $sql_fabricantes);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Informações dos Fabricantes e Veículos</title>
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
            <a href="lista.php">Voltar para a lista de máquinas</a>
        </nav>
        <hr/>
        <nav>
            <?php include_once('menu_veiculos.php'); ?>
        </nav>
        <?php 
        if ($_SESSION['nivel_acesso'] === 'admin' || $_SESSION['nivel_acesso'] === 'gerente') {
                echo "<a href='inserir_fabricante.php' ><button class='btn-voltar'style='color: #fff'>Inserir fabricante</button></a>";
                echo "<a href='editar_fabricante.php'><button class='btn-voltar' style='color: #fff; background-color: #00758f;'>Editar fabricante</button></a>";
                echo "<a href='deletar_fabricante.php'><button class='btn-voltar' style='color: #fff; background-color: #dc3545;'>Deletar fabricante</button></a>";
            }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Fabricantes</th>
                    <th>País de origem</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['nome_fabricante']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['pais_origem']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">Nenhum registro encontrado.</td></tr>';
                }
                
                ?>
            </tbody>            
            </tbody>
        </table>
    </div>
</body>
</html>