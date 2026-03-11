<?php
include_once("conexao.php");
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fabricantes</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div>
        <form class="form" method="POST" action="validacao_fabricante.php">
            <p class="title">Cadastro de Fabricantes</p>
            <p class="message">Preencha os dados do fabricante.</p>
            <label>
                <input required="" type="text" class="input" id="nome_fabricante" name="nome_fabricante" >
                <span>Fabricante</span>
            </label>
            <label>
                <input required="" type="text" class="input" id="pais_origem" name="pais_origem">
                <span>País de origem</span>
            </label>
            <button class="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>