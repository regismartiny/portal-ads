<?php

include_once $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
class Projeto
{
    private $id;
    private $titulo;
    private $conteudo;
    private $imagem;
    private $status;
    private $dataCadastro;
	private $dataPublicacao;
	private $usuario_id;
        
    public function __construct($id = null, $titulo = null, $conteudo = null, $imagem = null, $status = null, $dataCadastro = null, $dataPublicacao = null, $usuario_id = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        $this->imagem = $imagem;
        $this->status = $status;
        $this->dataCadastro = $dataCadastro;
		$this->dataPublicacao = $dataPublicacao;
		$this->usuario_id = $usuario_id;
    }
	
	public function __get($valor) {
			return $this->$valor;
	}
	public function __set($propriedade,$valor) {
			$this->$propriedade = $valor;
    }   

	
    public function listarUm() {
        $con = new MySQL();
        $sql = "SELECT * FROM Projeto WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->titulo = $resultado[0]["titulo"];
			$this->conteudo = $resultado[0]["conteudo"];
			$this->imagem = $resultado[0]["imagem"];
			$this->status = $resultado[0]["status"];
			$this->dataCadastro = $resultado[0]["dataCadastro"];
			$this->dataPublicacao = $resultado[0]["dataPublicacao"];
			$this->usuario_id = $resultado[0]["Usuario_id"];
			return true;	
        } else {
            return false;
        }
    }
     
        
    public function listarTodos() {
        $con = new MySQL();
        $sql = "SELECT * FROM Projeto";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $projetos = array();
            foreach ($resultados as $resultado) {
				$projeto = new Projeto();	
                $projeto->id = ($resultado['id']);
                $projeto->titulo = ($resultado['titulo']);
				$projeto->conteudo = ($resultado['conteudo']);
                $projeto->imagem =($resultado['imagem']);
                $projeto->status = ($resultado['status']);
                $projeto->dataCadastro = ($resultado['dataCadastro']);
				$projeto->dataPublicacao = ($resultado['dataPublicacao']);
                $projeto->usuario_id = ($resultado['Usuario_id']);
				$projetos[] = $projeto;
            }
            return $projetos;
        } else {
            return false;
        }
    }
	
	
    public function listarPorMatricula($siapeMatricula) {
        $con = new MySQL();
        $sql = "SELECT n.id, n.titulo, n.dataCadastro, n.status FROM Projeto n, Usuario u WHERE u.siapeMatricula = $siapeMatricula and u.id = n.Usuario_id";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $projetos = array();
            foreach ($resultados as $resultado) {
                $projeto = new Projeto();
                $projeto->id = ($resultado['id']);
                $projeto->status = ($resultado['status']);
                $projeto->titulo = ($resultado['titulo']);
                $projeto->dataCadastro = ($resultado['dataCadastro']);
                $projetos[] = $projeto;
            }
            return $projetos;
        } else {
            return false;
        }
    }

    public function listarPaginado($pagina, $quantidade) {
        $inicio = ($quantidade * $pagina) - $quantidade;
        $con = new MySQL();
        $sql = "SELECT * FROM Projeto ORDER BY dataPublicacao DESC LIMIT $inicio, $quantidade";
        $resultados  = $con->consulta($sql);
        if (!empty($resultados)) {
            $projetos = array();
            foreach ($resultados as $resultado){
                $projeto = new Projeto();
                $projeto->id = $resultado['id'];
                $projeto->titulo = $resultado['titulo'];
                $projeto->conteudo = $resultado['conteudo'];
                $projeto->imagem = $resultado['imagem'];
                $projeto->status = $resultado['status'];
                $projeto->dataCadastro = $resultado['dataCadastro'];
                $projeto->dataPublicacao = $resultado['dataPublicacao'];
                $projeto->usuario_id = $resultado['Usuario_id'];
                $projetos[] = $projeto;
            }
            return $projetos;
        } else {
            return false;
        }
    }
    
        
    public function inserir() {
        $con = new MySQL();
        $sql = "INSERT INTO Projeto (titulo, conteudo, imagem, status, dataCadastro, dataPublicacao, Usuario_id) 
                VALUES ('$this->titulo', '$this->conteudo', '$this->imagem', '1', now(), now(), '$this->usuario_id')";
        return $con->executa($sql) > 0 ? 1 : 0;
    }
	
	
	public function atualizar() {
        $con = new MySQL();
        $sql = "UPDATE Projeto SET titulo = '$this->titulo', conteudo = '$this->conteudo', imagem = '$this->imagem', status = '1', dataCadastro = now(), dataPublicacao = now() WHERE id = $this->id";
        return $con->executa($sql) > 0 ? 1 : 0;
    }
	
    public function desabilitar(){
        $con = new MySQL();
        $sql = "UPDATE Projeto SET status = $this->status WHERE id = $this->id";
        $con->executa($sql);
    } 
}

