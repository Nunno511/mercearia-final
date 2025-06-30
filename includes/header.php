<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']); // or your session variable for logged in user
?>
<header style="background-color: #fff; padding: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center;">
        <a href="index.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
            <img src="assets/images/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <h1 style="margin: 0; font-size: 1.5em;">CestaFresca</h1>
        </a>
    </div>
    <div id="user-area" style="display: flex; align-items: center; gap: 18px;">
      <!-- search bar -->
      <form class="search-bar" style="margin-left: 55px;">
          <input type="text" placeholder="Pesquisar produtos...">
          <button type="submit">
              <span>
                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <circle cx="9" cy="9" r="7" stroke="#888" stroke-width="2"/>
                      <line x1="14.2" y1="14.2" x2="18" y2="18" stroke="#888" stroke-width="2" stroke-linecap="round"/>
                  </svg>
              </span>
          </button>
      </form>
      <!-- icon utilizador -->
      <div style="position: relative; display: flex; align-items: center;">
        <button id="user-menu-btn" style="background:none; border:none; cursor:pointer; display:flex; align-items:center;">
            <img src="assets/icons/perfil-de-usuario.png" alt="User Icon" style="height: 30px; width: 30px; border-radius: 50%;">
        </button>
        <div id="user-dropdown" style="display:none; position:absolute; top:40px; right:0; background:#fff; border-radius:8px; box-shadow:0 4px 16px rgba(0,0,0,0.12); min-width:44px; width:44px; z-index:100; padding:4px 0;">
            <a href="#" id="btn-login" style="display:flex; align-items:center; justify-content:center; padding:8px 0; color:#27ae60; text-decoration:none;">
                <img src="assets/icons/login-do-usuario.png" alt="Login Icon" style="height:24px; width:24px;">
            </a>
            <a href="#" id="btn-register" style="display:flex; align-items:center; justify-content:center; padding:8px 0; color:#3498db; text-decoration:none;">
                <img src="assets/icons/adicionar-usuario.png" alt="Register Icon" style="height:24px; width:24px;">
            </a>
            <?php if ($isLoggedIn): ?>
            <a href="pages/auth/logout.php" id="btn-logout" style="display:flex; align-items:center; justify-content:center; padding:8px 0; color:#e74c3c; text-decoration:none;">
                <img src="assets/icons/sair-do-usuario.png" alt="Logout Icon" style="height:24px; width:24px;">
            </a>
            <?php endif; ?>
        </div>
      </div>
      <!-- carrinho -->
      <button href="mer" id="cart-btn" style="background:none; border:none; cursor:pointer; display:flex; align-items:center; position:relative;">
          <img src="assets/icons/shopping-cart.png" alt="Cart Icon" style="height: 30px; width: 30px;">
          <span id="cart-count" style="position:absolute; top:0; right:0; background:#e74c3c; color:#fff; border-radius:50%; font-size:0.85em; min-width:18px; height:18px; display:flex; align-items:center; justify-content:center; padding:0 5px; font-weight:bold; transform:translate(40%,-40%);">0</span>
      </button>
      <!-- Cart Modal -->
      <div id="cart-modal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:5000; align-items:center; justify-content:center;">
        <div style="background:#fff; padding:30px; border-radius:10px; min-width:320px; max-width:95vw; max-height:90vh; overflow-y:auto; position:relative;">
          <span id="close-cart-modal" style="position:absolute; top:10px; right:15px; cursor:pointer; font-size:2em;">&times;</span>
          <div id="cart-modal-items"></div>
          <div style="margin-top:18px;">
            <strong>Total: <span id="cart-modal-total">€0.00</span></strong>
          </div>
          <a href="checkout.php" id="cart-modal-checkout" style="display:inline-block; margin-top:18px; background:#27ae60; color:#fff; padding:10px 18px; border-radius:6px; text-decoration:none; font-weight:bold;">Finalizar Compra</a>
        </div>
      </div>
    </div>
</header>
<!-- Login Modal -->
<div id="modal-login" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:2000; align-items:center; justify-content:center;">
  <div style="background:#fff; padding:30px; border-radius:8px; min-width:300px; position:relative;">
    <span id="close-login" style="position:absolute; top:10px; right:15px; cursor:pointer;">&times;</span>
    <h2>Login</h2>
    <form method="post" action="pages/auth/login.php">
      <label>Email:<br><input type="email" name="email" required></label><br>
      <label>Senha:<br><input type="password" name="senha" required></label><br>
      <button type="submit" style="margin-top:10px;">Entrar</button>
    </form>
  </div>
</div>
<!-- Register Modal -->
<div id="modal-register" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:2000; align-items:center; justify-content:center;">
  <div style="background:#fff; padding:30px; border-radius:8px; min-width:300px; position:relative;">
    <span id="close-register" style="position:absolute; top:10px; right:15px; cursor:pointer;">&times;</span>
    <h2>Registar</h2>
    <form method="post" action="pages/auth/register.php">
      <label>Nome:<br><input type="text" name="nome" required></label><br>
      <label>Email:<br><input type="email" name="email" required></label><br>
      <label>Senha:<br><input type="password" name="senha" required></label><br>
      <button type="submit" style="margin-top:10px;">Registar</button>
    </form>
  </div>
</div>
<script src="assets/js/auth-modal.js"></script>
<nav style="background-color: #f4f4f4; padding: 10px; display: flex; gap: 15px; justify-content: center;">
    <a href="#" style="font-weight: bold;">Frutas</a>
    <a href="#" style="font-weight: bold;">Legumes</a>
    <a href="#" style="font-weight: bold;">Laticínios</a>
    <a href="#" style="font-weight: bold;">Padaria</a>
    <a href="#" style="font-weight: bold;">Carnes</a>
    <a href="#" style="font-weight: bold;">Bebidas</a>
    <a href="#" style="font-weight: bold;">Mercearia</a>
    <a href="#" style="font-weight: bold;">Congelados</a>
</nav>
