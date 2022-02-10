<?php
	session_start();
	include_once("php_action/conexao.php");
	require "_classe/tabela.php";
	$tabela=new Tabela;
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
					idEmpresa: "",
					nome: "",
					CNPJ: "",
					site: "",
					email: "",
					endereco: "",
					telefone: "",
					uf: "",
				};
			function recolher(n1){
				campos.idEmpresa = document.getElementById("coluna_"+n1+"_0").innerHTML;
				campos.nome = document.getElementById("coluna_"+n1+"_1").innerHTML;
				campos.CNPJ = document.getElementById("coluna_"+n1+"_2").innerHTML;
				campos.site = document.getElementById("coluna_"+n1+"_3").innerHTML;
				campos.email = document.getElementById("coluna_"+n1+"_4").innerHTML;
				campos.endereco = document.getElementById("coluna_"+n1+"_5").innerHTML;
				campos.telefone = document.getElementById("coluna_"+n1+"_6").innerHTML;
				campos.uf = document.getElementById("coluna_"+n1+"_7").innerHTML;
				document.getElementById("id_empresa").value = campos.idEmpresa;
				document.getElementById("nomeEmpresa").value = campos.nome;
				document.getElementById("CNPJEmpresa").value = campos.CNPJ;
				document.getElementById("siteEmpresa").value = campos.site;
				document.getElementById("emailEmpresa").value = campos.email;
				document.getElementById("enderecoEmpresa").value = campos.endereco;
				document.getElementById("telefoneEmpresa").value = campos.telefone;
				document.getElementById("UFempresa").value = campos.uf;
			}
