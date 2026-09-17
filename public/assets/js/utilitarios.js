/* ============================================================
   UTILITÁRIOS COMPARTILHADOS
   Usado por infoServico.js, agendamentoCli.js e consultasCli.js.
   Depende de: jQuery, Bootstrap 5 (bundle JS).
   Deve ser carregado ANTES do script de cada página.

   Concentra aqui o que antes estava duplicado (com pequenas
   divergências) em cada arquivo de página: leitura de parâmetro
   de URL, controle de modal via API nativa do Bootstrap 5,
   preenchimento de campos "data-campo" e o toggle de
   acessibilidade do skeleton de carregamento.
   ============================================================ */

(function ($, window) {
  "use strict";

  var ElmoUtilitarios = {

    /**
     * Lê um parâmetro da querystring da página atual.
     * Ex.: obterParametroUrl("id") em "pagina.html?id=42" -> "42"
     */
    obterParametroUrl: function (nome) {
      var parametros = new URLSearchParams(window.location.search);
      return parametros.get(nome);
    },

    /**
     * Bootstrap 5 não possui mais o plugin jQuery ($.fn.modal) que
     * existia no Bootstrap 4. Estes três helpers centralizam o uso
     * da API nativa "bootstrap.Modal" para todo o projeto — nenhuma
     * página deve chamar "$elemento.modal(...)" diretamente.
     */
    obterInstanciaModal: function ($elementoModal, opcoes) {
      return bootstrap.Modal.getOrCreateInstance($elementoModal.get(0), opcoes);
    },

    exibirModal: function ($elementoModal, opcoes) {
      this.obterInstanciaModal($elementoModal, opcoes).show();
    },

    esconderModal: function ($elementoModal) {
      var instancia = bootstrap.Modal.getInstance($elementoModal.get(0));
      if (instancia) {
        instancia.hide();
      }
    },

    /**
     * Preenche todos os elementos de "$camposDinamicos" (elementos
     * com atributo "data-campo") usando os dados recebidos do
     * backend. Convenção:
     *   - <img>: usa .attr("src", ...) + "data-campo-alt" para o alt
     *   - <input>: usa .val()
     *   - demais elementos: usa .text()
     */
    preencherCampos: function ($camposDinamicos, dados) {
      $camposDinamicos.each(function () {
        var $elemento = $(this);
        var nomeCampo = $elemento.data("campo");

        if (!(nomeCampo in dados)) {
          return;
        }

        if (this.tagName === "IMG") {
          $elemento.attr("src", dados[nomeCampo]);

          var nomeCampoAlt = $elemento.data("campo-alt");
          if (nomeCampoAlt && dados[nomeCampoAlt]) {
            $elemento.attr("alt", dados[nomeCampoAlt]);
          }
          return;
        }

        if (this.tagName === "INPUT") {
          $elemento.val(dados[nomeCampo]);
          return;
        }

        $elemento.text(dados[nomeCampo]);
      });
    },

    /**
     * Enquanto os dados reais não chegam via AJAX (skeleton ativo,
     * com ou sem erro), o conteúdo visível dos "$camposDinamicos" é
     * só um exemplo do Figma e não deve ser lido por leitores de
     * tela. Chamar com "true" ao iniciar o carregamento/erro, e
     * "false" assim que os dados reais chegarem.
     */
    alternarEsqueletoAcessivel: function ($camposDinamicos, ativo) {
      if (ativo) {
        $camposDinamicos.attr("aria-hidden", "true");
      } else {
        $camposDinamicos.removeAttr("aria-hidden");
      }
    }
  };

  window.ElmoUtilitarios = ElmoUtilitarios;

})(jQuery, window);
