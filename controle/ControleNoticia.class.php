<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT']."/modelo/Noticia.class.php";

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
		return $noticia->inserir();
    }
	
    public function consultar()
    {   
        $noticia = new Noticia();
        return $noticia->listarTodos();
    }
	
	public function minhasNoticias($siapeMatricula)
    {   
        $noticia = new Noticia();
        return $noticia->listarMinhasNoticias($siapeMatricula);
    }
	
	public function modificarStatusNoticia($id,$status){
        $noticia = new Noticia($id, null, null, null, null, $status, null, null, null, null);
        $noticia->modificarStatusNoticia();
    }

	public function filtrarNoticia($id){
		$noticia = new Noticia($id, null, null, null, null, $status, null, null, null, null);
        $noticia->filtrarNoticia();
	}	
	
	public function atualizar($dados)
    {
	
        $noticia = new Noticia(null, $dados['titulo'], $dados['conteudo'], $dados['fonte'], $dados['imagem'],1,null, null,null, $dados['categoriaNoticia_id']);
		return $noticia->atualizar($dados['idNoticia']);
    }

}
