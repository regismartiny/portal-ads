<?php

include $_SERVER['DOCUMENT_ROOT']."/modelo/InformacaoDoCurso.class.php";

class ControleInformacaoDoCurso
{   
    public function listarPorId($id)
    {
        $informacao = new InformacaoDoCurso($id);
        $informacao->listarPorId();
		return $informacao;
    }

    public function listarPorChave($chave)
    {
        $informacao = new InformacaoDoCurso(null, $chave);
        $informacao->listarPorChave();
		return $informacao;
    }

    public function listarTodos()
    {
        $informacoes = new InformacaoDoCurso();
        $informacoes->listarTodos();
		return $informacoes;
    }
	
    public function inserir($dados)
    {
        $informacao = new InformacaoDoCurso(null, $dados['chave'], $dados['titulo'], $dados['conteudo']);
        $informacao->inserir();
    }
}
