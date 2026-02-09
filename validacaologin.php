<?php
include_once("conexao.php");
$usuariodigitado = $_POST['login'] ?? '';
$stmt = $pdo->prepare("SELECT id_usuario, nome_usuario, senha, nivel_acesso FROM tb_usuarios WHERE login = ?");
$stmt->execute([$usuariodigitado]);

if ($stmt) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    session_start();
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nome_usuario'] = $usuario['nome_usuario'];
    $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];
    header("Location: lista.php");
} else {
        echo "<p class='alerta'>Login ou senha incorretos. Tente novamente.</p>";
}

?>