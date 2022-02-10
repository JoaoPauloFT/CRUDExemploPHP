<?php
	//starta a sessão e conecta ao banco de dados
	session_start();
	include_once("php_action/conexao.php");
	require "_classe/metodos.php";
	$metodos = new Metodos;
	//chama a classe tabela
	require "_classe/tabela.php";
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
			//função para decidir qual botão foi pressionado
			var campos = {
				id_empresa_estagio: "",
				titulo: "",
				data_informacao: "",
				cursos: "",
				contato: "",
				obs: "",
				valor_bolsa: "",
				outros: "",
				id_empresa: "",
			};
			function recolher(n1){
				campos.id_empresa_estagio = document.getElementById("coluna_"+n1+"_0").innerHTML;
				campos.titulo = document.getElementById("coluna_"+n1+"_1").innerHTML;
				campos.data_informacao = document.getElementById("coluna_"+n1+"_2").innerHTML;
				campos.id_curso = document.getElementById("coluna_"+n1+"_3").value;
				campos.contato = document.getElementById("coluna_"+n1+"_4").innerHTML;
				campos.obs = document.getElementById("coluna_"+n1+"_5").innerHTML;
				campos.valor_bolsa = document.getElementById("coluna_"+n1+"_6").innerHTML;
				campos.outros = document.getElementById("coluna_"+n1+"_7").innerHTML;
				campos.id_empresa = document.getElementById("coluna_"+n1+"_8").value;
				document.getElementById("id_empresa_estagio").value = campos.id_empresa_estagio;
				document.getElementById("titulo").value = campos.titulo;
				document.getElementById("data_informacao").value = campos.data_informacao;
				document.getElementById("opcao_".concat(campos.id_curso)).selected = "selected";
				document.getElementById("contato").value = campos.contato;
				document.getElementById("obs").value = campos.obs;
				document.getElementById("valor_bolsa").value = campos.valor_bolsa;
				document.getElementById("outros").value = campos.outros;
				document.getElementById("opcao_".concat(campos.id_empresa)).selected = "selected";
			}
			/*$(document).ready(function() {
    			selectViaAjax("#selempresa", "empresa", "nome", "id_empresa");
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
		<!-- titulo do site -->
		<title>
			Estagio - Empresa Estagio
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
							<li class="active"><a href="empresa-estagio.php">Empresa Estagio</a></li>
							<li><a href="aluno-empresa-estagio.php">Aluno EE</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<!-- inicia o formulario para cadastro, ediçao e apagar os dados -->
			<div id="info">
				<form id="form" action="php_action/processaEmpresaEstagio.php" method="POST">
					<label>Titulo:</label>
					<input id="titulo" class="form-control" type="text" name="tituloEE">
					<input id="id_empresa_estagio" class="form-control" type="hidden" name="id_empresa_estagio">
					<label>Data de Informação:</label>
					<input id="data_informacao" class="form-control" type="number" name="dataIEE">
					<label>Curso:</label>
					<!-- <select class='js-example-basic-multiple form-control' id='selcurso' name='selCurso' size ='1'></select> -->
					<?php $metodos->criaLista("curso", "nome", "id_curso"); ?>
					<label>Contato:</label>
					<input id="contato" class="form-control" type="text" name="contatoEE">
					<label>Observação:</label>
					<input id="obs" class="form-control" type="text" name="obsEE">
					<label>Valor da Bolsa:</label>
					<input id="valor_bolsa" class="form-control" type="number" name="valorBolsaEE">
					<label>Outros:</label>
					<input id="outros" class="form-control" type="text" name="outrosEE">
					<label>Empresa:</label>
					<!-- <select class='js-example-basic-multiple form-control' id='selempresa' name='selEmpresa' size ='1'></select> -->
					<?php $metodos->criaLista("empresa", "nome", "id_empresa"); ?>
					<br>
					<br>
					<!-- botoes para fazer uma ação -->
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
			<form action="empresa-estagio.php" method="POST">
				<label>Pesquisar:</label>
				<input type="text" class="form-control" id="busca" name="busca"/><br/>
				<input type="submit" class="btn btn-default" name="action" value="Buscar"/>
			</form>
			<div #mostrarInfo>
				<object>
				<table class='table table-striped' id='tabela'>
					<thead>
						<tr>
							<th>ID Empresa Estagio</th>
							<th>Titulo</th>
							<th>Data de Informação</th>
							<th>Cursos</th>
							<th>Contato</th>
							<th>Observação</th>
							<th>Valor da Bolsa</th>
							<th>Outros</th>
							<th>Empresa</th>
						</tr>
					</thead>
					<?php
						if($pesquisa == ""){
							$base = $pag * 10;
							$result_curso = "SELECT * FROM empresa_estagio LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM empresa_estagio";
							$resultado_count = mysqli_query($conn, $sql_count);
							$resultado_curso = mysqli_query($conn, $result_curso);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
						    $contador = 0;		    
							while ($campo=mysqli_fetch_array($resultado_curso)){
								$sql = "SELECT nome FROM curso WHERE id_curso = ".$campo["id_curso"];
								$resultado_sql = mysqli_query($conn, $sql);
								while ($curso=mysqli_fetch_array($resultado_sql)) {
									$sql = "SELECT nome FROM empresa WHERE id_empresa = ".$campo["id_empresa"];
									$resultado_sql = mysqli_query($conn, $sql);
									while ($empresa=mysqli_fetch_array($resultado_sql)) {
								  	    $tabela->insere_linha($contador);
								        $tabela->insere_coluna($campo["id_empresa_estagio"],$contador,0);
								        $tabela->insere_coluna($campo["titulo"],$contador,1);
								        $tabela->insere_coluna($campo["data_informacao"],$contador,2);
								        $tabela->insere_coluna2($curso[0],$contador,3,$campo["id_curso"]);
								        $tabela->insere_coluna($campo["contato"],$contador,4);
								        $tabela->insere_coluna($campo["obs"],$contador,5);
								        $tabela->insere_coluna($campo["valor_bolsa"],$contador,6);
								        $tabela->insere_coluna($campo["outros"],$contador,7);
								        $tabela->insere_coluna2($empresa[0],$contador,8,$campo["id_empresa"]);
								        $tabela->fecha_linha();
								        $contador++;
							        }
							    }
							}
						} else {
							$base = $pag * 10;
							$result_curso = "SELECT * FROM empresa_estagio WHERE titulo LIKE '$pesquisa' ORDER BY titulo LIMIT $base, 10";
							$sql_count = "SELECT COUNT(*) FROM empresa_estagio";
							$resultado_count = mysqli_query($conn, $sql_count);
							$resultado_curso = mysqli_query($conn, $result_curso);
							$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
							$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
						    $contador = 0;		    
							while ($campo=mysqli_fetch_array($resultado_curso)){
								$sql = "SELECT nome FROM curso WHERE id_curso = ".$campo["id_curso"];
								$resultado_sql = mysqli_query($conn, $sql);
								while ($curso=mysqli_fetch_array($resultado_sql)) {
									$sql = "SELECT nome FROM empresa WHERE id_empresa = ".$campo["id_empresa"];
									$resultado_sql = mysqli_query($conn, $sql);
									while ($empresa=mysqli_fetch_array($resultado_sql)) {
								  	    $tabela->insere_linha($contador);
								        $tabela->insere_coluna($campo["id_empresa_estagio"],$contador,0);
								        $tabela->insere_coluna($campo["titulo"],$contador,1);
								        $tabela->insere_coluna($campo["data_informacao"],$contador,2);
								        $tabela->insere_coluna2($curso[0],$contador,3,$campo["id_curso"]);
								        $tabela->insere_coluna($campo["contato"],$contador,4);
								        $tabela->insere_coluna($campo["obs"],$contador,5);
								        $tabela->insere_coluna($campo["valor_bolsa"],$contador,6);
								        $tabela->insere_coluna($campo["outros"],$contador,7);
								        $tabela->insere_coluna2($empresa[0],$contador,8,$campo["id_empresa"]);
								        $tabela->fecha_linha();
								        $contador++;
							        }
							    }
							}
						}
					?>
				</table>
				<div>
					<?php echo "<label>Numero da página:</label> " . ($pag + 1);?>
					<form action="empresa-estagio.php" method="POST">
						<?php
							$pag -= 1;
							if ($pag!="-1") {
								print "<input type='hidden' name='qntd_Pag' value='$pag' />";
								echo "<input id='anterior' class='btn btn-default' type='submit' value='Anterior' name='anterior'></input>";
							}
					?>
					</form>
					<form action="empresa-estagio.php" method="POST">
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