document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const tipo = params.get("tipo") || "cadastro";
    const telas = {
        cadastro: $("#cadastroCliente"),
        login: $("#loginCliente"),
        ativacao: $("#ativacao"),
        perfilUser: $("#perfilUser")
    };

    function mostrarTela(nomeTela) {
        Object.values(telas).forEach(tela => tela.hide());
        if (telas[nomeTela]) {
            telas[nomeTela].show();
        } else {
            console.warn("Tela não encontrada:", nomeTela);
            telas.cadastro.show();
        }
    }
    if (telas[tipo]) {
        mostrarTela(tipo);
    } else {
        mostrarTela("cadastro");
    }

    let codigoGeradoGlobal = null;


    //Objetos-Dados dos usuarios

    const cliente = {
        img: $("#img_perfil"),
        preview: $("#preview"),
        nome: $("#nomeCliente"),
        email: $("#emailCadastro"),
        tel: $("#telCliente"),
        user: $("#userCliente"),
        genero: $("#generoCliente"),
        bio: $("#bioCliente"),
        data: $("#dtnCli"),
        cpf: $("#CPF"),
        senha: $("#senhaCliente"),
        form: $("#cadastroCliente"),
        login: $("#login"),
        loginEmail: $("#emailLogin"),
        loginSenha: $("#senhaLogin"),
        emailAtivacao: $("#emailAtivacao"),
        codigo: $("#codigoCliente")
    };

    //FUNÇÕES

    //Alerta
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

    //E-mail
    function emailValido(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }

    //Limpeza dos valores
    function apenasNumeros(v) {
        return v.replace(/\D/g, "");
    }

    //Validação
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

    //CPF
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

    function marcarErro(campos, mensagem) {
        campos.forEach(c => c.addClass("is-invalid"));
        mostrarAlert(mensagem, "danger");
    }

    //Funções-Estrutura

    configurarPreview(cliente.img, cliente.preview);
    $(document).on("input change", ".form-control, .form-select, textarea", function () {
        $(this).removeClass("is-invalid");
    });




    // TROCAR DE TELA
    $(".logarCliente").on("click", function (e) {
        e.preventDefault();
        mostrarTela("login");
    });

    $(".cadastrarCliente").on("click", function (e) {
        e.preventDefault();
        mostrarTela("cadastro");
    });

    //CADASTRO
    $("#btnCadastrar").on("click", function () {
        const btn = $(this);
        btn.prop("disabled", true).html("Cadastrando...");

        const campos = [
            { valor: cliente.nome.val(), el: cliente.nome },
            { valor: cliente.tel.val(), el: cliente.tel },
            { valor: cliente.user.val(), el: cliente.user },
            { valor: cliente.bio.val(), el: cliente.bio },
            { valor: cliente.data.val(), el: cliente.data },
            { valor: cliente.senha.val(), el: cliente.senha },
            { valor: cliente.genero.val(), el: cliente.genero },
            { valor: cliente.email.val(), el: cliente.email },
            { valor: cliente.cpf.val(), el: cliente.cpf }
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("Preencha todos os campos obrigatórios!", "danger");
            return;
        }

        const cpfLimpo = cliente.cpf.val().replace(/\D/g, "");
        if (!cpfValido(cpfLimpo)) {
            cliente.cpf.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("CPF inválido!", "danger");
            return;
        }

        const email = cliente.email.val().trim();
        if (!emailValido(email)) {
            cliente.email.addClass("is-invalid");
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }

        const imgFile = cliente.img[0].files[0];
        if (!imgFile) {
            btn.prop("disabled", false).html("Cadastrar");
            mostrarAlert("A imagem de perfil é obrigatória.", "danger");
            return;
        }

        const formData = new FormData();
        formData.append("nome", cliente.nome.val());
        formData.append("email", email);
        formData.append("telefone", cliente.tel.val().replace(/\D/g, ""));
        formData.append("username", cliente.user.val());
        formData.append("bio", cliente.bio.val());
        formData.append("dtNas", cliente.data.val());
        formData.append("senha", cliente.senha.val());
        formData.append("genero", cliente.genero.val());
        formData.append("CPF", cpfLimpo);
        formData.append("acao", "cadastrar");
        formData.append("cxclientefoto", imgFile);

        $.ajax({
            url: window.BASE_URL + "index.php?uri=cliente", //Axolote
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (r) {
                btn.prop("disabled", false).html("Cadastrar");

                if (r.trim() === "sucesso") {
                    mostrarAlert("Cadastro realizado com sucesso!", "success");
                    mostrarTela("ativacao");
                } else {
                    mostrarAlert(r, "danger");
                }
            },
            error: function () {
                btn.prop("disabled", false).html("Cadastrar");
                mostrarAlert("Erro interno na requisição. Tente novamente.", "danger");
            }
        });
    });


    let geradoCod = false;



    // GERAR CÓDIGO
    $("#btnCodigo").on("click", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.prop("disabled", true);

        let tempo = 60;
        btn.text(`Aguarde ${tempo}s até conseguir gerar um novo código.`);

        const interval = setInterval(() => {
            tempo--;
            btn.text(`Aguarde ${tempo}s até conseguir gerar um novo código.`);
            if (tempo <= 0) {
                clearInterval(interval);
                btn.prop("disabled", false);
                btn.text("Gerar código");
            }
        }, 1000);


        // Define dinamicamente o e-mail e o destino (Back-end)
        let email = cliente.email.val().trim();

        const fd = new FormData();
        fd.append("email", email);
        fd.append("acao", "ReGerarCodigo");

        $.ajax({
            url: window.BASE_URL + "index.php?uri=cliente", //Axolote
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
                    //geradoCod = false;
                }
            },
            error: function () {
                console.log("Erro na requisição ao gerar código!", "danger");
                //geradoCod = false;
            }
        });
    });


    //ATIVACAO
    $("#btnAtivar").on("click", function (e) {
        e.preventDefault();
        /*console.log("Valor atual de codigoGeradoGlobal:", codigoGeradoGlobal);
        console.log("Tipo do valor:", typeof codigoGeradoGlobal);*/

        const btn = $(this);
        const campoCodigo = $("#codigoCliente");
        const inputCodigo = campoCodigo.val().trim();

        let email = cliente.email.val().trim();

        if (geradoCod = false) {
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
            url: window.BASE_URL + "index.php?uri=cliente", //Axolote
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,
            success: function (resposta) {
                btn.prop("disabled", false).html("Ativar");

                if (resposta.trim() === "sucesso") {
                    mostrarAlert("Conta ativada com sucesso!", "success");
                    codigoGeradoGlobal = null;
                    mostrarTela("loginCliente");
                } else {
                    mostrarAlert(resposta, "danger");
                }
            },
            error: function (xhr, status, error) {
                btn.prop("disabled", false).html("Ativar");
                console.log("STATUS:", status);
                console.log("ERRO:", error);
                console.log("RESPOSTA:", xhr.responseText);
                mostrarAlert("Erro na requisição de ativação!", "danger");
            }
        });
    });
    $("input").on("input", function () {
        $(this).removeClass("is-invalid");
    });



    //Login
    $("#btnLogar").on("click", function (e) {
        e.preventDefault();
        const btn = $(this);
        btn.prop("disabled", true).html("Logando...");

        const campos = [
            { valor: cliente.loginEmail.val(), el: cliente.loginEmail },
            { valor: cliente.loginSenha.val(), el: cliente.loginSenha }
        ];

        if (validarCampos(campos)) {
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("Preencha todos os campos!", "danger");
            return;
        }

        const email = cliente.loginEmail.val().trim();

        if (!email || !emailValido(email)) {
            cliente.loginEmail.addClass("is-invalid");
            btn.prop("disabled", false).html("Logar");
            mostrarAlert("E-mail inválido!", "danger");
            return;
        }


        const fd = new FormData();
        fd.append("email", email);
        fd.append("senhaLog", cliente.loginSenha);
        fd.append("acao", "login");

        $.ajax({
            url: window.BASE_URL + "index.php?uri=cliente",  //Axolote
            method: "POST",
            data: fd,
            processData: false,
            contentType: false,

            success: function (resposta) {
                console.log("Foi mandado");
                btn.prop("disabled", false).html("Logar");
                if (resposta.trim() === "sucesso") {
                    mostrarAlert("Login realizado com sucesso!", "success");
                    mostrarTela("perfilUser");
                } else {
                    mostrarAlert(resposta, "danger");
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

});