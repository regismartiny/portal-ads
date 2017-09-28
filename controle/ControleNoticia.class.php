<?php
include $_SERVER['DOCUMENT_ROOT']."/modelo/Noticia.class.php";

class ControleNoticia
{
    
    public function listarUm($dados)
    {
        $noticia = new Noticia(null, $dados['matricula'], null, null, null, null, null);
        $noticia->listarUm();
		return $noticia;
    }
	
    public function inserir($dados)
    {
        $noticia = new Noticia(null, $dados['matricula'], $dados['nome'], $dados['email'], '123456', 1, $dados['tipoNoticia_id']);
        $noticia->inserir();
    }
	
    public function consultar()
    {   
        $noticia = new Noticia();
        return $noticia->listarTodos();
    }
	
    public function desabilitarNoticia($id){
        $noticia = new Noticia($id, null, null, null, null, 0, null);
        $noticia->desabilitarNoticia();
    }

	public function filtrarNoticia($id){
		$noticia = new Noticia($id, null, null, null, null, null, null);
		$noticia->filtrarNoticia();
	}	
}
