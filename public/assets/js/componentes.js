/* ==================================================================
   Arquivo original: botao/botao.js
   ================================================================== */
/* 
  Componente: botaoBase
  Não implementa regras de negócio (regra 17) — apenas dispara um
  evento customizado "botaoAcionado" que outros módulos (cards.js,
  modal.js, filtro.js etc.) podem escutar para decidir o que fazer.
*/

$(function () {
  $(document).on("click", ".botaoBase", function (evento) {
    const $botao = $(this);

    if ($botao.is(":disabled") || $botao.attr("aria-disabled") === "true") {
      evento.preventDefault();
      return;
    }

    const acao = $botao.data("acao") || null;

    $botao.trigger("botaoAcionado", {
      acao: acao,
      elemento: $botao
    });
  });
});


/* ==================================================================
   Arquivo original: status/status.js
   ================================================================== */
/*
  Componente: indicadorStatus
  Não é clicável — o único comportamento é permitir que outros módulos
  (ex.: ao receber uma atualização do Back-End) troquem o estado visual
  de um indicador já renderizado, sem duplicar HTML.
*/

function atualizarIndicadorStatus($elemento, novoEstado) {
  const estadosValidos = ["agendada", "confirmada", "pendente", "cancelada", "realizada"];

  if (estadosValidos.indexOf(novoEstado) === -1) {
    console.warn(`indicadorStatus: estado "${novoEstado}" não reconhecido.`);
    return;
  }

  const classesEstado = estadosValidos.map((estado) => `indicadorStatus--${estado}`).join(" ");

  $elemento
    .removeClass(classesEstado)
    .addClass(`indicadorStatus--${novoEstado}`)
    .attr("data-estadoConsulta", novoEstado);
}


/* ==================================================================
   Arquivo original: campo/campo.js
   ================================================================== */
/*
  Componentes: campoTexto, campoPesquisa, campoSelect
  Com a conversão para Bootstrap, o floating label (campoTexto) e o
  abrir/fechar do dropdown (campoSelect) já são nativos do Bootstrap
  — não precisam mais de JS próprio. Este arquivo cuida só do que o
  Bootstrap não resolve sozinho: disparo de pesquisa e atualização do
  valor exibido/selecionado no campoSelect.
  Não implementa validação de negócio (regra 17).
*/

$(function () {

  // ---------- campoPesquisa: disparo de busca ----------
  function dispararPesquisa($campoPesquisa) {
    const termo = $campoPesquisa.find(".campoPesquisa_input").val();
    $campoPesquisa.trigger("pesquisaAcionada", { termo: termo });
  }

  $(document).on("click", ".campoPesquisa_botaoIcone", function () {
    dispararPesquisa($(this).closest(".campoPesquisa"));
  });

  $(document).on("keypress", ".campoPesquisa_input", function (evento) {
    if (evento.which === 13) {
      evento.preventDefault();
      dispararPesquisa($(this).closest(".campoPesquisa"));
    }
  });

  // ---------- campoSelect: seleção de opção ----------
  // Abrir/fechar já é feito pelo Bootstrap (data-bs-toggle="dropdown").
  $(document).on("click", ".campoSelect_opcao", function (evento) {
    evento.preventDefault();
    const $opcao = $(this);
    const $select = $opcao.closest(".campoSelect");

    $select.find(".campoSelect_valor").text($opcao.text().trim());
    $select.attr("data-valorSelecionado", $opcao.data("valor"));

    $select.trigger("opcaoSelecionada", { valor: $opcao.data("valor") });
  });

});


/* ==================================================================
   Arquivo original: filtro/filtro.js
   ================================================================== */
/*
  Componente: painelFiltro
  Não decide o que fazer com o filtro aplicado (regra 17) — apenas
  coleta os valores selecionados e dispara um evento customizado.
*/

$(function () {

  $(document).on("click", ".painelFiltro_botaoAplicar", function () {
    const $painel = $(this).closest(".painelFiltro");
    const filtrosSelecionados = {};

    $painel.find(".grupoFiltro").each(function () {
      const nomeGrupo = $(this).data("grupoFiltro");
      const valorSelecionado = $(this).find("input[type='radio']:checked").val() || null;
      filtrosSelecionados[nomeGrupo] = valorSelecionado;
    });

    $painel.trigger("filtroAplicado", filtrosSelecionados);
  });

});


/* ==================================================================
   Arquivo original: calendario/calendario.js
   ================================================================== */
/*
  Componente: calendarioBase
  Não decide disponibilidade real (regra 17) — os estados de cada dia
  (selecionado, indisponível, confirmada, pendente, folga) vêm de fora
  como dados (ex.: já calculados pelo Back-End) e são apenas exibidos.
*/

