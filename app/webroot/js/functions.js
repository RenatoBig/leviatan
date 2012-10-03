$(document).ready(function() {
	
	requestItem();
	
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

	//Função que chama o formulário de adição formulário que possuem tabela de integração
	//------------------------------------------
	$('.btnCallFormAdd').click(function(){	
		var controller = $(this).val();
		callFormAdd(controller);		
	});	
	
	//Adiciona um novo select de uma subcategoria na tela de add dos insumos
	//-----------------------------------------
	$('#newSelectInput').live('click', function(){
		
		var model_integrator = 'Input';
		var model_parent = 'InputCategory';
		var model_child = 'InputSubcategory';
		var table_child = 'input_subcategories';
		var name = 'Subcategoria';		
		
		newSelect(model_integrator, model_parent, model_child, table_child, name);
		
	});	
	//-----------------------------------------
	
	//Adiciona um novo select de uma área na tela de add das regiões
	//-----------------------------------------
	$('#newSelectArea').live('click', function(){
		
		var model_integrator = 'Region';
		var model_parent = 'City';
		var model_child = 'Area';
		var table_child = 'areas';
		var name = 'Área';		
		
		newSelect(model_integrator, model_parent, model_child, table_child, name);
	});	
	//-----------------------------------------
	
	//Adiciona um novo select de um setor na tela de add de uma unidade setor
	//-----------------------------------------
	$('#newSelectUnitySector').live('click', function(){
		
		var model_integrator = 'UnitySector';
		var model_parent = 'Unity';
		var model_child = 'Sector';
		var table_child = 'sectors';
		var name = 'Setor';		
		
		newSelect(model_integrator, model_parent, model_child, table_child, name);
	});	
	//-----------------------------------------
	
	//Função que remove um select
	//-----------------------------------------
	$('.remove-select').live('click', function(){		
		$(this).parent().remove();
		return false;
	})
	//------------------------------------------
	
	//Habilitar ou desabilitar status do item
	//---------------------
	$('.enable').click(function() {
		
		var id = $(this).val();
		
		var url = forUrl('/items/changeStatus/'+id);

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
				
		var url = forUrl('/cart_items/checkout');
	
		$.ajax({
			type: 'post',
		    data: {'memo_number':memo_number, 'description':description},
		    url:url,
		    success: function(retorno){
		    	if(retorno == 1) {
			    	var newUrl = forUrl('/solicitations/index');
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
		
		var url = forUrl('/justifications/view/'+id);
		
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

		var url = forUrl('/pngc_codes/checkEntries/');
		
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
	
	//Evita submit ao aperar ENTER
	$('#PagesHomeForm, #SolicitationItemIndexForm').submit(function(e){
		return false;
	})
	//unbind
	$('#filter').unbind('click');
	//Função do filtro na solicitação dos itens, e na pagina inicial
	$('#filter').click(function() {			
		var url = '';
		
		var idGroup = '';
		var idClass = '';
		var idPngc = '';
		var idName = '';
		if($(this).val() == 'solicitation_items') {
			url = '/' + $(this).val() + '/index/';
		}else if($(this).val() == 'pages') {
			url = '/' + $(this).val() + '/home/';
		}
		
		var item_group_id = $('#item-group-id').val();
		var item_class_id = $('#item-class-id').val();
		var name = $('#search-item').val();

		var url = forUrl(url);
		$('#html').load(
			url, 
			{'item_group_id': item_group_id, 'item_class_id': item_class_id, 'item_name': name}
		);
	});	
	
	//-------------------------------------
	$('.change-quantity').click(function(e){
		
		e.preventDefault();
		var id = $(this).val();
		var data = $(this).parent('form').serialize();
		
		var url = forUrl('/cart_items/edit/'+id);
		
		$.ajax({
			type: 'POST',
			data: data,
			url: url,
			beforeSend: function() {

			},
			success: function(retorno) {
				if(retorno == 1) {
					$("#alert-message").html('<div class="alert alert-success">Quantidade alterada com sucesso</div>');
				}else if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Não foi possível alterar a quantidade. Contacte o administrador do sistema.</div>');
				}
				$("#alert-message").show();
			},
			complete: function() {
				window.setTimeout(escondeMsg, 2500);
			}
		});
		
	});
	//------------------------------------
	//Deleta um item do carrinho via ajax
	$('.delete_cart').click(function() {
		
		var id = $(this).val();
		
		var url = forUrl('/cart_items/delete/'+id);

		$.ajax({
			type: 'POST',
			url : url,
			success : function(retorno) {
				if(retorno == -1) {
					$("#alert-message").html('<div class="alert alert-error">Item não existe no carrinho</div>');					
				}else if(retorno == 0){
					$("#alert-message").html('<div class="alert alert-error">Não foi possível deletar o item do carrinho</div>');
				}else if(retorno == 1){
					var newUrl = forUrl('/cart_items/index/');
					$("#items").load(newUrl);
				}else if(retorno == 2) {
					window.location.href = forUrl('/cart_items/');
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

		var url = forUrl('/solicitation_items/changeStatus/'+id+'/'+status);

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
		
		var url = forUrl('/solicitation_items/approvedAll/');

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
	//autocomplete nome do item
	$("#search-item").autocomplete({		
		minLength: 3,
		source: function(request, response) { 
			$.ajax({
				url: "/pages/autocomplete",
			   	dataType: "json",
			   	type: 'POST',
			   	data:{
				   	item_class_id: $('#item-class-id').val(),
			   		limit : 15,
			   		term : request.term
			   	},
			   	success: function(data) {
					response(data);
				}	
			})
		}
	});	
	//autocomplete do endereço
	$(".search-address").autocomplete({		
		minLength: 3,
		source: function(request, response) { 
			$.ajax({
				url: "/unities/autocomplete",
			   	dataType: "json",
			   	type: 'POST',
			   	data:{
				   	cep: $('#input-cep').val(),
				   	model: 'Address',
			   		limit : 15,
			   		term : request.term
			   	},
			   	success: function(data) {
					response(data);
				}	
			})
		}
	});	 
	//-----------------
	//Ajax verificação do CEP
	$('#search-cep').click(function(){
		
		$('#UnityState').val('').attr('disabled', 'disabled');
		$('#UnityCity').attr('readonly', true).attr('value', '');
		$('#UnityDistrict').attr('readonly', true).attr('value', '');
		$('#UnityAddress').attr('readonly', true).attr('value', '');
		
		var cep = $("#input-cep").val();
		quantity = cep.length;
		
		if(quantity == 8) {
			
			$("#input-cep").css('background-position', 'right center');
			
			var url = forUrl('/unities/search_cep');
			
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: url,
				data: {'cep':cep},				
				success: function(result) {
					
					$('#UnityCodResponse').val(result.response);
					if(result.response == 0) {						
						$('#UnityState').removeAttr('disabled');
						$('#UnityCity').attr('readonly', false);
						$('#UnityDistrict').attr('readonly', false);
						$('#UnityAddress').attr('readonly', false);
					}else {
						
						$('#UnityStateHidden').val(result.state);
						$('#UnityState').val(result.state);
						$('#UnityCity').val(result.city);
						
						if(result.response == 1 || result.response == 3) {
							$('#UnityDistrict').val(result.district);
							$('#UnityAddress').val(result.address);
						}else if(result.response == 2) {
							$('#UnityDistrict').val(result.district);
							$('#UnityAddress').attr('readonly', false);
						}
												
					}
				},
				complete: function() {						
					$("#input-cep").css('background-position', '-40px -40px');
				}
			});			
		}
	});
	
});

function escondeMsg() {   		
	$("#flashMessage, #alert-message").fadeOut();
}

forUrl = function(url) {
    return $('base').attr('href')+url.substr(1);
}

function submit(model, table) {
	if($('#'+model+'AddForm').valid() == false) {
		return;
	}
	;
	var values = new Array();
	var cont = 0;
	$('select').each(function(){
		values[cont] = $(this).val();
		cont++;
	});
	
	var url = forUrl('/'+table+'/checkEntries/');

	$.ajax({
		type: 'POST',
		data: 'values='+values,
		url : url,
		success : function(retorno) {
			if(retorno == 0) {
				$("#alert-message").html('<div class="alert alert-error">Entrada duplicada</div>');					
			}else if(retorno == -1) {
				$("#alert-message").html('<div class="alert alert-error">Combinação já está cadastrada</div>');					
			}else if(retorno == 1) {
				$('#'+model+'AddForm').submit();
			}	
			$("#alert-message").show();
		},
		complete: function() {
			window.setTimeout(escondeMsg, 2500);
		}
	});		
}

function callFormAdd(controller) {
	var url = forUrl('/'+controller+'/add');

	$.ajax({
		url: url,
		success: function(retorno){
			$('.modal-body').html(retorno);
			$('#modal-category').modal();
		}
	});
}

function newSelect(model_integrator, model_parent, model_child, table_child, name) {
	
	var indice = $('.newselect').length + 1;
	var element_parent = model_integrator+model_parent+'Id';
	var forLabel = model_integrator+model_child+'Id';
	var idSelect = forLabel+'-'+indice;
	var nameSelect = getNameSelect(model_integrator, indice);
	
	if($('#'+element_parent).val() == '') {
		if(model_integrator == 'Input') {
			alert('Selecione uma categoria');
		}else if(model_integrator == 'Region') {
			alert('Selecione uma cidade');
		}else if(model_integrator == 'UnitySector'){
			alert('Selecione uma unidade');
		}
		
		return false;
	}		
	
	var values = new Array();
	var cont = 0;
	$('select').each(function(){
		values[cont] = $(this).val();
		cont++;
	});	
			
    var url = forUrl('/'+table_child+'/get_children/');
    
    $.ajax({
    	type: 'POST',
    	dataType: 'json',
    	url: url,
    	data: 'values='+values,
    	success: function(result) {
    		
    		var options = "";    		
    		$.each(result, function(key, val) {
    			options += '<option value="' + key + '">' + val + '</option>';
    		});
    		
    		if(options) {
    			//Adicionado no final do elemento ( #boxFields) os campos
    			var div = $(document.createElement('div')).attr('class', 'input select newselect').attr('id', 'select-'+indice);
    			var label = $(document.createElement('label')).attr('for', forLabel).html(name);
    			var select = $(document.createElement('select')).attr('id', idSelect).attr('name', nameSelect);
    			var link = $(document.createElement('a')).attr('class', 'remove-select').attr('href', 'javascript:void(0)');
    			var img = $(document.createElement('img')).attr('alt', 'Remover select').attr('src', '/img/remove.png');
    			img.appendTo(link);
    			label.appendTo(div);
    			select.appendTo(div);
    			link.appendTo(div);
    			
    			div.appendTo("#boxFields");    			
    			
    			$('#'+idSelect).html(options);
    		}else {
    			alert('Não existem mais opções');
    		}
    	}
    });
    
    
    return false
}

function getNameSelect(model_integrator, indice) {
	
	var name = '';
	
	switch(model_integrator) {
		case "Input":
			name = 'data[Input][input_subcategory_id]['+indice+']';
			break;
		case "Region":
			name = 'data[Region][area_id]['+indice+']';
			break;
		case "UnitySector":
			name = 'data[UnitySector][sector_id]['+indice+']';
			break;
	}
	
	return name;
}

function selectFill(controller, action, value, id) {
	
	var url = forUrl('/'+controller+'/'+action);
	
	$.ajax({
    	type: 'POST',
    	dataType: 'json',
    	url: url,
    	data: {'parent_id':value},
    	success: function(result) {

    		var options = "";    		
    		$.each(result, function(key, val) {
    			options += '<option value="' + key + '">' + val + '</option>';
    		});
    		
    		var id_element = 'select_child';
    		
    		if(typeof(id) != "undefined") {
    			id_element = id;
    		}
    		
    		$('#'+id_element).html(options);
    	}
    });
}

function requestItem() {
	//Solicitação de um item via ajax
	$('.request').click(function(e){		
		e.preventDefault();
		var id = $(this).val();
		var element = $(this).parent().parent();

		var url = forUrl('/cart_items/add/'+id);
		
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
}
