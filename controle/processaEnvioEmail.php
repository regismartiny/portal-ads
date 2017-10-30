<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require '../lib/PHPMailer/src/Exception.php';
    require '../lib/PHPMailer/src/PHPMailer.php';
    require '../lib/PHPMailer/src/SMTP.php';
    include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php"; 

    use PHPMailer\PHPMailer\PHPMailer;                                                  // Import PHPMailer classes into the global namespace
    use PHPMailer\PHPMailer\Exception;                                                  // These must be at the top of your script, not inside a function

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST)) {
        $dados = clearArray($_POST);
        $nome = $dados["nome"];	                                                        // Pega o valor do campo Nome
        $categoria = $dados["categoria"];	                                            // Pega o valor do campo Telefone
        $email = $dados["email"];	                                                    // Pega o valor do campo Email
        $mensagem = $dados["mensagem"];	                                                // Pega os valores do campo Mensagem
        
        // Variável que junta os valores acima e monta o corpo do email
        $corpo = "Nome: $nome\n\nE-mail: $email\n\nCategoria: $categoria\n\nMensagem: $mensagem\n";

        $mail = new PHPMailer(true);                                                    // Passando `true`, são ativadas as exceções
        
        //define o local como pt-br
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        //seta o timezone para são paulo
        date_default_timezone_set('America/Sao_Paulo');

        define('GUSER', 'adsteste03@gmail.com');	                                    // Insira aqui o seu GMail
        define('GPWD', 'senha*123');		                                            // Insira aqui a senha do seu GMail
        define('NOMEREMETENTE', 'Contato Site ADS');                                    // Insira o nome do remetente
        define('ASSUNTO','Contato via site '.strftime("%c"));                           // Insira o assunto do email
        
        define('CORPO',$corpo);                                                         // Define o corpo do email
        try {
            //Server settings
            //$mail->SMTPDebug = 4;                                                       // Ativa o modo de debug
            $mail->isSMTP();                                                            // Diz para o mailer usar SMTP
            $mail->Host = 'tls://smtp.gmail.com:587';                                   // Specificação do SMTP principal e dos backups
            $mail->SMTPAuth = true;                                                     // Ativa a autenticação SMTP
            $mail->Username = GUSER;                                                    // Usuario do email
            $mail->Password = GPWD;                                                     // Senha do email

            //Recipients
            $mail->setFrom(GUSER, NOMEREMETENTE);
            //$mail->addAddress($para, 'Nome do destinatario');                         // Adiciona um destinatario
            $mail->AddAddress(GUSER);                                                   // O nome dele é opcional
            
            $mail->addReplyTo($email, $nome);                                           // Define o destinatario da resposta
            /*
                $mail->addCC('cc@example.com');                                         // Adiciona um destinatario
                $mail->addBCC('bcc@example.com');                                       // Adiciona um destinatario oculto

                //Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');                           // Adicionar anexo
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');                      // Adicionar anexo com nome personalizado

            //Content

                $mail->isHTML(true);                                                    // Faz o formato do email ser HTML
                $mail->Subject = $assunto;                                              // Assunto do email

                $mail->Body = $corpo;                                                   //Corpo do email em html ex: <b>Negrito</b>

                
                $mail->AltBody = $corpo;                                                //Corpo do email alternativo, para clientes de email que não suportam leituras HTMl
            */
            $mail->Subject = ASSUNTO;                                                   // Assunto do email
            $mail->Body = CORPO;                                                        //Corpo do email
            
            $mail->smtpConnect([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                ]
            ]);

            $mail->send();                                                              //Envia o email
            $status = array('sucesso' => true, 'mensagem' => 'Email enviado com sucesso.');
        } catch (Exception $e) {
            $status = array('sucesso' => false, 'mensagem' => 'O email não pode ser enviado. Código do erro: '.$mail->ErrorInfo);
        }
    }else{
        $status = array('sucesso' => false, 'mensagem' => 'Oops! Houve um problema com o envio do formulário. Por favor tente enviar novamente.');
    }
    $resultado = json_encode($status, JSON_FORCE_OBJECT);
    echo json_encode($resultado);
?>