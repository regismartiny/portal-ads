<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
	$uControle = new ControleUsuario();
	$usuarios = $uControle->consultar();
?>
<html lang='pt-br'>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<meta charset='utf-8'>
		<title>Listagem de Usuarios</title>
	</head>
	<style>
		#container {
			margin-top: 100px;
		}
	</style>
	<body>
		<div class='container-fluid' id="container">
			<div class="row justify-content-center" style='height:100%;'>
				<?php
					if($usuarios!=false){
						echo "<table class='table table-hover'>
								<thead>
									<tr>
									<th>Matricula</th>
									<th>Nome</th>
									<th>Status</th>
									</tr>
								</thead>";
						foreach($usuarios as $usuario){
							echo "<tr><th scope='row'>".$usuario->getSiapeMatricula()."</th>";
							echo "<td>".$usuario->getNome()."</td>";
							if($usuario->getStatus()==1){
								echo "<td>".$usuario->getStatus()."</td></tr>";
							}else{
								echo "<td>".$usuario->getStatus()."</td></tr>";
							}

						}
						echo "</table>";
					}
				?>
			</div>
		</div>
	</body>
</html>
