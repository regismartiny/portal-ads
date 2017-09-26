<?php
    // required headers
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: POST");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	
	session_start();		//Inicia seção
			
		if (!empty($_POST) && isset($_POST['senhaAntiga']) && isset($_POST['senhaNova'])&& isset($_POST['confSenha'])) {

			include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

			$cUsuario = new ControleUsuario();	

			$cadastrado = $cUsuario->trocaSenha($_SESSION['matricula'],$_POST);
				if ($cadastrado==0){
					//Erro no processo
			
				}else if($cadastrado==2){
					//Usuário e senha Certos e foi trocado a senha
			
					$status = array('sucesso' => true, 'mensagem' => 'Troca de Senha Efetuada!');
			
				}else if($cadastrado==1){
					//Usuário Certo, Senha Errada
					$status = array('sucesso' => false, 'mensagem' => 'Senha antiga incorreta!');
			   		
				}else if($cadastrado==3){
					//Usuario não existe
					$status = array('sucesso' => false, 'mensagem' => 'Usuário não existe!');
			
	
				}else if($cadastrado==4){
					//Senha nova e antiga iguais
					$status = array('sucesso' => false, 'mensagem' => 'Senha Nova deve ser diferente da antiga!');
			
	
				}else if($cadastrado==5){
					//Senha nova e confirmação diferentes ***************  regis vai passar para o front
					$status = array('sucesso' => false, 'mensagem' => 'Confirmação de senha inválida!');
	
				}
			$resultado = json_encode($status, JSON_FORCE_OBJECT);
			echo json_encode($resultado);
		}else{
		echo "123";
		//echo '	<head>';
		//echo '	<meta http-equiv="refresh" content=1;url="/visao/paginas-publicas/restrito.php">';
		//echo '	</head>';
	}
	
