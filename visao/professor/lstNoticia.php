<?php
	session_start();
	if (isset($_SESSION['ultima_atividade']) && (time() - $_SESSION['ultima_atividade'] > 5)) {

		// última atividade foi mais de 60 minutos atrás
		session_unset();     // unset $_SESSION  
		session_destroy();   // destroindo session data 
	}
	$_SESSION['ultima_atividade'] = time(); // update da ultima atividade


	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaNoticia.class.php";
	$nControle = new ControleNoticia();
	$categoriaNoticia = new CategoriaNoticia();

	$noticias = $nControle->minhasNoticias($_SESSION['matricula']);
	
?>
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
<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Minhas Notícias</h2>
		<?php
			if($noticias!=false){
				echo "<table class='table table-hover'>
						<thead>
							<tr>
							<th>Número</th>
							<th>Titulo</th>
							<th>Data da Publicação</th>
							<th>Status</th>
							</tr>
						</thead>";
				foreach($noticias as $noticia){
					//print_r($noticia);	
					echo "<tr><th scope='row'>".$noticia->id."</th>";
					echo "<td><a href='/visao/professor/editaNoticia.php?idNoticia=".$noticia->id."'>".$noticia->titulo."</td>";
					echo "<td>".$noticia->dataCadastro."</td>";
					if($noticia->status == 1){
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
