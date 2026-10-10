/* ============================================================
   PÁGINA: perfil (cliente, profissional e clínica)
   Depende de: jQuery, Bootstrap 5 (bundle), componentes.js,
   sessaoNavegacao.js e utilitarios.js (ElmoUtilitarios).
   Carregar DEPOIS deles.

   Só comportamento de interface (trocar visões, mostrar/ocultar
   por papel, habilitar campos). Nenhuma regra de negócio nem
   chamada de dados ao back-end: o que depende de dados sai como
   evento (formularioPerfilEnviado, vinculoConfirmado,
   desvinculoConfirmado) ou como função de window.PerfilTela.

   O papel vem de sessaoNavegacao.js, que dispara o evento
   "sessaoNavegacaoDefinida" com { logado, tipoUsuario }.
   ============================================================ */

(function ($, window) {
  "use strict";

  var PAPEL_POR_TIPO = {
    cliente: "cliente",
    clienteSimples: "cliente",
    profissional: "profissional",
    clinica: "clinica"
  };

  var configuracao = {
    urlLogin: "index.php", // Axalote: confirmar a página de login a usar quando a sessão expira
    urlAgendaPorPapel: {
      cliente: "index.php?uri=consultasCli",
      profissional: "index.php?uri=agendaProfissional",
      clinica: "index.php?uri=agendaClinica"
    },
    urlInicioProfissionalClinica: "home.php" // Axalote: confirmar a rota de "Início"
  };

  var $visoes = $();
  var $gatilhoVisaoAberta = null;
  var $cardDesvinculoPendente = null;

  /* ---------- Papel do usuário ---------- */

  /**
   * Mostra só o que pertence ao papel (abas e seções com data-papelPerfil).
   * A navegação (Buscar/Início, Contatos/Documentos) já é ajustada por
   * sessaoNavegacao.js + componentes.js; aqui só acertamos os links que
   * dependem do papel.
   * As visões (.visaoPerfil) só aparecem via mostrarVisao.
   */
  function aplicarPapelPerfil(papel) {
    $("[data-papelPerfil]").not(".visaoPerfil").each(function () {
      var papeisPermitidos = $(this).attr("data-papelPerfil").split(" ");
      var oculto = papeisPermitidos.indexOf(papel) === -1;
      $(this).prop("hidden", oculto);

      // Aba oculta também sai da navegação por setas do Bootstrap
      if ($(this).hasClass("abasPerfil_aba")) {
        $(this).prop("disabled", oculto);
      }
    });

    ajustarLinksPorPapel(papel);

    $("html").attr("data-papelAtual", papel);
    mostrarVisao("visaoResumoPerfil");
    atualizarEstadosVazios();
  }

  function ajustarLinksPorPapel(papel) {
    $("[data-itemAgenda]").attr("href", configuracao.urlAgendaPorPapel[papel]);

    if (papel !== "cliente") {
      $("[data-itemPapel]").attr("href", configuracao.urlInicioProfissionalClinica);
    }
  }

  function exibirModalSessaoExpirada() {
    $(".tab-content, #abasPerfil").prop("hidden", true);
    ElmoUtilitarios.exibirModal($("#modalSessaoExpirada"), {
      backdrop: "static",
      keyboard: false
    });
  }

  /* ---------- Visões dentro da aba Perfil ---------- */

  function mostrarVisao(idVisao) {
    var $alvo = $("#" + idVisao);
    if (!$alvo.length) {
      return;
    }

    $visoes.prop("hidden", true);
    $alvo.prop("hidden", false);

    var $titulo = $alvo.find(".formularioPerfil_titulo").first();
    if ($titulo.length) {
      $titulo.attr("tabindex", "-1").trigger("focus");
    }
  }

  function voltarAoResumo() {
    $visoes.filter(":not(#visaoResumoPerfil)").find("form").each(function () {
      this.reset();
    });
    $(".formularioPerfil [role='alert']").prop("hidden", true);
    $(".formularioPerfil .is-invalid").removeClass("is-invalid");
    $("#areaAlertasLocalizacao").empty();
    redefinirCampoSelect($("#campoTipoServico"));
    reaplicarEstadoDias();

    mostrarVisao("visaoResumoPerfil");

    if ($gatilhoVisaoAberta && $gatilhoVisaoAberta.length) {
      $gatilhoVisaoAberta.trigger("focus");
    }
  }

  function redefinirCampoSelect($campoSelect) {
    $campoSelect.attr("data-valorSelecionado", "").removeData("valorselecionado");
    $campoSelect.find(".campoSelect_valor").text("Selecione um tipo de serviço");
  }

  /* ---------- Dias da semana (horários de funcionamento) ---------- */

  function alternarHorariosDoDia($checkbox) {
    var marcado = $checkbox.is(":checked");
    var $horarios = $("#" + $checkbox.attr("aria-controls"));

    $horarios.prop("hidden", !marcado);
    $horarios.find("input").prop("disabled", !marcado);
    if (!marcado) {
      $horarios.find("input").val("");
    }
  }

  function reaplicarEstadoDias() {
    $(".seletorDia--comHorarios input[type='checkbox']").each(function () {
      alternarHorariosDoDia($(this));
    });
  }

  /* ---------- Estados vazios (tabelas e listas) ---------- */

  function alternarEstadoVazio($itens, $conteudo, $estadoVazio) {
    var vazio = $itens.length === 0;
    $conteudo.prop("hidden", vazio);
    $estadoVazio.prop("hidden", !vazio);
  }

  function atualizarEstadosVazios() {
    alternarEstadoVazio(
      $("#listaServicos tr"),
      $("#tabelaServicos").closest(".table-responsive"),
      $("#estadoVazioServicos")
    );
    alternarEstadoVazio(
      $("#listaHorarios tr"),
      $("#tabelaHorarios").closest(".table-responsive"),
      $("#estadoVazioHorarios")
    );
    alternarEstadoVazio($("#listaClinicasVinculadas > li"), $("#listaClinicasVinculadas"), $("#estadoVazioClinicas"));
    alternarEstadoVazio($("#listaProfissionaisVinculados > li"), $("#listaProfissionaisVinculados"), $("#estadoVazioProfissionais"));
  }

  /* ---------- Modal: vincular profissional ---------- */

  function redefinirModalVincular() {
    $("#resultadoProfissionalSelecionado").prop("checked", false);
    $("#resultadoBuscaProfissional").prop("hidden", true);
    $("#botaoConfirmarVinculo").prop("disabled", true);
    $("#campoUsuarioProfissional").val("");
  }

  /** Exibe o card do profissional encontrado (chamar após a busca). */
  function exibirResultadoBusca(dados) {
    ElmoUtilitarios.preencherCampos($("#resultadoBuscaProfissional [data-campo]"), dados || {});
    $("#resultadoBuscaProfissional").prop("hidden", false);
  }

  /** Abre o modal "Pedido de vinculamento enviado!" (chamar após o envio). */
  function exibirVinculoEnviado(dados) {
    ElmoUtilitarios.preencherCampos($("#modalVinculoEnviado [data-campo]"), dados || {});
    ElmoUtilitarios.esconderModal($("#modalVincularProfissional"));
    ElmoUtilitarios.exibirModal($("#modalVinculoEnviado"));
  }

  /* ---------- Eventos ---------- */

  $(function () {
    $visoes = $(".visaoPerfil");

    reaplicarEstadoDias();

    // Papel do usuário: definido por sessaoNavegacao.js assim que a sessão é verificada
    $(document).on("sessaoNavegacaoDefinida", function (evento, dados) {
      var papel = dados && dados.logado ? PAPEL_POR_TIPO[dados.tipoUsuario] : null;

      if (!papel) {
        exibirModalSessaoExpirada();
        return;
      }
      aplicarPapelPerfil(papel);
    });

    $("#botaoRealizarLoginSessao").on("click", function () {
      window.location.href = configuracao.urlLogin;
    });

    // Abrir / fechar visões
    $(document).on("click", "[data-acao='abrirVisao']", function () {
      $gatilhoVisaoAberta = $(this);
      var idVisao = $(this).attr("data-visao");

      if (idVisao === "visaoEdicaoBiografia") {
        $("#biografiaAtual").val($("#visaoResumoPerfil [data-campo='biografia']").text().trim());
      }
      mostrarVisao(idVisao);
    });

    $(document).on("click", "[data-acao='voltarResumo']", voltarAoResumo);

    // Horários: habilitar campos do dia marcado
    $(document).on("change", ".seletorDia--comHorarios input[type='checkbox']", function () {
      alternarHorariosDoDia($(this));
    });

    // Formulários: sem back-end aqui, apenas avisa quem for integrar
    $(document).on("submit", ".formularioPerfil", function (evento) {
      evento.preventDefault();
      $(this).trigger("formularioPerfilEnviado", { formulario: this.id });
    });

    // Localização: autopreenchimento por CEP (helper compartilhado)
    ElmoUtilitarios.configurarCEP($("#areaAlertasLocalizacao"), {
      cep: $("#localizacaoCep"),
      rua: $("#localizacaoRua"),
      bairro: $("#localizacaoBairro"),
      cidade: $("#localizacaoCidade"),
      uf: $("#localizacaoEstado"),
      ibge: $("#localizacaoIbge")
    });

    // Vincular profissional
    $(document).on("change", "input[name='profissionalSelecionado']", function () {
      $("#botaoConfirmarVinculo").prop("disabled", !$(this).is(":checked"));
    });

    $(document).on("click", "#botaoConfirmarVinculo", function () {
      $(document).trigger("vinculoConfirmado", {
        usuarioProfissional: $("#resultadoBuscaProfissional [data-campo='usuarioProfissional']").first().text().trim()
      });
    });

    $("#modalVincularProfissional").on("hidden.bs.modal", redefinirModalVincular);

    // Desvincular clínica
    $(document).on("click", "[data-acao='desvincularClinica']", function () {
      $cardDesvinculoPendente = $(this).closest("[data-idClinica]");
      ElmoUtilitarios.preencherCampos($("#modalDesvincularClinica [data-campo]"), {
        usuarioClinica: $cardDesvinculoPendente.find("[data-campo='usuarioClinica']").text().trim()
      });
    });

    $(document).on("click", "#botaoConfirmarDesvinculo", function () {
      $(document).trigger("desvinculoConfirmado", {
        idClinica: $cardDesvinculoPendente ? $cardDesvinculoPendente.attr("data-idClinica") : null
      });
      ElmoUtilitarios.esconderModal($("#modalDesvincularClinica"));
    });
  });

  window.PerfilTela = {
    aplicarPapelPerfil: aplicarPapelPerfil,
    mostrarVisao: mostrarVisao,
    atualizarEstadosVazios: atualizarEstadosVazios,
    exibirResultadoBusca: exibirResultadoBusca,
    exibirVinculoEnviado: exibirVinculoEnviado
  };

})(jQuery, window);
