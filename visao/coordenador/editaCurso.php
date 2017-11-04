<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=1 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
	}
	else{
		
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleInformacaoDoCurso.class.php";
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

		$dados = clearArray($_GET);

		$chave = $_GET['q'];
		
		$nControle = new ControleInformacaoDoCurso();

		$informacao = $nControle->listarPorChave($chave);
		
		
		$titulo = $informacao->getTitulo();
		
		
	}
?>

   <div class="row" >
			<div class="col mx-auto">
				<h2 class="titulo">Edição de <?php echo "$titulo";?></h2>
				<form id="ajax-form" method='post' action='/controle/processaEditaCurso.php'>
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $informacao->getId(); ?>">
					
					<div class="form-group row">
						<div class="col-12 col-md-12">
							<textarea class="form-control" id="conteudo" name="conteudo" required><?php echo $informacao->getConteudo(); ?></textarea>
						</div>
					</div>
					
					<div id="result" class="status alert" role="alert"></div>

					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6">
							<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="botao" value="Salvar" />
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
						<a href="index.php" class="btn btn-danger btn-lg btn-block">Cancelar</a>
						</div>
					</div>
				</form>		
			</div>
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