<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || !isset($_COOKIE["702741445"]) && ($_SESSION["tipoUsuario"]==2 || $_SESSION["tipoUsuario"]==1 )){
		header( 'Location: /controle/logout.php' );
	}
	else{
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

		$dados = clearArray($_GET);
		$nControle = new ControleNoticia();

		$nControle->remover($dados['idNoticia'],$_SESSION['usuario_id'],$_SESSION["tipoUsuario"]);
		
		//if($_SESSION["tipoUsuario"]==1){
			//header( 'Location: /visao/index.php#/visao/coordenador/lstNoticia.php' );
		//}else{
			header( 'Location: /visao/index.php#/visao/professor/lstNoticia.php' );
		//}
	}
?>
