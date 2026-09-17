$(document).ready(function () {
    console.log("cadClinica.js carregado");

    const telas = {
        cadastroClinica: $("#cadastroClinica"),
        loginClinica: $("#loginClinica"),
        ativacao: $("#ativacao"),
        perfilClinica: $("#perfilClinica")
    };

    function mostrarTela(nomeTela) {
        Object.values(telas).forEach(tela => tela.hide());

        if (telas[nomeTela]) {
            telas[nomeTela].show();
        } else {
            console.warn("Tela não encontrada:", nomeTela);
        }
    }

    mostrarTela("cadastroClinica");

    let geradoCod = false;

    const BASE_URL = "<?= BASE_URL ?>";

    //Objetos-Dados da clínica
    const cli = {
        img: $("#img_perfil_Clinica"),
        preview: $("#previewClinica"),
        nome: $("#nomeClinica"),
        email: $("#emailCadClinica"),
        tel: $("#telClinica"),
        user: $("#userClinica"),
        bio: $("#bioClinica"),
        cnpj: $("#cnpj"),
        senha: $("#senhaClinica"),
        cep: $("#cepClinica"),
        rua: $("#ruaClinica"),
        bairro: $("#bairroClinica"),
        uf: $("#ufClinica"),
        ibge: $("#ibgeClinica"),
        cidade: $("#cidadeClinica"),
        form: $("#cadastroClinica"),
        login: $("#loginClinica"),
        loginEmail: $("#emailLogClinica"),
        loginSenha: $("#senhaLogClinica"),
        emailAtivacao: $("#emailAtivar"),
        codigo: $("#codigoCliente")
    };

    //Funções
    function mostrarAlert(mensagem, tipo = "success") {
        const $container = $("#alertContainer");

        const $alert = $(`
            <div class="alert alert-${tipo} alert-dismissible fade show" role="alert">
                ${mensagem}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);

        $container.append($alert);

        setTimeout(() => {
            $alert.fadeOut(200, () => $alert.remove());
        }, 3000);
    }

    function emailValido(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    function apenasNumeros(v) {
        return v.replace(/\D/g, "");
    }

    function validarCampos(campos) {
        let erro = false;

        campos.forEach(c => {
            if (!c.valor) {
                c.el.addClass("is-invalid");
                erro = true;
            }
        });

        return erro;
    }

    function cnpjValido(cnpj) {
        cnpj = cnpj.replace(/\D/g, "");

        if (cnpj.length !== 14) return false;
        if (/^(\d)\1+$/.test(cnpj)) return false;// Elimina CNPJs inválidos conhecidos

        let tamanho = 12;
        let numeros = cnpj.substring(0, tamanho);
        let digitos = cnpj.substring(tamanho);

        let soma = 0;
        let pos = tamanho - 7;

        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }

        let resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

        if (resultado != digitos.charAt(0)) return false;

        tamanho = 13;
        numeros = cnpj.substring(0, tamanho);

        soma = 0;
        pos = tamanho - 7;

        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }

        resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);

        return resultado == digitos.charAt(1);
    }

    //IMG
    function configurarPreview(input, preview) {

        preview.on("click", () => input.trigger("click"));

        input.on("change", function () {

            const file = this.files[0];

            if (!file || !file.type.startsWith("image/")) {
                mostrarAlert("Selecione uma imagem válida!", "danger");
                return;
            }

            const reader = new FileReader();

            reader.onload = e => preview.attr("src", e.target.result);
            reader.readAsDataURL(file);
        });
    }

    //CEP
    function configurarCEP(config) {

        config.cep.on("blur", function () {

            const cep = apenasNumeros($(this).val());

            if (!/^[0-9]{8}$/.test(cep)) {
                config.cep.addClass("is-invalid");
                config.rua.addClass("is-invalid");
                config.bairro.addClass("is-invalid");
                config.cidade.addClass("is-invalid");
                config.uf.addClass("is-invalid");
                config.ibge.addClass("is-invalid");
                mostrarAlert("CEP inválido!", "danger");
                return;
            }

            config.rua.val("...");
            config.bairro.val("...");
            config.cidade.val("...");
            config.uf.val("...");
            config.ibge.val("...");

            $.getJSON(`https://viacep.com.br/ws/${cep}/json/?callback=?`, function (dados) {

                if (dados.erro) {
                    mostrarAlert("CEP não encontrado!", "danger");
                    config.cep.addClass("is-invalid");
                    config.rua.addClass("is-invalid");
                    config.bairro.addClass("is-invalid");
                    config.cidade.addClass("is-invalid");
                    config.uf.addClass("is-invalid");
                    config.ibge.addClass("is-invalid");
                    return;
                } else {
                    config.rua.val(dados.logradouro);
                    config.bairro.val(dados.bairro);
                    config.cidade.val(dados.localidade);
                    config.uf.val(dados.uf);
                    config.ibge.val(dados.ibge);
                    config.cep.removeClass("is-invalid");
                    config.rua.removeClass("is-invalid");
                    config.bairro.removeClass("is-invalid");
                    config.cidade.removeClass("is-invalid");
                    config.uf.removeClass("is-invalid");
                    config.ibge.removeClass("is-invalid");
                    return;
                }
            });
        });

        config.cep.on("input", function () {
            $(this).removeClass("is-invalid");
        });
    }

    //Funções-Estrutura
    configurarPreview(cli.img, cli.preview);

    configurarCEP({
        cep: cli.cep,
        rua: cli.rua,
        bairro: cli.bairro,
        cidade: cli.cidade,
        uf: cli.uf,
        ibge: cli.ibge
    });

    $(document).on("input change", ".form-control, .form-select, textarea", function () {
        $(this).removeClass("is-invalid");
    });

    //Troca de telas
    $(".logarClinica").on("click", function (e) {
        e.preventDefault();
        mostrarTela("loginClinica");
    });

    $(".cadastrarClinica").on("click", function (e) {
        e.preventDefault();
        mostrarTela("cadastroClinica");
    });

    //CADASTRO CLINICA
    $("#btnCadClinica").on("click", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.prop("disabled", true).html("Cadastrando...");
        const campos = [
            { valor: cli.nome.val(), el: cli.nome },
            { valor: cli.tel.val(), el: cli.tel },
            { valor: cli.user.val(), el: cli.user },
            { valor: cli.bio.val(), el: cli.bio },
            { valor: cli.senha.val(), el: cli.senha },
            { valor: cli.email.val(), el: cli.email },
            { valor: cli.cep.val(), el: cli.cep },
            { valor: cli.rua.val(), el: cli.rua },
            { valor: cli.bairro.val(), el: cli.bairro },
            { valor: cli.uf.val(), el: cli.uf },
            { valor: cli.ibge.val(), el: cli.ibge },
            { valor: cli.cidade.val(), el: cli.cidade },
            { valor: cli.cnpj.val(), el: cli.cnpj }
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("Preencha todos os campos!", "danger");
            return;
        }

        // CNPJ
        const cnpj = cli.cnpj.val().trim();

        if (!cnpj || !cnpjValido(cnpj)) {
            cli.cnpj.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("CNPJ inválido!", "danger");
            return;
        }

        // IMAGEM
        if (!cli.img[0].files || cli.img[0].files.length === 0) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("Imagem obrigatória!", "danger");
            return;
        }

        //E-MAIL
        const email = cli.email.val().trim();
        if (!email || !emailValido(email)) {
            cli.email.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }

        // CEP
        if (apenasNumeros(cli.cep.val()).length !== 8) {
            cli.cep.addClass("is-invalid");
            cli.rua.addClass("is-invalid");
            cli.bairro.addClass("is-invalid");
            cli.uf.addClass("is-invalid");
            cli.ibge.addClass("is-invalid");
            cli.cidade.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("CEP inválido!", "danger");
            return;
        }

        const CNPJLimpo = cli.cnpj.val().replace(/\D/g, "");
        const CEPLimpo = cli.cep.val().replace(/\D/g, "");

        const formData = new FormData();
        formData.append("nome", cli.nome.val());
        formData.append("email", email);
        formData.append("telefone", apenasNumeros(cli.tel.val()));
        formData.append("username", cli.user.val());
        formData.append("bio", cli.bio.val());
        formData.append("CEP", CEPLimpo);
        formData.append("CNPJ", CNPJLimpo);
        formData.append("senha", cli.senha.val());
        formData.append("cxclinFoto", cli.img[0].files[0]);
        formData.append("acao", "cadastrar");

        $.ajax({
            url: "/z/index.php?uri=clinica", //Axolote
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,

            success: function (resposta) {
                btn.prop("disabled", false).html("Cadastrar");

                if (resposta.trim() === "sucesso") {
                    mostrarAlert("Cadastro realizado!", "success");
                    mostrarTela("ativacao");
                } else {
                    mostrarAlert(resposta, "danger");
                }
            },

            error: function () {
                btn.prop("disabled", false).html("Cadastrar");
                mostrarAlert("Erro na requisição!", "danger");
            }
        });
    });
    $("input").on("input", function () {
        $(this).removeClass("is-invalid");
    });

    //Login
    $("#btnLogClinica").on("click", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.prop("disabled", true).html("Logando...");

        const campos = [
            { valor: cli.loginEmail.val(), el: cli.loginEmail },
            { valor: cli.loginSenha.val(), el: cli.loginSenha }
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("Preencha todos os campos!", "danger");
            return;
        }

        const email = cli.loginEmail.val().trim();

        if (!email || !emailValido(email)) {
            cli.loginEmail.addClass("is-invalid");
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }

        const fd = new FormData();
        fd.append("email", email);
        //fd.append("senhaLog", cli.loginSenha); Maria
		fd.append("senhaLog", cli.loginSenha.val()); //evelyn
        fd.append("acao", "login");

        $.ajax({
            url: "/z/index.php?uri=clinica", //Axolote
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,

            success: function (resposta) {
                console.log("Foi mandado");
                btn.prop("disabled", false).html("Logar");
                
				if (resposta.trim() === "sucesso") {
					mostrarAlert("Login realizado com sucesso!", "success");
                    //mostrarTela("perfilUser"); -> Maria
					//inicio evelyn
					setTimeout(() => {
					    window.location.href ="/z/index.php?uri=home";
					}, 1000);
					//fim evelyn
                } else {
                    mostrarAlert(resposta, "danger");
                    console.log("deu ruim");
                    //window.location.href = "/z/index.php?uri=clinica"; -> Maria
                }
            },

            error: function (xhr, status, error) {
                console.log("STATUS:", status);
                console.log("ERRO:", error);
                console.log("RESPOSTA:", xhr.responseText);
                mostrarAlert("Erro na requisição!", "danger");
            }
        });
    });
    $("input").on("input", function () {
        $(this).removeClass("is-invalid");
    });

    // GERAR CÓDIGO
    $("#btnCodigo").on("click", function (e) {
        e.preventDefault();

        const btn = $(this);
        btn.prop("disabled", true);

        let tempo = 6;
        btn.text(`Aguarde ${tempo}s para gerar um novo código`);

        const interval = setInterval(() => {
            tempo--;
            btn.text(`Aguarde ${tempo}s`);
            if (tempo <= 0) {
                clearInterval(interval);
                btn.prop("disabled", false);
                btn.text("Gerar código");
            }
        }, 1000);

        const email = cli.email.val().trim();
        const controller = "/z/index.php?uri=clinica"; //Axolote

        const fd = new FormData();
        fd.append("email", email);
        fd.append("acao", "ReGerarCodigo");

        $.ajax({
            url: controller, //Axolote
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (resposta) {
                if (resposta.trim() === "sucesso") {
                    mostrarAlert("Código enviado com sucesso para o seu e-mail!", "success");
                    geradoCod = true;
                } else {
                    mostrarAlert(resposta, "danger");
                    mostrarAlert("Não gerado", "danger");
                }
            },
            error: function () {
                console.log("Erro na requisição ao gerar código!", "danger");
            }
        });
    });

    //ATIVACAO
    $("#btnAtivar").on("click", function (e) {
        e.preventDefault();

        const btn = $(this);
        const campoCodigo = $("#codigoCliente");
        const inputCodigo = campoCodigo.val().trim();

        const email = cli.email.val().trim();
        const controller = "/z/index.php?uri=clinica"; //Axolote

        if (geradoCod === false) {
            mostrarAlert("Gere um código primeiro!", "danger");
            btn.prop("disabled", false).html("Ativar");
            return;
        }

        if (!inputCodigo) {
            campoCodigo.addClass("is-invalid");
            mostrarAlert("Digite o código enviado!", "danger");
            btn.prop("disabled", false).html("Ativar");
            return;
        }

        btn.prop("disabled", true).html("Ativando...");

        const fd = new FormData();
        fd.append("email", email);
        fd.append("codigo", inputCodigo);
        fd.append("acao", "ativar");

        $.ajax({
            url: controller, //Axolote
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (resposta) {
                btn.prop("disabled", false).html("Ativar");

                if (resposta.trim() === "sucesso") {
                    mostrarAlert("Conta ativada com sucesso!", "success");
                    geradoCod = false;
                    mostrarTela("loginClinica");
                } else {
                    mostrarAlert(resposta, "danger");
                    campoCodigo.addClass("is-invalid");
                    btn.prop("disabled", false).html("Ativar");
                }
            },
            error: function (xhr, status, error) {
                btn.prop("disabled", false).html("Ativar");
                console.error("Erro:", error);
                mostrarAlert("Erro na requisição de ativação!", "danger");
            }
        });
    });
    $("input").on("input", function () {
        $(this).removeClass("is-invalid");
    });

});
