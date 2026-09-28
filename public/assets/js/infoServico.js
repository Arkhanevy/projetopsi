document.addEventListener("DOMContentLoaded", function () {

    const Utilitarios = window.ElmoUtilitarios;

    //Configurações
    const configuracao = {
        urlObterServico: "index.php?uri=servico"
    };

    let idServico = 1; // Axalote Utilitarios.obterParametroUrl("id");

    //Elementos
    const elementos = {
        botaoAgendarAgora: $("#botaoAgendarAgora"),
        botaoTentarNovamente: $("#botaoTentarNovamente"),
        modalErro: $("#modalServicoNaoEncontrado"),
        modalSucesso: $("#modalAgendamentoEnviado"),
        camposDinamicos: $("[data-campo]"),
        cartaoServico: $("#cartaoServico")
    };

    //FUNÇÕES

    function mapearDadosServico(registro) {
        return {
            tituloServico: registro.ser_nome,
            descricaoServico: registro.ser_desc,
            duracaoServico: registro.ser_dur ? registro.ser_dur + " min" : "",
            precoServico: formatarPreco(registro.ser_val)
        };
    }

    function formatarPreco(valor) {
        const numero = Number(valor);
        if (isNaN(numero)) return "";
        return numero.toLocaleString("pt-BR", { style: "currency", currency: "BRL" });
    }

    function habilitarBotaoAgendar() {
        elementos.botaoAgendarAgora.prop("disabled", false).attr("aria-disabled", "false");
    }

    function desabilitarBotaoAgendar() {
        elementos.botaoAgendarAgora.prop("disabled", true).attr("aria-disabled", "true");
    }

    function exibirModalErro() {
        desabilitarBotaoAgendar();
        Utilitarios.exibirModal(elementos.modalErro, { backdrop: "static", keyboard: false });
    }

    function tratarFalhaCarregamento() {
        elementos.cartaoServico.removeClass("estadoCarregando").addClass("estadoErro");
        Utilitarios.alternarEsqueletoAcessivel(elementos.camposDinamicos, true);
        exibirModalErro();
    }

    function exibirModalSucessoSeAgendado() {
        const parametros = new URLSearchParams(window.location.search);
        if (parametros.get("agendado") !== "1") return;

        Utilitarios.exibirModal(elementos.modalSucesso);

        parametros.delete("agendado");
        const novaQuerystring = parametros.toString();
        const novaUrl = window.location.pathname + (novaQuerystring ? "?" + novaQuerystring : "");
        window.history.replaceState({}, document.title, novaUrl);
    }

    function irParaAgendamento() {
        let url = "index.php?uri=agendamentoCli";
        if (idServico) {
            url += "&servico=" + encodeURIComponent(idServico);
        }
        window.location.href = url;
    }

    function buscarDadosServico() {
        Utilitarios.esconderModal(elementos.modalErro);
        desabilitarBotaoAgendar();
        elementos.cartaoServico.removeClass("estadoErro").addClass("estadoCarregando");
        Utilitarios.alternarEsqueletoAcessivel(elementos.camposDinamicos, true);

        $.ajax({
            url: configuracao.urlObterServico,
            method: "POST",
            dataType: "json",
            data: {
                acao: "mostrardetalhes",
                ser_id: idServico
            },
            success: function (resposta) {
                if (!resposta || !resposta.sucesso || !resposta.dados || !resposta.dados.length) {
                    tratarFalhaCarregamento();
                    return;
                }

                elementos.cartaoServico.removeClass("estadoCarregando estadoErro");
                Utilitarios.preencherCampos(
                    elementos.camposDinamicos,
                    mapearDadosServico(resposta.dados[0])
                );
                Utilitarios.alternarEsqueletoAcessivel(elementos.camposDinamicos, false);
                habilitarBotaoAgendar();
                exibirModalSucessoSeAgendado();
            },
            error: function () {
                tratarFalhaCarregamento();
            }
        });
    }

    //EVENTOS

    elementos.botaoTentarNovamente.on("click", function () {
        buscarDadosServico();
    });

    elementos.botaoAgendarAgora.on("click", function (evento) {
        evento.preventDefault();
        irParaAgendamento();
    });

    elementos.modalErro.on("shown.bs.modal", function () {
        elementos.botaoTentarNovamente.trigger("focus");
    });

    //INICIALIZAÇÃO
    buscarDadosServico();

});
