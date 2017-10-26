<?php
    // required headers
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: POST");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

					
	if (!empty($_POST) && isset($_POST['senhaAtual']) && isset($_POST['senhaNova']) && isset($_POST['confSenha'])&& isset($_POST['email'])&& isset($_POST['confEmail']) && isset($_POST['siapeMatricula']))	 {

		include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
		include $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

		$cUsuario = new ControleUsuario();

		$dados = clearArray($_POST);

		$resposta2 = $cUsuario->validarEmail($dados['email']);
		
		if($resposta2 == 2){
			
			//print_r( $dados['siapeMatricula']);
//			print_r($dados);
	//		die;
			$resposta = $cUsuario->alterarSenha($dados['siapeMatricula'], $dados);
			echo $resposta;
		
		
			if ($resposta == 0) {
				//Erro no processo
				$status = array('sucesso' => false, 'mensagem' => 'Ocorreu um erro.');
			}
			else if($resposta == 2) {
				//Usuário e senha Certos e foi trocado a senha
				$status = array('sucesso' => true, 'mensagem' => 'Senha alterada com sucesso.');
			}
			else if($resposta == 1) {
				//Usuário Certo, Senha Errada
				$status = array('sucesso' => false, 'mensagem' => 'A senha atual está incorreta.');	
			}	
			else if($resposta == 3) {
				//Usuario não existe
				$status = array('sucesso' => false, 'mensagem' => 'O usuário não existe.');
			}
			else if($resposta == 4) {
				//Senha nova e antiga iguais
				$status = array('sucesso' => false, 'mensagem' => 'A senha nova deve ser diferente da atual.');
			}
			else if($resposta == 5) {
				//Senha nova e confirmação diferentes ***************  regis vai passar para o front
				$status = array('sucesso' => false, 'mensagem' => 'Senhas não conferem.');
			}
		}else{
			$status = array('sucesso' => false, 'mensagem' => 'Email já cadastrado. Cadastre outro e-mail.');
		}
	}else {
		$status = array('sucesso' => false, 'mensagem' => 'Solicitação inválida.');
	}
	
	$resultado = json_encode($status, JSON_FORCE_OBJECT);
	echo json_encode($resultado);
	
