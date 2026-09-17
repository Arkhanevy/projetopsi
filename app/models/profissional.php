<?php 

use core\database\DBQuery;
use core\utils\CodeGenerator;
use app\core\utils\Mail;

$acao = $_POST['acao'] ?? '';

$campospro =[
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
            $generator = new CodeGenerator();
            $cod = $generator->run(6);
            /*$assunto = 'codigo de validação';
            $body = "!DOCTYPE html>
                    <html lang='pt-BR'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    </head>
                    <body>
                        <p> seu codigo é: ".$cod."</p>
                    </body>
                    </html>";*/
            
            $dados =[
                0,
                $_POST['nome'],
                $_POST['email'],
                $_POST['username'],
                password_hash($_POST['senha'],PASSWORD_BCRYPT),
                $_POST['bio'],
                'cxfoto',//$_POST['cxproFoto'],
                $cod,
                $_POST['dtNas'],
                date('Y-m-d H:i:s'),
                '',
                "desativo",
                $_POST['CPF'],
                $_POST['CEP'],
                $_POST['telefone'],
                $_POST['genero'],
                $_POST['registro'],
                0,
                0
            ];
                $campospro = implode(',',$campospro);
            
            try {
                $cadastrar = new DBQuery("profissional", $campospro, ['pro_id']);
                $resultado = $cadastrar->insert($dados);
                
                if ($resultado) {
                    echo "sucesso";
                    /*$email = new Mail($dados[2], $assunto, $body);
                    $email ->send();*/
                } else {
                    echo "erro ao inserir";
                }
            } catch (InvalidArgumentException $e) {
                echo "Erro de validação: " . $e->getMessage();
            } catch (\Exception $e) {
                echo "Erro no banco: " . $e->getMessage();
            };
            exit;
                
        case "ReGerarCodigo":
            $generator = new CodeGenerator();
            $cod = $generator->run(6);
            $dados = [$_POST['email'],$cod];
            $campospro = implode(',',[$campospro[2], $campospro[7]]);
            /*$assunto = 'codigo de validação';
            $body = "!DOCTYPE html>
                    <html lang='pt-BR'>
                    <head>
                        <meta charset='UTF-8'>
                        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    </head>
                    <body>
                        <p> seu codigo é: ".$cod."</p>
                    </body>
                    </html>";*/
            
            try {
                $codigo = new DBQuery("profissional", $campospro, ['pro_email']);
                $resultado = $codigo->update($dados);
                if ($resultado) {
                    echo "sucesso";
                    /*$email = new Mail($dados[2], $assunto, $body);
                    $email ->send();*/
                } else {
                    echo "erro ao inserir";
                }
            } catch (InvalidArgumentException $e){
                echo "Erro de validação: " . $e->getMessage();
            }catch (\Exception $e) {
                echo "Erro no banco: " . $e->getMessage();
            };
            exit;
        case "ativar":
            $email = $_POST['email'];
            $cod = $_POST['codigo'];
            
            $select = $campospro[7];
            $db = new DBQuery("profissional", $select, '');
            $where = " where pro_email = '" . $email . "'";
            $resultado = $db->selectWhere($where);
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            
            if (!$registro) {
                echo "e-mail não encontrado";
                exit;
            }
            
            $codVali = $registro['pro_codVali'];
            
            if ($cod !== $codVali) {
                echo "código inválido";
                exit;
            }
            
            $campospro = implode(',',[$campospro[11], $campospro[2]]);
            $dados = [
                "ativo",
                $email
            ];
            
            try {
                $ativar = new DBQuery("profissional", $campospro,'pro_email');
                $Update = $ativar->update($dados);
                if ($Update) {
                    echo "sucesso";
                } else {
                    echo "erro ao atualizar";
                }
            } catch (InvalidArgumentException $e) {
                echo "Erro de validação: " . $e->getMessage();
            } catch (\Exception $e) {
                echo "Erro no banco: " . $e->getMessage();
            }
            exit;

}
?>