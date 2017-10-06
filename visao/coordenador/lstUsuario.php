<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
	$uControle = new ControleUsuario();
	$tipoUsuario = new TipoUsuario();

	$usuarios = $uControle->consultar();
	
?>
<script>
	function modificaStatus(id) {
		$.ajax({
			type: "POST",
			url: 'modificarStatusUsuario.php',
			data: "id="+id,
		});
	}
	function procuraNomes() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("myInput");
		filter = input.value.toUpperCase();
		table = document.getElementById("tabelaUsuarios");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[1];
			if (td) {
				if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
					tr[i].style.display = "";
				} else {
					tr[i].style.display = "none";
				}
			}       
		}
	}
</script>
<div class="row">
	<div class="col mx-auto">
		<h1 class="titulo">Lista de Usuários</h1>
		
		<input type="text" id="myInput" onkeyup="procuraNomes()" placeholder="Procure por um nome..." title="Digite um nome">


		
		<?php
			if($usuarios!=false){
		?>
			<table id="tabelaUsuarios" class="table table-responsive table-hover">
				<thead>
					<tr>
						<th>Matricula</th>
						<th>Nome</th>
						<th>Tipo</th>
						<th>Status</th>
					</tr>
				</thead>
			<?php
				foreach($usuarios as $usuario){
			?>
					<tr>
						<td scope="row"><?php echo $usuario->getSiapeMatricula();?></td>
						<td scope="row"><?php echo $usuario->getNome();?></td>
						<td scope="row"><?php echo $tipoUsuario->getUmTipoUsuario($usuario->getTipoUsuario_id());?></td>
				<?php
					if($usuario->getStatus()==1){
				?>
						<td>
							<label class="switch">
								<input type="checkbox" onclick=modificaStatus(<?php echo $usuario->getId();?>) checked>
								<span class="slider round"></span>
							</label>
						<td>
				<?php
					}else{
				?>
						<td>
							<label class='switch'>
							<input type="checkbox" onclick=modificaStatus(<?php echo $usuario->getId();?>)>
							<span class="slider round"></span>
							</label>
						<td>
					</tr>
			<?php
					}
				}
			?>
			</table>
		<?php
			}
		?>
	</div>
</div>
