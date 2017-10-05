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
</script>
<div class="row">
	<div class="col mx-auto">
		<div class="form-group row">
			<h1 class="col-sm-12 col-form-label">Lista de Usuários</h1>
		</div>
		<?php
			if($usuarios!=false){
		?>
			<table class="table table-hover">
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
