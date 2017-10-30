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
			$sql = "SELECT * FROM TipoUsuario";
			$resultados = $con->consulta($sql);
			return $resultados;
		}

		public function listarUm(){
			$con = new MySQL();
			$sql = "SELECT * FROM TipoUsuario WHERE id='$this->id'";
			$resultado = $con->consulta($sql);
			if (!empty($resultado)) {
				$this->setDescricao($resultado[0]["descricao"]);
				return true;
			} else {
				return false;
			}
		}

		public function listarTodos() {
			$con = new MySQL();
			$sql = "SELECT * FROM TipoUsuario";
			$resultados = $con->consulta($sql);
			if (!empty($resultados)) {
				$tipos = array();
				foreach ($resultados as $resultado) {
					$tipoUsuario = new TipoUsuario();
					$tipoUsuario->setId($resultado['id']);
					$tipoUsuario->setDescricao($resultado['descricao']);
					$tipos[] = $tipoUsuario;
				}
				return $tipos;
			}else {
				return false;
			}
		}
	}
?>
