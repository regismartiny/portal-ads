<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/InformacaoCurso.class.php";

class ControleInformacaoCurso
{   
    public function listarUm($dados)
    {
        $informacao = new InformacaoCurso(null, $dados['chave']);
        $informacao->listarUm();
		return $informacao;
    }
	
    public function inserir($dados)
    {
        $informacao = new InformacaoCurso(null, $dados['chave'], $dados['titulo'], $dados['conteudo']);
        $informacao->inserir();
    }
}
