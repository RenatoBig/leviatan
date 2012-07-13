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
			success : function() {
			
			
			}
		});
	});	
	//---------------------------------------------------------
	
	//Remover itens do carrinho
	$('.removeFromCart').click(function(){
		
		var id_key = $(this).val();
		
		var tamanho = id_key.length;
		var indice = id_key.indexOf('-');
		
		//Id do registro no banco de dados
		var id = id_key.substr(0, indice);
		//Registro a ser retirado da listagem
		var key = id_key.substr(indice+1, tamanho - 1);
		
		
		var caminho = '/solicitation_items/removeFromCart/'+id;
		
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
			success : function() {
				//Remove a linha			
				$("#tr_"+key).remove();
				
				var table = document.getElementById('table');
				var trs = table.getElementsByTagName('tr');
	        	//Testa se não existe mais itens
				if(trs.length == 1) {
					$('.span10').html(
						"<div class='span4 alert alert-info'>" +
						"<h3>Não há itens no carrinho</h3>" +
						"</div>"
					);					
				}
			}
		});		
		
	});		
	//---------------------------------------------------------
	//Adicionar itens ao carrinho
	$('.addToCart').click(function(){
		
		var id_key = $(this).val();
		
		var tamanho = id_key.length;
		var indice = id_key.indexOf('-');
		
		//Id do registro no banco de dados
		var id = id_key.substr(0, indice);
		//Registro a ser retirado da listagem
		var key = id_key.substr(indice+1, tamanho - 1);
		
		var caminho = '/solicitation_items/addToCart/'+id;
		
		// pega a url atual
		url = location.href;
		// pega o tamanho da string até leviatan/
		var tamanho = url.indexOf("leviatan") + "leviatan".length;
		// pega a url até leviatan/
		var aux = url.substr(0, tamanho);
		// concatena com o controller/action/id
		url = aux + caminho;		
		
		$.ajax({
			url : url,
			success : function() {

			}
		});			
	});	
	
	//--------------------------
	$('.homologation, .deny, .approved').click(function() {
		
		
		var valItem = $('#ItemItem').val();
		var valUser = $('#ItemUser').val();
		var valSolicitation = $('#ItemSolicitation').val();
		
		var id_key = $(this).val();
		
		var tamanho = id_key.length;
		var indice = id_key.indexOf('-');
		
		//Id do registro no banco de dados
		var id = id_key.substr(0, indice);
		//Registro a ser retirado da listagem
		var key = id_key.substr(indice+1, tamanho - 1);
		
		var caminho = '/solicitation_items/changeStatus/'+id;
		
		// pega a url atual
		url = location.href;
		// pega o tamanho da string até leviatan/
		var tamanho = url.indexOf("leviatan") + "leviatan".length;
		// pega a url até leviatan/
		var aux = url.substr(0, tamanho);
		// concatena com o controller/action/id
		url = aux + caminho;		
		
		var status = '';
		if($(this).html() == "Homologar") {
			status = "HOMOLOGADO";
		}else if($(this).html() == "Negar"){
			status = "NEGADO";
		}else if($(this).html() == "Aprovar") {
			status = "APROVADO";
		}

		$.ajax({
			url : url,
			data: {status: status},
			success : function() {
				
				var newUrl = '';
				if(valItem.length != 0) {
					newUrl = "item:" + valItem + "/";
				}
				if(valUser.length != 0) {
					newUrl = newUrl + "user:" + valUser + "/";
				}
				if(valSolicitation.length != 0) {
					newUrl = newUrl + "solicitation:" + valSolicitation+ "/";
				}

				var load = aux + '/solicitation_items/pendingSolicitations/'+newUrl;
				
				/*$.ajax({
					type: "POST",
					url: load,
					data: {item: valItem, user:valUser, solicitation: valSolicitation},
					success: function() {
						
					}
				});*/
				
				//window.location.href = load;
				
				//Remove a linha			
			/*	$("#trItem_"+key).remove();
				
				var table = document.getElementById('table');
				var trs = table.getElementsByTagName('tr');
	        	//Testa se não existe mais itens
				if(trs.length == 1) {
					window.location.href = aux + "/solicitation_items/pendingSolicitations";				
				}else if(trs.length < 6) {
					$(".paginacao").fadeOut();
				}*/
			}
		});			
		
		
		
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

	
