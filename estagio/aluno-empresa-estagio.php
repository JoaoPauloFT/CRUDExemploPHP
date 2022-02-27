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
<html>
	<head>
		<script src="_css/jquery.min.js"></script>
 		<script type="text/javascript">
			var campos = {
				idAlunoEE: "",
				anoInicio: "",
				anoTermino: "",
				id_empresa_estagio: "",
				id_aluno: "",
				id_status: "",
			};
			function recolher(n1){
				campos.idAlunoEE = document.getElementById("coluna_"+n1+"_0").innerHTML;
				campos.anoInicio = document.getElementById("coluna_"+n1+"_1").innerHTML;
				campos.anoTermino = document.getElementById("coluna_"+n1+"_2").innerHTML;
				campos.id_empresa_estagio = document.getElementById("coluna_"+n1+"_3").value;
				campos.id_aluno = document.getElementById("coluna_"+n1+"_4").value;
				campos.id_status = document.getElementById("coluna_"+n1+"_5").value;
				document.getElementById("id_alunoEE").value = campos.idAlunoEE;
				document.getElementById("anoInicio").value = campos.anoInicio;
				document.getElementById("anoTermino").value = campos.anoTermino;
				document.getElementById("opcao_".concat(campos.id_empresa_estagio)).selected = "selected";
				document.getElementById("opcao_".concat(campos.id_aluno)).selected = "selected";
				document.getElementById("opcao_".concat(campos.id_status)).selected = "selected";
			}
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
			Estagio - Aluno Empresa Estagio
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
							<li><a href="index.php">Aluno</a></li>
							<li><a href="curso.php">Curso</a></li>
							<li><a href="empresa.php">Empresa</a></li>
							<li><a href="estatus.php">Estatus</a></li>
							<li><a href="empresa-estagio.php">Empresa Estagio</a></li>
							<li class="active"><a href="aluno-empresa-estagio.php">Aluno EE</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<div id="info">
				<form id ="form"action="php_action/processaAEE.php" method="POST">
					<label>Ano de Inicio:</label>
					<input id="anoInicio" class="form-control" type="number" name="anoIAEE">
					<input id="id_alunoEE" class="form-control" type="hidden" name="id_alunoEE">
					<label>Previsão de Ano de Término:</label>
					<input id="anoTermino" class="form-control" type="number" name="anoTAEE">
					<label>Empresa Estagio:</label>
					<?php $metodos->criaLista("empresa_estagio", "titulo", "id_empresa_estagio"); ?>
					<label>Aluno:</label>
					<?php $metodos->criaLista("aluno", "nome", "id_aluno"); ?>
					<label>Estatus:</label>
					<?php $metodos->criaLista("estatus", "descricao", "id_status"); ?>
					<br>
					<br/>
					<table id="button">
						<tr>
							<td><input name="action" class="btn btn-default" type="button" value="Cadastrar" onclick="confirmacao('Cad')"/>&ensp; &ensp;</td>
							<td><input name="action" class="btn btn-default" type="button" value="Atualizar" onclick="confirmacao('Atualizar')"/>&ensp; &ensp;</td>
							<td><input name="action" class="btn btn-default" type="button" value="Deletar" onclick="confirmacao('Del')"/></td>
						</tr>
					</table>
					<div id = "hidden"/>
				</form>
			</div>
			<hr/>
			<form action="aluno-empresa-estagio.php" method="POST">
				<label>Pesquisar:</label>
				<input type="text" class="form-control" id="busca" name="busca"/><br/>
				<input type="submit" class="btn btn-default" name="action" value="Buscar"/>
			</form>
			<div #mostrarInfo>
				<object>
				<table class='table table-striped' id='tabela'>
					<thead>
						<tr>
							<th>ID Empresa Estagio Aluno</th>
							<th>Data de Inicio</th>
							<th>Data de Previsão de Término</th>
							<th>Empresa Estagio</th>
							<th>Aluno</th>
							<th>Estatus</th>
						</tr>
					</thead>
				<?php
					if($pesquisa == ""){
						$base = $pag * 10;
						//busca os dados da table aluno_empresa_status
						$result_curso = "SELECT * FROM aluno_empresa_status LIMIT $base, 10";
						$sql_count = "SELECT COUNT(*) FROM aluno_empresa_status";
						$resultado_count = mysqli_query($conn, $sql_count);
						$resultado_curso = mysqli_query($conn, $result_curso);
						$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
						$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
					    $contador = 0;
						while ($campo=mysqli_fetch_array($resultado_curso)){
							$db = new mysqli('localhost', 'root', '', 'estagio');
							//define sql para consulta
							$sql = "SELECT titulo FROM empresa_estagio WHERE id_empresa_estagio = ".$campo["id_empresa_estagio"];
							$resultado_sql = mysqli_query($conn, $sql);
							while ($empresa_estagio=mysqli_fetch_array($resultado_sql)) {
								$alunoPesq = "SELECT nome FROM aluno WHERE id_aluno = ".$campo["id_aluno"];
								$resultado_alunoPesq = mysqli_query($conn, $alunoPesq);
								while ($aluno=mysqli_fetch_array($resultado_alunoPesq)) {
									$estatusPesq = "SELECT descricao FROM estatus WHERE id_status = ".$campo["id_status"];
									$resultado_estatusPesq = mysqli_query($conn, $estatusPesq);
									while ($estatus=mysqli_fetch_array($resultado_estatusPesq)){
								  	    $tabela->insere_linha($contador);
								        $tabela->insere_coluna($campo["id_aluno_empresa_status"],$contador,0);
								        $tabela->insere_coluna($campo["data_inicio"],$contador,1);
								        $tabela->insere_coluna($campo["data_termino"],$contador,2);
								        $tabela->insere_coluna2($empresa_estagio[0],$contador,3,$campo["id_empresa_estagio"]);
								        $tabela->insere_coluna2($aluno[0],$contador,4,$campo["id_aluno"]);
								        $tabela->insere_coluna2($estatus[0],$contador,5,$campo["id_status"]);
								        $tabela->fecha_linha();
								        $contador++;
						    		}
								}
							}
						}
						$tabela->fecha();
					} else {
						$base = $pag * 10;
						$alunoPesq = "SELECT * FROM aluno WHERE nome = '$pesquisa'";
						$resultado_alunoPesq = mysqli_query($conn, $alunoPesq);
						while ($aluno=mysqli_fetch_array($resultado_alunoPesq)) {
						//busca os dados da table aluno_empresa_status
							$result_curso = "SELECT * FROM aluno_empresa_status WHERE id_aluno LIKE '$aluno[0]' ORDER BY id_aluno LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM aluno_empresa_status";
							$resultado_count = mysqli_query($conn, $sql_count);
							$resultado_curso = mysqli_query($conn, $result_curso);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
						    $contador = 0;
							while ($campo=mysqli_fetch_array($resultado_curso)){
								$db = new mysqli('localhost', 'root', '', 'estagio');
								//define sql para consulta
								$sql = "SELECT titulo FROM empresa_estagio WHERE id_empresa_estagio = ".$campo["id_empresa_estagio"];
								$resultado_sql = mysqli_query($conn, $sql);
								while ($empresa_estagio=mysqli_fetch_array($resultado_sql)) {
									$alunoPesq = "SELECT nome FROM aluno WHERE id_aluno = ".$campo["id_aluno"];
									$resultado_alunoPesq = mysqli_query($conn, $alunoPesq);
									while ($aluno=mysqli_fetch_array($resultado_alunoPesq)) {
										$estatusPesq = "SELECT descricao FROM estatus WHERE id_status = ".$campo["id_status"];
										$resultado_estatusPesq = mysqli_query($conn, $estatusPesq);
										while ($estatus=mysqli_fetch_array($resultado_estatusPesq)){
									  	    $tabela->insere_linha($contador);
									        $tabela->insere_coluna($campo["id_aluno_empresa_status"],$contador,0);
									        $tabela->insere_coluna($campo["data_inicio"],$contador,1);
									        $tabela->insere_coluna($campo["data_termino"],$contador,2);
									        $tabela->insere_coluna2($empresa_estagio[0],$contador,3,$campo["id_empresa_estagio"]);
									        $tabela->insere_coluna2($aluno[0],$contador,4,$campo["id_aluno"]);
									        $tabela->insere_coluna2($estatus[0],$contador,5,$campo["id_status"]);
									        $tabela->fecha_linha();
									        $contador++;
						    				}
									}
								}
							}
						}
						$tabela->fecha();
					}
				?>
			</div>
			<div>
						<?php
							echo "<label>Numero da página:</label> " . ($pag + 1);?>
					<form action="aluno-empresa-estagio.php" method="POST">
						<?php
							$pag -= 1;
							if ($pag!="-1") {
								print "<input type='hidden' name='qntd_Pag' value='$pag' />";
								echo "<input id='anterior' class='btn btn-default' type='submit' value='Anterior' name='anterior'></input>";
							}
					?>
					</form>
					<form action="aluno-empresa-estagio.php" method="POST">
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
	</body>
</html>