console.log("JS cadProfissional carregado");
/* ============================================================
   PÁGINA: cadProfissional (Cadastro / Login / Ativação do Profissional)
   Depende de: jQuery, Bootstrap 5 (bundle JS), ElmoUtilitarios
   (ver /assets/js/utilitarios.js — deve ser carregado antes deste arquivo)

   Responsabilidades deste arquivo:
   - Alternar entre as telas de cadastro, login, ativação e perfil
     do profissional.
   - Preencher automaticamente o endereço a partir do CEP (ViaCEP).
   - Validar e enviar o formulário de cadastro via AJAX (com upload
     da imagem de perfil).
   - Gerar/reenviar o código de ativação por e-mail.
   - Validar o código informado e ativar a conta.
   - Validar e enviar o formulário de login.
   ============================================================ */

(function ($, Utilitarios) {
  "use strict";

  var moduloCadProfissional = {

    /* ---------- Configuração ---------- */
    configuracao: {
      urlProfissional: "/z/index.php?uri=profissional", //Axolote
      urlInfoServico: "index.php?uri=infoServico"
    },

    /* ---------- Estado interno ---------- */
    estado: {
      telaInicial: "cadastroProfissional",
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

      var el = this.elementos;
      Utilitarios.configurarPreviewImagem(el.$alertContainer, el.$img, el.$preview);
      Utilitarios.configurarCEP(el.$alertContainer, {
        cep: el.$cep,
        rua: el.$rua,
        bairro: el.$bairro,
        cidade: el.$cidade,
        uf: el.$uf,
        ibge: el.$ibge
      });

      this.registrarEventos();
      this.mostrarTela(this.estado.telaInicial);
    },

    urlElementos: function () {
      this.telas = {
        cadastroProfissional: $("#cadastroProfissional"),
        loginProfissional: $("#loginProfissional"),
        ativacao: $("#ativacao"),
        perfilUser: $("#perfilUser")
      };

      this.elementos.$alertContainer = $("#alertContainer");

      this.elementos.$img = $("#img_perfil");
      this.elementos.$preview = $("#preview");
      this.elementos.$nome = $("#nomeProfissional");
      this.elementos.$email = $("#emailCadastro");
      this.elementos.$tel = $("#telProfissional");
      this.elementos.$user = $("#userProfissional");
      this.elementos.$genero = $("#generoProfissional");
      this.elementos.$bio = $("#bioProfissional");
      this.elementos.$data = $("#dtnPro");
      this.elementos.$cpf = $("#CPF");
      this.elementos.$senha = $("#senhaProfissional");
      this.elementos.$cep = $("#cep");
      this.elementos.$rua = $("#rua");
      this.elementos.$bairro = $("#bairro");
      this.elementos.$uf = $("#uf");
      this.elementos.$ibge = $("#ibge");
      this.elementos.$cidade = $("#cidade");
      this.elementos.$registro = $("#registroProfissional");
      this.elementos.$form = $("#cadastroProfissional");

      this.elementos.$loginEmail = $("#emailCadastroLog");
      this.elementos.$loginSenha = $("#senhaProfissionalLog");

      this.elementos.$emailAtivacao = $("#emailAtivar");
      this.elementos.$codigo = $("#codigoCliente");

      this.elementos.$botaoCadastrar = $("#btnCadastrar");
      this.elementos.$botaoLogar = $("#btnLogar");
      this.elementos.$botaoCodigo = $("#btnCodigo");
      this.elementos.$botaoAtivar = $("#btnAtivar");
    },

    registrarEventos: function () {
      var self = this;

      // Troca de telas
      $(".logarProfissional").on("click", function (evento) {
        evento.preventDefault();
        self.mostrarTela("loginProfissional");
      });

      $(".cadastrarProfissional").on("click", function (evento) {
        evento.preventDefault();
        self.mostrarTela("cadastroProfissional");
      });

      // Remove o estado de erro assim que o usuário volta a interagir com o campo.
      $(document).on("input change", ".form-control, .form-select, textarea", function () {
        $(this).removeClass("is-invalid");
      });

      this.elementos.$botaoCadastrar.on("click", function () {
        self.enviarCadastro($(this));
      });

      this.elementos.$botaoLogar.on("click", function (evento) {
        evento.preventDefault();
        self.enviarLogin($(this));
      });

      this.elementos.$botaoCodigo.on("click", function (evento) {
        evento.preventDefault();
        self.gerarCodigo($(this));
      });

      this.elementos.$botaoAtivar.on("click", function (evento) {
        evento.preventDefault();
        self.ativarConta($(this));
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
        { valor: el.$registro.val(), el: el.$registro },
        { valor: el.$senha.val(), el: el.$senha },
        { valor: el.$genero.val(), el: el.$genero },
        { valor: el.$email.val(), el: el.$email },
        { valor: el.$cpf.val(), el: el.$cpf },
        { valor: el.$cep.val(), el: el.$cep },
        { valor: el.$rua.val(), el: el.$rua },
        { valor: el.$bairro.val(), el: el.$bairro },
        { valor: el.$uf.val(), el: el.$uf },
        { valor: el.$ibge.val(), el: el.$ibge },
        { valor: el.$cidade.val(), el: el.$cidade }
      ];

      if (Utilitarios.validarCampos(campos)) {
        $botao.prop("disabled", false).html("Cadastrar");
        this.mostrarAlert("Preencha todos os campos!", "danger");
        return;
      }

      var cpf = el.$cpf.val().trim();
      if (!cpf || !Utilitarios.cpfValido(cpf)) {
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

      var camposEndereco = [el.$cep, el.$rua, el.$bairro, el.$uf, el.$ibge, el.$cidade];
      if (Utilitarios.apenasNumeros(el.$cep.val()).length !== 8) {
        Utilitarios.marcarCamposComErro(el.$alertContainer, camposEndereco, "CEP inválido!");
        $botao.prop("disabled", false).html("Cadastrar");
        return;
      }

      var cpfLimpo = Utilitarios.apenasNumeros(el.$cpf.val());
      var cepLimpo = Utilitarios.apenasNumeros(el.$cep.val());

      var formData = new FormData();
      formData.append("nome", el.$nome.val());
      formData.append("email", email);
      formData.append("telefone", Utilitarios.apenasNumeros(el.$tel.val()));
      formData.append("username", el.$user.val());
      formData.append("bio", el.$bio.val());
      formData.append("dtNas", el.$data.val());
      formData.append("registro", el.$registro.val());
      formData.append("senha", el.$senha.val());
      formData.append("genero", el.$genero.val());
      formData.append("CEP", cepLimpo);
      formData.append("CPF", cpfLimpo);
      formData.append("acao", "cadastrar");
      formData.append("cxproFoto", imgArquivo);

      $.ajax({
        url: this.configuracao.urlProfissional,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false
      })
        .done(function (resposta) {
          $botao.prop("disabled", false).html("Cadastrar");
          if ($.trim(resposta) === "sucesso") {
            self.mostrarAlert("Cadastro realizado!", "success");
            self.mostrarTela("ativacao");
          } else {
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function () {
          $botao.prop("disabled", false).html("Cadastrar");
          self.mostrarAlert("Erro na requisição!", "danger");
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
        url: this.configuracao.urlProfissional,
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
    },

    /* CÓDIGO DE ATIVAÇÃO */

    gerarCodigo: function ($botao) {
      var self = this;

      $botao.prop("disabled", true);

      var tempo = 60;
      $botao.text("Aguarde " + tempo + "s para gerar um novo código");

      var intervalo = setInterval(function () {
        tempo--;
        $botao.text("Aguarde " + tempo + "s para gerar um novo código");
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
        url: this.configuracao.urlProfissional,
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
        url: this.configuracao.urlProfissional,
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
            self.mostrarTela("loginProfissional");
          } else {
            $campoCodigo.addClass("is-invalid");
            self.mostrarAlert(resposta, "danger");
          }
        })
        .fail(function (xhr, status, erro) {
          $botao.prop("disabled", false).html("Ativar");
          console.error("Erro na ativação:", status, erro, xhr.responseText);
          self.mostrarAlert("Erro na requisição de ativação!", "danger");
        });
    }
  };

  $(function () {
    moduloCadProfissional.iniciar();
  });

})(jQuery, window.ElmoUtilitarios);