const NOMES_MES = [
  "JAN", "FEV", "MAR", "ABR", "MAI", "JUN",
  "JUL", "AGO", "SET", "OUT", "NOV", "DEZ"
];

/**
 * Renderiza a grade de dias de um mês dentro do calendarioBase.
 *
 * @param {jQuery} $calendario  elemento .calendarioBase
 * @param {number} ano          ex.: 2026
 * @param {number} mesIndex     0 = Janeiro ... 11 = Dezembro
 * @param {Object} estadosPorDia mapa { "1": "indisponivel", "15": "selecionado", ... }
 */
function renderizarCalendario($calendario, ano, mesIndex, estadosPorDia) {
  estadosPorDia = estadosPorDia || {};

  const $tituloMes = $calendario.find(".calendarioBase_tituloMes");
  const $grade = $calendario.find(".calendarioBase_grade");

  $tituloMes.text(`${NOMES_MES[mesIndex]} ${ano}`);
  $calendario.attr("data-mesAtual", mesIndex).attr("data-anoAtual", ano);

  // Remove apenas as células de dia, mantendo o cabeçalho Dom–Sáb
  $grade.find(".calendarioBase_dia, .calendarioBase_dia--vazio").remove();

  const primeiroDiaSemana = new Date(ano, mesIndex, 1).getDay(); // 0 = domingo
  const totalDiasNoMes = new Date(ano, mesIndex + 1, 0).getDate();

  // Preenche os espaços vazios antes do dia 1
  for (let i = 0; i < primeiroDiaSemana; i++) {
    $grade.append('<span class="calendarioBase_dia--vazio" aria-hidden="true"></span>');
  }

  for (let dia = 1; dia <= totalDiasNoMes; dia++) {
    const estado = estadosPorDia[String(dia)] || null;
    const $celula = $("<button>", {
      type: "button",
      class: "calendarioBase_dia",
      "data-dia": dia,
      text: dia
    });

    if (estado) {
      $celula.addClass(`calendarioBase_dia--${estado}`);
      $celula.attr("data-estadoDia", estado);
    }

    if (estado === "indisponivel" || estado === "folga") {
      $celula.prop("disabled", true);
    }

    $grade.append($celula);
  }
}

$(function () {

  // Navegação entre meses — quem escuta este evento deve buscar os
  // novos estados de dia (ex.: via AJAX) e chamar renderizarCalendario novamente
  $(document).on("click", ".calendarioBase_botaoNavegacao", function () {
    const $calendario = $(this).closest(".calendarioBase");
    const direcao = $(this).data("direcao") === "proximo" ? 1 : -1;

    $calendario.trigger("mesAlterado", {
      direcao: direcao,
      mesAtual: parseInt($calendario.attr("data-mesAtual"), 10),
      anoAtual: parseInt($calendario.attr("data-anoAtual"), 10)
    });
  });

  // Seleção de dia (somente dias habilitados)
  $(document).on("click", ".calendarioBase_dia:not(:disabled)", function () {
    const $dia = $(this);
    const $calendario = $dia.closest(".calendarioBase");

    $calendario.find(".calendarioBase_dia--selecionado").removeClass("calendarioBase_dia--selecionado");
    $dia.addClass("calendarioBase_dia--selecionado");

    $calendario.trigger("diaSelecionado", {
      dia: $dia.data("dia"),
      mes: parseInt($calendario.attr("data-mesAtual"), 10),
      ano: parseInt($calendario.attr("data-anoAtual"), 10)
    });
  });

});


/* ==================================================================
   Arquivo original: modal/modal.js
   ================================================================== */
/*
  Componente: modalBase
  Com a conversão para o Modal nativo do Bootstrap, abrir/fechar,
  overlay, ESC e foco preso já são resolvidos pelo próprio Bootstrap
  (via data-bs-toggle="modal" / data-bs-dismiss="modal"). Este arquivo
  fica disponível apenas para ganchos de negócio, como resetar um
  formulário quando o modal fecha — sem implementar regra de negócio
  alguma aqui (regra 17).
*/

$(function () {

  // Exemplo de gancho: disparar um evento próprio sempre que qualquer
  // modalBase for aberto/fechado, para quem quiser reagir a isso.
  $(document).on("shown.bs.modal", ".modalBase", function () {
    $(this).trigger("modalAberto");
  });

  $(document).on("hidden.bs.modal", ".modalBase", function () {
    $(this).trigger("modalFechado");
  });

});


/* ==================================================================
   Arquivo original: cards/cards.js
   ================================================================== */
/*
  Comportamento comum aos cards de consulta.
  Não decide se a ação é permitida (regra 17) — apenas identifica o
  registro via data-idConsulta e dispara o evento correspondente para
  quem for integrar com o Back-End.
*/

