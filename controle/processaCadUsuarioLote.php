<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file'])) {
            
        include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
        include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

        $uControle = new ControleUsuario();
    
        $estado = $uControle->inserirLote($_FILES);
  
        if($estado == 1){
            //Usuarios inseridos com sucesso
            $status = array('sucesso' => true, 'mensagem' => 'Concluído! Usuários adicionados.');
        }
        else if($estado == 2){
            //Email ja existe
            $status = array('sucesso' => false, 'mensagem' => 'Já existe um usuário com esse email!');	
        }
        else if($estado == 3){
            //Matricula ja existe 
            $status = array('sucesso' => false, 'mensagem' => 'Já existe outro usuário com essa Matrícula/SIAPE!');
        }
        else if($estado == 4){
            //Matricula / SIAPE não valido
            $status = array('sucesso' => false, 'mensagem' => 'Verifique a Matrícula/SIAPE!');
        }
    }else {
        $status = array('sucesso' => false, 'mensagem' => 'Oops! Houve um problema com o envio do formulário. Por favor tente enviar novamente.');
    }
    $resultado = json_encode($status, JSON_FORCE_OBJECT);
    echo json_encode($resultado);
?>