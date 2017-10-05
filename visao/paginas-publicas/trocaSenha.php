<div class="row">
	<div class="col-12 mx-auto">
		<form id="form" method="post" action="/controle/trocaSenha.php">
			<div class="form-group row">
				<h1 class="col-sm-12 col-form-label">Troca de Senha</h1>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-4 col-form-label">Senha Antiga:</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="senhaAntiga " name="senhaAntiga" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-4 col-form-label">Senha Nova:</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="senhaNova" name="senhaNova" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-4 col-form-label"> Confirmação de Senha:</label>
				<div class="col-sm-8">
					<input type="password" class="form-control" id="confSenha" name="confSenha" required>
				</div>
			</div>						
			<div id="result" class="status"></div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type='submit' class='btn btn-primary btn-lg btn-block' name='login' value='Trocar Senha'>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<a class='btn btn-danger btn-lg btn-block' href='#'>Cancelar</a>
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
				let sucesso = resObj.status;
				let mensagem = resObj.mensagem;
		
				statusLogin(mensagem);	
			},
			error: function(response) {
				console.log(response);
				statusLogin('Erro no envio do formulário');
			}
		});
	});
	function statusProcessando() {
		$("#result").html("Processando...");
		$("#result").fadeIn(400);
	}
	function statusLogin(status) {
		$("#result").html(status);
	}
	function navegaPagina(pagina) {
		window.location.href = pagina;
	}
</script>