$(function ($) {

    function zeroPad(n) {
        return (n < 10 ? '0' : '') + n;
    }

    $(document).on('click', '.excluir', function () {

        if (confirm("Deseja realmente excluir esta ação?")) {
            let id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "/excluir-historico-atendimento",
                data: {
                    id: id,
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.loading').show();
                },
                success: function (data) {
                    $('#historico_' + id).remove();
                },
                error: function (data) {
                    alert('Erro ao deletar o histórico!');
                },
                complete: function() {
                    // Ocultar o GIF de loading
                    $('.loading').hide();
                }
            });
        }

        function pesquisacep(valor) {
            var cep = valor.replace(/\D/g, '');

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;

                if(validacep.test(cep)) {
                    document.getElementById('form-checkout__address').value="...";
                    document.getElementById('form-checkout__district').value="...";
                    document.getElementById('form-checkout__city').value="...";
                    document.getElementById('form-checkout__state').value="...";

                    var script = document.createElement('script');
                    script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
                    document.body.appendChild(script);
                }
                else {
                    limpa_formulário_cep();
                    alert("Formato de CEP inválido.");
                }
            }
            else {
                limpa_formulário_cep();
            }
        };

        function limpa_formulário_cep() {
                document.getElementById('form-checkout__address').value=("");
                document.getElementById('form-checkout__district').value=("");
                document.getElementById('form-checkout__city').value=("");
                document.getElementById('form-checkout__state').value=("");
        }

        function meu_callback(conteudo) {
            if (!("erro" in conteudo)) {
                document.getElementById('form-checkout__address').value=(conteudo.logradouro);
                document.getElementById('form-checkout__district').value=(conteudo.bairro);
                document.getElementById('form-checkout__city').value=(conteudo.localidade);
                document.getElementById('form-checkout__state').value=(conteudo.uf);

        var select = document.getElementById("form-checkout__state");

        var novaOption = document.createElement("option");
        novaOption.value = (conteudo.uf);
        novaOption.text = (conteudo.uf);

        select.add(novaOption);
            }
            else {
                limpa_formulário_cep();
                alert("CEP não encontrado.");
            }
        }
    });

    $(document).on('change', '.recalcularFinanceiro', function () {
        calculaDescontoFinanceiro();
    })

    function calculaDescontoFinanceiro() {
        var valorDescontoTotal = 0;
        $('.recalcularFinanceiro').each(function () {
            valor = parseFloat($(this).val().replace('.', '').replace(',', '.'));
            valorDescontoTotal = valorDescontoTotal + valor;
        })

        total_investido = parseFloat($('#total_investido').val().replace('.', '').replace(',', '.'));
        valor_total = total_investido - valorDescontoTotal

        $('#total_descontos').val(valorDescontoTotal.toFixed(2));
        $('#total_pagar').val(valor_total.toFixed(2)); 
        $('#total_descontos, #total_pagar').focus();

    }

});


