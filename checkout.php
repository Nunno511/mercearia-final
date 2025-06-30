<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html><head>
    <title>Checkout</title>
    <script src="assets/js/checkout.js"></script>
</head>
<body>
<h1>Finalizar Encomenda</h1>
<form id="form-encomenda">
    <input type="hidden" name="utilizador_id" value="1"> <!-- Substituir com login real -->
    <label>Nome: <input type="text" name="nome" required></label><br>
    <label>Data de Nascimento: <input type="date" name="data_nascimento" required></label><br>
    <label>Morada: <textarea name="morada" required></textarea></label><br>
    <button type="submit">Concluir Compra</button>
</form>
</body></html>