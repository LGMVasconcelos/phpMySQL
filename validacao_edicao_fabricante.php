<?php
include_once("conexao.php");
// receive the ID from the form
$id = $_POST['id_fabricante'] ?? '';

// verify that the manufacturer actually exists
$stmt = $pdo->prepare("SELECT id_fabricante FROM tb_fabricantes WHERE id_fabricante = ?");
$stmt->execute([$id]);
if ($stmt->rowCount() > 0) {
    $pais_origem = $_POST['pais_origem'] ?? '';

    $edit_stmt = $pdo->prepare("UPDATE tb_fabricantes SET pais_origem = ? WHERE id_fabricante = ?");
    if ($edit_stmt->execute([$pais_origem, $id])) {
        echo "<p class='sucesso'>Fabricante editado com sucesso!</p>";
        header("Location: fabricantes_e_veiculos.php");
        exit();
    } else {
        echo "<p class='alerta'>Erro ao editar o fabricante. Tente novamente.</p>";
        header("Location: fabricantes_e_veiculos.php");
        exit();
    }
} else {
    // no such ID, show warning and redirect
    echo "<p class='alerta'>Fabricante não encontrado.</p>";
    header("Location: fabricantes_e_veiculos.php");
    exit();
}
?>