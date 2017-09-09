<?php

include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
	class Usuario{
		private $id;
		private $siapeMatricula;
		private $nome;
		private $email;
		private $senha;
		private $status;
		private $tipoUsuario_id;
		
		public function __construct($id = null, $si = null, $n = null, $e = null, $se = null, $st = null, $tp = null){
			$this->id = $id;
			$this->siapeMatricula = $si;
			$this->nome = $n;
			$this->email = $e;
			$this->senha = $se;
			$this->status = $st;
			$this->tipoUsuario_id = $tp;			
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getSiapeMatricula(){
			return $this->siapeMatricula;
		}
		
		public function setSiapeMatricula($siapeMatricula){
			$this->siapeMatricula = $siapeMatricula;
		}
		
		public function getNome(){
			return $this->nome;
		}
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function getEmail(){
			return $this->email;
		}
		
		public function setEmail($email){
			$this->email = $email;
		}
		
		public function getSenha(){
			return $this->senha;
		}
		
		public function setSenha($senha){
			$this->senha = $senha;
		}
		
		public function getStatus(){
			return $this->status;
		}
		
		public function setStatus($status){
			$this->status = $status;
		}
		
		public function getTipoUsuario_id(){
			return $this->tipoUsuario_id;
		}
		
		public function setTipoUsuario_id($status){
			$this->tipoUsuario_id = $tipoUsuario_id;
		}
		
		public function isCadastrado() {
			$con = new MySQL();
			$sql = "SELECT * FROM Usuario WHERE siapeMatricula = '$this->siapeMatricula' AND senha = '$this->senha'";
			$resultados = $con->consulta($sql);
			return count($resultados)>0;
		}
		
		public function listarUm(){
			$con = new MySQL();
			$sql = "SELECT * FROM Usuario WHERE siapeMatricula='$this->siapeMatricula'";
			$resultado = $con->consulta($sql);
			$usuario = new Usuario();
			if(!empty($resultado)){
				
					$this->id = $resultado[0]["id"];
					$this->numero = $resultado[0]["siapeMatricula"];
					$this->nome = $resultado[0]["nome"];
					$this->email = $resultado[0]["email"];
					$this->senha = $resultado[0]["senha"];
					$this->status = $resultado[0]["status"];
					$this->tipoUsuario_id = $resultado[0]["TipoUsuario_id"];
					return $usuario;
				}else{
				return false;
			}
		}
		
		
		public function listarTodos(){
			$con = new MySQL();
			$sql = "SELECT * FROM Usuario";
			$resultados = $con->consulta($sql);
			if(!empty($resultados)){
				$usuarios = array();
				foreach($resultados as $resultado){
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
			}else{
				return false;
			}
		}
		
		
		public function inserir(){
			$con = new MySQL();
			$sql = "INSERT INTO Usuario (siapeMatricula,nome,email,senha,status,TipoUsuario_id) VALUES ('$this->siapeMatricula','$this->nome','$this->email','$this->senha','$this->status','$this->tipoUsuario_id')";
			$con->executa($sql);
		}
	}
?>
