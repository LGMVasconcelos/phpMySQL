<?php
include_once("conexao.php");
$fabricante = $_POST['nome_fabricante'] ?? '';
$stmt = $pdo->prepare("SELECT id_fabricante FROM tb_fabricantes WHERE nome_fabricante = ?");
$stmt->execute([$fabricante]);
if ($stmt->rowCount() > 0) {
    echo "<p class='alerta'>O fabricante '$fabricante' já existe. Tente novamente.</p>";
} else {
    // Código para inserir o novo fabricante no banco de dados
    $pais_origem = $_POST['pais_origem'] ?? '';
    
    $insert_stmt = $pdo->prepare("INSERT INTO tb_fabricantes (nome_fabricante, pais_origem) VALUES (?, ?)");
    if ($insert_stmt->execute([$fabricante, $pais_origem])) {
        echo "<p class='sucesso'>Fabricante cadastrado com sucesso!</p>";
        header("Location: fabricantes_e_veiculos.php");
        exit();
    } else {
        echo "<p class='alerta'>Erro ao cadastrar o fabricante. Tente novamente.</p>";
        header("Location: fabricantes_e_veiculos.php");
        exit();
    }
}
?>