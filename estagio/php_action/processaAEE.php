<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$data_inicio = filter_input(INPUT_POST, 'anoIAEE', FILTER_SANITIZE_STRING);
		$data_termino = filter_input(INPUT_POST, 'anoTAEE', FILTER_SANITIZE_STRING);
		$id_aluno = filter_input(INPUT_POST, 'selaluno', FILTER_SANITIZE_STRING);
		$id_empresa_estagio = filter_input(INPUT_POST, 'selempresa_estagio', FILTER_SANITIZE_STRING);
		$id_status = filter_input(INPUT_POST, 'selestatus', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO aluno_empresa_status (id_empresa_estagio, id_aluno, data_inicio, data_termino, id_status) VALUES ('$id_empresa_estagio', '$id_aluno', '$data_inicio', '$data_termino', '$id_status')";
		echo $result_aluno;
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id = $_POST['id_alunoEE'];
		$result_aluno = "DELETE FROM aluno_empresa_status WHERE id_aluno_empresa_status = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_alunoEE'];
		$data_inicio = $_POST['anoIAEE'];
		$data_termino = $_POST['anoTAEE'];
		$id_aluno = $_POST['selaluno'];
		$id_status = $_POST['selestatus'];
		$id_empresa_estagio = $_POST['selempresa_estagio'];
		$result_aluno = "UPDATE aluno_empresa_status SET data_inicio = '$data_inicio', data_termino = '$data_termino', id_empresa_estagio = '$id_empresa_estagio', id_aluno = '$id_aluno', id_status = '$id_status' WHERE id_aluno_empresa_status = '$id'";
		echo $result_aluno;
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../aluno-empresa-estagio.php");
	} else {
		header("Location: ../aluno-empresa-estagio.php");
	}
?>