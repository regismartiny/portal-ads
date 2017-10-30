<?php
    include $_SERVER['DOCUMENT_ROOT']."/modelo/InformacaoDoCurso.class.php";

    class ControleInformacaoDoCurso {   
        public function listarPorId($id) {
            $informacao = new InformacaoDoCurso($id);
            $ok = $informacao->listarPorId();
            if ($ok) {
                return $informacao;
            } else {
                return false;
            }
        }

        public function listarPorChave($chave) {
            $informacao = new InformacaoDoCurso(null, $chave);
            $ok = $informacao->listarPorChave();
            if ($ok) {
                return $informacao;
            } else {
                return false;
            }
        }

        public function listarTodos() {
            $informacoes = new InformacaoDoCurso();
            $ok = $informacoes->listarTodos();
            if ($ok) {
                return $informacao;
            } else {
                return false;
            }
        }
        
        public function inserir($dados) {
            $informacao = new InformacaoDoCurso(null, $dados['chave'], $dados['titulo'], $dados['conteudo']);
            $informacao->inserir();
        }
		
		public function atualizar($dados) {
		$informacao = new InformacaoDoCurso($dados['id'], null, null, $dados['conteudo']);
            return $informacao->atualizar();
        }
    }
?>