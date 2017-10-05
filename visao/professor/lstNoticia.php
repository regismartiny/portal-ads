<?php
	session_start();

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaNoticia.class.php";
	$nControle = new ControleNoticia();
	$categoriaNoticia = new CategoriaNoticia();

	$noticias = $nControle->minhasNoticias($_SESSION['usuario_id']);
	
?>
<html lang='pt-br'>
	
	<head>
		<meta charset='utf-8'>
		<title>Minhas Notícias</title>
	</head>
	<style>
		.switch {
		position: relative;
		display: inline-block;
		width: 60px;
		height: 34px;
		}

		
		.switch input {display:none;}

		
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
					echo "<div class='form-group row'><h1 class='col-sm-12 col-form-label'>Minhas Notícias:</h1></div>";
					if($noticias!=false){
						echo "<table class='table table-hover'>
								<thead>
									<tr>
									<th>Matricula</th>
									<th>Nome</th>
									<th>Tipo</th>
									<th>Status</th>
									</tr>
								</thead>";
						foreach($noticias as $noticia){
							echo "<tr><th scope='row'>".$noticia->getId()."</th>";
							echo "<td>".$noticia->getTitulo()."</td>";
							echo "<td>".$noticia->getDataPublicacao()."</td>";
							if($noticia->getStatus()==1){
								echo "<td><label class='switch'><input type='checkbox' checked><span class='slider round'></span></label><td>";
							}else{
								echo "<td><label class='switch'><input type='checkbox' ><span class='slider round'></span></label><td>";
							}

						}
						echo "</table>";
					}
				?>
			</div>
		</div>
	</body>
</html>
