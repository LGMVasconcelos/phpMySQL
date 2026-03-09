<?php
include 'conexao.php';

header('Content-Type: application/json');

if (isset($_GET['tipo_maquina']) && !empty($_GET['tipo_maquina'])) {
    $tipo = $_GET['tipo_maquina'];
    
    // Mapeamento de tipos para prefixos
    $prefixos = [
        'Braço Robótico' => 'ROB',
        'Célula de pintura' => 'PNT',
        'Corte a Laser' => 'COR',
        'Embaladora' => 'EMB',
        'Extrusora' => 'EXT',
        'Linha de Montagem' => 'MON',
        'Prensa Hidráulica' => 'PRE',
        'Solda Robotizada' => 'SOL',
        'Torno CNC' => 'CNC'
    ];
    
    $prefixo = $prefixos[$tipo] ?? 'MAQ';
    
    // Contar quantas máquinas deste tipo já existem usando prepared statement
    $sql = "SELECT COUNT(*) as total FROM tb_maquinas WHERE tipo_maquina = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $tipo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $proximo_numero = $row['total'] + 1;
    
    // Formatar com trailing zero se necessário
    $numero_formatado = str_pad($proximo_numero, 2, '0', STR_PAD_LEFT);
    $tag = $prefixo . '-' . $numero_formatado;
    
    echo json_encode(['tag' => $tag, 'success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Tipo de máquina não fornecido']);
}
?>

