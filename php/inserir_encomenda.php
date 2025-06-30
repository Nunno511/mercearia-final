<?php
require_once('../conexoes/conexao.php');

$data = json_decode(file_get_contents("php://input"), true);

$nome = $data['nome'] ?? '';
$data_nasc = $data['data_nascimento'] ?? '';
$morada = $data['morada'] ?? '';
$produtos = json_encode($data['produtos'] ?? []);
$total = $data['preco_total'] ?? 0;
$utilizador_id = $data['utilizador_id'] ?? 0;

if (!$nome || !$data_nasc || !$morada || !$produtos || !$total || !$utilizador_id) {
    echo json_encode(['sucesso' => false, 'erro' => 'Dados incompletos.']);
    exit;
}

$idade = (int) ((time() - strtotime($data_nasc)) / (365.25 * 24 * 60 * 60));
if ($idade < 18) {
    echo json_encode(['sucesso' => false, 'erro' => 'A idade mínima é 18 anos.']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO encomendas (utilizador_id, nome_cliente, data_nascimento, morada, produtos, preco_total) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$utilizador_id, $nome, $data_nasc, $morada, $produtos, $total]);
    echo json_encode(['sucesso' => true]);
} catch (PDOException $e) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao gravar encomenda.']);
}
?>