<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>Perfil | Podopsi</title>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /><!-- Material Symbols (Google) -->
  <link rel="stylesheet" href="public/assets/css/variaveis.css" /><!-- Variáveis globais -->
  <link rel="stylesheet" href="public/assets/css/componentes.css" /><!-- Componentes -->
  <link rel="stylesheet" href="public/assets/css/perfil.css" /><!-- CSS próprio -->
</head>
<body>

  <a class="linkPularConteudo" href="#conteudoPerfil">Pular para o conteúdo</a>

  <!-- ===================== BARRA DO TOPO ===================== -->
  <header>
    <nav class="navbar navTopoDeslogado_barra" aria-label="Barra superior">
      <div class="container-fluid">
        <a class="navbar-brand navTopoDeslogado_logo" href="index.php">
          <img src="public/assets/images/logo.png" alt="" width="40" height="40">
          <span data-nomePlataforma="">Podopsi</span>
        </a>
      </div>
    </nav>

    <!-- MENU HAMBÚRGUER (DESKTOP, LOGADO) — exibido por sessaoNavegacao.js -->
    <div class="dropdown menuHamburguerLogado d-none d-md-block" hidden>
      <button type="button" class="menuHamburguerLogado_botao dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Abrir menu">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
      </button>
      <ul class="dropdown-menu menuHamburguerLogado_lista">
        <li><a href="#" class="dropdown-item menuHamburguerLogado_item"><span class="material-symbols-outlined" aria-hidden="true">help</span>Como funciona</a></li>
        <li><a href="index.php?uri=centralAjuda" class="dropdown-item menuHamburguerLogado_item"><span class="material-symbols-outlined" aria-hidden="true">support_agent</span>Central de ajuda</a></li>
        <li><a href="#" class="dropdown-item menuHamburguerLogado_item" data-acao="sair"><span class="material-symbols-outlined" aria-hidden="true">logout</span>Sair</a></li>
      </ul>
    </div>

    <!-- MENU HAMBÚRGUER (MOBILE, LOGADO) — o Figma mostra o menu também no mobile -->
    <div class="menuHamburguerLogado d-md-none" hidden>
      <button type="button" class="menuHamburguerLogado_botao" data-bs-toggle="offcanvas" data-bs-target="#painelMenuMobile" aria-controls="painelMenuMobile" aria-label="Abrir menu">
        <span class="material-symbols-outlined" aria-hidden="true">menu</span>
      </button>
    </div>

    <div class="offcanvas offcanvas-top painelMenuMobile" tabindex="-1" id="painelMenuMobile" aria-labelledby="tituloPainelMenuMobile">
      <div class="offcanvas-header">
        <span class="painelMenuMobile_logo" id="tituloPainelMenuMobile">
          <img src="public/assets/images/logo.png" alt="" width="40" height="40">Podopsi
        </span>
        <button type="button" class="painelMenuMobile_botaoFechar" data-bs-dismiss="offcanvas" aria-label="Fechar menu">
          <span class="material-symbols-outlined" aria-hidden="true">close</span>
        </button>
      </div>
      <div class="offcanvas-body d-flex flex-column">
        <ul class="painelMenuMobile_lista">
          <li><a href="#" class="painelMenuMobile_item"><span class="material-symbols-outlined" aria-hidden="true">help</span>Como funciona</a></li>
          <li><a href="index.php?uri=centralAjuda" class="painelMenuMobile_item"><span class="material-symbols-outlined" aria-hidden="true">support_agent</span>Central de ajuda</a></li>
        </ul>
        <ul class="painelMenuMobile_rodape">
          <li><a href="#" class="painelMenuMobile_item" data-acao="sair"><span class="material-symbols-outlined" aria-hidden="true">logout</span>Sair</a></li>
        </ul>
      </div>
    </div>
  </header>

  <!-- NAVEGAÇÃO LATERAL (DESKTOP, LOGADO) — exibida por sessaoNavegacao.js -->
  <nav class="navLateralLogado d-none d-md-flex" data-papel="cliente" aria-label="Navegação principal" hidden>
    <a href="index.php?uri=agendamentoCli" class="navLateralLogado_item" data-itemPapel>
      <span class="material-symbols-outlined" aria-hidden="true">search</span>
      <span class="navLateralLogado_rotulo">Buscar</span>
    </a>
    <a href="index.php?uri=mensagens" class="navLateralLogado_item" data-itemContatos>
      <span class="material-symbols-outlined" aria-hidden="true">chat</span>
      <span class="navLateralLogado_rotulo">Contatos</span>
    </a>
    <a href="index.php?uri=notificacoes" class="navLateralLogado_item">
      <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
      <span class="navLateralLogado_rotulo">Notificação</span>
    </a>
    <a href="index.php?uri=consultasCli" class="navLateralLogado_item" data-itemAgenda>
      <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
      <span class="navLateralLogado_rotulo">Agenda</span>
    </a>
    <div class="navLateralLogado_rodape">
      <a href="index.php?uri=perfil" class="navLateralLogado_item navLateralLogado_item--ativo" aria-current="page">
        <span class="material-symbols-outlined" aria-hidden="true">person</span>
        <span class="navLateralLogado_rotulo">Perfil</span>
      </a>
    </div>
  </nav>

  <!-- ===================== CONTEÚDO ===================== -->
  <main class="conteudoPerfil" id="conteudoPerfil" tabindex="-1">

    <!-- Cabeçalho do perfil (avatar + usuário) -->
    <div class="areaPerfil">
      <section class="cabecalhoPerfil" id="cabecalhoPerfil" aria-label="Identificação do perfil">
        <img class="cabecalhoPerfil_avatar" id="imagemPerfil" data-campo="fotoPerfil" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Foto de perfil" width="120" height="120">
        <h1 class="cabecalhoPerfil_nome" id="nomeUsuario" data-campo="nomeUsuario">camila.ferreira</h1>
      </section>
    </div>

    <!-- Abas do perfil: cada aba aparece só para os papéis listados em data-papelPerfil -->
    <nav class="abasPerfil" id="abasPerfil" aria-label="Seções do perfil">
      <div class="nav abasPerfil_lista" role="tablist">
        <button class="nav-link abasPerfil_aba active" type="button" role="tab" id="abaPerfil" data-bs-toggle="tab" data-bs-target="#painelPerfil" aria-controls="painelPerfil" aria-selected="true" data-papelPerfil="cliente profissional clinica" hidden>Perfil</button>
        <button class="nav-link abasPerfil_aba" type="button" role="tab" id="abaClinica" data-bs-toggle="tab" data-bs-target="#painelClinica" aria-controls="painelClinica" aria-selected="false" tabindex="-1" data-papelPerfil="profissional" hidden>Clínica</button>
        <button class="nav-link abasPerfil_aba" type="button" role="tab" id="abaProfissionais" data-bs-toggle="tab" data-bs-target="#painelProfissionais" aria-controls="painelProfissionais" aria-selected="false" tabindex="-1" data-papelPerfil="clinica" hidden>Profissionais</button>
        <button class="nav-link abasPerfil_aba" type="button" role="tab" id="abaDocumentos" data-bs-toggle="tab" data-bs-target="#painelDocumentos" aria-controls="painelDocumentos" aria-selected="false" tabindex="-1" data-papelPerfil="cliente profissional" hidden>Documentos</button>
        <button class="nav-link abasPerfil_aba" type="button" role="tab" id="abaRelatorio" data-bs-toggle="tab" data-bs-target="#painelRelatorio" aria-controls="painelRelatorio" aria-selected="false" tabindex="-1" data-papelPerfil="profissional clinica" hidden>Relatório</button>
      </div>
    </nav>

    <div class="areaPerfil">
      <div class="tab-content">

        <!-- ================= ABA: PERFIL ================= -->
        <div class="tab-pane fade show active" id="painelPerfil" role="tabpanel" aria-labelledby="abaPerfil" tabindex="0">

          <!-- ---------- Visão: resumo do perfil ---------- -->
          <div class="visaoPerfil" id="visaoResumoPerfil" data-visao="resumo">

            <!-- Biografia (todos os papéis) -->
            <section class="secaoPerfil" aria-labelledby="tituloBiografia">
              <h2 class="secaoPerfil_titulo" id="tituloBiografia">Biografia</h2>
              <div class="caixaPerfil caixaPerfil--biografia">
                <p class="caixaPerfil_texto" data-campo="biografia">Podóloga especializada em cuidados preventivos, tratamento de calosidades e saúde das unhas. Atendimento personalizado para diferentes necessidades.</p>
                <button class="btn botaoBase botaoBase--primario botaoIcone caixaPerfil_acao caixaPerfil_acao--inferior" type="button" data-acao="abrirVisao" data-visao="visaoEdicaoBiografia" aria-label="Editar biografia">
                  <span class="material-symbols-outlined" aria-hidden="true">edit_note</span>
                </button>
              </div>
            </section>

            <!-- Localização (clínica) -->
            <section class="secaoPerfil" aria-labelledby="tituloLocalizacao" data-papelPerfil="clinica" hidden>
              <h2 class="secaoPerfil_titulo" id="tituloLocalizacao">Localização</h2>
              <div class="caixaPerfil caixaPerfil--localizacao">
                <address class="caixaPerfil_texto">
                  Endereço: <span data-campo="enderecoCompleto">Rua do Sol, 27, São Paulo SP.</span><br>
                  CEP: <span data-campo="cep">07100-000</span>
                </address>
                <div class="caixaPerfil_acoes">
                  <a class="btn botaoBase botaoBase--secundario" id="botaoAbrirMapa" href="#" target="_blank" rel="noopener" data-acao="abrirMapa">
                    <span class="material-symbols-outlined" aria-hidden="true">map</span>Abrir no Maps
                  </a>
                  <button class="btn botaoBase botaoBase--primario botaoIcone" type="button" data-acao="abrirVisao" data-visao="visaoEdicaoLocalizacao" aria-label="Editar localização">
                    <span class="material-symbols-outlined" aria-hidden="true">edit_note</span>
                  </button>
                </div>
              </div>
            </section>

            <!-- Serviços (profissional) -->
            <section class="secaoPerfil" aria-labelledby="tituloServicos" data-papelPerfil="profissional" hidden>
              <h2 class="secaoPerfil_titulo" id="tituloServicos">Serviços</h2>
              <div class="caixaPerfil caixaPerfil--tabela">
                <button class="btn botaoBase botaoBase--primario botaoIcone caixaPerfil_acao caixaPerfil_acao--superior" type="button" data-acao="abrirVisao" data-visao="visaoCadastroServico" aria-label="Adicionar serviço">
                  <span class="material-symbols-outlined" aria-hidden="true">add</span>
                </button>
                <div class="table-responsive">
                  <table class="table tabelaPerfil" id="tabelaServicos">
                    <caption class="visually-hidden">Serviços cadastrados</caption>
                    <thead>
                      <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Valor</th>
                        <th scope="col">Duração</th>
                        <th scope="col">Dia</th>
                      </tr>
                    </thead>
                    <tbody id="listaServicos">
                      <!-- Exemplo do Figma; as linhas reais serão geradas por JS -->
                      <tr data-idServico="">
                        <td data-campo="nomeServico">Tratamento de Calosidade</td>
                        <td data-campo="valorServico">R$ 90,00</td>
                        <td data-campo="duracaoServico">60 min</td>
                        <td>
                          <ul class="list-unstyled mb-0" data-campo="diasServico">
                            <li>Segunda</li>
                            <li>Quarta</li>
                            <li>Sexta</li>
                          </ul>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="estadoVazio" id="estadoVazioServicos" hidden>
                  <span class="material-symbols-outlined estadoVazio_icone" aria-hidden="true">construction</span>
                  <p class="estadoVazio_texto">Sem serviço registrado</p>
                </div>
              </div>
            </section>

            <!-- Horários e dias de funcionamento (profissional e clínica) -->
            <section class="secaoPerfil" aria-labelledby="tituloHorarios" data-papelPerfil="profissional clinica" hidden>
              <h2 class="secaoPerfil_titulo" id="tituloHorarios">Horários e dias de funcionamento</h2>
              <div class="caixaPerfil caixaPerfil--tabela">
                <button class="btn botaoBase botaoBase--primario botaoIcone caixaPerfil_acao caixaPerfil_acao--superior" type="button" data-acao="abrirVisao" data-visao="visaoCadastroHorarios" aria-label="Cadastrar horários e dias de funcionamento">
                  <span class="material-symbols-outlined" aria-hidden="true">add</span>
                </button>
                <div class="table-responsive">
                  <table class="table tabelaPerfil" id="tabelaHorarios">
                    <caption class="visually-hidden">Horários e dias de funcionamento</caption>
                    <thead>
                      <tr>
                        <th scope="col">Dia de Semana</th>
                        <th scope="col">Abertura</th>
                        <th scope="col">Fechamento</th>
                      </tr>
                    </thead>
                    <tbody id="listaHorarios">
                      <!-- Exemplo do Figma; as linhas reais serão geradas por JS -->
                      <tr><td data-campo="diaSemana">Segunda</td><td data-campo="horaAbertura">07:00</td><td data-campo="horaFechamento">18:00</td></tr>
                      <tr><td data-campo="diaSemana">Quarta</td><td data-campo="horaAbertura">07:00</td><td data-campo="horaFechamento">18:00</td></tr>
                      <tr><td data-campo="diaSemana">Sexta</td><td data-campo="horaAbertura">10:00</td><td data-campo="horaFechamento">18:00</td></tr>
                      <tr><td data-campo="diaSemana">Domingo</td><td data-campo="horaAbertura">07:00</td><td data-campo="horaFechamento">12:00</td></tr>
                    </tbody>
                  </table>
                </div>
                <div class="estadoVazio" id="estadoVazioHorarios" hidden>
                  <span class="material-symbols-outlined estadoVazio_icone" aria-hidden="true">alarm_off</span>
                  <p class="estadoVazio_texto">Sem horários ou dias registrados</p>
                </div>
              </div>
            </section>
          </div>

          <!-- ---------- Visão: edição da biografia ---------- -->
          <div class="visaoPerfil" id="visaoEdicaoBiografia" data-visao="edicaoBiografia" hidden>
            <form class="formularioPerfil" id="formularioBiografia" novalidate>
              <h2 class="formularioPerfil_titulo">Edição da biografia</h2>
              <div class="alertaAtencao" id="alertaSemAlteracaoBiografia" role="alert" hidden>Nenhuma alteração foi feita!</div>

              <div class="campoTexto form-floating">
                <textarea class="form-control campoTextoLongo" id="biografiaAtual" name="biografiaAtual" placeholder="Biografia atual" readonly data-campo="biografia"></textarea>
                <label for="biografiaAtual">Biografia atual</label>
              </div>
              <div class="campoTexto form-floating">
                <textarea class="form-control campoTextoLongo" id="biografiaNova" name="biografiaNova" placeholder="Biografia nova" maxlength="500"></textarea>
                <label for="biografiaNova">Biografia nova</label>
              </div>

              <div class="formularioPerfil_rodape">
                <button class="btn botaoBase botaoBase--opositora" type="button" data-acao="voltarResumo"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
                <button class="btn botaoBase botaoBase--primario" type="submit"><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Salvar</button>
              </div>
            </form>
          </div>

          <!-- ---------- Visão: edição da localização (clínica) ---------- -->
          <div class="visaoPerfil" id="visaoEdicaoLocalizacao" data-visao="edicaoLocalizacao" data-papelPerfil="clinica" hidden>
            <form class="formularioPerfil" id="formularioLocalizacao" novalidate>
              <h2 class="formularioPerfil_titulo">Edição de localização</h2>
              <div class="areaAlertas" id="areaAlertasLocalizacao" aria-live="polite"></div>
              <div class="alertaAtencao" id="alertaSemAlteracaoLocalizacao" role="alert" hidden>Nenhuma alteração foi feita!</div>

              <div class="row g-3">
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoCep" name="cep" data-mascara="cep" inputmode="numeric" autocomplete="postal-code" maxlength="9" placeholder="CEP">
                    <label for="localizacaoCep">CEP</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoRua" name="rua" autocomplete="address-line1" placeholder="Rua">
                    <label for="localizacaoRua">Rua</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoBairro" name="bairro" placeholder="Bairro">
                    <label for="localizacaoBairro">Bairro</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoCidade" name="cidade" autocomplete="address-level2" placeholder="Cidade">
                    <label for="localizacaoCidade">Cidade</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoEstado" name="estado" autocomplete="address-level1" maxlength="2" placeholder="Estado">
                    <label for="localizacaoEstado">Estado</label>
                  </div>
                </div>
                <div class="col-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="localizacaoIbge" name="ibge" inputmode="numeric" placeholder="IBGE">
                    <label for="localizacaoIbge">IBGE</label>
                  </div>
                </div>
              </div>

              <div class="formularioPerfil_rodape">
                <button class="btn botaoBase botaoBase--opositora" type="button" data-acao="voltarResumo"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
                <button class="btn botaoBase botaoBase--primario" type="submit"><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Salvar</button>
              </div>
            </form>
          </div>

          <!-- ---------- Visão: cadastro de serviço (profissional) ---------- -->
          <div class="visaoPerfil" id="visaoCadastroServico" data-visao="cadastroServico" data-papelPerfil="profissional" hidden>
            <form class="formularioPerfil" id="formularioServico" novalidate>
              <h2 class="formularioPerfil_titulo">Cadastrar Serviço</h2>
              <div class="alertaValidacao" id="alertaServico" role="alert" hidden>Você precisa preencher todos os campos!</div>

              <div class="row g-4">
                <div class="col-md-6">
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="servicoNome" name="nomeServico" placeholder="Nome do serviço">
                    <label for="servicoNome">Nome do serviço</label>
                  </div>
                  <div class="campoTexto form-floating">
                    <input type="text" class="form-control" id="servicoValor" name="valorServico" inputmode="decimal" placeholder="Valor do serviço">
                    <label for="servicoValor">Valor do serviço</label>
                  </div>

                  <div class="campoSelect dropdown" id="campoTipoServico" data-valorSelecionado="">
                    <span class="form-label fw-bold d-block mb-1" id="rotuloTipoServico">Selecione um tipo para esse serviço</span>
                    <button class="campoSelect_gatilho dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="listbox" aria-labelledby="rotuloTipoServico valorTipoServico" aria-describedby="ajudaTipoServico">
                      <span class="campoSelect_valor" id="valorTipoServico">Selecione um tipo de serviço</span>
                      <span class="campoSelect_iconeChevron"><span class="material-symbols-outlined" aria-hidden="true">expand_more</span></span>
                    </button>
                    <ul class="campoSelect_lista dropdown-menu" role="listbox" aria-labelledby="rotuloTipoServico">
                      <!-- Exemplo do Figma; as opções reais serão geradas por JS -->
                      <li><a class="campoSelect_opcao dropdown-item" href="#" role="option" data-valor="tratamento">Tratamento</a></li>
                    </ul>
                    <p class="textoSmall mb-0 mt-1" id="ajudaTipoServico">O tipo de serviço ajuda os clientes a encontrar seu serviço.</p>
                  </div>

                  <div class="campoTexto form-floating">
                    <textarea class="form-control campoTextoLongo" id="servicoDescricao" name="descricaoServico" placeholder="Descrição do serviço" maxlength="500"></textarea>
                    <label for="servicoDescricao">Descrição do serviço</label>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="campoDuracao">
                    <label class="campoDuracao_rotulo" for="servicoDuracao">Duração do procedimento:</label>
                    <div class="input-group campoDuracao_entrada">
                      <input type="number" class="form-control" id="servicoDuracao" name="duracaoServico" min="0" step="5" placeholder="00">
                      <span class="input-group-text">min</span>
                    </div>
                  </div>
                  <div class="campoDuracao">
                    <label class="campoDuracao_rotulo" for="servicoIntervalo">Intervalo pós-procedimento:</label>
                    <div class="input-group campoDuracao_entrada">
                      <input type="number" class="form-control" id="servicoIntervalo" name="intervaloServico" min="0" step="5" placeholder="00" aria-describedby="ajudaIntervalo">
                      <span class="input-group-text">min</span>
                    </div>
                  </div>
                  <p class="textoSmall" id="ajudaIntervalo">Defina o tempo necessário entre consultas para se organizar ou fazer uma pausa.</p>

                  <fieldset class="grupoDias" id="grupoDiasServico">
                    <legend class="grupoDias_legenda">Selecione os dias em que você realiza esse serviço:</legend>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaDomingo" name="diasServico" value="domingo">
                    <label class="form-check-label" for="servicoDiaDomingo">Domingo</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaSegunda" name="diasServico" value="segunda">
                    <label class="form-check-label" for="servicoDiaSegunda">Segunda</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaTerça" name="diasServico" value="terca">
                    <label class="form-check-label" for="servicoDiaTerça">Terça</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaQuarta" name="diasServico" value="quarta">
                    <label class="form-check-label" for="servicoDiaQuarta">Quarta</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaQuinta" name="diasServico" value="quinta">
                    <label class="form-check-label" for="servicoDiaQuinta">Quinta</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaSexta" name="diasServico" value="sexta">
                    <label class="form-check-label" for="servicoDiaSexta">Sexta</label>
                  </div>
                  <div class="form-check seletorDia">
                    <input class="form-check-input" type="checkbox" id="servicoDiaSábado" name="diasServico" value="sabado">
                    <label class="form-check-label" for="servicoDiaSábado">Sábado</label>
                  </div>
                  </fieldset>
                </div>
              </div>

              <div class="formularioPerfil_rodape">
                <button class="btn botaoBase botaoBase--opositora" type="button" data-acao="voltarResumo"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
                <button class="btn botaoBase botaoBase--primario" type="submit"><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Confirmar</button>
              </div>
            </form>
          </div>

          <!-- ---------- Visão: cadastro de horários (profissional e clínica) ---------- -->
          <div class="visaoPerfil" id="visaoCadastroHorarios" data-visao="cadastroHorarios" data-papelPerfil="profissional clinica" hidden>
            <form class="formularioPerfil" id="formularioHorarios" novalidate>
              <h2 class="formularioPerfil_titulo">Cadastrar Horários e dias de funcionamento</h2>
              <div class="alertaValidacao" id="alertaHorarios" role="alert" hidden></div>

              <fieldset class="grupoDias" id="grupoDiasFuncionamento">
                <legend class="grupoDias_legenda">Selecione os dias em que você trabalha:</legend>
              <div class="seletorDia seletorDia--comHorarios" data-dia="domingo">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaDomingo" name="diasFuncionamento" value="domingo" aria-controls="horarioHorariosDomingo">
                  <label class="form-check-label" for="horarioDiaDomingo">Domingo</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosDomingo" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaDomingo" name="aberturaDomingo" placeholder="00:00">
                      <label for="horarioAberturaDomingo">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoDomingo" name="fechamentoDomingo" placeholder="00:00">
                      <label for="horarioFechamentoDomingo">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="segunda">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaSegunda" name="diasFuncionamento" value="segunda" aria-controls="horarioHorariosSegunda">
                  <label class="form-check-label" for="horarioDiaSegunda">Segunda</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosSegunda" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaSegunda" name="aberturaSegunda" placeholder="00:00">
                      <label for="horarioAberturaSegunda">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoSegunda" name="fechamentoSegunda" placeholder="00:00">
                      <label for="horarioFechamentoSegunda">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="terca">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaTerça" name="diasFuncionamento" value="terca" aria-controls="horarioHorariosTerça">
                  <label class="form-check-label" for="horarioDiaTerça">Terça</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosTerça" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaTerça" name="aberturaTerça" placeholder="00:00">
                      <label for="horarioAberturaTerça">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoTerça" name="fechamentoTerça" placeholder="00:00">
                      <label for="horarioFechamentoTerça">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="quarta">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaQuarta" name="diasFuncionamento" value="quarta" aria-controls="horarioHorariosQuarta">
                  <label class="form-check-label" for="horarioDiaQuarta">Quarta</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosQuarta" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaQuarta" name="aberturaQuarta" placeholder="00:00">
                      <label for="horarioAberturaQuarta">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoQuarta" name="fechamentoQuarta" placeholder="00:00">
                      <label for="horarioFechamentoQuarta">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="quinta">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaQuinta" name="diasFuncionamento" value="quinta" aria-controls="horarioHorariosQuinta">
                  <label class="form-check-label" for="horarioDiaQuinta">Quinta</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosQuinta" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaQuinta" name="aberturaQuinta" placeholder="00:00">
                      <label for="horarioAberturaQuinta">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoQuinta" name="fechamentoQuinta" placeholder="00:00">
                      <label for="horarioFechamentoQuinta">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="sexta">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaSexta" name="diasFuncionamento" value="sexta" aria-controls="horarioHorariosSexta">
                  <label class="form-check-label" for="horarioDiaSexta">Sexta</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosSexta" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaSexta" name="aberturaSexta" placeholder="00:00">
                      <label for="horarioAberturaSexta">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoSexta" name="fechamentoSexta" placeholder="00:00">
                      <label for="horarioFechamentoSexta">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="seletorDia seletorDia--comHorarios" data-dia="sabado">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="horarioDiaSábado" name="diasFuncionamento" value="sabado" aria-controls="horarioHorariosSábado">
                  <label class="form-check-label" for="horarioDiaSábado">Sábado</label>
                </div>
                <div class="seletorDia_horarios row g-3" id="horarioHorariosSábado" hidden>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioAberturaSábado" name="aberturaSábado" placeholder="00:00">
                      <label for="horarioAberturaSábado">Abertura</label>
                    </div>
                  </div>
                  <div class="col-6 col-md-3">
                    <div class="campoTexto form-floating">
                      <input type="time" class="form-control" id="horarioFechamentoSábado" name="fechamentoSábado" placeholder="00:00">
                      <label for="horarioFechamentoSábado">Fechamento</label>
                    </div>
                  </div>
                </div>
              </div>
              </fieldset>

              <div class="formularioPerfil_rodape">
                <button class="btn botaoBase botaoBase--opositora" type="button" data-acao="voltarResumo"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
                <button class="btn botaoBase botaoBase--primario" type="submit"><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Salvar</button>
              </div>
            </form>
          </div>
        </div>

        <!-- ================= ABA: CLÍNICA (profissional) ================= -->
        <div class="tab-pane fade" id="painelClinica" role="tabpanel" aria-labelledby="abaClinica" tabindex="0">
          <button class="btn botaoBase botaoBase--primario mb-4" type="button" id="botaoVincularClinica" data-acao="vincularClinica">
            <span class="material-symbols-outlined" aria-hidden="true">add_home</span>Vincular nova clínica
          </button>

          <ul class="listaCardsEntidade list-unstyled" id="listaClinicasVinculadas">
            <!-- Exemplo do Figma; os cards reais serão gerados por JS -->
            <li>
              <article class="card cardEntidadeBase cardEntidadeBase--tituloAcima cardClinica" data-idClinica="">
                <button class="modalBase_botaoFechar cardEntidade_botaoRemover" type="button" data-bs-toggle="modal" data-bs-target="#modalDesvincularClinica" data-acao="desvincularClinica" aria-label="Desvincular clínica clinica.bemestar">
                  <span class="material-symbols-outlined" aria-hidden="true">close</span>
                </button>
                <div class="card-body d-flex flex-column align-items-center gap-3">
                  <h3 class="card-title cardEntidadeBase_titulo mb-0" data-campo="usuarioClinica">clinica.bemestar</h3>
                  <img class="cardEntidadeBase_imagem" data-campo="fotoClinica" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Foto da clínica" width="160" height="160">
                  <div class="cardClinica_info">
                    <p>Endereço: <span data-campo="enderecoResumido">Rua Sol, SP</span></p>
                    <p>CEP: <span data-campo="cep">07000-000</span></p>
                  </div>
                  <a class="btn botaoBase botaoBase--secundario" href="#" data-acao="verPerfil">
                    <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span>Ver perfil
                  </a>
                </div>
              </article>
            </li>
          </ul>

          <div class="estadoVazio estadoVazio--solto" id="estadoVazioClinicas" hidden>
            <p class="estadoVazio_texto">Nenhuma clínica vinculada</p>
            <p class="textoSmall mb-0">Para vincular, a clínica deve enviar uma solicitação.</p>
          </div>
        </div>

        <!-- ================= ABA: PROFISSIONAIS (clínica) ================= -->
        <div class="tab-pane fade" id="painelProfissionais" role="tabpanel" aria-labelledby="abaProfissionais" tabindex="0">
          <button class="btn botaoBase botaoBase--primario mb-4" type="button" id="botaoVincularProfissional" data-bs-toggle="modal" data-bs-target="#modalVincularProfissional">
            <span class="material-symbols-outlined" aria-hidden="true">group_add</span>Vincular profissional
          </button>

          <h2 class="secaoPerfil_titulo" id="tituloGerenciarProfissionais">Gerenciar profissionais</h2>

          <ul class="listaCardsEntidade list-unstyled" id="listaProfissionaisVinculados" aria-labelledby="tituloGerenciarProfissionais" hidden>
            <!-- Os cards de profissionais vinculados serão gerados por JS (mesmo modelo do cardEntidadeBase) -->
          </ul>

          <div class="estadoVazio estadoVazio--solto" id="estadoVazioProfissionais">
            <p class="estadoVazio_texto">Nenhum profissional vinculado</p>
          </div>
        </div>

        <!-- ================= ABAS SEM TELA NO FIGMA ================= -->
        <div class="tab-pane fade" id="painelDocumentos" role="tabpanel" aria-labelledby="abaDocumentos" tabindex="0"></div>
        <div class="tab-pane fade" id="painelRelatorio" role="tabpanel" aria-labelledby="abaRelatorio" tabindex="0"></div>

      </div>
    </div>
  </main>

  <!-- NAVEGAÇÃO INFERIOR (MOBILE, LOGADO) — exibida por sessaoNavegacao.js -->
  <nav class="navInferiorLogado d-flex d-md-none" data-papel="cliente" aria-label="Navegação principal" hidden>
    <a href="index.php?uri=notificacoes" class="navInferiorLogado_item">
      <span class="material-symbols-outlined" aria-hidden="true">notifications</span>
      <span class="navInferiorLogado_rotulo">Notif.</span>
    </a>
    <a href="index.php?uri=mensagens" class="navInferiorLogado_item" data-itemContatos>
      <span class="material-symbols-outlined" aria-hidden="true">chat</span>
      <span class="navInferiorLogado_rotulo">Contatos</span>
    </a>
    <a href="index.php?uri=agendamentoCli" class="navInferiorLogado_item" data-itemPapel>
      <span class="material-symbols-outlined" aria-hidden="true">search</span>
      <span class="navInferiorLogado_rotulo">Buscar</span>
    </a>
    <a href="index.php?uri=consultasCli" class="navInferiorLogado_item" data-itemAgenda>
      <span class="material-symbols-outlined" aria-hidden="true">calendar_month</span>
      <span class="navInferiorLogado_rotulo">Agenda</span>
    </a>
    <a href="index.php?uri=perfil" class="navInferiorLogado_item navInferiorLogado_item--ativo" aria-current="page">
      <span class="material-symbols-outlined" aria-hidden="true">person</span>
      <span class="navInferiorLogado_rotulo">Perfil</span>
    </a>
  </nav>

  <!-- ===================== MODAIS ===================== -->

  <!-- Vincular profissional (clínica) -->
  <div class="modal fade modalBase" id="modalVincularProfissional" tabindex="-1" aria-labelledby="tituloModalVincularProfissional" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modalBase_conteudo">
        <div class="modal-header modalBase_cabecalho">
          <h2 class="modal-title modalBase_titulo" id="tituloModalVincularProfissional">Vincular Profissional</h2>
        </div>
        <div class="modal-body modalBase_corpo">
          <label class="fw-bold mb-2" for="campoUsuarioProfissional">Digite o user do profissional que deseja vincular:</label>
          <div class="campoPesquisa input-group" id="campoPesquisaProfissional">
            <input type="search" class="form-control" id="campoUsuarioProfissional" name="usuarioProfissional" placeholder="Pesquise" autocomplete="off">
            <button class="btn campoPesquisa_botaoIcone" type="button" aria-label="Pesquisar profissional">
              <span class="material-symbols-outlined" aria-hidden="true">search</span>
            </button>
          </div>

          <!-- Resultado da busca (exemplo do Figma; gerado por JS) -->
          <div class="resultadoBusca" id="resultadoBuscaProfissional" hidden>
            <input class="resultadoBusca_radio visually-hidden" type="radio" name="profissionalSelecionado" id="resultadoProfissionalSelecionado" value="">
            <article class="card cardEntidadeBase cardEntidadeBase--tituloAcima resultadoBusca_card">
              <label class="resultadoBusca_marcador" for="resultadoProfissionalSelecionado">
                <span class="visually-hidden">Selecionar profissional <span data-campo="usuarioProfissional">camila.ferreira</span></span>
                <span class="material-symbols-outlined" aria-hidden="true">check_circle</span>
              </label>
              <div class="card-body d-flex flex-column align-items-center gap-3">
                <h3 class="card-title cardEntidadeBase_titulo mb-0" data-campo="usuarioProfissional">camila.ferreira</h3>
                <img class="cardEntidadeBase_imagem" data-campo="fotoProfissional" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="Foto do profissional" width="160" height="160">
                <a class="btn botaoBase botaoBase--secundario" href="#" data-acao="verPerfil">
                  <span class="material-symbols-outlined" aria-hidden="true">assignment_turned_in</span>Ver perfil
                </a>
              </div>
            </article>
          </div>
        </div>
        <div class="modal-footer modalBase_rodape">
          <button type="button" class="btn botaoBase botaoBase--opositora" data-bs-dismiss="modal"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
          <button type="button" class="btn botaoBase botaoBase--primario" id="botaoConfirmarVinculo" data-acao="confirmarVinculo" disabled><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Confirmar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Pedido de vinculamento enviado (clínica) -->
  <div class="modal fade modalBase" id="modalVinculoEnviado" tabindex="-1" aria-labelledby="tituloModalVinculoEnviado" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modalBase_conteudo">
        <div class="modal-header modalBase_cabecalho">
          <h2 class="modal-title modalBase_titulo" id="tituloModalVinculoEnviado">Pedido de vinculamento enviado!</h2>
          <button type="button" class="modalBase_botaoFechar" data-bs-dismiss="modal" aria-label="Fechar">
            <span class="material-symbols-outlined" aria-hidden="true">close</span>
          </button>
        </div>
        <div class="modal-body modalBase_corpo">
          <p>Seu pedido de vinculamento foi enviado para <strong data-campo="nomeProfissionalVinculado">Camila Ferreira</strong>. No momento, seu pedido aguarda a confirmação do profissional.</p>
          <p class="mb-0">Quando ele confirmar, você receberá uma mensagem e o vínculo começará a aparecer no seu perfil, para que você possa gerenciar suas permissões e os clientes possam visualizá-lo por meio do seu perfil.</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Desvincular clínica (profissional) -->
  <div class="modal fade modalBase" id="modalDesvincularClinica" tabindex="-1" aria-labelledby="tituloModalDesvincularClinica" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modalBase_conteudo">
        <div class="modal-header modalBase_cabecalho">
          <h2 class="modal-title modalBase_titulo" id="tituloModalDesvincularClinica">Cuidado!</h2>
          <button type="button" class="modalBase_botaoFechar" data-bs-dismiss="modal" aria-label="Fechar">
            <span class="material-symbols-outlined" aria-hidden="true">close</span>
          </button>
        </div>
        <div class="modal-body modalBase_corpo">
          <p>Você está prestes a desvincular a clínica <strong data-campo="usuarioClinica">clinica.bemestar</strong>!</p>
          <p>Se continuar com isso, ela não aparecerá mais como uma clínica em que você trabalha. Dessa forma, os clientes não poderão agendar uma consulta com você nessa localização e suas futuras consultas não aparecerão no relatório dessa clínica.</p>
          <p class="mb-0">Deseja continuar com essa ação?</p>
        </div>
        <div class="modal-footer modalBase_rodape">
          <button type="button" class="btn botaoBase botaoBase--opositora" data-bs-dismiss="modal"><span class="material-symbols-outlined" aria-hidden="true">cancel</span>Cancelar</button>
          <button type="button" class="btn botaoBase botaoBase--primario" id="botaoConfirmarDesvinculo" data-acao="confirmarDesvinculo"><span class="material-symbols-outlined" aria-hidden="true">check_circle</span>Continuar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL: SESSÃO EXPIRADA (mesmo padrão das demais páginas logadas) -->
  <div class="modal fade modalBase" id="modalSessaoExpirada" tabindex="-1" aria-labelledby="tituloModalSessaoExpirada" aria-describedby="textoModalSessaoExpirada" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modalBase_conteudo">
        <div class="modal-header modalBase_cabecalho">
          <h2 class="modal-title modalBase_titulo" id="tituloModalSessaoExpirada">Sessão expirada</h2>
        </div>
        <div class="modal-body text-center">
          <p class="visually-hidden">Esta janela não pode ser fechada automaticamente. Use o botão "Realizar login" abaixo para continuar.</p>
          <div class="modalFeedback_icone" aria-hidden="true">
            <span class="material-symbols-outlined" aria-hidden="true">no_accounts</span>
          </div>
          <p id="textoModalSessaoExpirada" class="modalFeedback_mensagem">Sua sessão anterior expirou, precisamos que você realize login novamente para poder acessar essa página.</p>
        </div>
        <div class="modal-footer modalBase_rodape">
          <button type="button" id="botaoRealizarLoginSessao" class="btn botaoBase botaoBase--primario">Realizar login</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ===================== SCRIPTS ===================== -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap 5 (bundle com Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="public/assets/js/componentes.js"></script><!-- Componentes compartilhados -->
  <script src="public/assets/js/sessaoNavegacao.js"></script><!-- Decide qual navegação exibir -->
  <script src="public/assets/js/utilitarios.js"></script>
  <script src="public/assets/js/perfil.js" defer></script>
</body>
</html>
