<?php
include_once('conexao.php');
$query = "SELECT v.modelo, v.ano_fabricacao, f.nome_fabricante 
          FROM tb_veiculos v
          JOIN tb_fabricantes f ON v.id_fabricante_fk = f.id_fabricante
          ORDER BY f.nome_fabricante, v.modelo";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylelist.css">
    <title>Relatório de Estoque por Marca</title>
</head>

<body>
    <div class="container">
        <h1 class="form-title">Relatório de Estoque por Marca</h1>
        <table>
            <thead>
                <tr>
                    <th>Modelo do veículo</th>
                    <th>Ano de produção</th>
                    <th>Fabricante</th>

                </tr>
            </thead>
            <tbody>
                <?php
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['modelo']) . '</td>';
                        echo '<td>' . intval($row['ano_fabricacao']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['nome_fabricante']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3">Nenhum registro encontrado.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        <p><a href="fabricantes_e_veiculos.php" class="btn-voltar">&larr; Voltar para Lista</a></p>
    </div>
</body>

</html>