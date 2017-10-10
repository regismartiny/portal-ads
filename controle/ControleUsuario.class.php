<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

class ControleUsuario
{
    public function validarDadosLogin($dados) {
        return $this->validarLogin($dados['matricula'], $dados['senha']);
    }
    
    public function verificarSenha($senhaInformada, $senhaArmazenada) {
        //após implementar criptografia da senha, ajustar essa verificação, 
        //para encriptar senha informada antes de comparar
        return strcasecmp($senhaInformada, $senhaArmazenada) == 0;
    }

    public function alterarSenha($siapeMatricula, $dados) {
        $confirmacaoDeSenhaCorreta = strcasecmp($dados['senhaNova'], $dados['confSenha']) == 0;
        $senhaAtualENovaDiferentes = strcasecmp($dados['senhaAtual'], $dados['senhaNova']) != 0; 
		if($confirmacaoDeSenhaCorreta) {
            if ($senhaAtualENovaDiferentes) {
                $validacaoLogin = $this->validarLogin($siapeMatricula, $dados['senhaAtual']);
                if ($validacaoLogin == 2) { //login válido
                    $usuario = new Usuario(null, $siapeMatricula, null, null, $dados['senhaNova']);
                    $resposta = $usuario->atualizarSenha();
                    if ($resposta) {
                        return 2; //senha alterada com sucesso
                    }
                } else {
                    return $validacaoLogin;
                }
            } else {
                return 4; 
            }
		}else {
			return 5;
		}
    }

    public function validarLogin($matricula, $senha) {
        $usuario = new Usuario(null, $matricula);
        $resposta = $usuario->listarUm();
        if ($resposta != false) { //se existe um usuário com a matrícula informada
            $senhaCorreta = $this->verificarSenha($senha, $usuario->getSenha());
            if ($senhaCorreta) {
                $status = $usuario->getStatus();
                if ($status == 1) { //usuario ativo
                    return 2; //tudo ok
                }
                return 4; //usuário bloqueado
            }
            return 1; //senha incorreta
        }
        return 3; //usuário inexistente
    }
    
    public function listarUm($dados) {
        $usuario = new Usuario(null, $dados['matricula']);
        $usuario->listarUm();
		return $usuario;
    }
	
    public function inserir($dados) {
        $tipoUsuario = $this->getTipoUsuario($dados['matricula']);

        if($tipoUsuario != 0){
            $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], $dados['matricula'], 1, $tipoUsuario);
            return $usuario->inserir();
        }
        return 4;//Matricula / SIAPE inválido
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






















