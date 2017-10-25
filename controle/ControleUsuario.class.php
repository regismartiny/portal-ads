<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

class ControleUsuario
{    
    public function validarLogin($matricula, $senha) {
        $usuario = new Usuario(null, $matricula);
        $ok = $usuario->listarUmPorSiapeMatricula();
        if ($ok) { //se existe um usuário com a matrícula informada
            $senhaCorreta = $this->verificarSenha($senha, $usuario->getSenha());
            if ($senhaCorreta) {
                $status = $usuario->getStatus();
				$dua = $usuario->getDataUltimoAcesso();
                if ($status == 1) { //usuario ativo
                    //if($dua!=null){
						return 2; //tudo ok
						//$usuario->atualizaDataAcesso($matricula);
					//}else{
						//return 5; //tudo ok mas primeiro acesso. direciona para troca de senha;
					//}
										
                }
                return 4; //usuário bloqueado
            }
            return 1; //senha incorreta
        }
        return 3; //usuário inexistente
    }

    public function verificarSenha($senhaInformada, $senhaArmazenada) {
        $senhaInformadaEncriptada = $this->encriptarSenha($senhaInformada);
        return strcasecmp($senhaInformadaEncriptada, $senhaArmazenada) == 0;
    }

    public function alterarSenha($siapeMatricula, $dados) {
        $confirmacaoDeSenhaCorreta = strcasecmp($dados['senhaNova'], $dados['confSenha']) == 0;
        $senhaAtualENovaDiferentes = strcasecmp($dados['senhaAtual'], $dados['senhaNova']) != 0; 
		if($confirmacaoDeSenhaCorreta) {
            if ($senhaAtualENovaDiferentes) {
                $validacaoLogin = $this->validarLogin($siapeMatricula, $dados['senhaAtual']);
                if ($validacaoLogin == 2) { //login válido
                    $senhaEncriptada = $this->encriptarSenha($dados['senhaNova']);
                    $usuario = new Usuario(null, $siapeMatricula, null, null, $senhaEncriptada);
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

    public function alterarEmail($dados) {
        $confirmacaoDeEmailCorreta = strcasecmp($dados['email'], $dados['confEmail']) == 0;
		if($confirmacaoDeEmailCorreta) {
            $validacaoEmail = $this->validarEmail($dados['email']);
                if ($validacaoEmail == 2) { //login válido
                    $usuario = new Usuario(null, null, null, $email);
                    $resposta = $usuario->atualizarEmail();
                    if ($resposta) {
                        return 2; //senha alterada com sucesso
                    }
                } else {
                    return $validacaoLogin;
                }
           
		}else {
			return 5;
		}
    }

	public function validarEmail($email) {
        $usuario = new Usuario(null, null, null, $email);
        $ok = $usuario->listarUmPorEmail();
        if (!$ok) { //se não existe um usuário com esse email informado
			return 2; //tudo ok
									
        }else {  
            return 4; //email já existe
        }
    }
	
    public function encriptarSenha($senha) {
        return md5($senha);
    }

    public function listarUm($idUsuario) {
        $usuario = new Usuario($idUsuario);
        $usuario->listarUm();
		return $usuario;
    }
	
    public function inserir($dados) {
        $tipoUsuario = $this->getTipoUsuario($dados['siapeMatricula']);

        if($tipoUsuario != 0){
            $senhaEncriptada = $this->encriptarSenha($dados['senha']);
            $usuario = new Usuario(null, $dados['siapeMatricula'], $dados['nome'], $dados['email'], $senhaEncriptada, 1, $tipoUsuario);
            return $usuario->inserir();
        }
        return 4; //Matricula / SIAPE inválido
    }

    public function getTipoUsuario($siapeMatricula) {
        $tipoUsuario = 0;

        if(strlen($siapeMatricula) == 7){
            $tipoUsuario = 2;
        }else if(strlen($siapeMatricula) == 12){
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
        $desativar = !isset($dados['status']);
        $status =  $desativar && $this->usuarioPodeSerDesativado($dados['id']) ? 0 : 1;
        $usuario = new Usuario($dados['id'], $dados['siapeMatricula'], $dados['nome'], $dados['email'], null, $status);
        return $usuario->atualizar();
    }

    public function usuarioPodeSerDesativado($id) {
        // implementar regra de verificação se usuário pode ser desativado
        // quando o usuário não for do tipo admin ou quando houver outro usuário do tipo admin ativo
        return $id != 1; // temporário
    }
}






















