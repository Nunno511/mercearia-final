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

    // Floating cart drag logic (if you use it)
    const cart = document.getElementById('floating-cart');
    const handle = document.getElementById('cart-drag-handle');
    let offsetX = 0, offsetY = 0, isDragging = false;

    if (handle && cart) {
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
    }

    // Cart modal logic
    const cartBtn = document.getElementById('cart-btn');
    const cartModal = document.getElementById('cart-modal');
    const closeCartModal = document.getElementById('close-cart-modal');
    const cartModalItems = document.getElementById('cart-modal-items');
    const cartModalTotal = document.getElementById('cart-modal-total');
    const cartCount = document.getElementById('cart-count');

    function renderCartModal() {
        let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        let total = 0;
        if (carrinho.length === 0) {
            cartModalItems.innerHTML = "<p style='text-align:center;font-weight:bold;color:#e74c3c;font-size:1.2em;'>Carrinho vazio!!</p>";
        } else {
            cartModalItems.innerHTML = carrinho.map((item, idx) => `
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:10px; gap:10px;">
                    <span style="flex:1;">${item.nome}</span>
                    <button class="cart-dec" data-idx="${idx}" style="padding:2px 8px; font-size:1.1em;">-</button>
                    <span>${item.quantidade}</span>
                    <button class="cart-inc" data-idx="${idx}" style="padding:2px 8px; font-size:1.1em;">+</button>
                    <span>€${(item.preco * item.quantidade).toFixed(2)}</span>
                    <button class="cart-remove" data-idx="${idx}" style="color:#e74c3c; background:none; border:none; font-size:1.2em; cursor:pointer;">&times;</button>
                </div>
            `).join('');
        }
        total = carrinho.reduce((sum, item) => sum + item.preco * item.quantidade, 0);
        cartModalTotal.textContent = `€${total.toFixed(2)}`;
        cartCount.textContent = carrinho.length;
        localStorage.setItem('total', total.toFixed(2));
    }

    if (cartBtn && cartModal) {
        cartBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            if (carrinho.length === 0) {
                // Custom styled popup
                let popup = document.createElement('div');
                popup.style.position = 'fixed';
                popup.style.top = '50%';
                popup.style.left = '50%';
                popup.style.transform = 'translate(-50%, -50%)';
                popup.style.background = '#fff';
                popup.style.color = '#e74c3c';
                popup.style.fontWeight = 'bold';
                popup.style.fontSize = '1.2em';
                popup.style.padding = '32px 38px';
                popup.style.borderRadius = '12px';
                popup.style.boxShadow = '0 4px 24px rgba(0,0,0,0.18)';
                popup.style.zIndex = '9999';
                popup.style.textAlign = 'center';
                popup.textContent = 'Carrinho vazio!!';

                document.body.appendChild(popup);

                setTimeout(() => {
                    popup.style.transition = 'opacity 0.4s';
                    popup.style.opacity = '0';
                    setTimeout(() => popup.remove(), 400);
                }, 1600);

                return;
            }
            renderCartModal();
            cartModal.style.display = 'flex';
        });
    }
    if (closeCartModal && cartModal) {
        closeCartModal.addEventListener('click', function () {
            cartModal.style.display = 'none';
        });
    }
    window.addEventListener('click', function(e) {
        if (e.target === cartModal) cartModal.style.display = 'none';
    });

    // Handle add, remove, increment, decrement in modal
    if (cartModalItems) {
        cartModalItems.addEventListener('click', function(e) {
            let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
            if (e.target.classList.contains('cart-remove')) {
                const idx = parseInt(e.target.dataset.idx);
                carrinho.splice(idx, 1);
                localStorage.setItem('carrinho', JSON.stringify(carrinho));
                renderCartModal();
            }
            if (e.target.classList.contains('cart-inc')) {
                const idx = parseInt(e.target.dataset.idx);
                carrinho[idx].quantidade += 1;
                localStorage.setItem('carrinho', JSON.stringify(carrinho));
                renderCartModal();
            }
            if (e.target.classList.contains('cart-dec')) {
                const idx = parseInt(e.target.dataset.idx);
                if (carrinho[idx].quantidade > 1) {
                    carrinho[idx].quantidade -= 1;
                    localStorage.setItem('carrinho', JSON.stringify(carrinho));
                    renderCartModal();
                }
            }
        });
    }

    // Update cart count badge on storage change
    function updateCartCount() {
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        cartCount.textContent = carrinho.length;
    }
    updateCartCount();
    window.addEventListener('storage', updateCartCount);

    // Slideshow logic
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
