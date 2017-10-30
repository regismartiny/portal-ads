<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header('Location: /controle/logout.php');
		return;
	}

	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleNoticia.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";
	
	$nControle = new ControleNoticia();

	if (!empty($_POST['alterarStatusId'])) {
		$dados = clearArray($_POST);
		$nControle->modificarStatusNoticia($dados['alterarStatusId']);
	}

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
					echo "<tr><th scope='row'>".$noticia->id."</th>";
					echo "<td><a href='/visao/professor/editaNoticia.php?idNoticia=".$noticia->id."'>".$noticia->titulo."</td>";
					echo "<td>".$noticia->dataCadastro."</td>";
					if($noticia->status == 0){
						echo "<td>Aguardando</td>";
					}else if($noticia->status == 1){
						echo "<td>Aprovado</td>";
					}else{
						echo "<td>Reprovado</td>";
					}

				}
				echo "</table>";
			}
		?>
	</div>
</div>

<script>
	function modificarStatus(id) {
		$.ajax({
			type: 'POST',
			url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>',
			data: 'alterarStatusId=' + id
		});
	}
</script>
