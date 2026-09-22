console.log("JS loginProfissional carregado");
/* ============================================================
   PÁGINA: loginProfissional (Login do Profissional)
   Depende de: jQuery, Bootstrap 5 (bundle JS), ElmoUtilitarios
   (ver /assets/js/utilitarios.js — deve ser carregado antes deste arquivo)

   Responsabilidades deste arquivo:
   - Validar e enviar o formulário de login via AJAX.
   - Redirecionar para a página de serviços após o login.

   O cadastro e a ativação de conta ficam em cadProfissional.js.
   ============================================================ */

(function ($, Utilitarios) {
  "use strict";

  var moduloLoginProfissional = {

    /* ---------- Configuração ---------- */
    configuracao: {
      urlProfissional: "/projetopsi/index.php?uri=profissional", //Axolote
      urlInfoServico: "index.php?uri=infoServico"
    },

    /* ---------- Referências de elementos (cacheadas) ---------- */
    elementos: {},

    /**
     * Ponto de entrada. Deve ser chamado uma vez, quando o
     * documento estiver pronto.
     */
    iniciar: function () {
      this.urlElementos();
      this.registrarEventos();
    },

    urlElementos: function () {
      this.elementos.$alertContainer = $("#alertContainer");

      this.elementos.$loginEmail = $("#emailCadastroLog");
      this.elementos.$loginSenha = $("#senhaProfissionalLog");
      this.elementos.$botaoLogar = $("#btnLogar");
    },

    registrarEventos: function () {
      var self = this;

      // Remove o estado de erro assim que o usuário volta a interagir com o campo.
      $(document).on("input change", ".form-control", function () {
        $(this).removeClass("is-invalid");
      });

      this.elementos.$botaoLogar.on("click", function (evento) {
        evento.preventDefault();
        self.enviarLogin($(this));
      });
    },

    /* ALERTAS */

    mostrarAlert: function (mensagem, tipo) {
      Utilitarios.mostrarAlerta(this.elementos.$alertContainer, mensagem, tipo);
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
          $botao.prop("disabled", false).html("Logar");
          console.error("Erro no login:", status, erro, xhr.responseText);
          self.mostrarAlert("Erro na requisição!", "danger");
        });
    }
  };

  $(function () {
    moduloLoginProfissional.iniciar();
  });

})(jQuery, window.ElmoUtilitarios);
