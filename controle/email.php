<?php
    $Nome		= $_POST["nome"];	// Pega o valor do campo Nome
    $Categoria		= $_POST["categoria"];	// Pega o valor do campo Telefone
    $Email		= $_POST["email"];	// Pega o valor do campo Email
    $Mensagem	= $_POST["mensagem"];	// Pega os valores do campo Mensagem
    
    // Variável que junta os valores acima e monta o corpo do email

    $Vai 		= "Nome: $Nome\n\nE-mail: $Email\n\nCategoria: $Categoria\n\nMensagem: $Mensagem\n";

    require_once("phpmailer/class.phpmailer.php");

    define('GUSER', 'adsteste03@gmail.com');	// <-- Insira aqui o seu GMail
    define('GPWD', 'senha*123');		// <-- Insira aqui a senha do seu GMail

    function smtpmailer($para, $de, $de_nome, $assunto, $corpo) { 
        global $mensagem;
        $mail = new PHPMailer();
        $mail->IsSMTP();		// Ativar SMTP
        $mail->SMTPDebug = 0;		// Debugar: 1 = erros e mensagens, 2 = mensagens apenas
        $mail->SMTPAuth = true;		// Autenticação ativada
        $mail->SMTPSecure = 'ssl';	// SSL REQUERIDO pelo GMail
        $mail->Host = 'smtp.gmail.com';	// SMTP utilizado
        $mail->Port = 587;  		// A porta 587 deverá estar aberta em seu servidor
        $mail->Username = GUSER;
        $mail->Password = GPWD;
        $mail->SetFrom($de, $de_nome);
        $mail->Subject = $assunto;
        $mail->Body = $corpo;
        $mail->AddAddress($para);
        if(!$mail->Send()) {
            $mensagem = 'Mail error: '.$mail->ErrorInfo; 
            return false;
        } else {
            $mensagem = 'Mensagem enviada!';
            return true;
        }
    }

    // Insira abaixo o email que irá receber a mensagem, o email que irá enviar (o mesmo da variável GUSER), o nome do email que envia a mensagem, o Assunto da mensagem e por último a variável com o corpo do email.

    if (smtpmailer('adsteste03@gmail.com', 'adsteste03@gmail.com', 'Contato Site ADS', 'Contato via site '+date('l jS \of F Y h:i:s A'), $Vai)) {

        Header("location:http://www.dominio.com.br/obrigado.html"); // Redireciona para uma página de obrigado.

    }
    if (!empty($mensagem)) 
        echo $mensagem;
?>