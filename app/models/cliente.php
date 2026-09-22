<?php 

use core\database\DBQuery;
use core\utils\CodeGenerator;
use app\core\utils\Mail;

$acao = $_POST['acao'] ?? '';

$camposcli =[
    'cli_id',
    'cli_nome',
    'cli_email',
    'cli_user',
    'cli_senha',
    'cli_bio',
    'cli_foto',
    'cli_codVali',
    'cli_dtNasc',
    'cli_dtCad',
    'cli_dtDell',
    'cli_stat',
    'cli_CPF',
    'cli_tel',
    'cli_gen',
    'cli_doc',
    'cli_notif'];

    
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
                    </body>
                    </html>";*/
            
            $dados =[
                0,
                $_POST['nome'],
                $_POST['email'],
                $_POST['username'],
                password_hash($_POST['senha'],PASSWORD_BCRYPT),
                $_POST['bio'] ?? '',
                'cxfoto',//$_POST['cxproFoto'],
                $cod,
                $_POST['dtNas'] ?? '',
                date('Y-m-d H:i:s'),
                '',
                "desativo",
                $_POST['CPF'],
                /*$_POST['CEP'] || '',*/
                $_POST['telefone'],
                $_POST['genero'],
                0,
                ''
            ];
                $camposcli = implode(',',$camposcli);
            
            try {
                $cadastrar = new DBQuery("cliente", $camposcli, ['cli_id']);
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
            $camposcli = implode(',',[$camposcli[2], $camposcli[7]]);
            try {
                $codigo = new DBQuery("cliente", $camposcli, ['cli_email']);
                $resultado = $codigo->update($dados);
                if ($resultado) {
                    echo "sucesso";
                } else {
                    echo "erro ao inserir";
                }
            } catch (InvalidArgumentException $e){
                echo "Erro de validação: " . $e->getMessage();
            }catch (\Exception $e) {
                echo "Erro no banco: " . $e->getMessage();
            };
            exit;
        case "ativar": //ALERTA DE CAMBIARRA
                  
            $email = $_POST['email'];
            $cod = $_POST['codigo'];
            
            $select = $camposcli[7];
            $db = new DBQuery("cliente", $select, '');
            $where = " where cli_email = '" . $email . "'";
            $resultado = $db->selectWhere($where);
            $registro = $resultado->fetch(PDO::FETCH_ASSOC);
            
            if (!$registro) {
                echo "e-mail não encontrado";
                exit;
            }
            
            $codVali = $registro['cli_codVali'];
            
            if ($cod !== $codVali) {
                echo "código inválido";
                exit;
            }
            
            $camposcli = implode(',',[$camposcli[11], $camposcli[2]]);
            $dados = [
                "ativo",
                $email
            ];
            
            try {
                $ativar = new DBQuery("cliente", $camposcli,'cli_email');
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
            
            
            //EVELYN LOGIN
        case "login":
            
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senhaLog'] ?? '';
            
            $select = "cli_id,cli_nome,cli_email,cli_senha,cli_stat";
                       
            try {
                $db = new DBQuery("cliente", $select, "");
                
                $where = " WHERE cli_email = '" . $email . "'";
                
                $resultado = $db->selectWhere($where);
                
                $cliente = $resultado->fetch(PDO::FETCH_ASSOC);
                
                ;

                if (!$cliente) {
                    echo "E-mail não encontrado";
                    exit;
                }
                    
                if ($cliente['cli_stat'] != 'ativo') {
                    echo "Conta não ativada";
                    exit;
                }
                
                if (!password_verify($senha, $cliente['cli_senha'])) {
                    echo "Senha inválida";
                    exit;
                }
               
                $_SESSION['cliente'] = [
                    'id' => $cliente['cli_id'],
                    'nome' => $cliente['cli_nome'],
                    'email' => $cliente['cli_email']
                ];
                
                echo "sucesso";
                
            } catch (\Exception $e) {
                
                echo $e->getMessage();
                
            }
            
            exit;
            
}
?>