<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST) && isset($_POST['nome']) && isset($_POST['matricula'])&& isset($_POST['tipoUsuario_id'])) {
            
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
            $uControle = new ControleUsuario();
        
            $estado = $uControle->inserir($_POST);

            if ($estado!=0){
                    
                if($estado==2){
                    //Usuario inserido com sucesso
                    // Set a 200 (okay) response code.
                    $status = array('sucesso' => true, 'mensagem' => 'Concluido! Usuario adicionado!');
                }
                else if($estado==1){
                    //Email ja existe
                    $status = array('sucesso' => true, 'mensagem' => 'Já existe algum usuario com esse email!');	
                }
                else if($estado==3){
                    //Matricula ja existe 
                    $status = array('sucesso' => true, 'mensagem' => 'Já existe algum usuario com essa matricula!');
                }
                
                $resultado = json_encode($status, JSON_FORCE_OBJECT);
                echo json_encode($resultado);
            }
        }else{
            http_response_code(400);
            echo "Oops! Houve um problema com o envio do formulario. Por favor complete o formulario e tente novamente.";
            exit;
        }
    } else {
        // Não é um POST, seta como erro 403 (forbidden) o codigo de resposta
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>