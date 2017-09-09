<div class="row justify-content-center">
    
    <div class="col-5">
        <h1 class="titulo">Acesso Restrito</h1><br><br>    
        <form id="form" method="post" action="/controle/auth.php">
            <div class="form-group row">
                <label for="matricula" class="col-sm-4 col-md-4 col-form-label">Matrícula / SIAPE:</label>
                <div class="col-sm-10 col-md-8">
                    <input type="text" class="form-control" id="matricula" name="matricula" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="senha" class="col-sm-4 col-md-4 col-form-label">Senha:</label>
                <div class="col-sm-10 col-md-8">
					<input type="password" class="form-control" id="senha" name="senha" required>
                </div>
            </div>
            <input type="submit" class="btn btn-primary btn-lg btn-block" name="login" value="Login"/>
			<a href="esquecisenha.html" class="btn btn-danger btn-lg btn-block">Esqueci Minha Senha</a>
			<div id="loader" style="display:none;">Processando...</div>
			<div id="result"></div>
        </form>
    </div>
</div>
<script>
    $("#form").submit(function(event) {
		event.preventDefault();
		$form = $(this);

		$("#loader").show();

		$.ajax({
			type: "POST",
			url: $form.attr('action'),
			data: $form.serialize(),
			success: function(response) {
				$("#loader").fadeOut(400);
				console.log(response);
				let resObj = JSON.parse(response);
				if (resObj.tipoUsuario) {
					direcionaPagina(resObj.tipoUsuario);
				}
			},
			error: function(response) {
					console.log(response);
				$("#result").html('Erro no envio do formulário');
			}
		});
    });

	function direcionaPagina(tipoUsuario) {
		if (tipoUsuario === 1) {
            navegaPagina("/visao/coordenador/homeCoordenador.html");
        } else if (tipoUsuario === 2) {
            navegaPagina("/visao/professor/homeProfessor.html");
        } else if (tipoUsuario === 3) {
            navegaPagina("/visao/aluno/homeAluno.html");
        }
	}

	function navegaPagina(pagina) {
		window.location.href = pagina;
	}
</script>
