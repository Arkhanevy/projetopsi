<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Detalhe do Serviço </title>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /><!-- Material Symbols (Google) -->
  <link rel="stylesheet" href="public/assets/css/variaveis.css" /><!-- Variáveis globais  -->
  <link rel="stylesheet" href="public/assets/css/componentes.css" /><!-- Componentes compartilhados -->
  <link rel="stylesheet" href="public/assets/css/infoServico.css" /><!-- CSS próprio -->
  <!-- <base href="/atual/"> -->
</head>
<body class="bodyPagina">


  <!--NAVEGAÇÃO (DESKTOP)  -->
  <nav id="navegacaoLateral" class="navegacaoLateral d-none d-md-flex flex-column align-items-center" aria-label="Navegação principal">
    <a href="/" class="marcaApp" aria-label="Página inicial">
      <img src="../assets/img/logoElmo.svg" alt="Elmo" class="logoApp" />
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
        <img src="../assets/img/logoElmo.svg" alt="" class="logoAppMobile" />
        <span class="nomeApp">Elmo</span>
      </a>
      <button type="button" id="botaoMenuMobile" class="botaoMenuMobile btn" aria-label="Abrir menu" aria-expanded="false">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
      </button>
    </header>

    <!-- CONTEÚDO PRINCIPAL -->
    <main id="conteudoDetalheServico" class="conteudoPagina conteudoDetalheServico container-fluid">

      <button type="button" id="botaoVoltar" class="botaoVoltar btn rounded-circle" aria-label="Voltar">
        <span class="material-symbols-outlined" aria-hidden="true">arrow_back</span>
      </button>

      <article class="cartaoServico row gy-4 estadoCarregando" id="cartaoServico">

        <div class="col-12 col-md-6">
          <figure class="figuraServico">
            <img
              src="assets/img/servico.jpg"
              alt="Profissional realizando procedimento de remoção de unha encravada no pé do paciente"
              class="imagemServico img-fluid rounded"
              data-campo="imagemServico"
              data-campo-alt="legendaImagemServico"
            />
          </figure>
        </div>

        <div class="col-12 col-md-6">
          <div class="infoServico d-flex flex-column">

            <p class="nomeProfissional order-1 order-md-2">
              <span class="rotuloProfissional d-none d-md-inline">Profissional: </span>
              <span data-campo="nomeProfissional">Samanta Santos</span>
            </p>

            <h1 class="tituloServico order-2 order-md-1" data-campo="tituloServico">
              Tratamento de unha encravada
            </h1>

            <div class="detalhesServico order-3 d-flex justify-content-between">
              <p class="precoServico" data-campo="precoServico">R$12,50</p>
              <p class="duracaoServico" data-campo="duracaoServico">60 minutos</p>
            </div>

            <section class="descricaoServico order-4" aria-labelledby="tituloDescricao">
              <h2 id="tituloDescricao" class="tituloSecao">Descrição</h2>
              <p class="textoDescricao" data-campo="descricaoServico">
                O tratamento especializado para unha encravada oferece o alívio rápido da dor e
                da inflamação através de técnicas totalmente seguras e indolores. Garantimos
                cuidado profissional para corrigir o crescimento da unha, evitar graves
                infecções e devolver o conforto aos seus pés. O procedimento é realizado por
                especialistas em podologia. Agende sua consulta para caminhar novamente sem
                incômodos e com bem-estar.
              </p>
            </section>

            <button
              type="button"
              id="botaoAgendarAgora"
              class="botaoAgendarAgora botaoPrimario btn rounded-pill order-5"
            >
              Agendar agora
            </button>

          </div>
        </div>

      </article>
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

          <button type="button" id="botaoTentarNovamente" class="botaoTentarNovamente botaoPrimario btn rounded-pill">
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

  <!--  MODAL: PEDIDO DE AGENDAMENTO ENVIADO  -->
  <div
    class="modal fade modalPadrao modalSucesso"
    id="modalAgendamentoEnviado"
    tabindex="-1"
    aria-labelledby="tituloModalAgendamentoEnviado"
    aria-describedby="textoModalAgendamentoEnviado"
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
          <h2 id="tituloModalAgendamentoEnviado" class="tituloModal">
            Pedido de agendamento enviado!
          </h2>

          <p id="textoModalAgendamentoEnviado" class="textoModal">
            Seu pedido de agendamento foi enviado para
            <span data-campo="nomeProfissional">Samanta Santos</span>. No momento, sua consulta
            está aguardando a confirmação do profissional.
          </p>

          <p class="textoModal">
            Quando a consulta for confirmada, você receberá uma mensagem. Para acompanhar o
            status ou reagendar sua consulta, acesse as
            <a href="/minhas-consultas" id="linkMinhasConsultas" class="linkTexto">Minhas Consultas</a>.
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="public/assets/js/utilitarios.js"></script>
  <script src="public/assets/js/infoServico.js" defer></script>
</body>
</html>
