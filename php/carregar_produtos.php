<?php
require_once('../conexoes/conexao.php');

try {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($produtos);
} catch (PDOException $e) {
    echo json_encode(['erro' => 'Erro ao carregar produtos.']);
}
?>