<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/InformacaoCurso.class.php";

class ControleInformacaoCurso
{   
    public function listarUm($titulo)
    {
        $informacao = new InformacaoCurso(null, $titulo);
        $informacao->listarUm();
		return $informacao;
    }
	
    public function inserir($dados)
    {
        $informacao = new InformacaoCurso(null, $dados['titulo'], $dados['conteudo']);
        $informacao->inserir();
    }
}
