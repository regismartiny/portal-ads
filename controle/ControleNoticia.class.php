<?php

session_start();
include $_SERVER['DOCUMENT_ROOT']."/modelo/Noticia.class.php";

class ControleNoticia
{
    
    public function listarUm($id)
    {
        $noticia = new Noticia($id, null, null, null, null, null, null, null, null, null);
        $noticia->listarUm();
		return $noticia;
    }
	
    public function inserir($dados)
    {
	
        $noticia = new Noticia(null, $dados['titulo'], $dados['conteudo'], $dados['fonte'], $dados['imagem'],1,null, null, $_SESSION['usuario_id'], $dados['categoriaNoticia_id']);
		$noticia->inserir();
    }
	
    public function consultar()
    {   
        $noticia = new Noticia();
        return $noticia->listarTodos();
    }
	
    public function desabilitarNoticia($id){
        $noticia = new Noticia($id, null, null, null, null, 0, null, null, null, null);
        $noticia->desabilitarNoticia();
    }

}
