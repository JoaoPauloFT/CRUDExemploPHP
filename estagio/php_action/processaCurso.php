<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO curso (nome) VALUES ('$nome')";
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id_curso = $_POST['id_curso'];
		$result_aluno = "DELETE FROM curso WHERE id_curso = '$id_curso'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_curso'];
		$nome = $_POST['nome'];
		$result_aluno = "UPDATE curso SET nome = '$nome' WHERE id_curso = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../curso.php");
	} else {
		header("Location: ../curso.php");
	}
?>