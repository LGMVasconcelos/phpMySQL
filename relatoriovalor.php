<?php
include_once('conexao.php');
$query = "SELECT f.nome_fabricante, SUM(v.valor_tabela) AS soma_precos
          FROM tb_veiculos v
          JOIN tb_fabricantes f ON v.id_fabricante_fk = f.id_fabricante
          GROUP BY f.nome_fabricante
          ORDER BY f.nome_fabricante";
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
                    <th>Fabricante</th>
                    <th>Soma dos preços de todos os veículos da marca</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['nome_fabricante']) . '</td>';
                        echo '<td>R$ ' . number_format($row['soma_precos'], 2, ',', '.') . '</td>';
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