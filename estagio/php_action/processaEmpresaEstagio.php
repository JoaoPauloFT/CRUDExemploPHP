<?php
	include_once ("conexao.php");
	if($_POST['comando'] == "Cad"){
		$titulo = filter_input(INPUT_POST, 'tituloEE', FILTER_SANITIZE_STRING);
		$cursos = filter_input(INPUT_POST, 'selcurso', FILTER_SANITIZE_STRING);
		$contato = filter_input(INPUT_POST, 'contatoEE', FILTER_SANITIZE_STRING);
		$obs = filter_input(INPUT_POST, 'obsEE', FILTER_SANITIZE_STRING);
		$valor_bolsa = filter_input(INPUT_POST, 'valorBolsaEE', FILTER_SANITIZE_STRING);
		$data_informacao = filter_input(INPUT_POST, 'dataIEE', FILTER_SANITIZE_STRING);
		$outros = filter_input(INPUT_POST, 'outrosEE', FILTER_SANITIZE_STRING);
		$empresa = filter_input(INPUT_POST, 'selempresa', FILTER_SANITIZE_STRING);
		$result_aluno = "INSERT INTO empresa_estagio ( id_empresa, titulo, id_curso, contato, obs, valor_bolsa, data_informacao, outros) VALUES ('$empresa','$titulo', '$cursos', '$contato', '$obs', '$valor_bolsa', '$data_informacao', '$outros')";
		echo $result_aluno;
		$resultado_aluno = mysqli_query($conn, $result_aluno);
	}else if($_POST['comando'] == "Del"){
		$id = $_POST['id_empresa_estagio'];
		$result_aluno = "DELETE FROM empresa_estagio WHERE id_empresa_estagio = '$id'";
		$resultado_aluno = mysqli_query($conn,$result_aluno);
	}else if ($_POST['comando'] == "Atualizar") {
		$id = $_POST['id_empresa_estagio'];
		$titulo = $_POST['tituloEE'];
		$curso = $_POST['selcurso'];
		$contato = $_POST['contatoEE'];
		$obs = $_POST['obsEE'];
		$valorBolsa = $_POST['valorBolsaEE'];
		$dataInformacao = $_POST['dataIEE'];
		$outros = $_POST['outrosEE'];
		$id_empresa = $_POST['selempresa'];
		$result = "UPDATE empresa_estagio SET titulo = '$titulo', id_curso = '$curso', contato = '$contato', obs = '$obs', valor_bolsa = '$valorBolsa', data_informacao = '$dataInformacao', outros = '$outros', id_empresa = '$id_empresa' WHERE id_empresa_estagio = '$id'";
		$resultado = mysqli_query($conn,$result);
	}
	if(mysqli_insert_id($conn)){
		header("Location: ../empresa-estagio.php");
	} else {
		header("Location: ../empresa-estagio.php");
	}
?>