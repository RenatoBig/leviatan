$(document).ready(function() {
	
	//Calendário
	$(function(){
		$(".calendario").datepicker({
		yearRange: "1900:2012",
		changeMonth: true,
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		dayNames: [
			'Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'
		],
		dayNamesMin: [
			'D','S','T','Q','Q','S','S','D'
		],
		dayNamesShort: [
			'Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'
		],
		monthNames: [
			'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro',
			'Outubro','Novembro','Dezembro'
		],
		monthNamesShort: [
			'Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set',
			'Out','Nov','Dez'
		],
		nextText: 'Próximo',
		prevText: 'Anterior'

		});
	});
	
	
	//---------------------------------------------
	//Autocomplete
//	$("#autoComplete").autocomplete("items/autoComplete",
//	{
//		minChars: 2,
//		cacheLength: 10,
//		onItemSelect: selectItem,
//		onFindValue: findValue,
//		formatItem: formatItem,
// 		autoFill: false
// 	});
	
	//Habilitar ou desabilitar status do item
	//---------------------
	$('.enable').click(function() {
		
		var id = $(this).val();
		
		var caminho = '/items/changeStatus/'+id;

		// pega a url atual
		url = location.href;
		// pega o tamanho da string até leviatan/
		var tamanho = url.indexOf("leviatan") + "leviatan".length;
		// pega a url até gerenciador/
		var aux = url.substr(0, tamanho);
		// concatena com o controller/action/id
		url = aux + caminho;
		
		$.ajax({
			url : url,
			success : function(retorno) {
				if(retorno == 1) {
					$("#alert-message").html('<div class="alert alert-success">Alterado com sucesso</div>');					
				}else if(retorno == 0){
					$("#alert-message").html('<div class="alert alert-error">Não foi possível habilitar o item</div>');
				}else {
					$("#alert-message").html('<div class="alert alert-error">Requisição inválida</div>');
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});
	});	
	//---------------------------------------------------------
	//Muda a aba da view cart_items/index
	$('#myTab a').click(function(e) {
	  e.preventDefault();
	  $(this).tab('show');
	})
	//----------------------------------------
	//Submita os itens do carrinho para gerar a solicitação
	$('#submitSolicitation').click(function(){
	
		var description = CKEDITOR.instances.SolicitationDescription.getData();

		if(description == '') {
			alert('É obigatório preencher uma descrição');
			return;
		}
				
		var caminho = '/cart_items/checkout';
	
		// pega a url atual
		url = location.href;
		// pega o tamanho da string até leviatan/
		var tamanho = url.indexOf("leviatan") + "leviatan".length;
		// pega a url até leviatan/
		var aux = url.substr(0, tamanho);
		// concatena com o controller/action/
		url = aux + caminho;
	
		$.ajax({
			type: 'post',
		    data: {'description':description},
		    url:url,
		    success: function(retorno){
		    	if(retorno == 1) {
			    	var caminho = '/solicitations/index';
					url = aux + caminho;
					location.href = url;
		    	}else if(retorno == 0) {
					location.reload();
		    	}
		    }
		})
	
	})
	//---------------------------------------------------
	//Abre o modal para visualização da justificativa	
	$('.denyVisualization').click(function(){

		var id = $(this).attr('value');
		
		var caminho = '/justifications/view/'+id;
		
		// pega a url atual
		url = location.href;
		// pega o tamanho da string até leviatan/
		var tamanho = url.indexOf("leviatan") + "leviatan".length;
		// pega a url até gerenciador/
		var aux = url.substr(0, tamanho);
		// concatena com o controller/action/id
		url = aux + caminho;

		$.ajax({
			url : url,
			success : function(data) {
				$('#myModal').html(data);
				$('#myModal').modal('show');
			}
		});		
	});
	//----------------------------------------------------
	//abre formulário para justificar a notificação
	$('.deny').click(function(){
		var id = $(this).attr('value');
		$('#JustificationSolicitationItemId').attr('value', id);
		$('.modal').modal('show');
	});
	
});

//-----------------------------------
//Autocomplete
function selectItem(li) {
    findValue(li);
}
 
function findValue(li) {

    if( li == null ) 
        return alert("No match!");
 
	// if coming from an AJAX call, let's use the product id as the value
    if(!!li.extra ) { 
        var sValue = li.extra[0];
    } else {// otherwise, let's just display the value in the text box 
        var sValue = li.selectValue;
    }

}
 
function formatItem(row) {
    /*if(row[1] == undefined) {
        return row[0];
    }
    else {
        return row[0] + " (id: " + row[1] + ")";
    }*/
    return row[0];
}
//------------------------------------------

function escondeMsg() {   		
	$("#flashMessage, #alert-message").fadeOut();
}
	