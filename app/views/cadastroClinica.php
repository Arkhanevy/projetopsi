<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/css/cadProCli.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Cadastro de Clínica</title>
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

                    <!-- CADASTRO CLINICA-->
                    <div id="cadastroClinica" class="cadastro">
                        <div class="text-center mt-4">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <img src="public/assets/images/logo_verde.png" class="logo-titulo">
                                <h1 class="m-0">Seja Bem-Vindo!</h1>
                            </div>
                            <p class="text-muted mt-2 mx-auto" style="max-width: 400px;">
                                Cadastro a clinica em Elmo para que clientes consigam encontra-las!
                            </p>
                        </div>



                        <form id="formClinica" enctype="multipart/form-data">
                            <div class="avatar-container">
                            <img id="previewClinica" src="public/assets/images/logo_user.png" alt="Foto de perfil">
                            <input name="cxclinFoto" type="file" id="img_perfil_Clinica" accept="image/*" required>
                        </div>

                        <p class="text-center mt-2" style="font-size: 12px;">
                            Clique na imagem para adicionar logo da clinica.
                        </p>
                            <div class="form-floating mb-3">
                                <input name="cxclinNome" id="nomeClinica" class="form-control" type="text"
                                    placeholder="Nome" required>
                                <label>Nome da clínica</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="exclinEmail" id="emailCadClinica" class="form-control" type="email"
                                    placeholder="E-mail" required>
                                <label>E-mail</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="cxclinTelefone" id="telClinica" class="form-control" type="tel"
                                    placeholder="Telfone" required>
                                <label>Telefone</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="cxclinUsername" id="userClinica" class="form-control" type="text"
                                    placeholder="Username" required>
                                <label>Username da clínica</label>
                            </div>
                            <div class="form-floating mb-3">
                                <label>Biografia</label> <br />
                                    <br /><textarea name="cxclinBiografia" id="bioClinica"
                                        placeholder="Escreva sua biografia aqui." required></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="cxclinCEP" class="form-control" type="text" id="cepClinica" value=""
                                            placeholder="cep" required> <label>Cep</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="" class="parteCEPClinica form-control" type="text" id="ruaClinica" placeholder="rua"
                                            required>
                                        <label>Rua</label>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="" class="parteCEPClinica form-control" type="text" id="bairroClinica"
                                            placeholder="bairro" required> <label>Bairro</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="" class="parteCEPClinica form-control" type="text" id="cidadeClinica"
                                            placeholder="cidade" required> <label>Cidade</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="" class=" parteCEPClinica form-control" type="text" id="ufClinica" placeholder="uf"
                                            required>
                                        <label>Estado</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input name="" class="parteCEPClinica form-control" type="text" id="ibgeClinica" placeholder="ibge"
                                            required> <label>IBGE</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="cxclinCnpj" id="cnpj" class="form-control" type="text" placeholder="CNPJ"
                                    required>
                                <label>CNPJ</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input name="cxclinSenha" id="senhaClinica" class="form-control" type="password"
                                    placeholder="Senha" required>
                                <label>Senha</label>
                            </div>
                            <div class="d-grid mb-3">
                                <button type="submit" id="btnCadClinica" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>

                        

                        <p>Já tem conta? <a class="logarClinica" href="#">Faça login</a></p>
                    </div>

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

                        <p>Não tem conta? <a class="cadastrarClinica" href="#">Cadastre-se</a></p>
                    </div>

                        <!--Ativação-->
                        <div class="img-thumbnail bg-light border border-success p-4 rounded-4 shadow" id="ativacao">
                            <h1 class="text-muted mt-5 mx-auto">Seja Bem-Vindo!</h1>
                            <p class="text-muted mt-5 mx-auto"> Clique no botão "Gerar código" para que um código seja enviado para o seu e-mail. Depois coloque-o da caixa abaixo para ativar sua conta.</p>
                            <form>
                                <div class="form-floating mt-5 mb-3">
                                    <input name="cxcliCodigo" id="codigoCliente" class="form-control" type="text" placeholder="Nome" required>
                                    <label>Código de Ativação</label>
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="button" id="btnAtivar" class="btn btn-success mb-3">Ativar</button>
                                    <button type="button" id="btnCodigo" class="btn btn-success">Gerar código</button>
                                </div>
                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>

   <script>
    window.BASE_URL = "<?= BASE_URL ?>";
</script>

    <script src="public/assets/js/cadClinica.js"></script>

</body>

</html>
