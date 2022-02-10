<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO estatus (descricao) VALUES ('$descricao')";
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id = $_POST['id_estatus'];
		$result_aluno = "DELETE FROM estatus WHERE id_status = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_estatus'];
		$descricao = $_POST['descricao'];
		$result_aluno = "UPDATE estatus SET descricao = '$descricao' WHERE id_status = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../estatus.php");
	} else {
		header("Location: ../estatus.php");
	}
?>