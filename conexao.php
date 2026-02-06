<?php
/**
 * Configurações de Conexão - Contexto Industrial
 */
$host    = 'localhost';
$db_name = 'db_industria_automotiva';
$user    = 'root'; // Usuário criado no GRANT anteriormente
$pass    = '';
$charset = 'utf8mb4';
// Configuração do DSN (Data Source Name)
$dsn = "mysql:host=$host;dbname=$db_name;charset=$charset";
// Opções do PDO para maior segurança e performance
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lança exceções em erros
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Retorna arrays associativos
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Desativa emulação para usar o prepare real do MySQL
];
try {
    // Criação da conexão
    $pdo = new PDO($dsn, $user, $pass, $options); 
    // Conexão bem-sucedida (Opcional: remover em produção)
    // echo "Conectado!";
    // echo "Conexão estabelecida com sucesso!"; 
} catch (\PDOException $e) {
    // Em caso de erro, não exibimos a senha. Apenas uma mensagem genérica ou o erro técnico.
    exit("Erro na conexão com o Banco de Dados: " . $e->getMessage());
}
// Também expor uma conexão mysqli procedural para compatibilidade com código existente
$conn = mysqli_connect($host, $user, $pass, $db_name);
if (!$conn) {
    exit("Erro na conexão MySQLi: " . mysqli_connect_error());
}
mysqli_set_charset($conn, $charset);
?>