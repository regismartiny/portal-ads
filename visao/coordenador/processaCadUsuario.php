<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!empty($_POST) && isset($_POST['nome']) && isset($_POST['matricula'])) {
            
            include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
            $uControle = new ControleUsuario();

            $_POST['tipoUsuario_id']=0;

            if(strlen($_POST['matricula'])==7){
                $_POST['tipoUsuario_id']=2;
            }else if(strlen($_POST['matricula'])==12){
                $_POST['tipoUsuario_id']=3;
            }
        
            $estado = $uControle->inserir($_POST);

            if ($estado!=0){
                    
                if($estado==1){
                    //Usuario inserido com sucesso
                    if($_POST['tipoUsuario_id']==2){
                        $status = array('sucesso' => true, 'mensagem' => 'Concluido! Professor adicionado!');
                    }else{
                        $status = array('sucesso' => true, 'mensagem' => 'Concluido! Aluno adicionado!');
                    }
                }
                else if($estado==2){
                    //Email ja existe
                    $status = array('sucesso' => true, 'mensagem' => 'Já existe algum usuario com esse email!');	
                }
                else if($estado==3){
                    //Matricula ja existe 
                    if($_POST['tipoUsuario_id']==2){
                        $status = array('sucesso' => true, 'mensagem' => 'Já existe outro professor com esse SIAPE!');
                    }else{
                        $status = array('sucesso' => true, 'mensagem' => 'Já existe outro aluno com essa matricula!');
                    }
                }
                else if($estado==4){
                    //Matricula / SIAPE não valido
                    $status = array('sucesso' => true, 'mensagem' => 'Verifique a Matricula / SIAPE!!');
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