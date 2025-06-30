document.addEventListener('DOMContentLoaded', function () {
    const lista = document.getElementById('lista-produtos');
    const carrinho = [];
    let total = 0;

    fetch('php/carregar_produtos.php')
        .then(res => res.json())
        .then(produtos => {
            produtos.forEach(prod => {
                const div = document.createElement('div');
                div.innerHTML = `<strong>${prod.nome}</strong> - €${prod.preco} 
                <input type='number' min='1' max='${prod.quantidade}' value='1' id='qtd-${prod.id}'>
                <button onclick='adicionar(${JSON.stringify(prod)})'>Adicionar</button>`;
                lista.appendChild(div);
            });
        });

    window.adicionar = function (produto) {
        const qtd = parseInt(document.getElementById(`qtd-${produto.id}`).value);
        if (qtd > produto.quantidade) {
            alert("Quantidade excede o stock.");
            return;
        }
        carrinho.push({ ...produto, quantidade: qtd });
        total += produto.preco * qtd;
        document.getElementById('total').textContent = `Total: €${total.toFixed(2)}`;
        localStorage.setItem('carrinho', JSON.stringify(carrinho));
        localStorage.setItem('total', total.toFixed(2));
    }

    const cart = document.getElementById('floating-cart');
    const handle = document.getElementById('cart-drag-handle');
    let offsetX = 0, offsetY = 0, isDragging = false;

    handle.addEventListener('mousedown', function(e) {
        isDragging = true;
        offsetX = e.clientX - cart.getBoundingClientRect().left;
        offsetY = e.clientY - cart.getBoundingClientRect().top;
        cart.style.transition = 'none';
        document.body.style.userSelect = 'none';
    });

    document.addEventListener('mousemove', function(e) {
        if (!isDragging) return;
        cart.style.left = (e.clientX - offsetX) + 'px';
        cart.style.top = (e.clientY - offsetY) + 'px';
        cart.style.right = 'auto';
    });

    document.addEventListener('mouseup', function() {
        isDragging = false;
        cart.style.transition = '';
        document.body.style.userSelect = '';
    });

    // Cart open/close and show items
    const openCartBtn = document.getElementById('open-cart-btn');
    const cartItemsDiv = document.getElementById('cart-items');

    openCartBtn.addEventListener('click', function() {
        if (cartItemsDiv.style.display === 'none' || cartItemsDiv.style.display === '') {
            // Load items from localStorage
            const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            if (carrinho.length === 0) {
                cartItemsDiv.innerHTML = '<em>Carrinho vazio.</em>';
            } else {
                cartItemsDiv.innerHTML = carrinho.map(item =>
                    `<div>
                        <strong>${item.nome}</strong> (${item.quantidade} x €${item.preco})<br>
                        <span style="font-size:0.9em;color:#888;">Subtotal: €${(item.preco * item.quantidade).toFixed(2)}</span>
                    </div><hr style="margin:6px 0;">`
                ).join('');
            }
            cartItemsDiv.style.display = 'block';
            openCartBtn.textContent = 'Fechar Itens';
        } else {
            cartItemsDiv.style.display = 'none';
            openCartBtn.textContent = 'Ver Itens';
        }
    });

    fetch('php/carregar_produtos.php')
        .then(res => res.json())
        .then(produtos => {
            const slideshow = document.getElementById('slideshow-produtos');
            produtos.forEach((prod, idx) => {
                const slide = document.createElement('div');
                slide.className = 'slide';
                slide.style.animationDelay = (idx * 4) + 's';
                slide.innerHTML = `
                    <img src="assets/images/${prod.imagem || 'placeholder.jpg'}" alt="${prod.nome}" style="width:100%;height:100%;object-fit:cover;">
                    <div style="position:absolute;bottom:10px;left:0;width:100%;background:rgba(39,174,96,0.8);color:#fff;padding:8px 0;text-align:center;font-size:1.2em;">
                        <strong>${prod.nome}</strong> - €${prod.preco}
                    </div>
                `;
                slideshow.appendChild(slide);
            });
        });
});