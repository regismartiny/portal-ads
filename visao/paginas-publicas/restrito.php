<div class="row">
	<div class="col mx-auto">
		<h1 class="titulo">Acesso Restrito</h1><br><br>
		<form id="form" method="post" action="/controle/login.php">
			<div class="form-group row">
				<label for="matricula" class="col-sm-5 col-md-5 col-form-label">Matrícula / SIAPE:</label>
				<div class="col-sm-7 col-md-7">
					<input type="text" class="form-control" id="matricula" name="matricula" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha:</label>
				<div class="col-sm-7 col-md-7">
					<input type="password" class="form-control" id="senha" name="senha" required>
				</div>
			</div>
			<div id="result" class="status"></div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-4">
					<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="login" value="Login" />
				</div>
				<div class="col-xs-12 col-sm-12 col-md-8">
					<a href="esqueciSenha.html" class="btn btn-danger btn-lg btn-block">Esqueci Minha Senha</a>
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
			if (resObj.tipoUsuario<4) {
				statusLogin('Login OK');
				direcionaPagina(resObj.tipoUsuario);
			}else if(resObj.tipoUsuario==99){
				statusLogin('Usuário não Cadastrado!');
			}else if(resObj.tipoUsuario==98){
				statusLogin('Senha inválida!!');
			}
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

function direcionaPagina(tipoUsuario) {
	if (tipoUsuario === "1") {
		navegaPagina("/visao/coordenador/homeCoordenador.php");
	} else if (tipoUsuario === "2") {
		navegaPagina("/visao/professor/homeProfessor.php");
	} else if (tipoUsuario === "3") {
		navegaPagina("/visao/aluno/homeAluno.php");
	}
}

function navegaPagina(pagina) {
	window.location.href = pagina;
}
</script>
