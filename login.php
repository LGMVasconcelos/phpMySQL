<?php
include_once("conexao.php");
session_start();

// Verificar se já está logado via sessão
if (isset($_SESSION['usuario_id'])) {
    header("Location: lista.php");
    exit();
}

// Verificar remember me via cookie
if (isset($_COOKIE['remember_token'])) {
    mysqli_query($conn, "SET @chave_secreta = 'SenhaUltraForte!123@;.,'");
    $token = mysqli_real_escape_string($conn, $_COOKIE['remember_token']);
    $sql = "SELECT u.id, u.nome FROM usuario u JOIN remember_tokens r ON u.id = r.user_id WHERE r.token = '$token' AND r.expires > NOW()";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['usuario_id'] = $row['id'];
        $_SESSION['usuario_nome'] = $row['nome'];
        header("Location: lista.php");
        exit();
    } else {
        // Token inválido, remover cookie
        setcookie('remember_token', '', time() - 3600, '/');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $remember = isset($_POST['remember']);

    if (empty($email) || empty($senha)) {
        echo "<p class='alerta'>Todos os campos são obrigatórios.</p>";
    } else {
        mysqli_query($conn, "SET @chave_secreta = 'SenhaUltraForte!123@;.,'");
        $sql = "SELECT id, nome, AES_DECRYPT(senha_criptografada, @chave_secreta) AS senha FROM usuario WHERE email = '" . mysqli_real_escape_string($conn, $email) . "'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($senha === $row['senha']) {
                $_SESSION['usuario_id'] = $row['id'];
                $_SESSION['usuario_nome'] = $row['nome'];

                if ($remember) {
                    // Gerar token único
                    $token = bin2hex(random_bytes(32));
                    $expires = date('Y-m-d H:i:s', strtotime('+30 days'));
                    $user_id = $row['id'];

                    // Salvar token no banco
                    $sql_token = "INSERT INTO remember_tokens (user_id, token, expires) VALUES ($user_id, '$token', '$expires')";
                    mysqli_query($conn, $sql_token);

                    // Setar cookie
                    setcookie('remember_token', $token, strtotime('+30 days'), '/', '', false, true);
                }

                print($email);
                print($senha);
                header("Location: cadastroDeAlunos.php");
                exit();
            } else {
                echo "<p class='alerta'>Senha incorreta. Tente novamente.</p>";
            }
        } else {
            echo "<p class='alerta'>Usuário não encontrado. Verifique o email.</p>";
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