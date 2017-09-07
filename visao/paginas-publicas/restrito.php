<?php
if(isset($_POST["login"]) && $_POST["login"]=="Login"){
	include $_SERVER["DOCUMENT_ROOT"]."/portal-ads/controle/ControleUsuario.class.php";
	$cUsuario = new ControleUsuario();
	
	$logado = $cUsuario->verificaLogin($_POST);
	if ($logado){
			session_start();
			$usuario = $cUsuario->listarUm($_POST['matricula']);
			$_SESSION['nomeUsuario'] = $usuario->getNome();
			$_SESSION['matricula'] = $usuario->getSiapeMatricula();
			$_SESSION['email'] = $usuario->getEmail();
			$_SESSION['tipoUsuario']= $usuario->getTipoUsuario_id();
				
		if($_SESSION['tipoUsuario']==1){
			header("Location: /portal-ads/visao/coordenador/homeCoordenador.html");	
		}elseif($_SESSION['tipoUsuario']==2) {
			header("Location: /portal-ads/visao/professor/homeProfessor.html");	
		}else {
			header("Location: /portal-ads/visao/aluno/homeAluno.html");	
		}
		
	}else{
		echo "Login ou senha inválidos";
	}
}
?>

<head>
	<meta charset="utf8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" href="../index.css">
</head>
<div class="row justify-content-center">
   	
    <div class="col-5">
		<h1>Acesso Restrito</h1><br><br>    
		<form method="post" action="restrito.php">
            <div class="form-group row">
                <label for="matricula" class="col-sm-4 col-md-4 col-form-label">Matrícula / SIAPE:</label>
                <div class="col-sm-10 col-md-8">
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="senha" class="col-sm-4 col-md-4 col-form-label">Senha:</label>
                <div class="col-sm-10 col-md-8">
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="login" value="Login"/>
            <a href="esquecisenha.html" class="btn btn-primary btn-lg btn-block">Esqueci Minha Senha</a> 
            <a href="index.html" class="btn btn-primary btn-lg btn-block">Voltar</a> 
            
        </form>
    </div>
</div>
