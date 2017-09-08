<?php

include_once $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
	class TipoUsuario{
		private $id;
		private $descricao;
		
		public function __construct($id = null, $descricao = null){
			$this->id = $id;
			$this->descricao = $descricao;	
		}
		
		public function getId(){
			return $this->id;
		}
		
		public function setId($id){
			$this->id = $id;
		}
		
		public function getDescricao(){
			return $this->descricao;
		}
		
		public function setDescricao($descricao){
			$this->descricao = $descricao;
		}
		
		public function getTipoUsuario(){
			$con = new MySQL();
			$sql = "SELECT * FROM tipousuario";
			$resultados = $con->consulta($sql);
			return $resultados;
		}
	}
?>
