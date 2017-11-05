<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=1 || !isset($_COOKIE["702741445"])){
		header('Location: /controle/logout.php');
		return;
	}

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
	
	$nControle = new ControleNoticia();

	$noticias = $nControle->listarPaginado(1,10);
?>
<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Notícias</h2>
		<?php
			if($noticias!=false){
				echo "<table class='table table-hover'>
						<thead>
							<tr>
							<th>Titulo</th>
							<th>Data da Publicação</th>
							<th></th>
							<th>Status</th>
							</tr>
						</thead>";
				foreach($noticias as $noticia){
					//echo "<tr class='clickable-row' data-href=$noticia->id>";
					echo "<tr>";
					echo "<td class='clickable-row' data-href=$noticia->id scope='row'>$noticia->titulo</td>";
					echo "<td class='clickable-row' data-href=$noticia->id scope='row' align='center'>$noticia->dataCadastro</td>";
					echo "<td class='clickable-delete' data-href=$noticia->id scope='row' bgcolor='RED'>Remover</td>";
					
					if($noticia->status == 0){
						echo "<td bgcolor='BLUE'>Aguardando</td>";
					}else if($noticia->status == 1){
						echo "<td bgcolor='GREEN'>Aprovado</td>";
					}else{
						echo "<td bgcolor='ORANGE'>Reprovado</td>";
					}
					echo "</tr>";
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
		
		$(".clickable-delete").click(function() {
			console.log($(this).data("href"));
			window.location = "/visao/index.php#/controle/processaRemoveNoticia.php?idNoticia="+$(this).data("href");
		});
	});
	
</script>
