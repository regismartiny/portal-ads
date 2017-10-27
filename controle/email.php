<?php
    // Import PHPMailer classes into the global namespace
    // These must be at the top of your script, not inside a function

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    require '/PHPMailer/src/Exception.php';
    require '/PHPMailer/src/PHPMailer.php';
    require '/PHPMailer/src/SMTP.php';

    $Nome		= $_POST["nome"];	// Pega o valor do campo Nome
    $Categoria		= $_POST["categoria"];	// Pega o valor do campo Telefone
    $Email		= $_POST["email"];	// Pega o valor do campo Email
    $Mensagem	= $_POST["mensagem"];	// Pega os valores do campo Mensagem
    
    // Variável que junta os valores acima e monta o corpo do email

    $Vai 		= "Nome: $Nome\n\nE-mail: $Email\n\nCategoria: $Categoria\n\nMensagem: $Mensagem\n";



    function smtpmailer($para, $de, $de_nome, $assunto, $corpo) {

        $mail = new PHPMailer(true);                                        // Passing `true` enables exceptions Passando `true`, são ativadas as exceções

        define('GUSER', 'adsteste03@gmail.com');	                        // Insira aqui o seu GMail
        define('GPWD', 'senha*123');		                                // Insira aqui a senha do seu GMail

        try {
            //Server settings
            $mail->SMTPDebug = 2;                                           // Ativa o modo de debug
            $mail->isSMTP();                                                // Diz para o mailer usar SMTP
            $mail->Host = 'smtp.gmail.com';                                 // Specificação do SMTP principal e dos backups
            $mail->SMTPAuth = true;                                         // Ativa a autenticação SMTP
            $mail->Username = GUSER;                                        // Usuario do email
            $mail->Password = GPWD;                                         // Senha do email
            $mail->SMTPSecure = 'ssl';                                      // Ativa a encriptação TLS, `ssl tambem é aceita`
            $mail->Port = 587;                                              // Define a porta TCP a se conectar

            //Recipients
            $mail->setFrom($de, $de_nome);
            //$mail->addAddress($para, 'Nome do destinatario');             // Adiciona um destinatario
            $mail->AddAddress($para);                                       // O nome dele é opcional
            
            /*
                $mail->addReplyTo('info@example.com', 'Information');
                $mail->addCC('cc@example.com');
                $mail->addBCC('bcc@example.com');

                //Attachments
                $mail->addAttachment('/var/tmp/file.tar.gz');               // Adicionar anexo
                $mail->addAttachment('/tmp/image.jpg', 'new.jpg');          // Adicionar anexo com nome personalizado
            */

            //Content

            /*
                $mail->isHTML(true);                                        // Faz o formato do email ser HTML
                $mail->Subject = $assunto;                                  // Assunto do email

                $mail->Body = $corpo;                                       //Corpo do email em html ex: <b>Negrito</b>

                
                $mail->AltBody = $corpo;                                    //Corpo do email alternativo, para clientes de email que não suportam leituras HTMl
            */

            $mail->Body = $corpo;

            if(!$mail->send()) {
                $mensagem = 'Message could not be sent.\nErro do mailer: '.$mail->ErrorInfo; 
                return false;
            } else {
                $mensagem = 'Mensagem enviada!';
                return true;
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    if (smtpmailer('adsteste03@gmail.com', 'adsteste03@gmail.com', 'Contato Site ADS', 'Contato via site '+date('l jS \of F Y h:i:s A'), $Vai)) {
        
        Header("location:http://www.dominio.com.br/obrigado.html"); // Redireciona para uma página de obrigado.

    }
    if (!empty($mensagem)){
        echo $mensagem;
    }
?>