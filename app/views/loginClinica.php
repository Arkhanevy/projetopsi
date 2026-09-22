<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/css/cadProCli.css" rel="stylesheet">
    <title>Login da Clínica</title>
</head>


<body>

    <div class="container-fluid">
        <div id="alertContainer" class="position-fixed top-0 start-50 translate-middle-x p-3" style="z-index: 9999;"></div>
        <div class="row g-0 min-vh-100">

            <div id="imgBox" class="d-none d-md-block col-md-6">
                <img src="public/assets/images/bannerVertical.jpg" class="img-fluid h-100 w-100 object-fit-cover">
            </div>

            <div id="colForm" class="col-12 col-md-6 d-flex justify-content-center align-items-start">
                <div class="form-wrapper">

                    <!--LOGIN CLINICA-->
                    <div id="loginClinica">
                        <h1>Login Clínica</h1>
                        <form class="mt-4" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input name="cxproEmailLog" id="emailLogClinica" class="form-control" type="email"
                                        placeholder="E-mail" required>
                                    <label>E-mail</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproSenhaLog" id="senhaLogClinica" class="form-control" type="password"
                                        placeholder="Senha" required>
                                    <label>Senha</label>
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="submit" id="btnLogClinica" class="btn btn-success">Logar</button>
                                </div>
                        </form>

                        <p>Não tem conta? <a href="index.php?uri=cadastroClinica">Cadastre-se</a></p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap 5 (bundle com Popper) -->
    <script src="public/assets/js/utilitarios.js"></script>
    <script src="public/assets/js/loginClinica.js"></script>

</body>

</html>
