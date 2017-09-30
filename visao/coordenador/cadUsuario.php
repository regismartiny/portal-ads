<html lang='pt-br'>
	<head>
		<meta charset='utf-8'>
		<title>Cadastro de Usuarios</title>
	</head>
		
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<div >
					<form id="ajax-form" method='post' action=''>
						<div class="form-group row">
							<h1 class="col-sm-12 col-form-label">Cadastro de Usuários:</h1>
						</div>
						<div class="form-group row">
							<label for="nome" class="col-sm-4 col-form-label">Nome Completo:</label>
							<div class="col-sm-8">
							  <input type="text" class="form-control" id="nome" name='nome' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="matricula" class="col-sm-4 col-form-label">Matricula / SIAPE:</label>
							<div class="col-sm-8">
							  <input type="number" class="form-control" id="matricula" name='matricula' required>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-4 col-form-label">E-mail (Opcional):</label>
							<div class="col-sm-8">
							  <input type="email" class="form-control" id="email" name='email'>
							</div>
						</div>
						<div id="result" class="status"></div>
						<br>
						
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Adicionar'>
						<a class='btn btn-danger btn-lg btn-block' href='#'>Cancelar</a>
					</form>
					
				</div>
			</div>
		</div>
	</body>
	<script>
		$("#ajax-form").submit(function(event) {
			event.preventDefault();
			
			statusProcessando();
			
			$.ajax({
				type: "POST",
				url: "processaCadUsuario.php",
				data: $("#ajax-form").serialize(),
				success: function(response) {
				
					console.log(response);
					let resObj = JSON.parse(response);
					let mensagem = resObj.mensagem;
					printaMensagem(mensagem);
				},
				error: function(response) {
					console.log(response);
					printaMensagem('Erro no envio do formulário');
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
	</script>
</html>
