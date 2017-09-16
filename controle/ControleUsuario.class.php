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
    
    public function verificaLogin($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], null, null, $dados['senha'], null, null);
        $tudoCerto = $usuario->verificaSenha();
        return $tudoCerto;
    }
    
    public function listarUm($siapeMatricula)
    {
        $usuario = new Usuario(null, $siapeMatricula, null, null, null, null, null);
        $usuario->listarUm();
        return $usuario;
    }

    public function inserir($dados)
    {
        $usuario = new Usuario(null, $dados['matricula'], $dados['nome'], $dados['email'], '123456', 1, $dados['tipoUsuario_id']);
        $usuario->inserir();
    }
}
