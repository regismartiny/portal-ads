<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
	
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST)&& isset($_POST['titulo'])&& isset($_POST['conteudo'])&& isset($_POST['imagem']) ) {
            
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

            $dados = clearArray($_POST);

            $nControle = new ControleProjeto();     
            
            session_start();
        
            $estado = $nControle->inserir($_SESSION['usuario_id'], $dados);

            if ($estado == 1){
                $status = array('sucesso' => true, 'mensagem' => 'Projeto adicionado com sucesso.');
            }

            $resultado = json_encode($status, JSON_FORCE_OBJECT);
            echo json_encode($resultado);
        }else{
            http_response_code(400);
            echo "Oops! Houve um problema com o envio do formulário. Por favor complete o formulário e tente novamente.";
            exit;
        }
    } else {
        //codigo 405 - método não permitido
        http_response_code(405);
        echo "Método de envio inválido.";
    }

?>