<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"]!=2 || !isset($_COOKIE["702741445"])){
		header( 'Location: /controle/logout.php' );
	}
	else{
		include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleProjeto.class.php";
		//include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/CategoriaProjeto.class.php";
		$nControle = new ControleProjeto();
		//$categoriaProjeto = new CategoriaProjeto();

		$projetos = $nControle->meusProjetos($_SESSION['matricula']);
	}
	
?>
<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Meus Projetos</h2>
		<?php
			if($projetos!=false){
				echo "<table class='table table-hover'>
						<thead>
							<tr>
							<th>Titulo</th>
							<th>Data da Publicação</th>
							<th>Status</th>
							</tr>
						</thead>";
				foreach($projetos as $projeto){
					//print_r($projeto);	
					echo "<tr><th scope='row'>".$projeto->id."</th>";
					echo "<td><a href='/visao/professor/editaProjeto.php?idProjeto=".$projeto->id."'>".$projeto->titulo."</td>";
					echo "<td>".$projeto->dataCadastro."</td>";
					if($projeto->status == 1){
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
