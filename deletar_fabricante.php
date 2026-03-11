<?php
include_once("conexao.php");
session_start();

$stmt = $pdo->query('SELECT id_fabricante, nome_fabricante FROM tb_fabricantes');
$fabricantes_disponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exclusão de Fabricantes</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div>
        <form class="form" method="POST" action="validar_exclusao_fabricante.php">
            <p class="title">Exclusão de Fabricantes</p>
            <p class="message">Selecione o fabricante que deseja deletar.</p>
            <label>
                <select class="input" id="id_fabricante" name="id_fabricante" required>
                    <option value="" disabled>Selecione o fabricante que deseja deletar:</option>
                    <?php
                    foreach ($fabricantes_disponiveis as $fabricante) {
                        echo "<option value='{$fabricante['id_fabricante']}'>{$fabricante['nome_fabricante']}</option>";
                    }
                    ?>
                </select>
                <span>Fabricante</span>
            </label>
            <button class="submit">Deletar fabricante</button>
        </form>
    </div>
</body>
</html>