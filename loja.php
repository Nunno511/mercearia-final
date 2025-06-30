<?php include 'includes/header.php'; ?>
<?php include 'conexoes/conexao.php'; ?>
<!DOCTYPE html>
<html>
    <head>
    <title>Loja</title>
    <script src="assets/js/loja.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- Removed the sales-title and slideshow container from here -->

<div id="floating-cart">
    <div id="cart-drag-handle">Carrinho</div>
    <h2 id="total">Total: €0.00</h2>
    <button id="open-cart-btn" type="button">Ver Itens</button>
    <div id="cart-items" style="display:none; max-height:200px; overflow-y:auto; text-align:left; margin-top:10px; background:#f8f8f8; border-radius:8px; border:1px solid #eee; padding:10px;"></div>
    <a href="checkout.php" id="finalizar-btn">Finalizar Compra</a>
</div>

</body>
</html>