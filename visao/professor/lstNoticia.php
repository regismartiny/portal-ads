<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header('Location: /controle/logout.php');
		return;
	}

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
	
	$nControle = new ControleNoticia();

	$noticias = $nControle->minhasNoticias($_SESSION['matricula']);
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
					echo "<tr class='clickable-row' data-href=$noticia->id><th scope='row'>".$noticia->id."</th>";
					echo "<td>$noticia->titulo</td>";
					echo "<td>$noticia->dataCadastro</td>";
					if($noticia->status == 0){
						echo "<td>Aguardando</td>";
					}else if($noticia->status == 1){
						echo "<td>Aprovado</td>";
					}else{
						echo "<td>Reprovado</td>";
					}
					echo "</td>";
				}
				echo "</table>";
			}
		?>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		$(".clickable-row").click(function() {
			console.log($(this).data("href"));
			window.location = "/visao/index.php#/visao/professor/editaNoticia.php?idNoticia="+$(this).data("href");
		});
	});
</script>
