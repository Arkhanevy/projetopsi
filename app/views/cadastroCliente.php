<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Cadastro do Cliente</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-image: url("../img/bannerVertical.jpg");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100vh;
        width: 100%;
        overflow: hidden;
    }

    #ativacao, .cadastro {
        display: none;
    }

    /* CARD DO CADASTRO */
    #cadastroCliente, #ativacao {
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 30px;
        box-sizing: border-box;
    }

    /* FOTO */
    #preview {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

    #img_perfil{
     position: absolute;
     opacity: 0;
    }

    /* BIOGRAFIA */
    textarea {
        width: 100%;
        min-height: 150px;
        resize: none;
    }
    textarea.is-invalid, .form-select.is-invalid {
        border-color: #dc3545;
    }
</style>

<body>
    <div id="alertContainer" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999;"></div>

    <nav
        class="navbar navbar-expand-sm navbar-expand-md navbar-expand-lg navbar-expand-xl navbar-expand-xxl bg-success navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Logo</a>
        </div>
    </nav>

    <div class="container d-flex justify-content-center mt-3 min-vh-100">


        <!--Cadastro-->
        <div class="img-thumbnail bg-light border border-success p-4 rounded-4 shadow" id="cadastroCliente">
            <h1>Seja Bem-Vindo!</h1>
            <p class="text-muted mt-2 mx-auto"> Cadastre-se para poder agendar suas consultas.</p>
            <form method="POST">
                <div class="text-center">
                    <img class="img-fluid rounded-circle" id="preview" src="../img/logo_user.png" alt="Foto de perfil">
                    <input name="cxcliFoto" class="form-control" type="file" id="img_perfil" accept="image/*" required>
                </div>

                <p class="text-center mt-2" style="font-size: 12px;">Clique na imagem para adicionar foto</p>

                <div class="form-floating mb-3">
                    <input name="cxcliNome" id="nomeCliente" class="form-control" type="text" placeholder="Nome" required>
                    <label>Nome completo</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliUsername" id="userCliente" class="form-control" type="text" placeholder="Username"
                        required>
                    <label>Username</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliEmail" id="emailCadastro" class="form-control" type="email" placeholder="E-mail"
                        required>
                    <label>E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliTelefone" id="telCliente" class="form-control" type="tel" placeholder="Telfone"
                        required>
                    <label>Telefone</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliDtn" id="dtnCli" class="form-control" type="date" placeholder="Data de Nascimento"
                        required>
                    <label>Data de Nascimento</label>
                </div>
                <div class="form-floating mb-3">
                    <select name="cxcliGenero" id="generoCliente" class="form-select">
                        <option value="" selected disabled>Selecione uma opção</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                        <option value="O">Outro</option>
                    </select>
                    <label for="especialidade">Gênero</label>
                </div> 

                
                <div class="form-floating mb-3">
                    <label>Biografia</label> <br />
                    <br /><textarea name="cxcliBiografia" id="bioCliente"
                        placeholder="Escreva sua biografia aqui."></textarea>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliCPF" id="CPF" class="form-control" type="text" placeholder="CPF" required>
                    <label>CPF</label>
                </div>

                <div class="form-floating mb-3">
                    <input name="cxcliSenha" id="senhaCliente" class="form-control" type="password" placeholder="Senha"
                        required>
                    <label>Senha</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" id="btnCadastrar" class="btn btn-success">Cadastrar</button>
                </div>
            </form>
            <p>Já tem uma conta? <a href="index.php?uri=loginCliente">Faça login</a></p>
        </div>
        
        <!--Ativação-->
        <div class="img-thumbnail bg-light border border-success p-4 rounded-4 shadow" id="ativacao">
            <h1 class="text-muted mt-5 mx-auto">Seja Bem-Vindo!</h1>
            <p class="text-muted mt-5 mx-auto"> Um código de ativação foi enviado para o seu e-mail.</p>
            <form action="../model/caduser.php" method="POST">
                <div class="form-floating mt-5 mb-3">
                    <input name="cxcliCodigo" id="codigoCliente" class="form-control" type="text" placeholder="Código de Ativação" required>
                    <label>Código de Ativação</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="button" id="btnAtivar" class="btn btn-success mb-3">Ativar</button>
                    <button type="button" id="btnCodigo" class="btn btn-success">Gerar código</button>
                </div>
            </form>
        </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap 5 (bundle com Popper) -->
    <script src="public/assets/js/utilitarios.js"></script>
    <script src="public/assets/js/cadCliente.js"></script>

</body>

</html>