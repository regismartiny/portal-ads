<div class="row">
	<div class="col-12 mx-auto">
		<h2 class="titulo">Alteração de senha</h2>
		<form id="form" method="post" action="/controle/processaAlteracaoSenha.php">
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Senha Atual:</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="senhaAtual " name="senhaAtual" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Senha Nova:</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="senhaNova" name="senhaNova" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-5 col-form-label">Confirmação:</label>
				<div class="col-sm-12 col-md-7">
					<input type="password" class="form-control" id="confSenha" name="confSenha" required>
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