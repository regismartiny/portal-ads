<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if (!empty($_POST) && isset($_POST['matricula']) && isset($_POST['senha'])
        && !empty($_POST['matricula']) && !empty($_POST['senha'])) {

    include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

    $cUsuario = new ControleUsuario();

    $cadastrado = $cUsuario->verificaUser($_POST);
    if ($cadastrado) {
        
        $tudoCerto = $cUsuario->verificaLogin($_POST);
        $resultado = $tudoCerto;

		if ($tudoCerto) {
        
        
			if(!isset($_SESSION)){
				session_start();
				$usuario = $cUsuario->listarUm($_POST['matricula']);
				$_SESSION["nomeUsuario"] = $usuario->getNome();
				$_SESSION['matricula'] = $usuario->getSiapeMatricula();
				$_SESSION['email'] = $usuario->getEmail();
				$_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();

				$tipoUsuario = array('tipoUsuario' => $_SESSION['tipoUsuario']);
				$resultado = json_encode($tipoUsuario, JSON_FORCE_OBJECT);
			}
		}else{
        		//senha errada
			$tipoUsuario = array('tipoUsuario' => 98);
			$resultado = json_encode($tipoUsuario, JSON_FORCE_OBJECT);
    		}
    		echo json_encode($resultado);
    }else{
        // usuario não existe
	$user = new Usuario(null,null,null,null,null,null,99);  
	$resultado = json_encode($user, JSON_FORCE_OBJECT);
	echo json_encode($resultado); 
    }
    
}
