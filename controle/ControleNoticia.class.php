<?php
include_once $_SERVER['DOCUMENT_ROOT']."/modelo/Noticia.class.php";

class ControleNoticia {
    
    public function listarUm($id) {
        $noticia = new Noticia($id);
        $ok = $noticia->listarUm();
        if ($ok) {
            return $noticia;
        } else {
            return false;
        }
    }
	
    public function inserir($dados) {
        $noticia = new Noticia(null, $dados['titulo'], $dados['conteudo'], $dados['fonte'], $dados['imagem'],1,null, null, $_SESSION['usuario_id'], $dados['categoriaNoticia_id']);
		return $noticia->inserir();
    }
	
    public function consultar() {   
        $noticia = new Noticia();
        return $noticia->listarTodos();
    }
	
	public function minhasNoticias($siapeMatricula) {   
        $noticia = new Noticia();
        return $noticia->listarPorMatricula($siapeMatricula);
    }

    public function listarPaginado($pagina, $quantidade) {
        $pagina = !empty($pagina) ? $pagina : 1;
        $quantidade = !empty($quantidade) ? $quantidade : 10;
        $noticia = new Noticia();
        $noticias = $noticia->listarPaginado($pagina, $quantidade);
        if ($noticias == false || empty($noticias)) {
            return false;
        } else {
            return $noticias;
        }
    }
	
	public function modificarStatusNoticia($id, $status) {
        $noticia = new Noticia($id, null, null, null, null, $status);
        $noticia->modificarStatusNoticia();
    }
	
	public function atualizar($dados) {
        $noticia = new Noticia(null, $dados['titulo'], $dados['conteudo'], $dados['fonte'], $dados['imagem'],1,null, null,null, $dados['categoriaNoticia_id']);
		return $noticia->atualizar($dados['idNoticia']);
    }

}
