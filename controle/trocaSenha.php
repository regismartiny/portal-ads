<?php
    // required headers
   // header("Access-Control-Allow-Origin: *");
    //header("Content-Type: application/json; charset=UTF-8");
    //header("Access-Control-Allow-Methods: POST");
    //header("Access-Control-Max-Age: 3600");
    //header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

	if(isset($_SESSION)){ 	//verifica se há sessão aberta
		session_start();		//Inicia seção
		
		if (!empty($_POST) && isset($_POST['senhaAntiga']) && isset($_POST['senhaNova'])&& isset($_POST['confSenha'])) {

			include $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

			$cUsuario = new ControleUsuario();	

			$cadastrado = $cUsuario->trocaSenha($_SESSION[matricula],$_POST);
				if ($cadastrado==0){
					//Erro no processo
			
				}else if($cadastrado==1){
					//Usuário Certo, Senha Errada
					$tipoUsuario = array('tipoUsuario' => 98);
			   		
				}else if($cadastrado==2){
					//Usuário e senha Certos e foi trocado a senha
			
					$tipoUsuario = array('tipoUsuario' => 96);
			
				}else if($cadastrado==3){
					//Usuario não existe
					$tipoUsuario = array('tipoUsuario' => 99);
			
	
				}else if($cadastrado==4){
					//Senha nova e antiga iguais
					$tipoUsuario = array('tipoUsuario' => 97);
			
	
				}
			$resultado = json_encode($tipoUsuario, JSON_FORCE_OBJECT);
			echo json_encode($resultado);
		}

	}else{
		//echo '	<head>';
		//echo '	<meta http-equiv="refresh" content=1;url="/visao/paginas-publicas/restrito.php">';
		//echo '	</head>';
	}
	
	

	
?>
<!DOCTYPE html>


<html lang='pt-br'>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<meta charset='utf-8'>
		<title>Trocar Senha de Usuario</title>
	</head>
	<style>
		#container {
			margin-top: 100px;
		}
	</style>
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<div class="col-5 ">
					<form method='post' action='trocaSenha.php'>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Trocar Senha de Usuario:</h1>
						</div>
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha Antiga:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senhaAntiga " name="senhaAntiga" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha Nova:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senhaNova" name="senhaNova" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label"> Confirmação de Senha:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="confSenha" name="confSenha" required>
							</div>
						</div>
					</div>
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Trocar Senha'>
					</form>
					<a class='btn btn-danger btn-lg btn-block' href='/visao/index.php'>Cancelar</a>
				</div>
			</div>
		</div>
	</body>
</html>
