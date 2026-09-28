<?php
use models\profissional;

$acao = $_POST['acao'] ?? '';
$campos =[
    'pro_id',
    'pro_nome',
    'pro_email',
    'pro_user',
    'pro_senha',
    'pro_bio',
    'pro_foto',
    'pro_codVali',
    'pro_dtNasc',
    'pro_dtCad',
    'pro_dtDell',
    'pro_stat',
    'pro_CPF',
    'pro_CEP',
    'pro_tel',
    'pro_gen',
    'pro_regi',
    'pro_doc',
    'pro_notif'];
switch ($acao){
    case "cadastrar":
        $profissional = new profissional('profissional', $campos, $campos[0]);
        $resultado = $profissional->Cadastrarprofissional($_POST['nome'], $_POST['email'], $_POST['username'], $_POST['senha'],$_POST['bio'], $_POST['dtNas'], $_POST['CPF'],$_POST['CEP'],$_POST['telefone'],$_POST['genero'],$_POST['registro']);
        echo json_encode($resultado);
        exit;
        
    case "ReGerarCodigo":
        $campospro = [$campos[2], $campos[7]];
        $profissional = new profissional('profissional',$campospro,$campospro[0]);
        $resultado = $profissional->GerarCodigo($_POST['email']);
        echo json_encode($resultado);
        exit;

    case "ativar":
        $campospro = [$campos[2], $campos[7],$campos[11]];
        $profissional = new profissional('profissional', $campospro, $campospro[0]);
        $resultado = $profissional->Ativar($_POST['email'], $_POST['cod']);
        echo json_encode($resultado);
        exit;
        
    case "login":
        $campospro = [$campos[0],$campos[1],$campos[2],$campos[4], $campos[11]];
        $profissional = new profissional('profissional', $campospro, $campospro[2]);
        $resultado = $profissional->Login($_POST['email'],$_POST['senha']);
        echo json_encode($resultado);
        exit;
    case "MostrarConsulta":
        $campo = 'agnd_pro';
        $profissional = new profissional('profissional', $campo, $campo);
        $resultado = $profissional->MostrarConsulta();
        echo json_encode($resultado);
        exit;
}