<?php
include $_SERVER['DOCUMENT_ROOT']."/portal-ads/modelo/Usuario.class.php";

class ControleUsuario{
	public function verificaLogin($dados) {
		$usuario = new Usuario(null,$dados['matricula'],null,null,$dados['senha'],null,null);
		$cadastrado = $usuario->isCadastrado();
		return $cadastrado;
	}
	
	public function inserir($dados){
		
		$usuario = new Usuario(null,$dados['matricula'],$dados['nome'],$dados['email'],$dados['senha'],1,$dados['tipoUsuario_id']);
		$usuario->inserir();
		header("location:../visao/lstContato.php");
	}	
		
}

?>
