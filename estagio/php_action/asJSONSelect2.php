<?php
    require "../_classe/metodos.php";
    include("conexao.php");
    $metodos = new Metodos;
    $metodos->gerarJSONSelect2($conn, $_POST["tabela"], $_POST["valor"], $_POST["codigo"]);
?>