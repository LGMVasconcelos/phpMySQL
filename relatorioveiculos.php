<?php
include_once('conexao.php');
$query = "SELECT f.nome_fabricante, COUNT(v.id_veiculo) AS quantidade_veiculos 
          FROM tb_fabricantes f
          LEFT JOIN tb_veiculos v ON f.id_fabricante = v.id_fabricante_fk
          GROUP BY f.nome_fabricante
          ORDER BY f.nome_fabricante";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Relatório Geral de Fabricantes</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Relatório Geral de Fabricantes</h1>
        <table>
            <thead>
                <tr>
                    <th>Fabricante</th>
                    <th>Quantidade de veículos cadastrados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['nome_fabricante']) . '</td>';
                        echo '<td>' . intval($row['quantidade_veiculos']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="2">Nenhum registro encontrado.</td></tr>';
                }

                ?>
            </tbody>
        </table>
        <p><a href="fabricantes_e_veiculos.php" class="btn-voltar">&larr; Voltar para Lista</a></p>
    </div>
</body>

</html>