</script>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="_css/bootstrap.min.css">
		<link rel="stylesheet" href="_css/geral.css">
		<script src="_css/jquery.min.js"></script>
 		<script src="_css/bootstrap.min.js"></script>
 		<script src="_classe/metodosJS.js"></script>
		<title>
			Estagio - Empresa
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
							<li class="active"><a href="empresa.php">Empresa</a></li>
							<li><a href="estatus.php">Estatus</a></li>
							<li><a href="empresa-estagio.php">Empresa Estagio</a></li>
							<li><a href="aluno-empresa-estagio.php">Aluno EE</a></li>
						</ul>
					</div>
				</nav>
			</header>
			<div id="info">
				<form id = "form" action="php_action/processaEmpresa.php" method="POST">
					<label>Nome:</label>
					<input id="nomeEmpresa" class="form-control" type="text" name="nomeEmpresa">
					<input id="id_empresa" class="form-control" type="hidden" name="id_empresa">
					<label>CNPJ:</label>
					<input id="CNPJEmpresa" class="form-control" type="number" name="CNPJEmpresa">
					<label>Site:</label>
					<input id="siteEmpresa" class="form-control" type="text" name="siteEmpresa">
					<label>Email:</label>
					<input id="emailEmpresa" class="form-control" type="email" name="emailEmpresa">
					<label>Endereço:</label>
					<input id="enderecoEmpresa" class="form-control" type="text" name="enderecoEmpresa">
					<label>Telefone:</label>
					<input id="telefoneEmpresa" class="form-control" type="number" name="telefoneEmpresa">
					<label>UF:</label>		
					<select id="UFempresa" class="form-control" name="UFempresa" size="1">
						<option value="AC">AC</option>
						<option value="AL">AL</option>
						<option value="AP">AP</option>
						<option value="AM">AM</option>
						<option value="BA">BA</option>
						<option value="CE">CE</option>
						<option value="DF">DF</option>
						<option value="ES">ES</option>
						<option value="GO">GO</option>
						<option value="MA">MA</option>
						<option value="MT">MT</option>
						<option value="MS">MS</option>
						<option value="MG">MG</option>
						<option value="PA">PA</option>
						<option value="PB">PB</option>
						<option value="PE">PE</option>
						<option value="PI">PI</option>
						<option value="PR">PR</option>
						<option value="RJ">RJ</option>
						<option value="RN">RN</option>
						<option value="RS">RS</option>
						<option value="RO">RO</option>
						<option value="RR">RR</option>
						<option value="SC">SC</option>
						<option value="SP">SP</option>
						<option value="SE">SE</option>
						<option value="TO">TO</option>
					</select>
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
			<form action="empresa.php" method="POST">
				<label>Pesquisar:</label>
				<input type="text" class="form-control" id="busca" name="busca"/><br/>
				<input type="submit" class="btn btn-default" name="action" value="Buscar"/>
			</form>
			<div #mostrarInfo>
				<table class='table table-striped' id='tabela'>
					<thead>
						<tr>
							<th>ID Empresa</th>
							<th>Nome</th>
							<th>CNPJ</th>
							<th>Site</th>
							<th>Email</th>
							<th>Endereço</th>
							<th>Telefone</th>
							<th>UF</th>
						</tr>
					</thead>
				<?php
					if($pesquisa == ""){
						$base = $pag * 10;
						$result_empresa = "SELECT * FROM empresa LIMIT $base, 10";
						$sql_count = "SELECT COUNT(*) FROM empresa";
						$resultado_count = mysqli_query($conn, $sql_count);
						$resultado_empresa = mysqli_query($conn, $result_empresa);
						$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
						$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
					    $contador = 0;	    
						while ($campo=mysqli_fetch_array($resultado_empresa)){
					  	      $tabela->insere_linha($contador);
					          $tabela->insere_coluna($campo["id_empresa"],$contador,0);
					          $tabela->insere_coluna($campo["nome"],$contador,1);
					          $tabela->insere_coluna($campo["CNPJ"],$contador,2);
					          $tabela->insere_coluna($campo["site"],$contador,3);
					          $tabela->insere_coluna($campo["email"],$contador,4);
					          $tabela->insere_coluna($campo["endereco"],$contador,5);
					          $tabela->insere_coluna($campo["telefone"],$contador,6);
					          $tabela->insere_coluna($campo["uf"],$contador,7);
					          $tabela->fecha_linha();
					          $contador++;
						}
						$tabela->fecha();
					} else {
						$base = $pag * 10;
						$result_empresa = "SELECT * FROM empresa WHERE nome LIKE '$pesquisa' ORDER BY nome LIMIT $base, 10";
						$sql_count = "SELECT COUNT(*) FROM empresa";
						$resultado_count = mysqli_query($conn, $sql_count);
						$resultado_empresa = mysqli_query($conn, $result_empresa);
						$contador_total = intval(mysqli_fetch_array($resultado_count)[0]);
						$num_pages = $contador_total % 10? intval($contador_total/10)+1 : $contador_total/10;
					    $contador = 0;	    
						while ($campo=mysqli_fetch_array($resultado_empresa)){
					  	      $tabela->insere_linha($contador);
					          $tabela->insere_coluna($campo["id_empresa"],$contador,0);
					          $tabela->insere_coluna($campo["nome"],$contador,1);
					          $tabela->insere_coluna($campo["CNPJ"],$contador,2);
					          $tabela->insere_coluna($campo["site"],$contador,3);
					          $tabela->insere_coluna($campo["email"],$contador,4);
					          $tabela->insere_coluna($campo["endereco"],$contador,5);
					          $tabela->insere_coluna($campo["telefone"],$contador,6);
					          $tabela->insere_coluna($campo["uf"],$contador,7);
					          $tabela->fecha_linha();
					          $contador++;
						}
						$tabela->fecha();
					}
				?>
				<div>
						<?php
							echo "<label>Numero da página:</label> " . ($pag + 1);?>
					<form action="empresa.php" method="POST">
						<?php
							$pag -= 1;
							if ($pag!="-1") {
								print "<input type='hidden' name='qntd_Pag' value='$pag' />";
								echo "<input id='anterior' class='btn btn-default' type='submit' value='Anterior' name='anterior'></input>";
							}
					?>
					</form>
					<form action="empresa.php" method="POST">
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