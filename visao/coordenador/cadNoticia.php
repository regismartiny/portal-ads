<?php
	if(isset($_POST['botao']) && $_POST['botao']=="Adicionar"){
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
		$uControle = new ControleUsuario();
		$uControle->inserir($_POST);
	}
	
	function inserircategoriaNoticiaNoCombo(){
		include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/categoriaNoticia.class.php";
		
		$categoriaNoticia = new categoriaNoticia(null,null,null);
		$categoriasNoticias = $categoriaNoticia->getcategoriaNoticia();
		$returncategoriaNoticia = "";
		foreach($categoriasNoticias as $row => $arrayInterno){
			$categoriaNoticia = new categoriaNoticia($arrayInterno['id'],$arrayInterno['descricao'], $arrayInterno['cor']);
			$returncategoriaNoticia = $returncategoriaNoticia."<option value=".$arrayInterno['id'].">".$arrayInterno['descricao']."</option>";
		}
		return $returncategoriaNoticia;
	}	
?>
	<head>
		<meta charset='utf-8'>
		<title>Cadastro de Noticias</title>
	</head>
	<style>
		#container {
			margin-top: 100px;
		}
	</style>
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<div >
					<form method='post' action='cadUsuario.php'>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Cadastro de Noticias:</h1>
						</div>
						<div class="form-group row">
						<label for="categoria" class="col-sm-4 col-form-label">Categotia:</label>
						<div class="col-sm-8">
							<select class="col custom-select" id="categoria_id" name="categoria_id" required>
								<?php 
								echo inserircategoriaNoticiaNoCombo();
								?>
							</select>
						</div>
						<div class="form-group row">
							<label for="nome" class="col-sm-4 col-form-label">Título da Notícia:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="titulo" name='titulo' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="matricula" class="col-sm-4 col-form-label">Texto da Notícia:</label>
							<div class="col-sm-8">
							  <textarea class="form-control" id="texto" name='texto' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="nome" class="col-sm-4 col-form-label">Link para Imagem:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="linkImagem" name='linkImagem' required>
							</div>
						</div>
												
					</div>
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Adicionar'>
					</form>
					<a class='btn btn-danger btn-lg btn-block' href='/visao/index.html'>Cancelar</a>
				</div>
			</div>
		</div>
	</body>
