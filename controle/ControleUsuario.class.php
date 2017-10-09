<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

class ControleUsuario
{
    public function validarDadosLogin($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, null, null, null);
        $resposta = $usuario->listarUm();
        if ($resposta != false) { //se existe um usuario com a matricula informada
            $senhaCorreta = $this->verificarSenha($dados['senha'], $usuario->getSenha());
            if ($senhaCorreta) {
                $status = $usuario->getStatus();
                if ($status == 1) { //usuario ativo
                    return 2; //tudo ok
                }
                return 4; //usuario bloqueado
            }
            return 1; //senha incorreta
        }
        return 3; //usuario inexistente
    }
    
    public function verificarSenha($senhaInformada, $senhaArmazenada) {
        //após implementar criptografia da senha, ajustar essa verificação, 
        //para encriptar senha informada antes de comparar
        return strcasecmp($senhaInformada, $senhaArmazenada) == 0;
    }

    public function trocaSenha($siapeMatricula, $dados) {
        $comparaSenha = strcasecmp($dados['senhaNova'], $dados['confSenha']); //se são iguais retorna zero
		if($comparaSenha==0){
			$usuario = new Usuario(null, $siapeMatricula, null, null, $dados['senhaAntiga'], null, null);
			$cadastrado = $usuario->trocaSenha($dados['senhaNova']);
			return $cadastrado;
		}else{
			return 5;
		}
    }
    
    public function listarUm($dados) {
        $usuario = new Usuario(null, $dados['matricula'], null, null, null, null, null);
        $usuario->listarUm();
		return $usuario;
    }
	
    public function inserir($dados) {
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
	
    public function consultar() {   
        $usuario = new Usuario();
        return $usuario->listarTodos();
    }
	
    public function modificarStatusUsuario($id) {
        $usuario = new Usuario($id);
        $usuario->modificarStatusUsuario();
    }

	public function filtrarUsuario($id) {
		$usuario = new Usuario($id);
		$usuario->filtrarUsuario();
	}	
	
	public function editar($dados) {		
        $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], $dados['senha'], null, $dados['tipoUsuario_id']);
        $usuario->editar();
    }

    public function usuarioPodeSerDesativado($id) {
        // implementar regra de verificação se usuário pode ser desativado
        // quando o usuário não for do tipo admin ou quando houver outro usuário do tipo admin ativo
        return $id != 1; // temporário
    }
}






















