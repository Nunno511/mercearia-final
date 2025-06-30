
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrinho</title>
    <script src="assets/js/carrinho.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1 class="sales-title">Carrinho de Compras</h1>
<div id="cart-page-container" style="max-width:600px;margin:30px auto;background:#fff;padding:24px 18px;border-radius:10px;box-shadow:0 2px 12px rgba(0,0,0,0.07);">
    <div id="cart-page-items"></div>
    <div style="margin-top:18px;">
        <strong>Total: <span id="cart-page-total">€0.00</span></strong>
    </div>
    <div style="margin-top:24px;display:flex;gap:16px;">
        <a href="loja.php" style="background:#3498db;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;font-weight:bold;">Adicionar Produtos</a>
        <a href="checkout.php" id="cart-page-checkout" style="background:#27ae60;color:#fff;padding:10px 18px;border-radius:6px;text-decoration:none;font-weight:bold;">Finalizar Compra</a>
    </div>
</div>
<script src="assets/js/loja.js"></script>
</body>
</html>