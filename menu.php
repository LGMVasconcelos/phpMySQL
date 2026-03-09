<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if ($_SESSION['nivel_acesso'] === 'admin' || $_SESSION['nivel_acesso'] === 'gerente') {
        echo "<a href='relatorio.php' style='color: #00758f; text-decoration: none;'>Relatório de Produção</a>";
        echo "&nbsp; | &nbsp;";
        echo "<a href='relatorio2.php' style='color: #00758f; text-decoration: none;'>Relatório de Operação</a>";
     }
    else if ($_SESSION['nivel_acesso'] === 'operador') {
        echo "<a href='relatorio.php' style='color: #00758f; text-decoration: none;'>Relatório de Produção</a>";
    }
        echo "&nbsp; | &nbsp;";
        echo "<a href='#' style='color: #00758f; text-decoration: none;'>#</a>";
        echo "&nbsp; | &nbsp;";
        echo "<a href='#' style='color: #00758f; text-decoration: none;'>#</a>";
?>
