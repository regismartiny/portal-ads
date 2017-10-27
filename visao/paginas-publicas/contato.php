<div class="row">
	<div class="col mx-auto">
        <h2 class="titulo">Contato</h2>
        <form id="ajax-form" method="post" action="/controle/processaEnvioEmail.php">
            <div class="form-group row">
                <label for="categoria" class="col-sm-12 col-md-4 col-form-label">Tipo de mensagem:</label>
                <div class="col-sm-12 col-md-8">
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="Categoria 1">Categoria 1</option>
                    <option value="Categoria 2">Categoria 2</option>
                    <option value="Categoria 3">Categoria 3</option>
                </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nome" class="col-sm-12 col-md-4 col-form-label">Seu nome</label>
                <div class="col-sm-12 col-md-8">
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-sm-12 col-md-4 col-form-label">Seu e-mail</label>
                <div class="col-sm-12 col-md-8">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="mensagem" class="col-sm-12 col-md-4 col-form-label">Digite sua mensagem</label>
                <div class="col-sm-12 col-md-8">
                    <textarea class="form-control" rows="3" id="mensagem" name="mensagem" cols="50" required></textarea>
                </div>
            </div>
            <div id="result" class="status"></div>
            <br>
            <div class="form-group row">
                <div class="col-sm-12 col-md-6 mx-auto">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="enviar" value="Enviar">
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
			},
			error: function(response) {
				console.log(response);
				printaMensagem(mensagem);
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
