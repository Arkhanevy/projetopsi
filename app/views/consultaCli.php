<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Minhas consultas </title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /><!-- Material Symbols (Google) -->
  <link rel="stylesheet" href="public/assets/css/variaveis.css" /><!-- Variáveis globais -->
  <link rel="stylesheet" href="public/assets/css/componentes.css" /><!-- Componentes  -->
  <link rel="stylesheet" href="public/assets/css/consultasCli.css" /><!-- CSS próprio -->
  <base href="/atual/">
</head>
<body class="bodyPagina">

  <a href="#conteudoConsultas" class="linkPularConteudo">Pular para o conteúdo principal</a>

  <!-- NAVEGAÇÃO (DESKTOP)  -->
  <nav id="navegacaoLateral" class="navegacaoLateral d-none d-md-flex flex-column align-items-center" aria-label="Navegação principal">
    <a href="/" class="marcaApp" aria-label="Página inicial">
      <img src="../assets/img/logoElmo.svg" alt="Elmo" class="logoApp" />
    </a>

    <ul class="listaNavegacao list-unstyled d-flex flex-column align-items-center gap-3">
      <li>
        <a href="/agendamento" class="itemNavegacao" aria-label="Agendamento">
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
        <a href="/minhas-consultas" class="itemNavegacao itemNavegacaoAtivo" aria-current="page" aria-label="Minhas consultas">
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
        <img src="../assets/img/logoElmo.svg" alt="" class="logoAppMobile" />
        <span class="nomeApp">Elmo</span>
      </a>
      <button type="button" id="botaoMenuMobile" class="botaoMenuMobile btn" aria-label="Abrir menu" aria-expanded="false">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
      </button>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main id="conteudoConsultas" class="conteudoPagina conteudoConsultas container-fluid">

      <h1 class="tituloConsultas">Minhas consultas</h1>
      <p id="mensagemStatusConsultas" class="visually-hidden" aria-live="polite" aria-atomic="true"></p>

      <div id="gradeConsultas" class="gradeConsultas estadoCarregando">
        <article class="cartaoConsulta cartaoConsultaEsqueleto" aria-hidden="true">
          <h2 class="tituloConsulta">Tratamento de unha encravada</h2>
          <div class="linhaConsulta d-flex justify-content-between">
            <p class="dataHoraConsulta">17 de junho, 08:00</p>
            <p class="precoConsulta">R$12,50</p>
          </div>
          <p class="profissionalConsulta"><strong>Profissional:</strong> Samanta Santos</p>
          <p class="clinicaConsulta"><strong>Clínica:</strong> Girasol</p>
          <div class="rodapeConsulta d-flex justify-content-between align-items-center">
            <span class="botaoCancelar btn rounded-pill">Cancelar</span>
            <span class="badgeStatus badgeStatusPendente">Pendente</span>
          </div>
        </article>
        <article class="cartaoConsulta cartaoConsultaEsqueleto" aria-hidden="true">
          <h2 class="tituloConsulta">Pedicure</h2>
          <div class="linhaConsulta d-flex justify-content-between">
            <p class="dataHoraConsulta">26 de junho, 08:00</p>
            <p class="precoConsulta">R$80,50</p>
          </div>
          <p class="profissionalConsulta"><strong>Profissional:</strong> Katarina</p>
          <p class="clinicaConsulta"><strong>Clínica:</strong> Girasol</p>
          <div class="rodapeConsulta d-flex justify-content-between align-items-center">
            <span class="botaoCancelar btn rounded-pill">Cancelar</span>
            <span class="badgeStatus badgeStatusAgendada">Agendada</span>
          </div>
        </article>
      </div>

      <!-- Estado vazio -->
      <div id="estadoVazioConsultas" class="estadoVazioConsultas" hidden>
        <span class="material-symbols-outlined iconeEstadoVazio" aria-hidden="true">assignment_ind</span>
        <p class="textoEstadoVazio">
          Nenhuma consulta agendada.<br />
          Se estiver atrás de algum serviço, faça uma
          <a href="../infoServico/index.html" class="linkTexto">busca</a>.
        </p>
      </div>

    </main>

    <!-- NAVEGAÇÃO INFERIOR  -->
    <nav id="navegacaoInferior" class="navegacaoInferior d-flex d-md-none align-items-center justify-content-around" aria-label="Navegação principal">
      <a href="/notificacoes" class="itemNavegacaoInferior" aria-label="Notificações">
        <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
      </a>
      <a href="/mensagens" class="itemNavegacaoInferior" aria-label="Mensagens">
        <span class="material-symbols-outlined" aria-hidden="true">chat</span>
      </a>
      <a href="/agendamento" class="itemNavegacaoInferior" aria-label="Agendamento">
        <span class="material-symbols-outlined" aria-hidden="true">search</span>
      </a>
      <a href="/minhas-consultas" class="itemNavegacaoInferior itemNavegacaoInferiorAtivo" aria-current="page" aria-label="Minhas consultas">
        <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
      </a>
      <a href="/perfil" class="itemNavegacaoInferior" aria-label="Perfil">
        <span class="material-symbols-outlined" aria-hidden="true">person</span>
      </a>
    </nav>

  </div>

  <!-- MODAL: SESSÃO EXPIRADA-->
  <div
    class="modal fade modalPadrao"
    id="modalSessaoExpirada"
    tabindex="-1"
    aria-labelledby="tituloModalSessaoExpirada"
    aria-describedby="textoModalSessaoExpirada"
    aria-modal="true"
    role="dialog"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <p class="visually-hidden">
            Esta janela não pode ser fechada automaticamente. Use o botão
            "Realizar login" abaixo para continuar.
          </p>

          <h2 id="tituloModalSessaoExpirada" class="tituloModal">Sessão expirada</h2>

          <div class="iconeModal" aria-hidden="true">
            <span class="material-symbols-outlined iconeModalBase">no_accounts</span>
          </div>

          <p id="textoModalSessaoExpirada" class="textoModal">
            Sua sessão anterior expirou, precisamos que você realize login novamente
            para poder acessar essa página.
          </p>

          <button type="button" id="botaoRealizarLoginSessao" class="botaoPrimario btn rounded-pill">
            Realizar login
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL: CONFIRMAR CANCELAMENTO -->
  <div
    class="modal fade modalPadrao"
    id="modalConfirmarCancelamento"
    tabindex="-1"
    aria-labelledby="tituloModalConfirmarCancelamento"
    aria-describedby="textoModalConfirmarCancelamento"
    aria-modal="true"
    role="dialog"
  >
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <button
          type="button"
          class="botaoFecharModal btn-close"
          data-bs-dismiss="modal"
          aria-label="Fechar"
        ></button>

        <div class="modal-body text-center">
          <h2 id="tituloModalConfirmarCancelamento" class="tituloModal">Cuidado!</h2>

          <p id="textoModalConfirmarCancelamento" class="textoModal">
            Você está preste a cancelar sua consulta de
            <strong id="nomeConsultaParaCancelar">Tratamento de unha encravada</strong>!
          </p>

          <p class="textoModal">
            Se continuar com isso, a consulta sairá da sua agenda e da agenda do
            profissional. Essa ação não pode ser desfeita. Deseja continuar com essa ação?
          </p>

          <div class="acoesModalConfirmacao d-flex flex-wrap justify-content-center gap-3">
            <button type="button" id="botaoVoltarParaAgenda" class="botaoSecundario btn rounded-pill" data-bs-dismiss="modal">
              <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span>
              Voltar para a agenda
            </button>
            <button type="button" id="botaoConfirmarCancelamento" class="botaoCancelar btn rounded-pill">
              <span class="material-symbols-outlined" aria-hidden="true">cancel</span>
              Cancelar consulta
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5 (bundle com Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="public/assets/js/utilitarios.js"></script>
  <script src="public/assets/js/consultasCli.js" defer></script>
</body>
</html>
