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
			<div class="text-center">
				<input type="submit" class="btn btn-primary btn-lg" name="login" value="Login" />
				<a href="esqueciSenha.html" class="btn btn-danger btn-lg">Esqueci Minha Senha</a>
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
			statusLogin('Login OK');
			console.log(response);
			let resObj = JSON.parse(response);
			if (resObj.tipoUsuario) {
				direcionaPagina(resObj.tipoUsuario);
			}else{
				statusLogin('Login inválido!');
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
		navegaPagina("/visao/coordenador/homeCoordenador.html");
	} else if (tipoUsuario === "2") {
		navegaPagina("/visao/professor/homeProfessor.html");
	} else if (tipoUsuario === "3") {
		navegaPagina("/visao/aluno/homeAluno.html");
	}
}

function navegaPagina(pagina) {
	window.location.href = pagina;
}
</script>