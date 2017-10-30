<?php
	session_start();
	if (!isset($_SESSION["tipoUsuario"]) || $_SESSION["tipoUsuario"] != 1 || !isset($_COOKIE["702741445"])){
		header('Location: /controle/logout.php');
		return;
	}
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/Util.php";

	$uControle = new ControleUsuario();

	if (!empty($_POST['alterarStatusId'])) {
		$dados = clearArray($_POST);
		$uControle->modificarStatusUsuario($dados['alterarStatusId']);
		return;
	}

	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
	
	$tipoUsuario = new TipoUsuario();
	$usuarios = $uControle->consultar();
?>
<script>
	var filtroTipo = 0;
	var filtroNome = '';
	$(document).ready(function () {
		$('.btn-filter').on('click', function () {
			filtroTipo = $(this).data('target');
			filtroTipoEProcuraNomes();
			
		});
		$('button').on('click', function() {
			$('button').removeClass('selected');
			$(this).addClass('selected');
		});
		$('#myInput').on('keyup', function() {
			filtroNome = $(this).val();
			filtroTipoEProcuraNomes();
		});
	});
	function modificaStatus(id) {
		$.ajax({
			type: 'POST',
			url: '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>',
			data: 'alterarStatusId=' + id
		});
	}

	function filtroTipoEProcuraNomes() {
		filtroNomeUpper = filtroNome.toUpperCase();
		var jsonArrayUsuarios = <?php echo json_encode($usuarios); ?>;
		var arrayIntermediario = [];
		var arrayFiltrado = [];
		for (var indice in jsonArrayUsuarios) {
			if (jsonArrayUsuarios.hasOwnProperty(indice)) {
				var usuario = jsonArrayUsuarios[indice];
				if (filtroTipo == 2) {
					if(usuario.tipoUsuario_id == 2) {
						arrayIntermediario.push(usuario);
					}
				}else if(filtroTipo == 3){
					if(usuario.tipoUsuario_id == 3) {
						arrayIntermediario.push(usuario);
					}
				}else{
					arrayIntermediario = jsonArrayUsuarios;
				}
			}
		}
		for(var indice in arrayIntermediario){
			if (arrayIntermediario.hasOwnProperty(indice)) {
				var usuario = arrayIntermediario[indice];
				if(usuario.nome.toUpperCase().indexOf(filtroNomeUpper) > -1){
					arrayFiltrado.push(usuario);
				}
			}
		}
		renderizarTabela(arrayFiltrado);
	}
	
	function renderizarTabela(arrayFiltrado) {
		var divTabela = $("#tabelaUsuarios");
		
		
		var tabelaAtualizada = "<table id='tabelaUsuarios' class='table table-hover'><thead><tr data-status='topo'><th onclick='sortTable(0)'>Matrícula</th><th onclick='sortTable(1)'>Nome</th><th onclick='sortTable(2)' class='un'>Tipo</th><th onclick='sortTable(3)' class='un2'>Status</th></tr></thead>";

		divTabela.html(tabelaAtualizada);
	}

	function sortTable(n) {
		var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
		table = document.getElementById("tabelaUsuarios");
		switching = true;
		//Set the sorting direction to ascending:
		dir = "asc"; 
		/*Make a loop that will continue until
		no switching has been done:*/
		while (switching) {
			//start by saying: no switching is done:
			switching = false;
			rows = table.getElementsByTagName("TR");
			/*Loop through todos table rows (except the
			first, which contains table headers):*/
			for (i = 1; i < (rows.length - 1); i++) {
				//start by saying there should be no switching:
				shouldSwitch = false;
				/*Get the two elements you want to compare,
				one from current row and one from the next:*/
				x = rows[i].getElementsByTagName("TD")[n];
				y = rows[i + 1].getElementsByTagName("TD")[n];
				/*check if the two rows should switch place,
				based on the direction, asc or desc:*/
				if (dir == "asc") {
					if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
						//if so, mark as a switch and break the loop:
						shouldSwitch= true;
						break;
					}
				} else if (dir == "desc") {
					if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
						//if so, mark as a switch and break the loop:
						shouldSwitch= true;
						break;
					}
				}
			}
			if (shouldSwitch) {
				/*If a switch has been marked, make the switch
				and mark that a switch has been done:*/
				rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
				switching = true;
				//Each time a switch is done, increase this count by 1:
				switchcount ++;      
			} else {
				/*If no switching has been done AND the direction is "asc",
				set the direction to "desc" and run the while loop again.*/
				if (switchcount == 0 && dir == "asc") {
					dir = "desc";
					switching = true;
				}
			}
		}
	}
	jQuery(document).ready(function($) {
		$(".clickable-row").click(function() {
			console.log($(this).data("href"));
			window.location = $(this).data("href");
		});
	});
</script>
<div class="row">
	<div class="col mx-auto">
		<h2 class="titulo">Lista de Usuários</h2>
		
		<input class="col-sm-12" type="text" id="myInput" placeholder="Procure por um nome..." title="A busca realizada incluirá usuários de todos os tipos">

		<div class="form-group row">
			<label for="nome" class="col-sm-12 col-md-5 col-form-label">Filtro por tipo</label>
			<div class="col-sm-12 col-md-7">
				<div class="btn-group  col-ml-auto" role="group" aria-label="Tipos de Usuário">
					<button type="button" class="btn btn btn-outline-default btn-filter selected" data-target="0">Todos</button>
					<button type="button" class="btn btn btn-outline-default btn-filter" data-target="3">Alunos</button>
					<button type="button" class="btn btn btn-outline-default btn-filter" data-target="2">Professores</button>
				</div>
			</div>
		</div>
		<div class="row">

<?php
	if($usuarios != false) {
?>
			<table id="tabelaUsuarios" class="table table-hover">
				<thead>
					<tr data-status="topo">
						<th onclick="sortTable(0)">Matrícula</th>
						<th onclick="sortTable(1)">Nome</th>
						<th onclick="sortTable(2)" class="un">Tipo</th>
						<th onclick="sortTable(3)" class="un2">Status</th>
					</tr>
				</thead>
<?php
		foreach($usuarios as $usuario) {
			$tipoUsuario = new TipoUsuario($usuario->getTipoUsuario_id());
			$tipoUsuario->listarUm();
			$descricaoTipo = $tipoUsuario->getDescricao();
			$idTipo = $tipoUsuario->getId();
?>
				<tr class='clickable-row' data-href='/visao/index.php#/visao/coordenador/editaUsuario.php?id=<?php echo $usuario->getId();?>' data-tipo = "<?php echo $idTipo; ?>" data-status="<?php echo $usuario->getTipoUsuario_id();?>">
					<td scope="row"><?php echo $usuario->getSiapeMatricula();?></td>
					<td scope="row"><?php echo $usuario->getNome();?></td>
					<td scope="row" class="un"><?php echo $descricaoTipo;?></td>
<?php
			if($uControle->usuarioPodeSerDesativado($usuario->getId())) {
?>
					<td class="un2">
						<label class="switch">
							<input type="checkbox" onclick="modificaStatus(<?php echo $usuario->getId();?>)" <?php if ($usuario->isAtivo()) echo 'checked';?>>
							<span class="slider round"></span>
						</label>
					</td>
<?php
			}else {
?>
					<td class="un2">Ativo</td>
<?php
			}
?>
				</tr>
<?php
		}
?>
			</table>
<?php
	}
?>
		</div>
	</div>
</div>