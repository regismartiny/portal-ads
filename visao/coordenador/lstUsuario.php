<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
	$uControle = new ControleUsuario();
	$tipoUsuario = new TipoUsuario();

	$usuarios = $uControle->consultar();
	
?>
<html lang='pt-br'>
	<script>
		function modificaStatus(id) {
			$.ajax({
				type: "POST",
				url: 'modificarStatusUsuario.php',
				data: "id="+id,
			});
		}
	</script>
	<head>
		<meta charset='utf-8'>
		<title>Listagem de Usuarios</title>
	</head>
	<style>
		/* The switch - the box around the slider */
		.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		}

		/* Hide default HTML checkbox */
		.switch input {display:none;}

		/* The slider */
		.slider {
		position: absolute;
		cursor: pointer;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		background-color: #ccc;
		-webkit-transition: .4s;
		transition: .4s;
		}

		.slider:before {
		position: absolute;
		content: "";
		height: 26px;
		width: 26px;
		left: 4px;
		bottom: 4px;
		background-color: white;
		-webkit-transition: .4s;
		transition: .4s;
		}

		input:checked + .slider {
		background-color: #2196F3;
		}

		input:focus + .slider {
		box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		-webkit-transform: translateX(26px);
		-ms-transform: translateX(26px);
		transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		border-radius: 34px;
		}

		.slider.round:before {
		border-radius: 50%;
		}
	</style>
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<?php
					echo "<div class='form-group row'><h1 class='col-sm-12 col-form-label'>Lista de Usuários:</h1></div>";
					if($usuarios!=false){
						echo "<table class='table table-hover'>
								<thead>
									<tr>
									<th>Matricula</th>
									<th>Nome</th>
									<th>Tipo</th>
									<th>Status</th>
									</tr>
								</thead>";
						foreach($usuarios as $usuario){
							echo "<tr><th scope='row'>".$usuario->getSiapeMatricula()."</th>";
							echo "<td>".$usuario->getNome()."</td>";
							echo "<td>".$tipoUsuario->getUmTipoUsuario($usuario->getTipoUsuario_id())."</td>";
							if($usuario->getStatus()==1){
								//echo "<td>".$usuario->getStatus()."</td></tr>";
								echo "<td><label class='switch'><input type='checkbox' onclick='modificaStatus(".$usuario->getId().")' checked><span class='slider round'></span></label><td>";
							}else{
								echo "<td><label class='switch'><input type='checkbox' onclick='modificaStatus(".$usuario->getId().")'><span class='slider round'></span></label><td>";
							}

						}
						echo "</table>";
					}
				?>
			</div>
		</div>
	</body>
</html>
