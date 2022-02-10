<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$matricula = filter_input(INPUT_POST, 'matricula', FILTER_SANITIZE_STRING);
		$anoEntrada = filter_input(INPUT_POST, 'anoEntrada', FILTER_SANITIZE_STRING);
		$anoTermino = filter_input(INPUT_POST, 'anoTermino', FILTER_SANITIZE_STRING);
		$obs = filter_input(INPUT_POST, 'obs', FILTER_SANITIZE_STRING);
		$idCurso = filter_input(INPUT_POST, 'selcurso', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO aluno(nome, matricula, id_curso, ano_entrada, ano_termino, obs) VALUES ('$nome', '$matricula', '$idCurso', '$anoEntrada', '$anoTermino', '$obs')";
		echo $result_aluno;
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id = $_POST['id_aluno'];
		$result_aluno = "DELETE FROM aluno WHERE id_aluno = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_aluno'];
		$nome = $_POST['nome'];
		$matricula = $_POST['matricula'];
		$anoEntrada = $_POST['anoEntrada'];
		$anoTermino = $_POST['anoTermino'];
		$obs = $_POST['obs'];
		$idCurso = $_POST['selcurso'];
		$result_aluno = "UPDATE aluno SET nome = '$nome', matricula = '$matricula', ano_entrada = '$anoEntrada', ano_termino = '$anoTermino', obs = '$obs', id_curso = '$idCurso' WHERE id_aluno = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../index.php");
	} else {
		header("Location: ../index.php");
	}
?>