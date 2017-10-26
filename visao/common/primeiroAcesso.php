<?php
include $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
$dados = clearArray($_GET);
$siapeMatricula = $dados['siapeMatricula'];

?>
<div class="row">
	<div class="col-12 mx-auto">
		<h2 class="titulo">Alteração de senha</h2>
				
		<form id="form" method="post" action="/controle/processaPrimeiroAcesso.php">
		<input type="hidden" class="form-control" id="siapeMatricula"  name="siapeMatricula"  value="<?php echo $siapeMatricula; ?>">
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Senha Atual</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="senhaAtual " name="senhaAtual" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Senha Nova</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="senhaNova" name="senhaNova" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Confirmação de Senha</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="confSenha" name="confSenha" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-12 col-md-5 col-form-label">E-mail</label>
				<div class="col-12 col-md-7">
					<input type="email" class="form-control" id="email" name="email" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-12 col-md-5 col-form-label">Confirmação de E-mail</label>
				<div class="col-12 col-md-7">
					<input type="email" class="form-control" id="confEmail" name="confEmail" required>
				</div>
			</div>


			
			<div id="result" class="status alert" role="alert"></div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type='submit' class='btn btn-primary btn-lg btn-block btn-login' name='login' value='Alterar'>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type="reset" class="btn btn-danger btn-lg btn-block" value="Limpar">
				</div>
			</div>		
		</form>
	</div>
</div>
<script>
	$("#form").submit(function(event) {
		event.preventDefault();
		$form = $(this);
			statusProcessando();
			$.ajax({
			type: "POST",
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(response) {
				
				console.log(response);
				let resObj = JSON.parse(response);
				let mensagem = resObj.mensagem;
				
				if (resObj.sucesso) {
					statusSucesso(mensagem);
					window.location="#/visao/paginas-publicas/restrito.php"; 
				} else {
					statusErro(mensagem);
				}
			},
			error: function(response) {
				console.log(response);
				statusErro('Erro no envio do formulário');
			}
		});
	});
</script>