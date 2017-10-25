<?php
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

	$dados = clearArray($_GET);

	$nControle = new ControleUsuario();

	$usuario = $nControle->listarUm($dados['id']);
	
	$idUsuario = $usuario->getId();
	$nome = $usuario->getNome();
	$siapeMatricula = $usuario->getSiapeMatricula();
	$email = $usuario->getEmail();
	$tipoUsuario_id = $usuario->getTipoUsuario_id();
	$ativo = $usuario->getStatus() == 1;
?>

   <div class="row" >
			<div class="col mx-auto">
				<h2 class="titulo">Edição de Usuário</h2>
				<form id="ajax-form" method='post' action='/controle/processaEditaUsuario.php'>
					<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $idUsuario; ?>">
					<div class="form-group row">
						<label for="nome" class="col-12 col-md-5 col-form-label">Nome Completo:</label>
						<div class="col-12 col-md-7">
							<input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="siapeMatricula" class="col-12 col-md-5 col-form-label">Matricula / SIAPE:</label>
						<div class="col-12 col-md-7">
							<input type="number" class="form-control" id="siapeMatricula" name="siapeMatricula" value="<?php echo $siapeMatricula; ?>" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-12 col-md-5 col-form-label">E-mail (Opcional):</label>
						<div class="col-12 col-md-7">
							<input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="status" class="col-12 col-md-5 col-form-label">Ativo:</label>
						<div class="col-12 col-md-7">
							<input type="checkbox" class="form-control" id="status" name="status"<?php if ($ativo) echo ' checked';?>>
						</div>
					</div>
					<div id="result" class="status"></div>
					<br>
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-6">
							<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="botao" value="Salvar" />
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6">
							<input type="reset" class="btn btn-danger btn-lg btn-block" value="Limpar">
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