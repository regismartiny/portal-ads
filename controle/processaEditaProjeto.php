<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST)) {
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
            $dados = clearArray($_POST);
            if (isset($dados['id']) && isset($dados['categoriaNoticia_id']) && isset($dados['titulo']) && isset($dados['conteudo']) && isset($dados['imagem']) && isset($dados['fonte']) ) {
            
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
                $nControle = new ControleNoticia();
            
                $estado = $nControle->atualizar($dados);
                
                if ($estado == 1){
                    $status = array('sucesso' => true, 'mensagem' => 'Notícia atualizada.');
                } else {
                    $status = array('sucesso' => false, 'mensagem' => 'Falha na atualização da notícia.');
                }

                $resultado = json_encode($status, JSON_FORCE_OBJECT);
                echo json_encode($resultado);
            }else {
                //codigo 406 - not acceptable
                http_response_code(406);
                echo "Dados incompletos";            }
        }else{
            //codigo 400 - bad request
            http_response_code(400);
            echo "Oops! Houve um problema com o envio do formulário. Por favor complete o formulário e tente novamente.";
        }
    } else {
        //codigo 405 - método não permitido
        http_response_code(405);
        echo "Método de envio inválido.";
    }

?>