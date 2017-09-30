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
		if ($cadastrado==0){
			//Erro no processo
			
		}else if($cadastrado==1){
			//Usuário Certo, Senha Errada
			$tipoUsuario = array('tipoUsuario' => 98);
			   		
		}else if($cadastrado==2){
			//Usuário e senha Certos
			
				session_start();
				$usuario = new Usuario();
				$usuario = $cUsuario->listarUm($_POST);
				$_SESSION['usuario_id'] = $usuario->getId();
				$_SESSION['nomeUsuario'] = $usuario->getNome();
				$_SESSION['matricula'] = $usuario->getSiapeMatricula();
				$_SESSION['email'] = $usuario->getEmail();
				$_SESSION['tipoUsuario'] = $usuario->getTipoUsuario_id();
				setcookie('702741445', $usuario->getSiapeMatricula(), (time() + (1 * 3600)));//define o cookie pra sessão em n horas
				$tipoUsuario = array('tipoUsuario' => $_SESSION['tipoUsuario']);
				
			
		}else if($cadastrado==3){
			//Usuario não existe
			$tipoUsuario = array('tipoUsuario' => 99);
			
	
		}
		$resultado = json_encode($tipoUsuario, JSON_FORCE_OBJECT);
		echo json_encode($resultado);
}
