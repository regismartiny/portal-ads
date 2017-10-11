<?php
	function inserirCategoriaNoticiaNoCombo(){
		include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaNoticia.class.php";
		
		$categoriaNoticia = new CategoriaNoticia(null,null,null);
		$categoriasNoticias = $categoriaNoticia->getCategoriaNoticia();
		$returnCategoriaNoticia = "";
		foreach($categoriasNoticias as $row => $arrayInterno){
			$categoriaNoticia = new categoriaNoticia($arrayInterno['id'],$arrayInterno['descricao'], $arrayInterno['cor']);
			$returnCategoriaNoticia = $returnCategoriaNoticia."<option value=".$arrayInterno['id'].">".$arrayInterno['descricao']."</option>";
		}
		return $returnCategoriaNoticia;
	}	
?>
			<div class="row justify-content-center" >
				<div class="col-12 mx-auto">
					<form id="ajax-form" method='post' action=''>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Cadastro de Noticias</h1>
						</div>
						<div class="form-group row">
							<label for="categoriaNoticia_id" class="col-sm-4 col-form-label">Categotia:</label>
							<div class="col-sm-8">
								<select class="col custom-select" id="categoriaNoticia_id" name="categoriaNoticia_id" required>
									<?php 
										echo inserirCategoriaNoticiaNoCombo();
									?>
								</select>
							</div>
						</div>	
						<div class="form-group row">
							<label for="titulo" class="col-sm-5 col-form-label">Título da Notícia:</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="titulo" name='titulo' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="conteudo" class="col-sm-4 col-form-label">Conteúdo:</label>
							<div class="col-sm-8">
								<textarea class="form-control" id="conteudo" name='conteudo' required></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="fonte" class="col-sm-4 col-form-label">Fonte da Notícia:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="fonte" name='fonte' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="imagem" class="col-sm-4 col-form-label">Link para Imagem:</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="imagem" name='imagem' required>
							</div>
						</div>
						<div id="result" class="status"></div>
						<br>
						
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Adicionar'>
				
						<a class='btn btn-danger btn-lg btn-block' href='#'>Cancelar</a>
					</form>						
				</div>
			</div>
	</body>
	<script>
		$("#ajax-form").submit(function(event) {
			event.preventDefault();
			
			statusProcessando();
			
			$.ajax({
				type: "POST",
				url: "/controle/processaCadNoticia.php",
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