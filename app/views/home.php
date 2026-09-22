<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Amanda Imóveis - Home</title>
  <link rel="stylesheet" href="public/assets/css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
  <script src="public/assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Material Symbols (Google) -->
  <link rel="stylesheet" href="public/assets/css/componentesCSS/componentes.css">

</head>
<style>
  .fundo {
    position: relative;
    min-height: 100vh;

    background-image: url("public/assets/images/bannerHorizontal.jpg");
    background-size: cover;
    background-position: center;
  }

  /* Filtro esverdeado */
  .fundo::before {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0, 120, 60, 0.45);
  }

  /* Conteúdo fica acima do filtro */
  .fundo>* {
    position: relative;
    z-index: 1;
  }
</style>

<body>
  <div class="fundo">
    


    <section class="mb-5" aria-labelledby="tituloNavDeslogado">

      <nav class="navTopoDeslogado" aria-label="Navegação principal">
        <div class="navTopoDeslogado_barra navTopoDeslogado_acoes">
          <a href="#" class="navTopoDeslogado_logo">
            <img src="public/assets/images/logo.png" alt="Descrição da imagem" width="50" height="50">
            <!--<span class="material-symbols-outlined" aria-hidden="true">eco</span> -->
            <span data-nomePlataforma="">Podopsi</span>
          </a>

          <div class="navTopoDeslogado_acoes">
            <a href="#" class="nav-link dropdown-toggle navbar-brand navTopoDeslogado_acao" role="button" data-bs-toggle="dropdown">Cadastre-se</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=cadastroCliente">Sou um cliente</a></li>
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=cadastroProfissional">Sou um profissional</a>
              </li>
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=cadastroClinica">Sou uma clínica</a></li>
            </ul>
            <a href="#" class="nav-link dropdown-toggle navbar-brand navTopoDeslogado_acao"  href="#" role="button" data-bs-toggle="dropdown">Entrar</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=loginCliente">Sou um cliente</a></li>
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=loginProfissional">Sou um profissional</a>
              </li>
              <li><a class="dropdown-item" href="/projetopsi/index.php?uri=loginClinica">Sou uma clínica</a></li>
            </ul>
          </div>
        </div>
        <div class="navTopoDeslogado_secundaria">
          <a href="#" class="navTopoDeslogado_link navTopoDeslogado_link--ativo" aria-current="page">Como funciona</a>
          <a href="#" class="navTopoDeslogado_link">Encontre serviços</a>
          <a href="#" class="navTopoDeslogado_link">Encontre profissionais</a>
          <a href="#" class="navTopoDeslogado_link">Encontre clínicas</a>
          <a href="#" class="navTopoDeslogado_link">Central de ajuda</a>
        </div>
      </nav>
    </section>



    <!--
    <section class="mb-5" aria-labelledby="tituloPesquisa">
      <h2 id="tituloPesquisa" class="mb-4">Campo de pesquisa</h2>

      <div class="input-group campoPesquisa" style="max-width: 480px;">
        <input class="form-control campoPesquisa_input" type="search" placeholder="Pesquise" aria-label="Pesquisar">
        <button type="button" class="btn campoPesquisa_botaoIcone" aria-label="Buscar">
          <span class="material-symbols-outlined" aria-hidden="true">search</span>
        </button>
      </div>
    </section>-->

  </div>
  <script src="public/assets/js/componentesJS/componentes.js"></script>
</body>

</html>