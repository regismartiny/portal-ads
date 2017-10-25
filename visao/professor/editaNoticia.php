<?php
	
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

	$dados = clearArray($_GET);

	$nControle = new ControleNoticia();

	$noticia = $nControle->listarUm($dados['idNoticia']);
	
	$titulo = $noticia->titulo;
	$conteudo = $noticia->conteudo;
	$fonte = $noticia->fonte;
	$imagem = $noticia->imagem;
	$idNoticia = $noticia->id;
	$categoriaNoticia_id = $noticia->categoriaNoticia_id;
	
	
	function inserirCategoriaNoticiaNoCombo($idSelecionado){

		$categoriaNoticia = new CategoriaNoticia();
		$categoriasNoticias = $categoriaNoticia->listarTodos();
		$returnCategoriaNoticia = "";
		foreach($categoriasNoticias as $categoria){
			$returnCategoriaNoticia = $returnCategoriaNoticia."<option value=".$categoria->getId();
			if($categoria->getId() == $idSelecionado) {
				$returnCategoriaNoticia = $returnCategoriaNoticia." selected";
			}
			$returnCategoriaNoticia = $returnCategoriaNoticia.">".$categoria->getDescricao()."</option>";
		}
		return $returnCategoriaNoticia;
	}
?>

   <div class="row" >
			<div class="col mx-auto">
				<h2 class="titulo">Edição de Notícias</h2>
				<form id="ajax-form" method='post' action='/controle/processaEditaNoticia.php'>
					<input type="hidden" class="form-control" id="idNoticia"  name="id"  value="<?php echo $idNoticia; ?>">
					<div class="form-group row">
						<label for="categoriaNoticia_id" class="col-sm-4 col-form-label">Categoria</label>
						<div class="col-sm-8">
							<select class="col custom-select" id="categoriaNoticia_id" name="categoriaNoticia_id" required>
								<?php 
									echo inserirCategoriaNoticiaNoCombo($categoriaNoticia_id);
								?>
							</select>
						</div>
					</div>	
					<div class="form-group row">
						<label for="titulo" class="col-sm-12 col-md-4 col-form-label">Título</label>
						<div class="col-sm-12 col-md-8">
							<input type="text" class="form-control" id="titulo" name='titulo' value="<?php echo $titulo; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="conteudo" class="col-sm-12 col-md-4 col-form-label">Conteúdo</label>
						<div class="col-sm-12 col-md-8">
							<textarea class="form-control" id="conteudo" name="conteudo" required><?php echo $conteudo; ?></textarea>
						</div>
					</div>
					<div class="form-group row">
						<label for="fonte" class="col-sm-12 col-md-4 col-form-label">Fonte</label>
						<div class="col-sm-12 col-md-8">
							<input type="text" class="form-control" id="fonte" name="fonte" value="<?php echo $fonte; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="imagem" class="col-sm-12 col-md-4 col-form-label">Link para Imagem</label>
						<div class="col-sm-12 col-md-8">
							<input type="text" class="form-control" id="imagem" name="imagem" value="<?php echo $imagem; ?>" required>
						</div>
					</div>
					<div id="result" class="status"></div>
					<br>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6">
							<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="botao" value="Atualizar" />
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<a href="/visao/professor/lstNoticia.php" class="btn btn-danger btn-lg btn-block">Cancelar</a>
						</div>
					</div>
								
				</form>		
				
			</div>
	</div>

	<script>
		$("#ajax-form").submit(function(event) {
			event.preventDefault();
			$form = $(this);
			
			statusProcessando();
			
			$.ajax({
				type: $form.attr('method'),
				url: $form.attr('action'),
				data: $form.serialize(),
				success: function(response) {
					let resObj = JSON.parse(response);
					if (resObj) {
						let sucesso = resObj.sucesso;
						if (sucesso) {
							statusSucesso(resObj.mensagem);
						} else {
							statusErro(resObj.mensagem);
						}
					}
				},
				error: function(response) {
					console.log(response);
					statusErro('Erro no envio do formulário');
				}
			});
		});
	</script>