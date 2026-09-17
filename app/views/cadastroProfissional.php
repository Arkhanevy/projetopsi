<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" /><!-- Bootstrap 5 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" /> <!-- Material Symbols (Google) -->
    <link href="public/assets/css/cadProCli.css" rel="stylesheet"><!-- CSS próprio -->
    <title>Cadastro de Profissional</title>
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

                    <div id="cadastroProfissional" class="cadastro">
                        <div class="text-center mt-4">
                            <div class="d-flex align-items-center gap-2 flex-wrap">
                                <img src="public/assets/images/logo_verde.png" class="logo-titulo">
                                <h1 class="m-0">Seja Bem-Vindo!</h1>
                            </div>
                            <p class="text-muted mt-2 mx-auto" style="max-width: 400px;">
                                Faça um cadastro como profissional para que os clientes possam encontrar seus serviços.
                            </p>
                        </div>

                        
                        <form id="formProfissional" enctype="multipart/form-data">
                            <div class="avatar-container">
                                <img id="preview" src="public/assets/images/logo_user.png" alt="Foto de perfil">
                                <input name="cxproFoto" type="file" id="img_perfil" accept="image/*" required>
                            </div>

                            <p class="text-center mt-2" style="font-size: 12px;">
                                Clique na imagem para adicionar foto
                            </p>

                                <div class="form-floating mb-3">
                                    <input name="cxproNome" id="nomeProfissional" class="form-control" type="text"
                                        placeholder="Nome" required>
                                    <label>Nome completo</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproUsername" id="userProfissional" class="form-control" type="text"
                                        placeholder="Username" required>
                                    <label>Username</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproEmail" id="emailCadastro" class="form-control" type="email"
                                        placeholder="E-mail" required>
                                    <label>E-mail</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproTelefone" id="telProfissional" class="form-control" type="tel"
                                        placeholder="Telfone" required>
                                    <label>Telefone</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxprodtNasc" id="dtnPro" class="form-control" type="date" placeholder="Data de Nascimento" required>
                                    <label>Data de Nascimento</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <select name="cxproGenero" id="generoProfissional" class="form-select">
                                        <option value="" selected disabled>Selecione uma opção</option>
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
                                        <option value="O">Não Binario</option>
                                        <option value="I">Prefiro não dizer</option>
                                    </select>
                                    <label for="especialidade">Gênero</label>
                                </div> 
                                <div class="form-floating mb-3">
                                    <label>Biografia</label> <br />
                                    <br /><textarea name="cxproBiografia" id="bioProfissional"
                                        placeholder="Escreva sua biografia aqui."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="cxproCEP" class="form-control" type="text" id="cep" value=""
                                                placeholder="cep" required> <label>CEP</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="" class="parteCEP form-control" type="text" id="rua" placeholder="rua"
                                                required>
                                            <label>Rua</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="" class="parteCEP form-control" type="text" id="bairro"
                                                placeholder="bairro" required> <label>Bairro</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="" class="parteCEP form-control" type="text" id="cidade"
                                                placeholder="cidade" required> <label>Cidade</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="" class=" parteCEP form-control" type="text" id="uf" placeholder="uf"
                                                required>
                                            <label>Estado</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                            <input name="" class="parteCEP form-control" type="text" id="ibge" placeholder="ibge"
                                                required> <label>IBGE</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproRegistro" id="registroProfissional" class="form-control" type="text"
                                        placeholder="Registro" required>
                                    <label>Registro profissional</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input name="cxproCPF" id="CPF" class="form-control" type="text" placeholder="CPF"
                                        required>
                                    <label>CPF</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input name="cxproSenha" id="senhaProfissional" class="form-control" type="password"
                                        placeholder="Senha" required>
                                    <label>Senha</label>
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="submit" id="btnCadastrar" class="btn btn-success">Cadastrar</button>
                                </div>
                        </form>

                        <p>
                            Já tem uma conta? <a class="logarProfissional" href="#">Faça login</a>
                        </p>


                    </div>

                    <!-- LOGIN PROFISSIONAL-->
                    <div id="loginProfissional">
                        <div class="text-center mt-4">
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <img src="public/assets/images/logo_verde.png" class="logo-titulo">
                                <h1 class="m-0">Seja Bem-Vindo de Volta!</h1>
                            </div>
                            <p class="text-muted mt-2 mx-auto" style="max-width: 400px;">
                                Faça um login como profissional para que os clientes possam encontrar seus serviços.
                            </p>
                        </div>
                        <form class="mt-4" enctype="multipart/form-data">
                                <div class="form-floating mb-3">
                                    <input name="cxproEmailLog" id="emailCadastroLog" class="form-control" type="email"
                                        placeholder="E-mail" required>
                                    <label>E-mail</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input name="cxproSenhaLog" id="senhaProfissionalLog" class="form-control" type="password"
                                        placeholder="Senha" required>
                                    <label>Senha</label>
                                </div>
                                <div class="d-grid mb-3">
                                    <button type="submit" id="btnLogar" class="btn btn-success">Logar</button>
                                </div>
                        </form>
                        
                        <p> Não tem conta? <a class="cadastrarProfissional" href="#">Cadastre-se</a></p>
                        <!-- <a id="linkEsqueci" href="#">Esqueci a senha</a> -->

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

      
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script><!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script><!-- Bootstrap 5 (bundle com Popper) -->
    <script src="public/assets/js/cadProfissional.js"></script>

</body>

</html>
