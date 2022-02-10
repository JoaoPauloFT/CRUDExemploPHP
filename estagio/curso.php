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
		<script type="text/javascript">
			var campos = {
					idCurso: "",
					nome: "",
				};
			function recolher(n1){
				campos.nome = document.getElementById("coluna_"+n1+"_1").innerHTML;
				campos.idCurso = document.getElementById("coluna_"+n1+"_0").innerHTML;
				document.getElementById("nome").value = campos.nome;
				document.getElementById("hidden_id_curso").value = campos.idCurso;
			}
		</script>
		<style type="text/css">
			/*input#proximo {
				float: right;
			}*/
		</style>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="_css/bootstrap.min.css">
		<link rel="stylesheet" href="_css/geral.css">
		<link href="_classe/select2.min.css" rel="stylesheet" />
		<script src="_classe/select2.min.js"></script>
 		<script src="_css/jquery.min.js"></script>
 		<script src="_classe/metodosJS.js"></script>
 		<script src="_css/bootstrap.min.js"></script>
		<title>
			Estagio - Curso
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
						<li class="active"><a href="curso.php">Curso</a></li>
						<li><a href="empresa.php">Empresa</a></li>
						<li><a href="estatus.php">Estatus</a></li>
						<li><a href="empresa-estagio.php">Empresa Estagio</a></li>
						<li><a href="aluno-empresa-estagio.php">Aluno EE</a></li>
					</ul>
				</div>
			</nav>
		</header>
			<div id="pegarInfo">
				<form id ="form" action="php_action/processaCurso.php" method="POST">
					<div class="form-group">
						<label for="nome">Nome:</label>
						<input id = "nome" class="form-control" type="text" name="nome">
					</div>
					<input id="hidden_id_curso" type="hidden" name="id_curso"></td><br>
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
			<form action="curso.php" method="POST">
				<label>Pesquisar:</label>
				<input type="text" class="form-control" id="busca" name="busca"/><br/>
				<input type="submit" class="btn btn-default" name="action" value="Buscar"/>
			</form>
			<div id="mostrarInfo">
				<object>
					<table class='table table-striped' id='tabela'>
						<thead>
							<tr>
								<th>ID Curso</th>
								<th>Nome</th>
							</tr>
						</thead>
					<?php
						if($pesquisa == ""){
							$base = $pag * 10;
							$result_curso = "SELECT * FROM curso LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM curso";
							$resultado_curso = mysqli_query($conn, $result_curso);
							$resultado_count = mysqli_query($conn, $sql_count);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
							$contador = 0;	    
							while ($campo=mysqli_fetch_array($resultado_curso)){
							    $tabela->insere_linha($contador);
							    $tabela->insere_coluna($campo["id_curso"],$contador,0);
							    $tabela->insere_coluna($campo["nome"],$contador,1);
							    $tabela->fecha_linha();
							    $contador++;
							}
						} else {
							$base = $pag * 10;
							$result_curso = "SELECT * FROM curso WHERE nome LIKE '$pesquisa' ORDER BY nome LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM curso";
							$resultado_curso = mysqli_query($conn, $result_curso);
							$resultado_count = mysqli_query($conn, $sql_count);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
							$contador = 0;	    
							while ($campo=mysqli_fetch_array($resultado_curso)){
							    $tabela->insere_linha($contador);
							    $tabela->insere_coluna($campo["id_curso"],$contador,0);
							    $tabela->insere_coluna($campo["nome"],$contador,1);
							    $tabela->fecha_linha();
							    $contador++;
							}
						}
					?>
					</table>
					<div>
						<?php
							echo "<label>Numero da página:</label> " . ($pag + 1);?>
					<form action="curso.php" method="POST">
						<?php
							$pag -= 1;
							if ($pag!="-1") {
								print "<input type='hidden' name='qntd_Pag' value='$pag' />";
								echo "<input id='anterior' class='btn btn-default' type='submit' value='Anterior' name='anterior'></input>";
							}
					?>
					</form>
					<form action="curso.php" method="POST">
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