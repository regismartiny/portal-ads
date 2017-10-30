<?php
    include $_SERVER['DOCUMENT_ROOT']."/modelo/Usuario.class.php";

    class ControleUsuario
    {    
        public function validarLogin($siapeMatricula, $senha) {
            $usuario = new Usuario(null, $siapeMatricula);
            $ok = $usuario->listarUmPorSiapeMatricula();
            if ($ok) { //se existe um usuário com a matrícula informada
                $senhaCorreta = $this->verificarSenha($senha, $usuario->getSenha());
                if ($senhaCorreta) {
                    $status = $usuario->getStatus();
                    if ($status == 1) { //usuario ativo
                        $dtUltimoAcesso = $usuario->getDataUltimoAcesso();
                        if($dtUltimoAcesso != null) {
                            $usuario->atualizarDataUltimoAcesso($siapeMatricula);
                            return 2; //tudo ok
                        }else {
                            return 5; //login ok, porém primeiro acesso
                        }
                                            
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

        public function alterarSenha($idUsuario, $dados) {

            $confirmacaoDeSenhaCorreta = strcasecmp($dados['senhaNova'], $dados['confSenha']) == 0;
            $senhaAtualENovaDiferentes = strcasecmp($dados['senhaAtual'], $dados['senhaNova']) != 0; 
            
            if($confirmacaoDeSenhaCorreta) {
                if ($senhaAtualENovaDiferentes) {
                    $validacaoLogin = $this->validarLogin($dados['siapeMatricula'], $dados['senhaAtual']);
                    if ($validacaoLogin == 2 || $validacaoLogin == 5) { //login válido
                        $senhaEncriptada = $this->encriptarSenha($dados['senhaNova']);
                        $usuario = new Usuario($idUsuario, null, null, null, $senhaEncriptada);
                        $sucesso = $usuario->atualizar();
                        if ($sucesso) {
                            return 2; //senha alterada com sucesso
                        } else {
                            return 0; //erro na alteração da senha
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

        public function alterarEmail($idUsuario, $dados) {
            $email = $dados['email'];
            $confirmacaoDeEmailCorreta = strcasecmp($email, $dados['confEmail']) == 0;
            if($confirmacaoDeEmailCorreta) {
                $validacaoEmail = $this->validarEmail($email);
                    if (!$validacaoEmail) { //ok - email ainda não cadastrado
                        $usuario = new Usuario($idUsuario, null, null, $email);
                        $sucesso = $usuario->atualizar();
                        if ($sucesso) {
                            return 2; //email alterado com sucesso
                        } else {
                            return 3; //ocorreu um erro na atualização do email
                        }
                    } else {
                        return 4; //email já existe
                    }
            }else {
                return 5;
            }
        }

        public function atualizarDataUltimoAcesso($siapeMatricula) {
            $usuario = new Usuario(null, $siapeMatricula);
            return $usuario->atualizarDataUltimoAcesso($siapeMatricula);
        }

        public function validarEmail($email) {
            $usuario = new Usuario(null, null, null, $email);
            return $usuario->listarUmPorEmail();
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
            $tipoUsuario = $this->getTipoUsuario($dados['matricula']);

            if($tipoUsuario != 0){
                $senhaEncriptada = $this->encriptarSenha($dados['matricula']);
                $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], $senhaEncriptada, 1, $tipoUsuario);
                return $usuario->inserir();
            }
            return 4; //Matricula / SIAPE inválido
        }

        public function inserirLote($arquivos) {
            $arquivo = $arquivos[0];
            
        }

        public function getTipoUsuario($siapeMatricula) {
            if(strlen($siapeMatricula) == 7){
                return 2;
            }
            if(strlen($siapeMatricula) == 12){
                return 3;
            }
            return 0;
        }
        
        public function consultar() {   
            $usuario = new Usuario();
            return $usuario->listarTodos();
        }
        
        public function modificarStatusUsuario($id) {
            $usuario = new Usuario($id);
            $usuario->listarUm();
            return $usuario->modificarStatus();
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
            // Regra: pode desativar quando o usuário não for do tipo admin ou 
            // quando houver outro usuário do tipo admin ativo
            return $id != 1; // temporário
        }
    }
?>