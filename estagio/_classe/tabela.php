<?php
	class tabela {
		function inicia () {
			echo "<table id='tabela' width=95%>";
		}
		function fecha () {
			echo '</table>';
		}
		function insere_linha ($numero1) {
			echo "<tr onclick = 'recolher($numero1)'>";
		}
		function insere_linha1 () {
			echo "<tr>";
		}
		function fecha_linha () {
			echo '</tr>';
		}
		function insere_coluna_header ($mens) {
			echo '<th>';
			echo $mens;
			echo '</th>';
		}
		function insere_coluna1 ($mens) {
		    echo '<td>';
            echo $mens;
		    echo '</td>';
		}
		function insere_coluna ($mens, $numero1, $numero2) {
		    echo '<td  id = coluna_'.$numero1.'_'.$numero2.'>';
            echo $mens;
		    echo '</td>';
		}
		function insere_coluna2 ($mens, $numero1, $numero2, $id) {
	        echo '<td>';
            echo $mens;
            echo "<input id = coluna_".$numero1."_".$numero2." type='hidden' value =".$id.">";
	        echo '</td>';
		}
	}
?>
