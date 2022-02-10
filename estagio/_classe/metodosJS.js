function confirmacao (x) {
	if(x=="Del"){
		var resposta = confirm("Se este dado estiver associado a outra linha de dados ela será apagada. Deseja Continuar?")
		if (resposta==true){
			document.getElementById("hidden").innerHTML = "<input type = 'hidden' name='comando' value = "+x+" />";
	   		document.getElementById('form').submit();
    	}
	} else {
		document.getElementById("hidden").innerHTML = "<input type = 'hidden' name='comando' value = "+x+" />";
    	document.getElementById('form').submit();
	}
}

function selectViaAjax(identificador, tabela, principal, value) {
	$(identificador).select2({
		ajax: {
			url: 'php_action/asJSONSelect2.php',
			type: "POST",
			dataType: 'json',
			data:  function (params) {
				  return {
					q: params.term
				  }
			},
			data: jQuery.param({tabela: tabela,valor:principal,codigo:value}),
			processResults: function (data, params) {
				var search = params.term? params.term : "";
				data.results = data.results.filter(function(value){
					return value.text.includes(search);
				});
				return data;
			}
		}
	});
}