<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header('Location: /controle/logout.php');
		return;
	}

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
	
	$nControle = new ControleProjeto();

	$projetos = $nControle->meusProjetos($_SESSION['matricula']);
?>
	<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Meus Projetos</h2>
		<?php
			if($projetos!=false){
				echo "<table class='table table-hover'>
						<thead>
							<tr>
							<th>Número</th>
							<th>Título</th>
							<th>Data da Publicação</th>
							<th>Status</th>
							</tr>
						</thead>";
				foreach($projetos as $projeto){
					//print_r($projeto);	
					echo "<tr class='clickable-row' data-href=$projeto->id><th scope='row'>".$projeto->id."</th>";
					echo "<td>$projeto->titulo</td>";
					echo "<td>$projeto->dataCadastro</td>";
					if($projeto->status == 0){
						echo "<td>Aguardando</td>";
					}else if($projeto->status == 1){
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
			window.location = "/visao/index.php#/visao/professor/editaProjeto.php?idProjeto="+$(this).data("href");
		});
	});
</script>
