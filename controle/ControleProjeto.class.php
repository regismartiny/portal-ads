<?php
    include_once $_SERVER['DOCUMENT_ROOT']."/modelo/Projeto.class.php";

    class ControleProjeto {
        
        public function listarUm($id) {
            $projeto = new Projeto($id);
            $ok = $projeto->listarUm();
            if ($ok) {
                return $projeto;
            } else {
                return false;
            }
        }
        
        public function inserir($usuario, $dados) {
            $projeto = new Projeto(null, $dados['titulo'], $dados['conteudo'], $dados['imagem'],1,null, null, $usuario);
            return $projeto->inserir();
        }
        
        public function consultar() {   
            $projeto = new Projeto();
            return $projeto->listarTodos();
        }
        
        public function meusProjetos($siapeMatricula) {   
            $projeto = new Projeto();
            return $projeto->listarPorMatricula($siapeMatricula);
        }

        public function listarPaginado($pagina, $quantidade) {
            $pagina = !empty($pagina) ? $pagina : 1;
            $quantidade = !empty($quantidade) ? $quantidade : 10;
            $projeto = new Projeto();
            $projetos = $projeto->listarPaginado($pagina, $quantidade);
            if ($projetos == false || empty($projetos)) {
                return false;
            } else {
                return $projetos;
            }
        }
        
        public function modificarStatusProjeto($id, $status) {
            $projeto = new Projeto($id, null, null, null, null, $status);
            $projeto->modificarStatusProjeto();
        }
        
        public function atualizar($dados) {
            $projeto = new Projeto($dados['id'], $dados['titulo'], $dados['conteudo'], $dados['imagem'],1,null, null,null);
            return $projeto->atualizar();
        }

    }
?>