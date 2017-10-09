<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/controle/ControleUsuario.class.php";

	if (!empty($_POST['alterarStatusId'])) {
		$uControle = new ControleUsuario();
		$uControle->modificarStatusUsuario($_POST['alterarStatusId']);
		return;
	}

	include_once $_SERVER["DOCUMENT_ROOT"]."/modelo/TipoUsuario.class.php";
	$uControle = new ControleUsuario();
	$tipoUsuario = new TipoUsuario();

	$usuarios = $uControle->consultar();
	
?>
<script>
	function modificaStatus(id) {
		$.ajax({
			type: "POST",
			url: '/visao/coordenador/lstUsuario.php',
			data: 'alterarStatusId=' + id
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
	$(document).ready(function () {
		$('.btn-filter').on('click', function () {
			var $target = $(this).data('target');
			if ($target != 'todos') {
				$('.table tr').css('display', 'none');
				$('.table tr[data-status="topo"]').fadeIn('slow');
				$('.table tr[data-status="' + $target + '"]').fadeIn('slow');
			} else {
				$('.table tr').css('display', 'none').fadeIn('slow');
			}
		});

	});
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
	$('button').on('click', function() {
		$('button').removeClass('selected');
		$(this).addClass('selected');
	});
</script>
<div class="container">
	<div class="row">
		<div class="col-mx-auto">
			<h1 class="titulo col-sm-12">Lista de Usuários</h1>
			
			<!--<input class="col-sm-12" type="text" id="myInput" onkeyup="procuraNomes()" placeholder="Procure por um nome..." title="A busca realizada incluirá usuários de todos os tipos">-->

			<div class="form-group row">
                <label for="nome" class="col-sm-12 col-md-5 col-form-label">Filtro por tipo:</label>
                <div class="col-sm-12 col-md-7">
					<div class="btn-group  col-ml-auto" role="group" aria-label="Tipos de Usuário">
						<button type="button" class="btn btn btn-outline-default btn-filter selected" data-target="todos">Todos</button>
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
?>
					<tr data-status="<?php echo $usuario->getTipoUsuario_id();?>">
						<td scope="row"><?php echo $usuario->getSiapeMatricula();?></td>
						<td scope="row"><?php echo $usuario->getNome();?></td>
						<td scope="row" class="un"><?php echo $tipoUsuario->getUmTipoUsuario($usuario->getTipoUsuario_id());?></td>
<?php
					if($uControle->usuarioPodeSerDesativado($usuario->getId())) {
?>
						<td class="un2">
							<label class="switch">
								<input type="checkbox" onclick="modificaStatus(<?php echo $usuario->getId();?>)" <?php if ($usuario->isAtivo()) echo 'checked';?>>
								<span class="slider round"></span>
							</label>
						</td>
					</tr>
<?php
					}else {
?>
						<td class="un2">Ativo</td>
<?php
					}
				}
?>
					</tr>
			</table>
<?php
			}
?>
			</div>
		</div>
	</div>
</div>