<?php

include_once $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
class Noticia
{
    private $id;
    private $titulo;
    private $conteudo;
    private $fonte;
    private $imagem;
    private $status;
    private $dataCadastro;
	private $dataPublicacao;
	private $usuario_id;
	private $categoriaNoticia_id;
        
    public function __construct($id = null, $titulo = null, $conteudo = null, $fonte = null, $imagem = null, $status = null, $dataCadastro = null, $dataPublicacao = null, $usuario_id = null, $categoriaNoticia_id = null)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->conteudo = $conteudo;
        $this->fonte = $fonte;
        $this->imagem = $imagem;
        $this->status = $status;
        $this->dataCadastro = $dataCadastro;
		$this->dataPublicacao = $dataPublicacao;
		$this->usuario_id = $usuario_id;
		$this->categoriaNoticia_id = $categoriaNoticia_id;
    }
	
	public function __get($valor) {
			return $this->$valor;
	}
	public function __set($propriedade,$valor) {
			$this->$propriedade = $valor;
    }   

	
    public function listarUm() {
        $con = new MySQL();
        $sql = "SELECT * FROM Noticia WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->titulo = $resultado[0]["titulo"];
			$this->conteudo = $resultado[0]["conteudo"];
			$this->fonte = $resultado[0]["fonte"];
			$this->imagem = $resultado[0]["imagem"];
			$this->status = $resultado[0]["status"];
			$this->dataCadastro = $resultado[0]["dataCadastro"];
			$this->dataPublicacao = $resultado[0]["dataPublicacao"];
			$this->usuario_id = $resultado[0]["Usuario_id"];
			$this->categoriaNoticia_id = $resultado[0]["CategoriaNoticia_id"];
			return true;	
        } else {
            return false;
        }
    }
     
        
    public function listarTodos() {
        $con = new MySQL();
        $sql = "SELECT * FROM Noticia";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $noticias = array();
            foreach ($resultados as $resultado) {
				$noticia = new Noticia();	
                $noticia->id = ($resultado['id']);
                $noticia->titulo = ($resultado['titulo']);
				$noticia->conteudo = ($resultado['conteudo']);
                $noticia->fonte = ($resultado['fonte']);
                $noticia->imagem =($resultado['imagem']);
                $noticia->status = ($resultado['status']);
                $noticia->dataCadastro = ($resultado['dataCadastro']);
				$noticia->dataPublicacao = ($resultado['dataPublicacao']);
                $noticia->usuario_id = ($resultado['Usuario_id']);
                $noticia->categoriaNoticia_id = ($resultado['CategoriaNoticia_id']);
				$noticias[] = $noticia;
            }
            return $noticias;
        } else {
            return false;
        }
    }
	
	
    public function listarPorMatricula($siapeMatricula) {
        $con = new MySQL();
        $sql = "SELECT n.id, n.titulo, n.dataCadastro, n.status FROM Noticia n, Usuario u WHERE u.siapeMatricula = $siapeMatricula and u.id = n.Usuario_id";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) {
            $noticias = array();
            foreach ($resultados as $resultado) {
                $noticia = new Noticia();
                $noticia->id = ($resultado['id']);
                $noticia->status = ($resultado['status']);
                $noticia->titulo = ($resultado['titulo']);
                $noticia->dataCadastro = ($resultado['dataCadastro']);
                $noticias[] = $noticia;
            }
            return $noticias;
        } else {
            return false;
        }
    }

    public function listarPaginado($pagina, $quantidade) {
        $inicio = ($quantidade * $pagina) - $quantidade;
        $con = new MySQL();
        $sql = "SELECT * FROM Noticia ORDER BY dataPublicacao DESC LIMIT $inicio, $quantidade";
        $resultados  = $con->consulta($sql);
        if (!empty($resultados)) {
            $noticias = array();
            foreach ($resultados as $resultado){
                $noticia = new Noticia();
                $noticia->id = $resultado['id'];
                $noticia->titulo = $resultado['titulo'];
                $noticia->conteudo = $resultado['conteudo'];
                $noticia->fonte = $resultado['fonte'];
                $noticia->imagem = $resultado['imagem'];
                $noticia->status = $resultado['status'];
                $noticia->dataCadastro = $resultado['dataCadastro'];
                $noticia->dataPublicacao = $resultado['dataPublicacao'];
                $noticia->usuario_id = $resultado['Usuario_id'];
                $noticia->categoriaNoticia_id = $resultado['CategoriaNoticia_id'];
                $noticias[] = $noticia;
            }
            return $noticias;
        } else {
            return false;
        }
    }
       
    public function inserir() {
        $con = new MySQL();
        $sql = "INSERT INTO Noticia (titulo, conteudo, fonte, imagem, status, dataCadastro, dataPublicacao, Usuario_id, CategoriaNoticia_id) 
                VALUES ('$this->titulo', '$this->conteudo', '$this->fonte', '$this->imagem', '$this->status', now(), now(), '$this->usuario_id', '$this->categoriaNoticia_id')";
        return $con->executa($sql) > 0 ? 1 : 0;
    }
	
	public function atualizar() {
        $con = new MySQL();
        $sql = "UPDATE Noticia SET titulo = '$this->titulo', conteudo = '$this->conteudo', fonte = '$this->fonte', imagem = '$this->imagem', status = '1', dataCadastro = now(), dataPublicacao = now(), CategoriaNoticia_id = '$this->categoriaNoticia_id' WHERE id = $this->id";
        return $con->executa($sql) > 0 ? 1 : 0;
    }
	
    public function desabilitar(){
        $con = new MySQL();
        $sql = "UPDATE Noticia SET status = $this->status WHERE id = $this->id";
        $con->executa($sql);
    }

    public function modificarStatus() {
        $status = $this->status;
        $con = new MySQL();
        if ($status == 1) {
            $sql = "UPDATE Noticia SET status = 0 WHERE id = '$this->id'";
        }else {
            $sql = "UPDATE Noticia SET status = 1 WHERE id = '$this->id'";
        }
        return $con->executa($sql) > 0;
    }
	
	public function remover($tipoUsuario){
		$con = new MySQL();
		if($tipoUsuario==1){//verifica se é o coordenador
			$sql = "DELETE from Noticia WHERE id = '$this->id'";
		}else{
			$sql = "DELETE from Noticia WHERE id = '$this->id' AND usuario_id = '$this->usuario_id'";
		}
		$con->executa($sql);
	}
}

