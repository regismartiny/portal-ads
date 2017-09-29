<?php

include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
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
        
    public function getId()
    {
        return $this->id;
    }
        
    public function setId($id)
    {
        $this->id = $id;
    }
	
	public function getTitulo()
    {
        return $this->titulo;
    }
        
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function getConteudo()
    {
        return $this->conteudo;
    }
        
    public function setConteudo($conteudo)
    {
        $this->conteudo = $conteudo;
    }    
    public function getFonte()
    {
        return $this->fonte;
    }
        
    public function setFonte($fonte)
    {
        $this->fonte = $fonte;
    }
    public function getImagem()
    {
        return $this->imagem;
    }
        
    public function setImagem($id)
    {
        $this->imagem = $imagem;
    }
	public function getStatus()
    {
        return $this->status;
    }
        
    public function setStatus($status)
    {
        $this->status = $status;
    }
	public function getDataCadastro()
    {
        return $this->dataCadastro;
    }
        
    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;
    }
	
	public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }
        
    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;
    }
	public function getUsuario_id()
    {
        return $this->usuario_id;
    }
        
    public function setUsuario_id($usuario_id)
    {
        $this->usuario_id = $usuario_id;
    }
	public function getCategoriaNoticia_id()
    {
        return $this->categoriaNoticia_id;
    }
        
    public function setCategoriaNoticia_id($categoriaNoticia_id)
    {
        $this->categoriaNoticia_id = $categoriaNoticia_id;
    }
	
	  
	
    public function listarUm()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM Noticia WHERE id='$this->id'";
        $resultado = $con->consulta($sql);
        $noticia = new Noticia();
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->titulo = $resultado[0]["titulo"];
			$this->conteudo = $resultado[0]["conteudo"];
			$this->fonte = $resultado[0]["fonte"];
			$this->imagem = $resultado[0]["imagem"];
			$this->status = $resultado[0]["status"];
			$this->dataCadastro = $resultado[0]["dataCadastro"];
			$this->dataPublicacao = $resultado[0]["dataPublicacao"];
			$this->usuario_id = $resultado[0]["usuario_id"];
			$this->categoriaNoticia_id = $resultado[0]["categoriaNoticia_id"];
			
			return $noticia;	
        } else {
            return false;
        }
    }
     
        
    public function listarTodos()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) 
	{
            $usuarios = array();
            foreach ($resultados as $resultado) 
	    {
                $usuario = new Usuario();
                $usuario->setId($resultado['id']);
                $usuario->setSiapeMatricula($resultado['siapeMatricula']);
                $usuario->setNome($resultado['nome']);
                $usuario->setEmail($resultado['email']);
                $usuario->setSenha($resultado['senha']);
                $usuario->setStatus($resultado['status']);
                $usuario->setTipoUsuario_id($resultado['TipoUsuario_id']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        } 
	else 
	{
            return false;
        }
    }
	
    public function filtrarUsuario()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE id='$this->id'";
        $resultados = $con->consulta($sql);
        if (!empty($resultados)) 
	{
            $usuarios = array();
            foreach ($resultados as $resultado) 
	    {
                $usuario = new Usuario();
                $usuario->setId($resultado['id']);
                $usuario->setSiapeMatricula($resultado['siapeMatricula']);
                $usuario->setNome($resultado['nome']);
                $usuario->setEmail($resultado['email']);
                $usuario->setSenha($resultado['senha']);
                $usuario->setStatus($resultado['status']);
                $usuario->setTipoUsuario_id($resultado['TipoUsuario_id']);
                $usuarios[] = $usuario;
            }
            return $usuarios;
        } 
	else 
	{
            return false;
        }
    }	
        
        
    public function inserir()
    {
        $con = new MySQL();
        $sql = "INSERT INTO Usuario (siapeMatricula,nome,email,senha,status,TipoUsuario_id) VALUES ('$this->siapeMatricula','$this->nome','$this->email','$this->senha','$this->status','$this->tipoUsuario_id')";
        $con->executa($sql);
    }
	
    public function desabilitarUsuario(){
        $con = new MySQL();
        $sql = "UPDATE Usuario SET status = $this->status WHERE id = $this->id";
        $con->executa($sql);
    } 
}