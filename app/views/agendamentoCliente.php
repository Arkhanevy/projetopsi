<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Agendamento</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Material Symbols (Google) -->
  <link rel="stylesheet" href="public/assets/css/variaveis.css" /><!-- Variáveis globais de design -->
  <link rel="stylesheet" href="public/assets/css/componentes.css" /><!-- Componentes compartilhados  -->
  <link rel="stylesheet" href="public/assets/css/agendamentoCli.css" /><!-- CSS próprio -->
</head>
<body class="bodyPagina">

  <a href="#conteudoAgendamento" class="linkPularConteudo">Pular para o conteúdo principal</a>

  <!-- NAVEGAÇÃO (DESKTOP) -->
  <nav id="navegacaoLateral" class="navegacaoLateral d-none d-md-flex flex-column align-items-center" aria-label="Navegação principal">
    <a href="/" class="marcaApp" aria-label="Página inicial">
      <img src="public/assets/img/logoElmo.svg" alt="Elmo" class="logoApp" />
    </a>

    <ul class="listaNavegacao list-unstyled d-flex flex-column align-items-center gap-3">
      <li>
        <a href="/agendamento" class="itemNavegacao itemNavegacaoAtivo" aria-current="page" aria-label="Agendamento">
          <span class="material-symbols-outlined" aria-hidden="true">search</span>
        </a>
      </li>
      <li>
        <a href="/mensagens" class="itemNavegacao" aria-label="Mensagens">
          <span class="material-symbols-outlined" aria-hidden="true">chat</span>
        </a>
      </li>
      <li>
        <a href="/notificacoes" class="itemNavegacao" aria-label="Notificações">
          <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
        </a>
      </li>
      <li>
        <a href="/minhas-consultas" class="itemNavegacao" aria-label="Minhas consultas">
          <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
        </a>
      </li>
      <li>
        <a href="/suporte" class="itemNavegacao" aria-label="Suporte">
          <span class="material-symbols-outlined" aria-hidden="true">support_agent</span>
        </a>
      </li>
      <li>
        <a href="/perfil" class="itemNavegacao" aria-label="Perfil">
          <span class="material-symbols-outlined" aria-hidden="true">person</span>
        </a>
      </li>
    </ul>
  </nav>

  <div class="areaConteudo">

    <!-- CABEÇALHO (MOBILE) -->
    <header id="cabecalhoMobile" class="cabecalhoMobile d-flex d-md-none align-items-center justify-content-between">
      <a href="/" class="marcaAppMobile d-flex align-items-center gap-2" aria-label="Página inicial">
        <img src="public/assets/img/logoElmo.svg" alt="" class="logoAppMobile" />
        <span class="nomeApp">Elmo</span>
      </a>
      <button type="button" id="botaoMenuMobile" class="botaoMenuMobile btn" aria-label="Abrir menu" aria-expanded="false">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
      </button>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main id="conteudoAgendamento" class="conteudoPagina conteudoAgendamento container-fluid">

      <button type="button" id="botaoVoltar" class="botaoVoltar btn rounded-circle" aria-label="Voltar">
        <span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>
      </button>

      <form id="formularioAgendamento" class="gradeAgendamento estadoCarregando" novalidate>

        <input type="hidden" id="inputIdServico" name="idServico" />

        <h1 class="tituloAgendamento areaTitulo">Agendamento</h1>

        <div class="alertaValidacao areaAlerta" id="alertaValidacao" role="alert" hidden>
          Você precisa preencher todos os dados!
        </div>

        <!-- ---------- Valor ---------- -->
        <div class="campoValor areaValor">
          <div class="campoValorLinha">
            <h2 class="tituloCampo">Valor</h2>
            <p class="valorAgendamento" data-campo="precoServico">R$12,50</p>
          </div>
          <p class="textoAjuda">
            O valor do agendamento é calculado com base no valor do serviço selecionado.
          </p>
        </div>

        <!-- ---------- Profissional responsável ---------- -->
        <div class="campoFormulario areaProfissional">
          <label for="inputProfissionalResponsavel" class="tituloCampo">Profissional responsável</label>
          <input
            type="text"
            id="inputProfissionalResponsavel"
            class="inputFormulario"
            data-campo="nomeProfissional"
            value="Samanta Santos"
            readonly
          />
        </div>

        <!-- ---------- Localização de atendimento ---------- -->
        <!--<div class="campoFormulario areaLocalizacao">
          <span id="labelLocalizacao" class="tituloCampo">Localização de atendimento</span>
          <div class="dropdownCustomizado" id="dropdownLocalizacao">
            <button
              type="button"
              id="botaoDropdownLocalizacao"
              class="dropdownCustomizadoBotao"
              aria-haspopup="listbox"
              aria-expanded="false"
              aria-labelledby="labelLocalizacao"
              aria-describedby="textoLocalizacaoSelecionada"
            >
              <span class="material-symbols-outlined" aria-hidden="true">location_on</span>
              <span id="textoLocalizacaoSelecionada" class="dropdownCustomizadoTexto">Selecione localização</span>
              <span class="material-symbols-outlined dropdownCustomizadoSeta" aria-hidden="true">expand_more</span>
            </button>
            <ul
              id="listaLocalizacoes"
              class="dropdownCustomizadoLista"
              role="listbox"
              aria-labelledby="labelLocalizacao"
              hidden
            >
            </ul>
          </div>
          <input type="hidden" id="inputLocalizacaoSelecionada" name="localizacaoSelecionada" />
        </div> -->

        <!-- ---------- Calendário ---------- -->
        <div class="campoFormulario areaCalendario">
          <h2 class="tituloCampo" id="labelCalendario">Selecione um dia disponível</h2>
          <div class="calendarioAgendamento" id="calendarioAgendamento" role="group" aria-labelledby="labelCalendario">
            <div class="calendarioCabecalho">
              <button type="button" id="botaoMesAnterior" class="calendarioBotaoNavegacao" aria-label="Mês anterior">
                <span class="material-symbols-outlined" aria-hidden="true">chevron_left</span>
              </button>
              <p class="calendarioTitulo" id="calendarioTitulo" aria-live="polite">JUL 2026</p>
              <button type="button" id="botaoProximoMes" class="calendarioBotaoNavegacao" aria-label="Próximo mês">
                <span class="material-symbols-outlined" aria-hidden="true">chevron_right</span>
              </button>
            </div>

            <div class="calendarioDiasSemana" aria-hidden="true">
              <span>Dom</span><span>Seg</span><span>Ter</span><span>Qua</span><span>Qui</span><span>Sex</span><span>Sáb</span>
            </div>

            <div class="calendarioGrade" id="calendarioGrade">
            </div>

            <div class="calendarioLegenda">
              <span class="legendaItem">
                <span class="legendaAmostra legendaAmostraSelecionado" aria-hidden="true"></span>
                Dia selecionado
              </span>
              <span class="legendaItem">
                <span class="legendaAmostra legendaAmostraIndisponivel" aria-hidden="true"></span>
                Dias indisponíveis
              </span>
            </div>
          </div>
          <input type="hidden" id="inputDiaSelecionado" name="diaSelecionado" />
        </div>

        <!-- ---------- Horário ---------- -->
        <div class="campoFormulario areaHorario">
          <span id="labelHorario" class="tituloCampo">Selecione um dos horários disponível</span>
          <div class="dropdownCustomizado" id="dropdownHorario">
            <button
              type="button"
              id="botaoDropdownHorario"
              class="dropdownCustomizadoBotao"
              aria-haspopup="listbox"
              aria-expanded="false"
              aria-labelledby="labelHorario"
              aria-describedby="textoHorarioSelecionado"
              disabled
            >
              <span class="material-symbols-outlined" aria-hidden="true">schedule</span>
              <span id="textoHorarioSelecionado" class="dropdownCustomizadoTexto">Selecione horário</span>
              <span class="material-symbols-outlined dropdownCustomizadoSeta" aria-hidden="true">expand_more</span>
            </button>
            <ul
              id="listaHorarios"
              class="dropdownCustomizadoLista"
              role="listbox"
              aria-labelledby="labelHorario"
              hidden
            >
            </ul>
          </div>
          <input type="hidden" id="inputHorarioSelecionado" name="horarioSelecionado" />
        </div>

        <!-- ---------- Ações ---------- -->
        <div class="acoesFormulario areaBotoes">
          <button type="button" id="botaoCancelarAgendamento" class="botaoCancelar btn rounded-pill">
            <span class="material-symbols-outlined" aria-hidden="true">cancel</span>
            Cancelar
          </button>
          <button type="submit" id="botaoConfirmarAgendamento" class="botaoPrimario btn rounded-pill">
            <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
            Agendar
          </button>
        </div>

      </form>
    </main>

    <!-- NAVEGAÇÃO INFERIOR -->
    <nav id="navegacaoInferior" class="navegacaoInferior d-flex d-md-none align-items-center justify-content-around" aria-label="Navegação principal">
      <a href="/notificacoes" class="itemNavegacaoInferior" aria-label="Notificações">
        <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
      </a>
      <a href="/mensagens" class="itemNavegacaoInferior" aria-label="Mensagens">
        <span class="material-symbols-outlined" aria-hidden="true">chat</span>
      </a>
      <a href="/agendamento" class="itemNavegacaoInferior itemNavegacaoInferiorAtivo" aria-current="page" aria-label="Agendamento">
        <span class="material-symbols-outlined" aria-hidden="true">search</span>
      </a>
      <a href="/minhas-consultas" class="itemNavegacaoInferior" aria-label="Minhas consultas">
        <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
      </a>
      <a href="/perfil" class="itemNavegacaoInferior" aria-label="Perfil">
        <span class="material-symbols-outlined" aria-hidden="true">person</span>
      </a>
    </nav>

  </div>

  <!-- MODAL: SERVIÇO NÃO ENCONTRADO  -->
  <div
    class="modal fade modalPadrao modalErro"
    id="modalServicoNaoEncontrado"
    tabindex="-1"
    aria-labelledby="tituloModalServicoNaoEncontrado"
    aria-describedby="textoModalServicoNaoEncontrado"
    aria-modal="true"
    role="dialog"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <p class="visually-hidden">
            Esta janela não pode ser fechada automaticamente. Use o botão
            "Tentar novamente" ou o link "Central de Ajuda" abaixo para continuar.
          </p>

          <h2 id="tituloModalServicoNaoEncontrado" class="tituloModal">Serviço não encontrado</h2>

          <div class="iconeModal" aria-hidden="true">
            <span class="material-symbols-outlined iconeModalBase">search</span>
            <span class="material-symbols-outlined iconeModalSobreposto">monitor_heart</span>
          </div>

          <p id="textoModalServicoNaoEncontrado" class="textoModal">
            Infelizmente não conseguimos encontrar o serviço que você selecionou.
          </p>

          <button type="button" id="botaoTentarNovamente" class="botaoPrimario btn rounded-pill">
            Tentar novamente
          </button>

          <p class="textoRodapeModal">
            Caso o erro permaneça, entre em contato com a
            <a href="/central-de-ajuda" id="linkCentralAjuda" class="linkTexto">Central de Ajuda.</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL: USUÁRIO NÃO LOGADO -->
  <div
    class="modal fade modalPadrao"
    id="modalNaoLogado"
    tabindex="-1"
    aria-labelledby="tituloModalNaoLogado"
    aria-describedby="textoModalNaoLogado"
    aria-modal="true"
    role="dialog"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h2 id="tituloModalNaoLogado" class="tituloModal">Você não está logado(a)</h2>

          <div class="iconeModal" aria-hidden="true">
            <span class="material-symbols-outlined iconeModalBase">no_accounts</span>
          </div>

          <p id="textoModalNaoLogado" class="textoModal">
            Para finalizar o agendamento, você precisa estar logado(a). Para fazer login,
            clique no botão abaixo.
          </p>

          <button type="button" id="botaoRealizarLogin" class="botaoPrimario btn rounded-pill">
            Realizar login
          </button>

          <p class="textoRodapeModal">
            Caso não tenha uma conta, realize o
            <a href="/cadastro" id="linkCadastro" class="linkTexto">Cadastro</a>.
          </p>
        </div>
      </div>
    </div>
  </div>

  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!-- jQuery -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap 5 -->
  <script src="public/assets/js/utilitarios.js"></script>
  <script src="public/assets/js/agendamentoCli.js" defer></script>

</html>
