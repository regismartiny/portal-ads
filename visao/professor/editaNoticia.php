<?php
	
	//include $_SERVER['DOCUMENT_ROOT']."/db/MySQL.class.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";

	$nControle = new ControleNoticia();
	$noticia = new Noticia;
	$noticia = $nControle->listarUm($_GET['idNoticia']);
	

	$titulo = $noticia->titulo;
	$conteudo = $noticia->conteudo;
	$fonte = $noticia->fonte;
	$imagem = $noticia->imagem;
	$idNoticia = $noticia->id;
	$categoriaNoticia_id = $noticia->categoriaNoticia_id;
	
	
	function inserirCategoriaNoticiaNoCombo($idSelecionado){
		
		
		$categoriaNoticia = new CategoriaNoticia(null,null,null);
		$categoriasNoticias = $categoriaNoticia->getCategoriaNoticia();
		$returnCategoriaNoticia = "";
		foreach($categoriasNoticias as $row => $arrayInterno){
			$categoriaNoticia = new categoriaNoticia($arrayInterno['id'],$arrayInterno['descricao'], $arrayInterno['cor']);
			
			$returnCategoriaNoticia = $returnCategoriaNoticia."<option value=".$arrayInterno['id'];
			if($arrayInterno['id'] == $idSelecionado){$returnCategoriaNoticia = $returnCategoriaNoticia." selected";}
			$returnCategoriaNoticia = $returnCategoriaNoticia.">".$arrayInterno['descricao']."</option>";
		}
		return $returnCategoriaNoticia;
	}
	
	
	

?>

   <div class="row justify-content-center" >
				<div class="col-12 mx-auto">
					<form id="ajax-form" method='post' action=''>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Editar Noticia</h1>
						</div>
						<div>
						<input type="text" class="form-control" id="idNoticia"  name="idNoticia"  value="<?php echo $idNoticia; ?>">
						</div>
						<div class="form-group row">
							<label for="categoriaNoticia_id" class="col-sm-4 col-form-label">Categotia:</label>
							<div class="col-sm-8">
								<select class="col custom-select" id="categoriaNoticia_id" name="categoriaNoticia_id" required>
									<?php 
										echo inserirCategoriaNoticiaNoCombo($categoriaNoticia_id);
									?>
								</select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="titulo" class="col-sm-5 col-form-label">Título da Notícia:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="titulo" name='titulo' value="<?php echo $titulo; ?>" required>
							</div>
						</div>
						<div class="form-group row">
							<label for="conteudo" class="col-sm-4 col-form-label">Conteúdo:</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="conteudo" name='conteudo' "required><?php echo $conteudo; ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="fonte" class="col-sm-4 col-form-label">Fonte da Notícia:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="fonte" name='fonte' value="<?php echo $fonte; ?>"required>
							</div>
						</div>
						<div class="form-group row">
							<label for="imagem" class="col-sm-4 col-form-label">Link para Imagem:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="imagem" name='imagem' value="<?php echo $imagem; ?>"required>
							</div>
						</div>
						<div id="result" class="status"></div>
						<br>
						
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Atualizar'>
				
						<a class='btn btn-danger btn-lg btn-block' href='#'>Cancelar</a>
					</form>		
					
				</div>
	</div>

	<script>
		$("#ajax-form").submit(function(event) {
			event.preventDefault();
			
			statusProcessando();
			
			$.ajax({
				type: "POST",
				url: "/controle/processaEditaNoticia.php",
				data: $("#ajax-form").serialize(),
				success: function(response) {
				
					console.log(response);
					let resObj = JSON.parse(response);
					let mensagem = resObj.mensagem;
					printaMensagem(mensagem);
				},
				error: function(response) {
					console.log(response);
					printaMensagem('Erro no envio do formulário');
				}
			});
		});

		function statusProcessando() {
			$("#result").html("Processando...");
			$("#result").fadeIn(400);
		}
		function printaMensagem(status) {
			$("#result").html(status);
		}
	</script>
</html>