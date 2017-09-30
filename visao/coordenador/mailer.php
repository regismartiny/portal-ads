<?php
    //  http://blog.teamtreehouse.com/create-ajax-contact-form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
        $uControle = new ControleUsuario();
        
        $nome = $_POST["nome"];
        $matricula = $_POST["matricula"];
        $tipoUsuario_id = $_POST["tipoUsuario_id"];
        
        // Check that data was sent to the class.
        if ( empty($nome) OR empty($matricula) OR empty($tipoUsuario_id)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! Houve um problema com o envio do formulario. Por favor complete o formulario e tente novamente.";
            exit;
        }

        // Send the email.
        if ($uControle->inserir($_POST)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Concluido! Usuario adicionado";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Aconteceu algum problema e nós não podemos enviar o seu formulario.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>