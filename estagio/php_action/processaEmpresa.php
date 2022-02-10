<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$nome = filter_input(INPUT_POST, 'nomeEmpresa', FILTER_SANITIZE_STRING);
		$CNPJ = intval(filter_input(INPUT_POST, 'CNPJEmpresa', FILTER_SANITIZE_STRING));
		$site = filter_input(INPUT_POST, 'siteEmpresa', FILTER_SANITIZE_URL);
		$email = filter_input(INPUT_POST, 'emailEmpresa', FILTER_SANITIZE_EMAIL);
		$endereco = filter_input(INPUT_POST, 'enderecoEmpresa', FILTER_SANITIZE_STRING);
		$telefone = filter_input(INPUT_POST, 'telefoneEmpresa', FILTER_SANITIZE_NUMBER_INT);
		$UF = filter_input(INPUT_POST, 'UFempresa', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO empresa (nome,CNPJ,site,email,endereco,telefone,uf) VALUES ('$nome','$CNPJ','$site','$email','$endereco','$telefone','$UF')";
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id = $_POST['id_empresa'];
		$result_aluno = "DELETE FROM empresa WHERE id_empresa = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_empresa'];
		$nome = $_POST['nomeEmpresa'];
		$CNPJ = $_POST['CNPJEmpresa'];
		$site = $_POST['siteEmpresa'];
		$endereco = $_POST['enderecoEmpresa'];
		$email = $_POST['emailEmpresa'];
		$telefone = $_POST['telefoneEmpresa'];
		$UF = $_POST['UFempresa'];
		$result_aluno = "UPDATE empresa SET nome = '$nome', CNPJ = '$CNPJ', site = '$site', email = '$email', endereco = '$endereco', telefone = '$telefone', uf = '$UF' WHERE id_empresa = '$id'";
		echo $result_aluno;
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../empresa.php");
	} else {
		header("Location: ../empresa.php");
	}
?>