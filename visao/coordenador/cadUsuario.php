<?php
	function inserirTipoUsuarioNoCombo(){
		include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
		
		$tipoUsuario = new TipoUsuario(null,null);
		$tiposUsuarios = $tipoUsuario->getTipoUsuario();
		$returnTipoUsuarios = "";
		foreach($tiposUsuarios as $row => $arrayInterno){
			$tipoUsuario = new TipoUsuario($arrayInterno['id'],$arrayInterno['descricao']);
			$returnTipoUsuarios = $returnTipoUsuarios."<option value=".$arrayInterno['id'].">".$arrayInterno['descricao']."</option>";
		}
		return $returnTipoUsuarios;
	}	
?>
<html lang='pt-br'>
	<head>
		<meta charset='utf-8'>
		<title>Cadastro de Usuarios</title>
		<<script>
		$("#ajax-form").submit(function(e) {
			$.ajax({
				type: "POST",
				url: "mailer.php",
				data: $("#ajax-form").serialize(),
				success: function(data)
				{
					alert(data); // show response from the php script.
				}
			});
			e.preventDefault(); // avoid to execute the actual submit of the form.
		})
		</script>
	</head>
	<style>
		#container {
			margin-top: 100px;
		}
	</style>
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
						<div class="form-group row">
							<label for="categoria" class="col-sm-4 col-form-label">Tipo:</label>
							<div class="col-sm-8">
								<select class="col custom-select" id="tipoUsuario_id" name="tipoUsuario_id" required>
									<?php 
									echo inserirTipoUsuarioNoCombo();
									?>
								</select>
							</div>
						</div>
						<div id="form-messages"></div>
						<input type='submit' class='btn btn-primary btn-lg btn-block' name='botao' value='Adicionar'>
						<a class='btn btn-danger btn-lg btn-block' href='#'>Cancelar</a>
					</form>
					
				</div>
			</div>
		</div>
	</body>
</html>
