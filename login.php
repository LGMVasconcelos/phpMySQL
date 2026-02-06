<?php
include_once("conexao.php");
session_start();

// Verificar se já está logado via sessão
if (isset($_SESSION['usuario_id'])) {
    header("Location: lista.php");
    exit();
}

// (Nota: remember-me token logic removed for now; implement with a dedicated table if desired)

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if (empty($login) || empty($senha)) {
        echo "<p class='alerta'>Todos os campos são obrigatórios.</p>";
    } else {
        $login_safe = mysqli_real_escape_string($conn, $login);
        $sql = "SELECT id_usuario, nome_usuario, senha FROM tb_usuarios WHERE login = '$login_safe'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($senha, $row['senha'])) {
                $_SESSION['usuario_id'] = $row['id_usuario'];
                $_SESSION['usuario_nome'] = $row['nome_usuario'];
                header("Location: lista.php");
                exit();
            } else {
                echo "<p class='alerta'>Senha incorreta. Tente novamente.</p>";
            }
        } else {
            echo "<p class='alerta'>Usuário não encontrado. Verifique o login.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="cadastro.css">
</head>
<body>
    <div>
        <form class="form" method="POST" >
            <p class="title">Login</p>
            <p class="message">Entre com suas credenciais para acessar a plataforma.</p>
            <label>
                <input required="" placeholder="" type="email" class="input" id="email" name="email">
                <span>Email</span>
            </label>
            <label>
                <input required="" placeholder="" type="password" class="input" id="senha" name="senha">
                <span>Senha</span>
            </label>
            <label>
                <input type="checkbox" name="remember" id="remember"> Lembrar-me
            </label>
            <button class="submit">Login</button>
            <p class="signin">Ainda não possui uma conta? <a class="textologin" href="index.php">Cadastre-se</a></p>
        </form>
    </div>
</body>
</html>