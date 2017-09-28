<?php

include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
class Usuario
{
    private $id;
    private $siapeMatricula;
    private $nome;
    private $email;
    private $senha;
    private $status;
    private $tipoUsuario_id;
        
    public function __construct($id = null, $si = null, $n = null, $e = null, $se = null, $st = null, $tp = null)
    {
        $this->id = $id;
        $this->siapeMatricula = $si;
        $this->nome = $n;
        $this->email = $e;
        $this->senha = $se;
        $this->status = $st;
        $this->tipoUsuario_id = $tp;
    }
        
    public function getId()
    {
        return $this->id;
    }
        
    public function setId($id)
    {
        $this->id = $id;
    }
        
    public function getSiapeMatricula()
    {
        return $this->siapeMatricula;
    }
        
    public function setSiapeMatricula($siapeMatricula)
    {
        $this->siapeMatricula = $siapeMatricula;
    }
        
    public function getNome()
    {
        return $this->nome;
    }
        
    public function setNome($nome)
    {
        $this->nome = $nome;
    }
        
    public function getEmail()
    {
        return $this->email;
    }
        
    public function setEmail($email)
    {
        $this->email = $email;
    }
        
    public function getSenha()
    {
        return $this->senha;
    }
        
    public function setSenha($senha)
    {
        $this->senha = $senha;
    }
        
    public function getStatus()
    {
        return $this->status;
    }
        
    public function setStatus($status)
    {
        $this->status = $status;
    }
        
    public function getTipoUsuario_id()
    {
        return $this->tipoUsuario_id;
    }
        
    public function setTipoUsuario_id($status)
    {
        $this->tipoUsuario_id = $tipoUsuario_id;
    }
        
    public function isCadastrado()
    {	
	$resposta=0;
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula'";
        $resultados = $con->consulta($sql);
        if (count($resultados)==1)
	{
		$sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula' AND senha = '$this->senha'";
		$resultados2 = $con->consulta($sql);
		if (count($resultados2)==1)
		{
			$resposta=2;
		}else
		{
			$resposta=1;
		}
	}
	else
	{
		$resposta=3;
	}
	return $resposta;
    }

    public function trocaSenha($senhaNova)
    {	
	$resposta=0;
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula'";
        $resultados = $con->consulta($sql);
        if (count($resultados)==1)
	{
		$sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula' AND senha = '$this->senha'";
		$resultados2 = $con->consulta($sql);
		if (count($resultados2)==1)
		{//tudo certo
			$comparaSenha = strcasecmp($this->senha, $senhaNova); //se são iguais retorna zero
			if($comparaSenha!=0)
			{
				$sql = "UPDATE Usuario SET Senha = '$senhaNova' WHERE siapeMatricula = '$this->siapeMatricula'";
				$con->executa($sql);
				$resposta=2;
			}
			else
			{//senha nova e velha iguais
				$resposta=4;
			}
		}
		else
		{//senha errada
			$resposta=1;
		}
	}
	else
	{//usuario não existe
		$resposta=3;
	}
	return $resposta;
    }

	
    public function listarUm()
    {
        $con = new MySQL();
        $sql = "SELECT * FROM Usuario WHERE siapeMatricula='$this->siapeMatricula'";
        $resultado = $con->consulta($sql);
        $usuario = new Usuario();
        if (!empty($resultado)) {
            $this->id = $resultado[0]["id"];
            $this->numero = $resultado[0]["siapeMatricula"];
            $this->nome = $resultado[0]["nome"];
            $this->email = $resultado[0]["email"];
            $this->senha = $resultado[0]["senha"];
            $this->status = $resultado[0]["status"];
            $this->tipoUsuario_id = $resultado[0]["TipoUsuario_id"];
            return $usuario;	
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
        $sql = "UPDATE Usuario SET status = '$this->status' WHERE id = '$this->id'";
        $con->executa($sql);
    }
	
    public function editar()
    {
        $con = new MySQL();		
        $sql = "UPDATE Usuario SET siapeMatricula = '$this->siapeMatricula', nome = '$this->nome', email = '$this->email', senha = '$this->senha', status = '$this->status', TipoUsuario_id = '$this->tipoUsuario_id' WHERE id = '$this->id'";
        $con->executa($sql);		
    }
	
}
