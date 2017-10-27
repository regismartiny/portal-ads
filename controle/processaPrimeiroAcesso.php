<?php
    // required headers
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	header("Access-Control-Allow-Methods: POST");
	header("Access-Control-Max-Age: 3600");
   	header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	// VALIDAR SE USUARIO ESTÁ AUTENTICADO
	//
	//

	session_start();

	//só pode acessar a página se for o primeiro acesso do usuário
	if (!isset($_SESSION['primeiroAcesso']) || $_SESSION['primeiroAcesso'] == false) {
		return;
	}

	$idUsuario = $_SESSION['usuario_id'];

	$status = array();	

	if (!empty($_POST) && isset($_POST['siapeMatricula']) && isset($_POST['senhaAtual']) && isset($_POST['senhaNova']) && isset($_POST['confSenha']) && isset($_POST['email']) && isset($_POST['confEmail'])) {

		include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
		include $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

		$cUsuario = new ControleUsuario();

		$dados = clearArray($_POST);

		$respostaEmail = $cUsuario->alterarEmail($idUsuario, $dados);
		
		if($respostaEmail == 2) { //ok

			$respostaSenha = $cUsuario->alterarSenha($idUsuario, $dados);
		
			if ($respostaSenha == 0) {
				//Erro no processo
				$status = array('sucesso' => false, 'mensagem' => 'Ocorreu um erro.');
			}
			else if($respostaSenha == 2) {
				//Usuário e senha Certos e foi trocado a senha
				$cUsuario->atualizarDataUltimoAcesso($_POST['siapeMatricula']);
				$status = array('sucesso' => true, 'mensagem' => 'Dados alterados com sucesso.');
			}
			else if($respostaSenha == 1) {
				//Usuário Certo, Senha Errada
				$status = array('sucesso' => false, 'mensagem' => 'A senha atual está incorreta.');	
			}	
			else if($respostaSenha == 3) {
				//Usuario não existe
				$status = array('sucesso' => false, 'mensagem' => 'O usuário não existe.');
			}
			else if($respostaSenha == 4) {
				//Senha nova e antiga iguais
				$status = array('sucesso' => false, 'mensagem' => 'A senha nova deve ser diferente da atual.');
			}
			else if($respostaSenha == 5) {
				//Senha nova e confirmação diferentes ***************  regis vai passar para o front
				$status = array('sucesso' => false, 'mensagem' => 'Senhas não conferem.');
			}
		}else if ($respostaEmail == 4) {
			$status = array('sucesso' => false, 'mensagem' => 'Email já cadastrado. Cadastre outro e-mail.');
		}else if ($respostaEmail == 5) {
			$status = array('sucesso' => false, 'mensagem' => 'Emails não conferem.');
		}
	}else {
		$status = array('sucesso' => false, 'mensagem' => 'Solicitação inválida.');
	}

	$resultado = json_encode($status, JSON_FORCE_OBJECT);
	echo json_encode($resultado);

	