$(function () {

  $(document).on("click", "[data-acao='cancelarConsulta']", function () {
    const $card = $(this).closest("[data-idConsulta]");
    $card.trigger("consultaCancelada", { idConsulta: $card.data("idconsulta") });
  });

  $(document).on("click", "[data-acao='aceitarConsulta']", function () {
    const $card = $(this).closest("[data-idConsulta]");
    $card.trigger("consultaAceita", { idConsulta: $card.data("idconsulta") });
  });

  $(document).on("click", "[data-acao='reagendarConsulta']", function () {
    const $card = $(this).closest("[data-idConsulta]");
    $card.trigger("consultaReagendada", { idConsulta: $card.data("idconsulta") });
  });

  $(document).on("click", "[data-acao='apagarDocumento']", function () {
    const $card = $(this).closest("[data-idDocumento]");
    $card.trigger("documentoApagado", { idDocumento: $card.data("iddocumento") });
  });

  $(document).on("click", "[data-acao='visualizarDocumento']", function () {
    const $card = $(this).closest("[data-idDocumento]");
    $card.trigger("documentoVisualizado", { idDocumento: $card.data("iddocumento") });
  });

});


/* ==================================================================
   Arquivo original: navegacao/painelMenuMobile.js
   ================================================================== */
/*
  Estrutura-base: painelMenuMobile
  Com a conversão para o Offcanvas nativo do Bootstrap, abrir/fechar,
  overlay e Esc já são resolvidos pelo próprio Bootstrap. Este arquivo
  cuida só de marcar visualmente o item clicado — a navegação real
  fica a cargo do href/Back-End (regra 17).
*/

$(function () {

  $(document).on("click", ".painelMenuMobile_item", function () {
    $(this).closest(".painelMenuMobile_lista, .painelMenuMobile_rodape")
      .find(".painelMenuMobile_item--ativo")
      .removeClass("painelMenuMobile_item--ativo");
    $(this).addClass("painelMenuMobile_item--ativo");
  });

});


/* ==================================================================
   Arquivo original: navegacao/menuHamburguerLogado.js
   ================================================================== */
/*
  Componente: menuHamburguerLogado (desktop)
  Com a conversão para o Dropdown nativo do Bootstrap, abrir/fechar,
  clique fora e Esc já são resolvidos pelo próprio Bootstrap. Este
  arquivo cuida só da ação "Sair" — não implementa logout (regra 17),
  apenas dispara o evento para quem for integrar com o Back-End.
*/

$(function () {

  $(document).on("click", "[data-acao='sair']", function () {
    $(document).trigger("usuarioSolicitouSair");
  });

});


/* ==================================================================
   Arquivo original: navegacao/navegacao.js
   ================================================================== */
/*
  Regra compartilhada entre navLateralLogado e navInferiorLogado:
  o primeiro item da lista muda de ícone/rótulo conforme o papel do
  usuário logado. Cliente e profissional/clínica usam a mesma
  estrutura HTML/CSS — só este dado muda (confirmado: rótulo do
  profissional/clínica é "Início" tanto no desktop quanto no mobile).
*/

const ITEM_POR_PAPEL = {
  cliente: { icone: "search", rotulo: "Buscar", acao: "buscar" },
  profissionalClinica: { icone: "home", rotulo: "Início", acao: "irParaInicio" }
};

function aplicarPapelNavegacao($navegacao) {
  const papel = $navegacao.data("papel"); // "cliente" | "profissionalClinica"
  const config = ITEM_POR_PAPEL[papel];

  if (!config) {
    console.warn(`navegacao: papel "${papel}" não reconhecido.`);
    return;
  }

  const $primeiroItem = $navegacao.find("[data-itemPapel]");
  $primeiroItem.find(".material-symbols-outlined").text(config.icone);
  $primeiroItem.find(".navLateralLogado_rotulo, .navInferiorLogado_rotulo").text(config.rotulo);
  $primeiroItem.attr("data-acao", config.acao);
}

$(function () {
  $(".navLateralLogado, .navInferiorLogado").each(function () {
    aplicarPapelNavegacao($(this));
  });

  // Item ativo (desktop e mobile)
  $(document).on("click", ".navLateralLogado_item, .navInferiorLogado_item", function () {
    const $nav = $(this).closest(".navLateralLogado, .navInferiorLogado");
    $nav.find(".navLateralLogado_item--ativo, .navInferiorLogado_item--ativo")
      .removeClass("navLateralLogado_item--ativo navInferiorLogado_item--ativo");
    $(this).addClass(
      $(this).closest(".navLateralLogado").length
        ? "navLateralLogado_item--ativo"
        : "navInferiorLogado_item--ativo"
    );
  });
});


