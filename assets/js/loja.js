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
});