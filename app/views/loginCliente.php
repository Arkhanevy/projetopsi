<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login do Cliente</title>
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

    /* CARD DO LOGIN */
    #loginCliente {
        width: 100%;
        max-width: 500px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 30px;
        box-sizing: border-box;
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

        <!--Login-->
        <div class="img-thumbnail bg-light border border-success p-4 rounded-4 shadow" id="loginCliente">
            <h1 class="text-muted mt-5 mx-auto">Seja Bem-Vindo de Volta!</h1>
            <p class="text-muted mt-5 mx-auto"> Entre para poder agendar suas consultas.</p>
            <form method="POST">
                <div class="form-floating mt-5 mb-3">
                    <input name="cxcliEmail" id="emailLogin" class="form-control" type="email" placeholder="E-mail"
                        required>
                    <label>E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input name="cxcliSenha" id="senhaLogin" class="form-control" type="password" placeholder="Senha"
                        required>
                    <label>Senha</label>
                </div>
                <div class="d-grid mb-3">
                    <button type="submit" id="btnLogar" class="btn btn-success">Logar</button>
                </div>
            </form>
            <p>Ainda não tem conta? <a href="index.php?uri=cadastroCliente">Faça o cadastro</a></p>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap 5 (bundle com Popper) -->
    <script src="public/assets/js/utilitarios.js"></script>
    <script src="public/assets/js/loginCliente.js"></script>

</body>

</html>
