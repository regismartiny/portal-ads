<div class="row">
	<div class="col mx-auto">
		<h1 class="titulo">Troca de Senha</h1><br><br>
		<form id="form" method="post" action="/controle/trocaSenha.php">
						
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha Antiga:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senhaAntiga " name="senhaAntiga" required>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label">Senha Nova:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="senhaNova" name="senhaNova" required>
							</div>
						</div>

						<div class="form-group row">
							<label for="senha" class="col-sm-5 col-md-5 col-form-label"> Confirmação de Senha:</label>
							<div class="col-sm-7 col-md-7">
								<input type="password" class="form-control" id="confSenha" name="confSenha" required>
							</div>
						</div>						
			
			
			<div id="result" class="status"></div>
			
				
			<br>
			<div class="row">
			
			
				<div class="col-xs-12 col-sm-12 col-md-4">
					<input type='submit' class='btn btn-primary btn-lg btn-block' name='login' value='Trocar Senha'>
				</div>
				
				
				<div class="col-xs-12 col-sm-12 col-md-8">
					<a href="/visao/index.php" class="btn btn-danger btn-lg btn-block">Cancelar</a>
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
			
			if(resObj.tipoUsuario==99){
				statusLogin('Usuário não Cadastrado!');
			}else if(resObj.tipoUsuario==98){
				statusLogin('Senha Antiga inválida!!');
			}else if(resObj.tipoUsuario==96){
				statusLogin('Troca de Senha Efetuada!');
				direcionaPagina(resObj.tipoUsuario);
			}else if(resObj.tipoUsuario==97){
				statusLogin('Senha Antiga inválida!!');
			}else if(resObj.tipoUsuario==95){
				statusLogin('Confirmação de senha inválida!!');
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
	//if (tipoUsuario == 96) {
	//	navegaPagina("/visao/index.php");
	//} else if (tipoUsuario === "2") {
	//	navegaPagina("/visao/professor/homeProfessor.php");
	//} else if (tipoUsuario === "3") {
	//	navegaPagina("/visao/aluno/homeAluno.php");
	//}
}

function navegaPagina(pagina) {
	window.location.href = pagina;
}
</script>
