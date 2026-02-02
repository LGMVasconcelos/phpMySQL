<?php
    include_once("conexao.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $confirmarsenha = $_POST['confirmarsenha'] ?? '';

        if (empty($nome) || empty($email) || empty($senha) || empty($confirmarsenha)) {
            echo "<p class='alerta'>Todos os campos são obrigatórios.</p>";
        } elseif ($confirmarsenha !== $senha) {
            echo "<p class='alerta'>As senhas não coincidem. Tente novamente.</p>";
        } else {
            mysqli_query($conn, "SET @chave_secreta = 'SenhaUltraForte!123@;.,'");
            $sql = "INSERT INTO usuario (nome, email, senha_criptografada) VALUES ('" . mysqli_real_escape_string($conn, $nome) . "', '" . mysqli_real_escape_string($conn, $email) . "', AES_ENCRYPT('" . mysqli_real_escape_string($conn, $senha) . "', @chave_secreta))";
            if (mysqli_query($conn, $sql)) {
                echo "<script type='text/javascript'>alert('Você foi cadastrado com sucesso!');</script>";
                header("Location: login.php");
                exit();
            } else {
                echo "<p class='alerta'>Erro ao cadastrar: " . mysqli_error($conn) . "</p>";
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
                <input required="" placeholder="" type="email" class="input" id="email" name="email">
                <span>Email</span>
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