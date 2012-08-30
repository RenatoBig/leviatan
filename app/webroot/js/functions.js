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
		
		var url = '/items/changeStatus/'+id;

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
		
		var memo_number = $('#SolicitationMemoNumber').val();
		var description = CKEDITOR.instances.SolicitationDescription.getData();
		
		if(memo_number == '') {
			alert('É obrigatório preencher o número do memorando');
			return;
		}
		if(description == '') {
			alert('É obigatório preencher uma descrição');
			return;
		}
				
		var url = '/cart_items/checkout';
	
		$.ajax({
			type: 'post',
		    data: {'memo_number':memo_number, 'description':description},
		    url:url,
		    success: function(retorno){
		    	if(retorno == 1) {
			    	var newUrl = '/solicitations/index';
					location.href = newUrl;
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
		
		var url = '/justifications/view/'+id;
		
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
	//------------------------------------------------
	//Verificações antes de submitar um formulário para cadastro do PNGC
	$('#submitPngc').click(function(){
		
		if($("#PngcCodeAddForm").valid() == false) {
			return;
		}

		var expense_group_id = $('#PngcCodeExpenseGroupId').val();
		var input_category_id = $('#PngcCodeInputCategoryId').val();
		var input_subcategory_id = $('#PngcCodeInputSubcategoryId').val();

		var url = '/pngc_codes/checkEntries/';
		
		$.ajax({
			type: 'POST',
			url : url,
			data: {'expense_group_id': expense_group_id, 'input_category_id': input_category_id, 'input_subcategory_id':input_subcategory_id},
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Combinação de categoria e subcategoria não existe. Por favor, entre em contato com o admnistrador do sistema</div>');					
				}else if(retorno == 0){
					$("#alert-message").html('<div class="alert alert-error">Pngc com essa combinação já cadastrado(grupo de gastos + categoria de insumo + subcategoria de insumo).</div>');
				}else if(retorno == 1) {
					$('#PngcCodeAddForm').submit();
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});		
	});
	//-----------------------------------
	//verificação antes de submitar o formulário de Input
	$('#submitInput').click(function(){
		if($("#InputAddForm").valid() == false) {
			return;
		}
		
		var input_category_id = $('#InputInputCategoryId').val();
		var input_subcategory_id = $('#InputInputSubcategoryId').val();
		
		var url = '/inputs/checkEntries/';

		$.ajax({
			type: 'POST',
			url : url,
			data: {'input_category_id': input_category_id, 'input_subcategory_id':input_subcategory_id},
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Combinação de categoria e subcategoria já está cadastrada</div>');					
				}else if(retorno == 1) {
					$('#InputAddForm').submit();
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});		
	});	
	
	//Função do filtro na solicitação dos itens
	$('#filter').click(function() {

		var item_group_id = $('#SolicitationItemItemGroupId').val();
		var item_class_id = $('#SolicitationItemItemClassId').val();
		var pngc_code_id = $('#SolicitationItemPngcCodeId').val();

		var url = '/solicitation_items/index/';

		$('#html').load(url, {'item_group_id': item_group_id, 'item_class_id': item_class_id, 'pngc_code_id': pngc_code_id});
		
	});	
	
	//Solicitação de um item via ajax
	$('.request').click(function(){
		var id = $(this).val();
		var element = $(this).parent().parent();

		var url = '/cart_items/add/'+id;
		
		$.ajax({
			type: 'POST',
			url : url,
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Não foi possível adicionar ao carrinho</div>');					
				}else if(retorno == 1) {
					element.html('<i title="Item está na lista de solicitados" alt="Item está na lista de solicitados" class="icon-shopping-cart center"></i>');
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});		
	});
	//Deleta um item do carrinho via ajax
	$('.delete_cart').click(function() {
		
		var id = $(this).val();
		
		var url = '/cart_items/delete/'+id;

		$.ajax({
			type: 'POST',
			url : url,
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Item não existe no carrinho</div>');					
				}else if(retorno == 0){
					$("#alert-message").html('<div class="alert alert-error">Não foi possível deletar o item do carrinho</div>');
				}else if(retorno == 1){
					var newUrl = aux + '/cart_items/index/';
					$("#items").load(newUrl);
				}else if(retorno == 2) {
					window.location.href = aux + '/cart_items/index/';
				}
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});		
	});	
	//Aprova um item
	$('.approved-item').click(function(){
		
		var element = $(this).parent();
		var value = $(this).val();
		var index = value.indexOf("-");

		var id = value.substring(0, index);
		var status = value.substring(index+1, value.length);

		var url = '/solicitation_items/changeStatus/'+id+'/'+status;

		$.ajax({
			url : url,
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Não foi possível aprovar o item</div>');					
				}else if(retorno == 1){
					element.html('<i title="Item aprovado" class="icon-thumbs-up"></i>');
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});
	});
	//Aprova um itens selecionados
	$('.approved-selected').click(function(){
		
		var ids = new Array();
		$('input:checked').each(function(){
			ids.push($(this).val());
		});
		
		if(ids.length == 0) {
			alert('Selecione algum item');
			return false;
		}

		if($('#selectAll').attr('checked') == 'checked') {
			//Retira o primeiro select, o que seleciona todos
			ids.shift();
		}
		
		var url = '/solicitation_items/approvedAll/';

		$.ajax({
			type: 'POST',
			url: url,
			data: {'ids':ids},			
			success: function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Não foi possível aprovar os itens</div>');					
				}else if(retorno == 1){
					$('input:checked').each(function(){
						$(this).attr('checked', false);
						$('#'+$(this).val()).html('<i title="Item aprovado" class="icon-thumbs-up"></i>');
					});
				}	
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});		
	});
	//Seleciona todos os checkbox dos itens em pendência
	$('#selectAll').click(function(){
		
		if($(this).attr('checked')) {
			$('input:unchecked').each(function(){
				$(this).attr('checked', true);
			});
		}else {
			$('input:checked').each(function(){
				$(this).attr('checked', false);
			});
		}		
	});	
	//Muda checkbox de todos os itens selecionados
	$('.check-items').click(function(){
		//Se todos os itens estão marcados e vc desmarcar algum, também desmarca a caixa que seleciona todos
		if($(this).attr('checked') != 'checked' && $('#selectAll').attr('checked') == 'checked') {
			$('#selectAll').attr('checked', false);
		}
		//Se vocẽ marcar algum item, e ele for o último que esteja desmarcado, então marca a caixa de seleção de todos os itens
		if($(this).attr('checked') == 'checked') {
			var all = $('.check-items').length;
			var selecteds =  0;
			
			$('input:checked').each(function(){
				selecteds += 1;
			});
			
			if(all == selecteds) {
				$('#selectAll').attr('checked', true);
			}
		}		
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
	
