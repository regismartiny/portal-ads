<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST)&& isset($_POST['categoriaNoticia_id']) && isset($_POST['titulo'])&& isset($_POST['conteudo'])&& isset($_POST['imagem'])&& isset($_POST['fonte']) ) {
            
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
            $nControle = new ControleNoticia();
        
            $estado = $nControle->atualizar($_POST);
			

            if ($estado==1){
                $status = array('sucesso' => true, 'mensagem' => 'Concluido! Noticia atualizada!');
            }

            $resultado = json_encode($status, JSON_FORCE_OBJECT);
            echo json_encode($resultado);
        }else{
            http_response_code(400);
            echo "Oops! Houve um problema com o envio do formulario. Por favor complete o formulario e tente novamente.";
            exit;
        }
    } else {
        //echo "Não é um POST, seta como erro 403 (forbidden) o codigo de resposta";
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>