<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    echo "<a href='relatorioestoque.php' style='color: #00758f; text-decoration: none;'>Relatório de Estoque por marca</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='relatorioveiculos.php' style='color: #00758f; text-decoration: none;'>Relatório Geral de fabricantes</a>";
    echo "&nbsp; | &nbsp;";
    echo "<a href='relatoriovalor.php' style='color: #00758f; text-decoration: none;'>Relatório de Valor Total em Frota</a>";
?>