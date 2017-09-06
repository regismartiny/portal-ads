<?php
include $_SERVER['DOCUMENT_ROOT']."/portal-ads-master/modelo/Usuario.class.php";

class ControleUsuario{
	
	
	
	public function verificaLogin($dados) {
		$usuario = new Usuario(null,$dados['matricula'],null,null,$dados['senha'],null,null);
		$cadastrado = $usuario->isCadastrado();
		return $cadastrado;
	}
	
	
	
	
}

?>