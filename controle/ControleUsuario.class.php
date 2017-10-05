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
        $tipoUsuario = $this->getTipoUsuario($dados['matricula']);

        if($tipoUsuario != 0){
            $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], $dados['matricula'], 1, $tipoUsuario);
            return $usuario->inserir();
        }
        return 4;//Matricula / SIAPE não valido
    }

    public function getTipoUsuario($matricula) {
        $tipoUsuario = 0;
        
        if(strlen($matricula) == 7){
            $tipoUsuario = 2;
        }else if(strlen($matricula) == 12){
            $tipoUsuario = 3;
        }

        return $tipoUsuario;
    }
	
    public function consultar()
    {   
        $usuario = new Usuario();
        return $usuario->listarTodos();
    }
	
    public function modificarStatusUsuario($id){
        $usuario = new Usuario($id, null, null, null, null, null, null);
        $usuario->modificarStatusUsuario();
    }

	public function filtrarUsuario($id){
		$usuario = new Usuario($id, null, null, null, null, null, null);
		$usuario->filtrarUsuario();
	}	
	
	public function editar($dados)
    {		
        $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], $dados['senha'], null, $dados['tipoUsuario_id']);
        $usuario->editar();
    }	
}






















