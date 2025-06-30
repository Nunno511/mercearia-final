
<header style="background-color: #fff; padding: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between;">
    <div style="display: flex; align-items: center;">
        <a href="index.php" style="text-decoration: none; color: inherit; display: flex; align-items: center;">
            <img src="assets/images/logo.png" alt="Logo" style="height: 40px; margin-right: 10px;">
            <h1 style="margin: 0; font-size: 1.5em;">CestaFresca</h1>
        </a>
    </div>
    <div style="display: flex; align-items: center; gap: 18px;">
        <span style="margin-right: 15px;">Área do Utilizador</span>
        <a href="#" id="btn-login" style="background-color: #27ae60; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; margin-right: 5px;">Login</a>
        <a href="#" id="btn-register" style="background-color: #3498db; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px;">Registar</a>
        <form class="search-bar" style="margin-left: 24px;">
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