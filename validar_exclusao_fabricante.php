<?php
include_once("conexao.php");
$fabricante = $_POST['id_fabricante'] ?? '';
$stmt = $pdo->prepare("DELETE FROM tb_fabricantes WHERE id_fabricante = ?");
$success = $stmt->execute([$fabricante]);
if ($success && $stmt->rowCount() > 0) {
    echo "<p class='sucesso'>Fabricante deletado com sucesso!</p>";
    header("Location: fabricantes_e_veiculos.php");
    exit();
} else {
    echo "<p class='alerta'>Erro ao deletar o fabricante. Tente novamente.</p>";
    header("Location: fabricantes_e_veiculos.php");
    exit();
}
?>