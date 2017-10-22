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
            if (isset($dados['id']) && isset($dados['siapeMatricula']) && isset($dados['nome']) && isset($dados['email']) && isset($dados['senha']) && isset($dados['status']) && isset($dados['tipoUsuario_id'])) {
            
                include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
                $uControle = new ControleUsuario();
            
                $estado = $uControle->atualizar($dados);
                
                if ($estado == 1){
                    $status = array('sucesso' => true, 'mensagem' => 'Usuário atualizado.');
                } else {
                    $status = array('sucesso' => false, 'mensagem' => 'Falha na atualização do Usuário.');
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