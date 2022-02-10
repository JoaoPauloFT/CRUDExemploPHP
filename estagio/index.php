<?php
	session_start();
	include_once("php_action/conexao.php");
	require "_classe/tabela.php";
	require "_classe/metodos.php";
	$metodos = new Metodos;
	$tabela = new Tabela;
	$pag = 0;
	if(isset($_POST["qntd_Pag"])){
		$pag = intval($_POST["qntd_Pag"]);
	}
	if (isset($_POST["busca"])) {
		$pesquisa = $_POST["busca"];
	} else {
		$pesquisa = "";
	}
?>
<html onload=''>
	<head>
		<script src="_css/jquery.min.js"></script>
		<script type="text/javascript">
			var campos = {
				idAluno: "",
				nome: "",
				matricula: "",
				anoEntrada: "",
				anoTermino: "",
				obs: "",
				idCurso: "",
			};
			function recolher(n1){
				campos.idAluno = document.getElementById("coluna_"+n1+"_0").innerHTML;
				campos.nome = document.getElementById("coluna_"+n1+"_1").innerHTML;
				campos.matricula = document.getElementById("coluna_"+n1+"_2").innerHTML;
				campos.idCurso = document.getElementById("coluna_"+n1+"_3").value;
				campos.anoEntrada = document.getElementById("coluna_"+n1+"_4").innerHTML;
				campos.anoTermino = document.getElementById("coluna_"+n1+"_5").innerHTML;
				campos.obs = document.getElementById("coluna_"+n1+"_6").innerHTML;
				document.getElementById("id_aluno").value = campos.idAluno;
				document.getElementById("nome").value = campos.nome;
				document.getElementById("matricula").value = campos.matricula;
				//$('#selcurso').val(campos.idCurso);
				//$('#selcurso').trigger('change');




				/*$('#selcurso').select2({
				    ajax: {
				        url: '/api/students'
				    }
				});
				var studentSelect = $('#selcurso');
				$.ajax({
				    type: 'GET',
				    url: '/api/students/s/' + studentId
				}).then(function (data) {
				    var option = new Option(data.full_name, data.id, true, true);
				    studentSelect.append(option).trigger('change');
				    studentSelect.trigger({
				        type: 'select2:select',
				        params: {
				            data: data
				        }
				    });
				});

				$('#selcurso').val(campos.idCurso);
				$('#selcurso').trigger('change.select2');*/




				document.getElementById("anoEntrada").value = campos.anoEntrada;
				document.getElementById("anoTermino").value = campos.anoTermino;
				document.getElementById("obs").value = campos.obs;
				document.getElementById("opcao_".concat(campos.idCurso)).selected = "selected";
			}
			/*$(document).ready(function() {
    			selectViaAjax("#selcurso", "curso", "nome", "id_curso");
			});*/
		</script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="_css/bootstrap.min.css">
		<link rel="stylesheet" href="_css/geral.css">
		<link href="_classe/select2.min.css" rel="stylesheet" />
		<script src="_classe/select2.min.js"></script>
 		<script src="_classe/metodosJS.js"></script>
 		<script src="_css/bootstrap.min.js"></script>
		<title>
			Estagio - Aluno
		</title>
	</head>
	<body id="tudo">
		<div id="interface">
			<header id="cabecalho">
				<nav class="navbar navbar-default">
			  	<div class="container-fluid">
				    <div class="navbar-header">
				    	<a class="navbar-brand" href="#">Estagio</a>
				    </div>
					<ul class="nav navbar-nav">
						<li class="active"><a href="index.php">Aluno</a></li>
						<li><a href="curso.php">Curso</a></li>
						<li><a href="empresa.php">Empresa</a></li>
						<li><a href="estatus.php">Estatus</a></li>
						<li><a href="empresa-estagio.php">Empresa Estagio</a></li>
						<li><a href="aluno-empresa-estagio.php">Aluno EE</a></li>
					</ul>
				</div>
			</nav>
		</header>
			<div id="info">
				<form id="form" action="php_action/processaAluno.php" method="POST">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input id="nome" class="form-control" type="text" name="nome">
						<input id="id_aluno" class="form-control" type="hidden" name="id_aluno">
						<label for="matricula">Matrícula:</label>
						<input id="matricula" class="form-control" type="number" name="matricula">
						<label for="anoEntrada">Ano de Entrada:</label>
						<input id="anoEntrada" class="form-control" type="number" name="anoEntrada">
						<label for="anoTermino">Previsão de Ano de Término:</label>
						<input id="anoTermino" class="form-control" type="number" name="anoTermino">
						<label for="obs">Observação:</label>
						<input id="obs" class="form-control" type="text" name="obs">
						<label for="curso">Curso:</label>
						<!-- <select class='js-example-basic-multiple form-control' id='selcurso' name='selCurso' size ='1'></select> -->
						<?php $metodos->criaLista("curso", "nome", "id_curso"); ?>
					</div>
					<table id="button">
						<tr>
							<td><input name="action" class="btn btn-default" type="button" value="Cadastrar" onclick="confirmacao('Cad')"/>&ensp; &ensp;</td>
							<td><input name="action" class="btn btn-default" type="button" value="Atualizar" onclick="confirmacao('Atualizar')"/>&ensp; &ensp;</td>
							<td><input name="action" class="btn btn-default" type="button" value="Deletar" onclick="confirmacao('Del')"/></td>
						</tr>
					</table>
					<br/>
					<div id = "hidden"/>
				</form>
			</div>
			<hr/>
			<form action="index.php" method="POST">
				<label>Pesquisar:</label>
				<input type="text" class="form-control" id="busca" name="busca"/><br/>
				<input type="submit" class="btn btn-default" name="action" value="Buscar"/>
			</form>
			<div #mostrarInfo>
				<object>
				<table class='table table-striped' id='tabela'>
					<thead>
						<tr>
							<th>ID Aluno</th>
							<th>Nome</th>
							<th>Matricula</th>
							<th>Curso</th>
							<th>Ano de Entrada</th>
							<th>Previsão de Ano de Termino</th>
							<th>Observação</th>
						</tr>
					</thead>
					<?php
						if($pesquisa == ""){
							$base = $pag * 10;
							$result_curso = "SELECT * FROM aluno LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM aluno";
							$resultado_count = mysqli_query($conn, $sql_count);
							$resultado_curso = mysqli_query($conn, $result_curso);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
						    $contador = 0;
							while ($campo=mysqli_fetch_array($resultado_curso)){
								 	$sql = "SELECT nome FROM curso WHERE id_curso = ".$campo["id_curso"];
									$resultado_sql = mysqli_query($conn, $sql);
									while ($curso=mysqli_fetch_array($resultado_sql)) {
									    $tabela->insere_linha($contador);
									    $tabela->insere_coluna($campo["id_aluno"],$contador,0);
									    $tabela->insere_coluna($campo["nome"],$contador,1);
									    $tabela->insere_coluna($campo["matricula"],$contador,2);
									    $tabela->insere_coluna2($curso[0],$contador,3,$campo["id_curso"]);
									    $tabela->insere_coluna($campo["ano_entrada"],$contador,4);
									    $tabela->insere_coluna($campo["ano_termino"],$contador,5);
									    $tabela->insere_coluna($campo["obs"],$contador,6);
									    $tabela->fecha_linha();
									    $contador++;
									}
							}
						} else {
							$base = $pag * 10;
							$result_curso = "SELECT * FROM aluno WHERE nome LIKE '$pesquisa' ORDER BY nome LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM aluno";
							$resultado_count = mysqli_query($conn, $sql_count);
							$resultado_curso = mysqli_query($conn, $result_curso);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
						    $contador = 0;
							while ($campo=mysqli_fetch_array($resultado_curso)){
								 	$sql = "SELECT nome FROM curso WHERE id_curso = ".$campo["id_curso"];
									$resultado_sql = mysqli_query($conn, $sql);
									while ($curso=mysqli_fetch_array($resultado_sql)) {
									    $tabela->insere_linha($contador);
									    $tabela->insere_coluna($campo["id_aluno"],$contador,0);
									    $tabela->insere_coluna($campo["nome"],$contador,1);
									    $tabela->insere_coluna($campo["matricula"],$contador,2);
									    $tabela->insere_coluna2($curso[0],$contador,3,$campo["id_curso"]);
									    $tabela->insere_coluna($campo["ano_entrada"],$contador,4);
									    $tabela->insere_coluna($campo["ano_termino"],$contador,5);
									    $tabela->insere_coluna($campo["obs"],$contador,6);
									    $tabela->fecha_linha();
									    $contador++;
									}
							}
						}
					?>
				</table>
				<div>
						<?php
							echo "<label>Numero da página:</label> " . ($pag + 1);?>
					<form action="index.php" method="POST">
						<?php
							$pag -= 1;
							if ($pag!="-1") {
								print "<input type='hidden' name='qntd_Pag' value='$pag' />";
								echo "<input id='anterior' class='btn btn-default' type='submit' value='Anterior' name='anterior'></input>";
							}
					?>
					</form>
					<form action="index.php" method="POST">
						<?php
							$pag += 2;
							if ($pag!= $num_pages) {
								print "<input type='hidden' name ='qntd_Pag' value='$pag' />";
								echo "<input id='proximo' class='btn btn-default' type='submit' value='Próximo' name='proximo'></input>";
							}
						?>
					</form>
					</div>
				</object>
			</div>
		</div>
	</body>
</html>