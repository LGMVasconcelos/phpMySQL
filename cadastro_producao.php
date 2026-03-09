<?php
include_once("conexao.php");
session_start();

$stmt = $pdo->query('SELECT id_maquina, tag_maquina FROM tb_maquinas GROUP BY(id_maquina)');
$maquinas_disponiveis = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produção</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div>
        <form class="form" method="POST" action="validacao_producao.php">
            <p class="title">Cadastro de Produção</p>
            <p class="message">Preencha os dados da produção.</p>
            <label>
                <select class="input" id="tag_maquina" name="tag_maquina" required>
                    <option value="" disabled>Selecione a máquina</option>
                    <?php
                    foreach ($maquinas_disponiveis as $maquina) {
                        echo "<option value='{$maquina['tag_maquina']}'>{$maquina['tag_maquina']}</option>";
                    }
                    ?>
                </select>
                <span>Máquina</span>
            </label>
            <label>
                <input required="" type="number" class="input" id="quantidade_produzida" name="quantidade_produzida">
                <span>Quantidade produzida</span>
            </label>
            <label>
                <input required=""type="date" class="input" id="data_producao" name="data_producao">
                <span>Data de produção</span>
            </label>
            <label>
                <select class="input" id="turno" name="turno">
                    <option value="">Selecione o turno</option>
                    <option value="1">Turno A</option>
                    <option value="2">Turno B</option>
                    <option value="3">Turno C</option>
                </select>
                <span>Turno</span>
            </label>
            <button class="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>