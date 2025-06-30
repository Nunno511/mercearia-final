document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-encomenda');
    const carrinho = JSON.parse(localStorage.getItem('carrinho'));
    const total = localStorage.getItem('total');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const dados = {
            nome: form.nome.value,
            data_nascimento: form.data_nascimento.value,
            morada: form.morada.value,
            tipo_pagamento: form.tipo_pagamento.value, // Added payment type
            produtos: carrinho,
            preco_total: total,
            utilizador_id: form.utilizador_id.value
        };

        fetch('php/inserir_encomenda.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(dados)
        }).then(res => res.json())
          .then(resp => {
              if (resp.sucesso) {
                  alert("Encomenda realizada com sucesso!");
                  localStorage.clear();
                  window.location.href = 'index.php';
              } else {
                  alert(resp.erro);
              }
          });
    });
});