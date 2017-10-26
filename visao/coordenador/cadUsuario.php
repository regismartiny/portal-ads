<?php 
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=1 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
	}
?>
<div class="row">
	<div class="col mx-auto">
		<h1 class="titulo">Cadastro de Usuários</h1>
		<form id="ajax-form" method="post" action="/controle/processaCadUsuario.php">
			<div class="form-group row">
				<label for="nome" class="col-12 col-md-5 col-form-label">Nome Completo</label>
				<div class="col-12 col-md-7">
					<input type="text" class="form-control" id="nome" name="nome" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="matricula" class="col-12 col-md-5 col-form-label">Matrícula / SIAPE</label>
				<div class="col-12 col-md-7">
					<input type="number" class="form-control" id="matricula" name="matricula" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="email" class="col-12 col-md-5 col-form-label">E-mail (Opcional)</label>
				<div class="col-12 col-md-7">
					<input type="email" class="form-control" id="email" name="email">
				</div>
			</div>
			<div id="result" class="status"></div>
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type="submit" class="btn-login btn btn-primary btn-lg btn-block" name="botao" value="Adicionar" />
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">
					<input type="reset" class="btn btn-danger btn-lg btn-block" value="Limpar">
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
			type: "POST",
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(response) {
				console.log(response);			
				let resObj = JSON.parse(response);
				let mensagem = resObj.mensagem;
				let sucesso = resObj.sucesso;
				printaMensagem(mensagem);
				if(sucesso==true){
					navegaPagina("/visao/coordenador/lstUsuario.php");
				}
			},
			error: function(response) {
				console.log(response);
				printaMensagem("Erro no envio do formulário");
			}
		});
	});

	function statusProcessando() {
		$("#result").html("Processando...");
		$("#result").fadeIn(400);
	}
	function printaMensagem(status) {
		$("#result").html(status);
	}
	function navegaPagina(pagina) {
		window.location.hash = pagina;
	}
</script>