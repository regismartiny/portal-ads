<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Acesso Restrito</h2>
		<form id="form" method="post" action="/controle/processaLogin.php">
			<div class="form-group row">
				<label for="matricula" class="col-sm-12 col-md-12 col-form-label">Matrícula / SIAPE:</label>
				<div class="col-sm-12 col-md-12">
					<input type="text" class="form-control" id="matricula" name="matricula" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-12 col-md-12 col-form-label">Senha:</label>
				<div class="col-sm-12 col-md-12">
					<input type="password" class="form-control" id="senha" name="senha" required>
				</div>
			</div>
			<div id="result" class="status alert" role="alert"></div>
			<br>
			<div class="row">
				<div class="col-sm-12 col-md-4">
					<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="login" value="Login" />
				</div>
				<div class="col-sm-12 col-md-8">
					<a href="esqueciSenha.html" class="btn btn-danger btn-lg btn-block">Esqueci Minha Senha</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$('#form').submit(function(event) {
		event.preventDefault();
		$form = $(this);

		statusProcessando();

		$.ajax({
			type: $form.attr('method'),
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(response) {
				
				console.log(response);
				let resObj = JSON.parse(response);
				if (resObj) {
					let sucesso = resObj.sucesso;
					if (sucesso) {
						statusSucesso(resObj.mensagem);
					} else {
						statusErro(resObj.mensagem);
					}
					let tipoUsuario = resObj.tipoUsuario;
					if (sucesso && tipoUsuario) {
						direcionaPagina(tipoUsuario);
					}
				}
			},
			error: function(response) {
				console.log(response);
				statusErro('Erro no envio do formulário');
			}
		});
	});

	function direcionaPagina(tipoUsuario) {
		/*
		// Implementar atualização do menu por AJAX
		*/
		navegaPagina('/visao/index.php');
		/*
		if (tipoUsuario === '1') {
			navegaPagina('/visao/coordenador/homeCoordenador.php');
		} else if (tipoUsuario === '2') {
			navegaPagina('/visao/professor/homeProfessor.php');
		} else if (tipoUsuario === '3') {
			navegaPagina('/visao/aluno/homeAluno.php');
		}*/
	}
</script>
