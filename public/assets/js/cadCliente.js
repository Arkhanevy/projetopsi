console.log("JS cadCliente carregado");
/* ============================================================
   PÁGINA: cadCliente (Cadastro / Login / Ativação do Cliente)
   Depende de: jQuery, Bootstrap 5 (bundle JS), ElmoUtilitarios
   (ver /assets/js/utilitarios.js — deve ser carregado antes deste arquivo)

   Responsabilidades deste arquivo:
   - Alternar entre as telas de cadastro, login, ativação e perfil
     do cliente, de acordo com o parâmetro "tipo" da URL.
   - Validar e enviar o formulário de cadastro via AJAX (com upload
     da imagem de perfil).
   - Gerar/reenviar o código de ativação por e-mail.
   - Validar o código informado e ativar a conta.
   - Validar e enviar o formulário de login.
   ============================================================ */

(function ($, Utilitarios) {
  "use strict";

  var moduloCadCliente = {

    /* ---------- Configuração ---------- */
    configuracao: {
      urlCliente: "/z/index.php?uri=cliente", //Axolote
      urlInfoServico: "index.php?uri=infoServico"
    },

    /* ---------- Estado interno ---------- */
    estado: {
      telaInicial: "cadastro",
      codigoGerado: false
    },

    /* ---------- Referências de elementos (cacheadas) ---------- */
    telas: {},
    elementos: {},

    /**
     * Ponto de entrada. Deve ser chamado uma vez, quando o
     * documento estiver pronto.
     */
    iniciar: function () {
      this.urlElementos();

      var parametros = new URLSearchParams(window.location.search);
      this.estado.telaInicial = parametros.get("tipo") || "cadastro";

      Utilitarios.configurarPreviewImagem(this.elementos.$alertContainer, this.elementos.$img, this.elementos.$preview);
      this.registrarEventos();
      this.mostrarTela(this.estado.telaInicial);
    },

    urlElementos: function () {
      this.telas = {
        cadastro: $("#cadastroCliente"),
        login: $("#loginCliente"),
        ativacao: $("#ativacao"),
        perfilUser: $("#perfilUser")
      };

      this.elementos.$alertContainer = $("#alertContainer");

      this.elementos.$img = $("#img_perfil");
      this.elementos.$preview = $("#preview");
      this.elementos.$nome = $("#nomeCliente");
      this.elementos.$email = $("#emailCadastro");
      this.elementos.$tel = $("#telCliente");
      this.elementos.$user = $("#userCliente");
      this.elementos.$genero = $("#generoCliente");
      this.elementos.$bio = $("#bioCliente");
      this.elementos.$data = $("#dtnCli");
      this.elementos.$cpf = $("#CPF");
      this.elementos.$senha = $("#senhaCliente");
      this.elementos.$form = $("#cadastroCliente");

      this.elementos.$loginEmail = $("#emailLogin");
      this.elementos.$loginSenha = $("#senhaLogin");

      this.elementos.$emailAtivacao = $("#emailAtivacao");
      this.elementos.$codigo = $("#codigoCliente");

      this.elementos.$botaoCadastrar = $("#btnCadastrar");
      this.elementos.$botaoCodigo = $("#btnCodigo");
      this.elementos.$botaoAtivar = $("#btnAtivar");
      this.elementos.$botaoLogar = $("#btnLogar");
    },

    registrarEventos: function () {
      var self = this;

      // Troca de telas
      $(".logarCliente").on("click", function (evento) {
        evento.preventDefault();
        self.mostrarTela("login");
      });

      $(".cadastrarCliente").on("click", function (evento) {
        evento.preventDefault();
        self.mostrarTela("cadastro");
      });

      // Remove o estado de erro assim que o usuário volta a interagir com o campo.
      $(document).on("input change", ".form-control, .form-select, textarea", function () {
        $(this).removeClass("is-invalid");
      });

      this.elementos.$botaoCadastrar.on("click", function () {
        self.enviarCadastro($(this));
      });

      this.elementos.$botaoCodigo.on("click", function (evento) {
        evento.preventDefault();
        self.gerarCodigo($(this));
      });

      this.elementos.$botaoAtivar.on("click", function (evento) {
        evento.preventDefault();
        self.ativarConta($(this));
      });

      this.elementos.$botaoLogar.on("click", function (evento) {
        evento.preventDefault();
        self.enviarLogin($(this));
      });
    },

    /* TELAS */

    mostrarTela: function (nomeTela) {
      var self = this;
      Object.keys(this.telas).forEach(function (chave) {
        self.telas[chave].hide();
      });

      if (this.telas[nomeTela]) {
        this.telas[nomeTela].show();
      } else {
        console.warn("Tela não encontrada:", nomeTela);
        this.telas.cadastro.show();
      }
    },

    /* ALERTAS */

    mostrarAlert: function (mensagem, tipo) {
      Utilitarios.mostrarAlerta(this.elementos.$alertContainer, mensagem, tipo);
    },

    /* CADASTRO */

    enviarCadastro: function ($botao) {
      var self = this;
      var el = this.elementos;

      $botao.prop("disabled", true).html("Cadastrando...");

      var campos = [
        { valor: el.$nome.val(), el: el.$nome },
        { valor: el.$tel.val(), el: el.$tel },
        { valor: el.$user.val(), el: el.$user },
        { valor: el.$bio.val(), el: el.$bio },
        { valor: el.$data.val(), el: el.$data },
        { valor: el.$senha.val(), el: el.$senha },
        { valor: el.$genero.val(), el: el.$genero },
        { valor: el.$email.val(), el: el.$email },
        { valor: el.$cpf.val(), el: el.$cpf }
      ];

      if (Utilitarios.validarCampos(campos)) {
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("Preencha todos os campos obrigatórios!", "danger");
        return;
      }

      var cpfLimpo = Utilitarios.apenasNumeros(el.$cpf.val());
      if (!Utilitarios.cpfValido(cpfLimpo)) {
        el.$cpf.addClass("is-invalid");
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("CPF inválido!", "danger");
        return;
      }

      if (!Utilitarios.telefoneValido(el.$tel.val())) {
        el.$tel.addClass("is-invalid");
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("Telefone inválido!", "danger");
        return;
      }

      if (!Utilitarios.maiorDeIdade(el.$data.val(), 18)) {
        el.$data.addClass("is-invalid");
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("Você precisa ser maior de 18 anos para se cadastrar!", "danger");
        return;
      }

      var email = el.$email.val().trim();
      if (!Utilitarios.emailValido(email)) {
        el.$email.addClass("is-invalid");
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("E-mail inválido!", "danger");
        return;
      }

      var imgArquivo = el.$img[0].files[0];
      if (!imgArquivo) {
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("A imagem de perfil é obrigatória.", "danger");
        return;
      }

      var formData = new FormData();
      formData.append("nome", el.$nome.val());
      formData.append("email", email);
      formData.append("telefone", Utilitarios.apenasNumeros(el.$tel.val()));
      formData.append("username", el.$user.val());
      formData.append("bio", el.$bio.val());
      formData.append("dtNas", el.$data.val());
      formData.append("senha", el.$senha.val());
      formData.append("genero", el.$genero.val());
      formData.append("CPF", cpfLimpo);
      formData.append("acao", "cadastrar");
      formData.append("cxclientefoto", imgArquivo);

      $.ajax({
        url: this.configuracao.urlCliente,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false
      })
        .done(function (resposta) {
          $botao.prop("disabled", false).html("Cadastrar");
          if ($.trim(resposta) === "sucesso") {
            self.mostrarAlert("Cadastro realizado com sucesso!", "success");
            self.mostrarTela("ativacao");
          } else {
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function () {
          $botao.prop("disabled", false).html("Cadastrar");
          self.mostrarAlert("Erro interno na requisição. Tente novamente.", "danger");
        });
    },

    /* CÓDIGO DE ATIVAÇÃO */

    gerarCodigo: function ($botao) {
      var self = this;

      $botao.prop("disabled", true);

      var tempo = 60;
      $botao.text("Aguarde " + tempo + "s até conseguir gerar um novo código.");

      var intervalo = setInterval(function () {
        tempo--;
        $botao.text("Aguarde " + tempo + "s até conseguir gerar um novo código.");
        if (tempo <= 0) {
          clearInterval(intervalo);
          $botao.prop("disabled", false);
          $botao.text("Gerar código");
        }
      }, 1000);

      var email = this.elementos.$email.val().trim();

      var fd = new FormData();
      fd.append("email", email);
      fd.append("acao", "ReGerarCodigo");

      $.ajax({
        url: this.configuracao.urlCliente,
        method: "POST",
        data: fd,
        processData: false,
        contentType: false
      })
        .done(function (resposta) {
          if ($.trim(resposta) === "sucesso") {
            self.mostrarAlert("Código enviado com sucesso para o seu e-mail!", "success");
            self.estado.codigoGerado = true;
          } else {
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function () {
          console.error("Erro na requisição ao gerar código!");
        });
    },

    ativarConta: function ($botao) {
      var self = this;
      var $campoCodigo = this.elementos.$codigo;
      var codigoDigitado = $campoCodigo.val().trim();
      var email = this.elementos.$email.val().trim();

      if (!this.estado.codigoGerado) {
        this.mostrarAlert("Gere um código primeiro!", "danger");
        $botao.prop("disabled", false).html("Ativar");
        return;
      }

      if (!codigoDigitado) {
        $campoCodigo.addClass("is-invalid");
        this.mostrarAlert("Digite o código enviado!", "danger");
        $botao.prop("disabled", false).html("Ativar");
        return;
      }

      $botao.prop("disabled", true).html("Ativando...");

      var fd = new FormData();
      fd.append("email", email);
      fd.append("codigo", codigoDigitado);
      fd.append("acao", "ativar");

      $.ajax({
        url: this.configuracao.urlCliente,
        method: "POST",
        data: fd,
        processData: false,
        contentType: false
      })
        .done(function (resposta) {
          $botao.prop("disabled", false).html("Ativar");
          if ($.trim(resposta) === "sucesso") {
            self.mostrarAlert("Conta ativada com sucesso!", "success");
            self.estado.codigoGerado = false;
            self.mostrarTela("login");
          } else {
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function (xhr, status, erro) {
          $botao.prop("disabled", false).html("Ativar");
          console.error("Erro na ativação:", status, erro, xhr.responseText);
          self.mostrarAlert("Erro na requisição de ativação!", "danger");
        });
    },

    /* LOGIN */

    enviarLogin: function ($botao) {
      var self = this;
      var el = this.elementos;

      $botao.prop("disabled", true).html("Logando...");

      var campos = [
        { valor: el.$loginEmail.val(), el: el.$loginEmail },
        { valor: el.$loginSenha.val(), el: el.$loginSenha }
      ];

      if (Utilitarios.validarCampos(campos)) {
        $botao.prop("disabled", false).html("Logar");
        this.mostrarAlert("Preencha todos os campos!", "danger");
        return;
      }

      var email = el.$loginEmail.val().trim();
      if (!Utilitarios.emailValido(email)) {
        el.$loginEmail.addClass("is-invalid");
        $botao.prop("disabled", false).html("Logar");
        this.mostrarAlert("E-mail inválido!", "danger");
        return;
      }

      var fd = new FormData();
      fd.append("email", email);
      fd.append("senhaLog", el.$loginSenha.val());
      fd.append("acao", "login");

      $.ajax({
        url: this.configuracao.urlCliente,
        method: "POST",
        data: fd,
        processData: false,
        contentType: false
      })
        .done(function (resposta) {
          $botao.prop("disabled", false).html("Logar");
          if ($.trim(resposta) === "sucesso") {
            self.mostrarAlert("Login realizado com sucesso!", "success");
            window.location.href = self.configuracao.urlInfoServico;
          } else {
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function (xhr, status, erro) {
          console.error("Erro no login:", status, erro, xhr.responseText);
          self.mostrarAlert("Erro na requisição!", "danger");
        });
    }
  };

  $(function () {
    moduloCadCliente.iniciar();
  });

})(jQuery, window.ElmoUtilitarios);
