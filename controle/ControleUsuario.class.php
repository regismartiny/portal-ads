<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

class ControleUsuario
{
    public function verificaUser($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, $dados['senha'], null, null);
        $cadastrado = $usuario->isCadastrado();
        return $cadastrado;
    }
    public function trocaSenha($siapeMatricula, $dados)
    {
        $comparaSenha = strcasecmp($dados['senhaNova'], $dados['confSenha']); //se são iguais retorna zero
		if($comparaSenha==0){
			$usuario = new Usuario(null, $siapeMatricula, null, null, $dados['senhaAntiga'], null, null);
			$cadastrado = $usuario->trocaSenha($dados['senhaNova']);
			return $cadastrado;
		}else{
			return 5;
		}
    }
    

    public function listarUm($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, null, null, null);
        $usuario->listarUm();
		return $usuario;
    }
	
	

    public function inserir($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], '123456', 1, $dados['tipoUsuario_id']);
        $usuario->inserir();
    }
}
