<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <script src="assets/js/checkout.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<h1 class="sales-title" style="margin-bottom:24px;">Finalizar Encomenda</h1>
<div class="form-container" style="margin: 0 auto; max-width: 400px;">
    <form id="form-encomenda">
        <input type="hidden" name="utilizador_id" value="1"> <!-- Substituir com login real -->
        <label>Nome:
            <input type="text" name="nome" required>
        </label>
        <label>Data de Nascimento:
            <input type="date" name="data_nascimento" required>
        </label>
        <label>Morada:
            <textarea name="morada" required style="width:100%;min-height:60px;border-radius:4px;border:1px solid #ccc;padding:6px;"></textarea>
        </label>
        <label>Tipo de Pagamento:
            <select name="tipo_pagamento" required style="width:100%;padding:8px;border-radius:4px;border:1px solid #ccc;">
                <option value="">Selecione...</option>
                <option value="mbway">MB WAY</option>
                <option value="multibanco">Multibanco</option>
                <option value="visa">Visa</option>
                <option value="dinheiro">Dinheiro</option>
            </select>
        </label>
        <button type="submit" id="checkout-btn" style="margin-top:16px;">Concluir Compra</button>
    </form>
</div>
</body>
</html>