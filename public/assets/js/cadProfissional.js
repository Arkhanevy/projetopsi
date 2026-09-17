$(document).ready(function () {
    const telas = {
        cadastroProfissional: $("#cadastroProfissional"),
        loginProfissional: $("#loginProfissional"),
        ativacao: $("#ativacao"),
        perfilUser: $("#perfilUser")
    };

    function mostrarTela(nomeTela) {
        Object.values(telas).forEach(tela => tela.hide());

        if (telas[nomeTela]) {
            telas[nomeTela].show();
        } else {
            console.warn("Tela não encontrada:", nomeTela);
        }
    }

    mostrarTela("cadastroProfissional");

    let geradoCod = false;

    const BASE_URL = "<?= BASE_URL ?>";

    //Objetos-Dados do profissional
    const prof = {
        img: $("#img_perfil"),
        preview: $("#preview"),
        nome: $("#nomeProfissional"),
        email: $("#emailCadastro"),
        tel: $("#telProfissional"),
        user: $("#userProfissional"),
        genero: $("#generoProfissional"),
        bio: $("#bioProfissional"),
        data: $("#dtnPro"),
        cpf: $("#CPF"),
        senha: $("#senhaProfissional"),
        cep: $("#cep"),
        rua: $("#rua"),
        bairro: $("#bairro"),
        uf: $("#uf"),
        ibge: $("#ibge"),
        cidade: $("#cidade"),
        registro: $("#registroProfissional"),
        form: $("#cadastroProfissional"),
        login: $("#loginProfissional"),
        loginEmail: $("#emailCadastroLog"),
        loginSenha: $("#senhaProfissionalLog"),
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

    function cpfValido(cpf) {
        cpf = cpf.replace(/\D/g, "");

        if (cpf.length !== 11) return false;
        if (/^(\d)\1+$/.test(cpf)) return false;// Elimina CPFs inválidos conhecidos

        // Validação do primeiro dígito
        let soma = 0;
        for (let i = 0; i < 9; i++) {
            soma += parseInt(cpf[i]) * (10 - i);
        }

        let resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;

        if (resto !== parseInt(cpf[9])) return false;

        // Validação do segundo dígito
        soma = 0;
        for (let i = 0; i < 10; i++) {
            soma += parseInt(cpf[i]) * (11 - i);
        }

        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;

        return resto === parseInt(cpf[10]);
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

    function marcarErro(campos, mensagem) {
        campos.forEach(c => c.addClass("is-invalid"));
        mostrarAlert(mensagem, "danger");
    }

    //Funções-Estrutura
    configurarPreview(prof.img, prof.preview);

    configurarCEP({
        cep: prof.cep,
        rua: prof.rua,
        bairro: prof.bairro,
        cidade: prof.cidade,
        uf: prof.uf,
        ibge: prof.ibge
    });

    $(document).on("input change", ".form-control, .form-select, textarea", function () {
        $(this).removeClass("is-invalid");
    });

    //Troca de telas
    $(".logarProfissional").on("click", function (e) {
        e.preventDefault();
        mostrarTela("loginProfissional");
    });

    $(".cadastrarProfissional").on("click", function (e) {
        e.preventDefault();
        mostrarTela("cadastroProfissional");
    });

    //CADASTRO PROFISSIONAL
    $("#btnCadastrar").on("click", function () {
        const btn = $(this);
        btn.prop("disabled", true).html("Cadastrando...");
        const campos = [
            { valor: prof.nome.val(), el: prof.nome },
            { valor: prof.tel.val(), el: prof.tel },
            { valor: prof.user.val(), el: prof.user },
            { valor: prof.bio.val(), el: prof.bio },
            { valor: prof.data.val(), el: prof.data },
            { valor: prof.registro.val(), el: prof.registro },
            { valor: prof.senha.val(), el: prof.senha },
            { valor: prof.genero.val(), el: prof.genero },
            { valor: prof.email.val(), el: prof.email },
            { valor: prof.cpf.val(), el: prof.cpf },
            { valor: prof.cep.val(), el: prof.cep },
            { valor: prof.rua.val(), el: prof.rua },
            { valor: prof.bairro.val(), el: prof.bairro },
            { valor: prof.uf.val(), el: prof.uf },
            { valor: prof.ibge.val(), el: prof.ibge },
            { valor: prof.cidade.val(), el: prof.cidade },
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("Preencha todos os campos!", "danger");
            return;
        }

        const cpf = prof.cpf.val().trim();

        if (!cpf || !cpfValido(cpf)) {
            prof.cpf.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("CPF inválido!", "danger");
            return;
        }

        const email = prof.email.val().trim();

        if (!email || !emailValido(email)) {
            prof.email.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }

        const imgFile = prof.img[0].files[0];
        if (!imgFile) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("A imagem de perfil é obrigatória.", "danger");
            return;
        }

        // CEP
        const camposEndereco = [
            prof.cep,
            prof.rua,
            prof.bairro,
            prof.uf,
            prof.ibge,
            prof.cidade
        ];

        if (apenasNumeros(prof.cep.val()).length !== 8) {
            marcarErro(camposEndereco, "CEP inválido!");
            btn.prop("disabled", false).html("Cadastrar");
            return;
        }

        const cpfLimpo = prof.cpf.val().replace(/\D/g, "");
        const CEPLimpo = prof.cep.val().replace(/\D/g, "");

        const formData = new FormData();
        formData.append("nome", prof.nome.val());
        formData.append("email", prof.email.val());
        formData.append("telefone", prof.tel.val());
        formData.append("username", prof.user.val());
        formData.append("bio", prof.bio.val());
        formData.append("dtNas", prof.data.val());
        formData.append("registro", prof.registro.val());
        formData.append("senha", prof.senha.val());
        formData.append("genero", prof.genero.val());
        formData.append("CEP", CEPLimpo);
        formData.append("CPF", cpfLimpo);
        formData.append("acao", "cadastrar");
        formData.append("cxproFoto", imgFile);

        $.ajax({
            url: "/z/index.php?uri=profissional", //Axolote
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (r) {
                btn.prop("disabled", false).html("Cadastrar");

                if (r.trim() === "sucesso") {
                    mostrarAlert("Cadastro realizado!", "success");
                    mostrarTela("ativacao");
                } else {
                    mostrarAlert(r, "danger");
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

    //LOGIN
    $("#btnLogar").on("click", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.prop("disabled", true).html("Logando...");

        const campos = [
            { valor: prof.loginEmail.val(), el: prof.loginEmail },
            { valor: prof.loginSenha.val(), el: prof.loginSenha }
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("Preencha todos os campos!", "danger");
            return;
        }

        const email = prof.loginEmail.val().trim();

        if (!email || !emailValido(email)) {
            prof.loginEmail.addClass("is-invalid");
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }

        const fd = new FormData();
        fd.append("email", email);
        //fd.append("senhaLog", prof.loginSenha); Maria
		fd.append("senhaLog", prof.loginSenha.val()); //evelyn
		fd.append("acao", "login");

        $.ajax({
            url:"/z/index.php?uri=profissional", //Axolote
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
					    window.location.href ="/z/index.php?uri=perfil";
					}, 1000);
					//fim evelyn
                } else {
                    mostrarAlert(resposta, "danger");
                    //window.location.href = window.BASE_URL + "index.php?uri=clinica"; -> Maria
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

        let tempo = 60;
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

        const email = prof.email.val().trim();
        const controller = "/z/index.php?uri=profissional"; //Axolote

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

        const email = prof.email.val().trim();
        const controller ="/z/index.php?uri=profissional"; //Axolote

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
                    mostrarTela("loginProfissional");
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
