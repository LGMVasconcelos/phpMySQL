<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banco Vulnerável</title>
    <link rel="stylesheet" href="stylelist.css">
</head>
<body>
    <div class="container">
        <h1>Busca Segura</h1>
        <form action="" method="get">
            <input type="text" name="busca" id="busca">
            <button>Buscar</button>
        </form>
        <?php
        include_once("conexao.php");

        if(isset($_GET['busca'])) {
            $busca = $_GET['busca'];

            $sql = "SELECT * FROM alunos WHERE nome LIKE ?";
            $stmt = mysqli_prepare($conn, $sql);

            $param_busca = "%" . $busca . "%";

            mysqli_stmt_execute($stmt);

            $resultado = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<table><tr><th>Nome</th><th>Email</th></tr>";
                while ($linha = mysqli_fetch_assoc($resultado)) {
                    echo "<tr><th>{$linha['nome']}</td><td>{$linha['email']}</td></tr>";
                }
                echo "</table>";
            }
        }
        ?>
    </div>
</body>
</html>