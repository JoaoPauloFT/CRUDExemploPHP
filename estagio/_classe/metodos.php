<?php	
	class Metodos {
		function gerarJSONSelect2($conn, $tabela,$campoLiteral,$campoCodigo){
			//faz conexao
			$db = new mysqli('localhost', 'root', '', 'estagio');
			//define sql para consulta
			$sql = "SELECT * FROM ".$tabela;
			$query = mysqli_query($conn, $sql);
			//cria lista de seleção
			$registros = array();
			while ($registro=mysqli_fetch_array($query)){
				$registros[] = array("text" => $registro[$campoLiteral], "id"=>$registro[$campoCodigo]);
			}
			$resultados = array("results" => $registros);
			echo json_encode($resultados);
		}

		function criaLista($tabela,$campoLiteral,$campoCodigo){
			$db = new mysqli('localhost', 'root', '', 'estagio');
			$sql = "SELECT * FROM ".$tabela;
			echo '<select class="form-control" name="sel'.$tabela.'" id="sel'.$tabela.'" size = "1">';
			if ($result = $db->query($sql)) {
				while ($campo = $result->fetch_assoc()){
					echo '<option id="opcao_'.$campo[$campoCodigo].'" value="'.$campo[$campoCodigo].'">'.$campo[$campoLiteral];
				}
			}
			echo "</select>";
		}
	}
?>