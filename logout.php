<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: index.html");
    exit();
}
session_unset();
session_destroy();

if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID', '', time() - 3600, '/', '', 0, true);
}
header("Location: index.html");
exit();
?>