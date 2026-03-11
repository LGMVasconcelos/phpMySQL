<?php
include_once("conexao.php");
$maquina = $_POST['tag_maquina'] ?? '';
$stmt = $pdo->prepare("SELECT id_maquina FROM tb_maquinas WHERE tag_maquina = ?");
$stmt->execute([$maquina]);
if ($stmt->rowCount() > 0) {
    echo "<p class='alerta'>A máquina com a tag '$maquina' já existe. Tente novamente.</p>";
} else {
    // Código para inserir a nova máquina no banco de dados
    $tipo = $_POST['tipo_maquina'] ?? '';
    $status = $_POST['status_operacional'] ?? '';
    
    $insert_stmt = $pdo->prepare("INSERT INTO tb_maquinas (tag_maquina, tipo_maquina, status_operacional) VALUES (?, ?, ?)");
    if ($insert_stmt->execute([$maquina, $tipo, $status])) {
        echo "<p class='sucesso'>Máquina cadastrada com sucesso!</p>";
        header("Location: lista.php");
        exit();
    } else {
        echo "<p class='alerta'>Erro ao cadastrar a máquina. Tente novamente.</p>";
        header("Location: lista.php");
        exit();
    }
}
?>