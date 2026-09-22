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
    },

    /**
     * ALERTAS (Bootstrap 5 "alert" dispensável, com autofechamento).
     * Usado por cadCliente.js, cadClinica.js e cadProfissional.js.
     */
    mostrarAlerta: function ($container, mensagem, tipo) {
      tipo = tipo || "success";

      var $alerta = $(
        '<div class="alert alert-' + tipo + ' alert-dismissible fade show" role="alert">' +
          mensagem +
          '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
        "</div>"
      );

      $container.append($alerta);

      setTimeout(function () {
        $alerta.fadeOut(200, function () {
          $alerta.remove();
        });
      }, 3000);
    },

    /**
     * VALIDAÇÃO — helpers genéricos de formulário.
     */
    emailValido: function (email) {
      return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    },

    apenasNumeros: function (valor) {
      return valor.replace(/\D/g, "");
    },

    /**
     * Aceita telefones fixos (10 dígitos) e celulares (11 dígitos,
     * com o "9" na frente do número). Valida o DDD (11 a 99).
     */
    telefoneValido: function (telefone) {
      var numeros = this.apenasNumeros(telefone || "");

      if (numeros.length !== 10 && numeros.length !== 11) return false;

      var ddd = parseInt(numeros.substring(0, 2), 10);
      if (ddd < 11 || ddd > 99) return false;

      if (numeros.length === 11 && numeros.charAt(2) !== "9") return false;

      return true;
    },

    /**
     * Calcula a idade completa (em anos) a partir de uma data de
     * nascimento no formato "YYYY-MM-DD" (padrão de <input type="date">).
     */
    calcularIdade: function (dataNascimento) {
      var hoje = new Date();
      var nascimento = new Date(dataNascimento + "T00:00:00");
      var idade = hoje.getFullYear() - nascimento.getFullYear();
      var diferencaMeses = hoje.getMonth() - nascimento.getMonth();

      if (diferencaMeses < 0 || (diferencaMeses === 0 && hoje.getDate() < nascimento.getDate())) {
        idade--;
      }

      return idade;
    },

    /**
     * Confere se a data de nascimento informada corresponde a uma
     * idade igual ou maior que "idadeMinima" (padrão: 18 anos).
     */
    maiorDeIdade: function (dataNascimento, idadeMinima) {
      idadeMinima = idadeMinima || 18;

      if (!dataNascimento || isNaN(new Date(dataNascimento + "T00:00:00").getTime())) {
        return false;
      }

      return this.calcularIdade(dataNascimento) >= idadeMinima;
    },

    /**
     * Recebe uma lista de { valor, el } e marca com "is-invalid"
     * todo campo cujo valor esteja vazio. Retorna true se algum
     * campo estiver inválido.
     */
    validarCampos: function (campos) {
      var erro = false;
      campos.forEach(function (campo) {
        if (!campo.valor) {
          campo.el.addClass("is-invalid");
          erro = true;
        }
      });
      return erro;
    },

    /**
     * Marca uma lista de elementos jQuery com "is-invalid" e exibe
     * um alerta explicando o motivo.
     */
    marcarCamposComErro: function ($container, campos, mensagem) {
      campos.forEach(function ($campo) {
        $campo.addClass("is-invalid");
      });
      this.mostrarAlerta($container, mensagem, "danger");
    },

    cpfValido: function (cpf) {
      cpf = cpf.replace(/\D/g, "");

      if (cpf.length !== 11) return false;
      if (/^(\d)\1+$/.test(cpf)) return false; // Elimina CPFs inválidos conhecidos

      var soma = 0;
      var i;
      for (i = 0; i < 9; i++) {
        soma += parseInt(cpf[i], 10) * (10 - i);
      }
      var resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf[9], 10)) return false;

      soma = 0;
      for (i = 0; i < 10; i++) {
        soma += parseInt(cpf[i], 10) * (11 - i);
      }
      resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;

      return resto === parseInt(cpf[10], 10);
    },

    cnpjValido: function (cnpj) {
      cnpj = cnpj.replace(/\D/g, "");

      if (cnpj.length !== 14) return false;
      if (/^(\d)\1+$/.test(cnpj)) return false; // Elimina CNPJs inválidos conhecidos

      var tamanho = 12;
      var numeros = cnpj.substring(0, tamanho);
      var digitos = cnpj.substring(tamanho);
      var soma = 0;
      var pos = tamanho - 7;
      var i;

      for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
      }

      var resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
      if (resultado != digitos.charAt(0)) return false;

      tamanho = 13;
      numeros = cnpj.substring(0, tamanho);
      soma = 0;
      pos = tamanho - 7;

      for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
      }

      resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
      return resultado == digitos.charAt(1);
    },

    /**
     * Liga o clique no preview de imagem ao input de arquivo e
     * valida que o arquivo escolhido é uma imagem antes de exibir
     * o preview.
     */
    configurarPreviewImagem: function ($container, $input, $preview) {
      var self = this;

      $preview.on("click", function () {
        $input.trigger("click");
      });

      $input.on("change", function () {
        var arquivo = this.files[0];

        if (!arquivo || !arquivo.type.startsWith("image/")) {
          self.mostrarAlerta($container, "Selecione uma imagem válida!", "danger");
          return;
        }

        var leitor = new FileReader();
        leitor.onload = function (evento) {
          $preview.attr("src", evento.target.result);
        };
        leitor.readAsDataURL(arquivo);
      });
    },

    /**
     * Autopreenchimento de endereço a partir do CEP (ViaCEP).
     * "campos" deve conter os elementos jQuery: cep, rua, bairro,
     * cidade, uf, ibge.
     */
    configurarCEP: function ($container, campos) {
      var self = this;
      var todosOsCampos = [campos.cep, campos.rua, campos.bairro, campos.cidade, campos.uf, campos.ibge];

      campos.cep.on("blur", function () {
        var cep = self.apenasNumeros($(this).val());

        if (!/^[0-9]{8}$/.test(cep)) {
          self.marcarCamposComErro($container, todosOsCampos, "CEP inválido!");
          return;
        }

        campos.rua.val("...");
        campos.bairro.val("...");
        campos.cidade.val("...");
        campos.uf.val("...");
        campos.ibge.val("...");

        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
          if (dados.erro) {
            self.marcarCamposComErro($container, todosOsCampos, "CEP não encontrado!");
            return;
          }

          campos.rua.val(dados.logradouro);
          campos.bairro.val(dados.bairro);
          campos.cidade.val(dados.localidade);
          campos.uf.val(dados.uf);
          campos.ibge.val(dados.ibge);
          todosOsCampos.forEach(function ($campo) {
            $campo.removeClass("is-invalid");
          });
        });
      });

      campos.cep.on("input", function () {
        $(this).removeClass("is-invalid");
      });
    }
  };

  window.ElmoUtilitarios = ElmoUtilitarios;

})(jQuery, window);
