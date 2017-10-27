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
	<div class="col mx-auto">
		<h2 class="titulo">Minhas Notícias</h2>
		<?php if($noticias != false) { ?>
			<table class='table table-hover'>
				<thead>
					<tr>
						<th>Número</th>
						<th>Titulo</th>
						<th>Data da Publicação</th>
						<th>Status</th>
					</tr>
				</thead>
			<?php foreach($noticias as $noticia) {
				//print_r($noticia);	
				$ativa = $noticia->status == 1 
			?>
				<tr>
					<th scope='row'><?php echo $noticia->id ?></th>
					<td><a href='/visao/professor/editaNoticia.php?idNoticia="<?php echo $noticia->id ?>"'><?php echo $noticia->titulo ?></td>
					<td><?php echo $noticia->dataCadastro ?></td>					
					<td>
						<label class='switch'>
							<input type='checkbox' onclick="modificarStatus(<?php echo $noticia->id ?>)"<?php if($ativa) echo ' checked' ?>>
							<span class='slider round'></span>
						</label>
					</td>
				</tr>
			<? } ?>
			</table>
		<?php } ?>
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
