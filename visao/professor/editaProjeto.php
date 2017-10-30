<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
		return;
	}

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

	$dados = clearArray($_GET);

	$cProjeto = new ControleProjeto();

	$projeto = $cProjeto->listarUm($dados['idProjeto']);
	
	$titulo = $projeto->titulo;
	$conteudo = $projeto->conteudo;
	$imagem = $projeto->imagem;
	$idProjeto = $projeto->id;
?>

   <div class="row" >
			<div class="col mx-auto">
				<h2 class="titulo">Edição de Projetos</h2>
				<form id="ajax-form" method='post' action='/controle/processaEditaProjeto.php'>
					<input type="hidden" class="form-control" id="idProjeto"  name="id"  value="<?php echo $idProjeto; ?>">
					
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
							<a href="/visao/professor/lstProjeto.php" class="btn btn-danger btn-lg btn-block">Cancelar</a>
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