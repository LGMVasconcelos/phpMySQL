<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $login = $_POST['login'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmarsenha = $_POST['confirmarsenha'] ?? '';

        if (empty($nome) || empty($login) || empty($senha) || empty($confirmarsenha)) {
            echo "<p class='alerta'>Todos os campos são obrigatórios.</p>";
        } elseif ($confirmarsenha !== $senha) {
            echo "<p class='alerta'>As senhas não coincidem. Tente novamente.</p>";
        } else {
            // Verificar se login já existe
            $login_safe = mysqli_real_escape_string($conn, $login);
            $check = mysqli_query($conn, "SELECT id_usuario FROM tb_usuarios WHERE login = '$login_safe'");
            if ($check && mysqli_num_rows($check) > 0) {
                echo "<p class='alerta'>Login já existe. Escolha outro.</p>";
            } else {
                $nome_safe = mysqli_real_escape_string($conn, $nome);
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $sql = "INSERT INTO tb_usuarios (nome_usuario, login, senha) VALUES ('$nome_safe', '$login_safe', '$senha_hash')";
                if (mysqli_query($conn, $sql)) {
                    echo "<script type='text/javascript'>alert('Você foi cadastrado com sucesso!');</script>";
                    header("Location: login.php");
                    exit();
                } else {
                    echo "<p class='alerta'>Erro ao cadastrar: " . mysqli_error($conn) . "</p>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>
    <div>
        <form class="form" method="POST">
            <p class="title">Cadastro </p>
            <p class="message">Cadastre-se agora para acessar a plataforma. </p>
            <label>
                <input required="" placeholder="" type="text" class="input" id="nome" name="nome">
                <span>Nome</span>
            </label>

            <label>
                <input required="" placeholder="" type="text" class="input" id="login" name="login">
                <span>Login</span>
            </label>

            <label>
                <input required="" placeholder="" type="password" class="input" id="senha" name="senha">
                <span>Senha</span>
            </label>
            <label>
                <input required="" placeholder="" type="password" class="input" id="confirmarsenha" name="confirmarsenha">
                <span>Confirmar senha</span>
            </label>
            <button class="submit">Cadastrar-se</button>
            <p class="signin">Já tem uma conta? Acesse o <a class="textologin" href="login.php">Login </a> </p>
        </form>
    </div>
</body>

</html>