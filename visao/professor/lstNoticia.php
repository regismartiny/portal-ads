<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
	}
	else{
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
	}
	
?>
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
