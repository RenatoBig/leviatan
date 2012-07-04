$(document).ready(function() {
	
	//Group
	//-----------------------------------------
	//validação de formulário
	$("#GroupAddForm, #GroupEditForm").validate({ 
    	rules: { 			
			'data[Group][name]':{
				required: true
			}
		},
		messages: {
			'data[Group][name]':{
				required: "Campo obrigatório"
			}
		}
	});
	
	//User
	//-----------------
	$("#UserAddForm, #UserEditForm").validate({ 
    	rules: { 			
			'data[User][group_id]':{
				required: true
			},
			'data[User][employee_id]':{
				required: true
			},
			'data[User][password]':{
				required: true
			},
			'data[User][confirm_password]':{
				required: true,
				equalTo: "#UserPassword"
			}
		},
		messages: {
			'data[User][group_id]':{
				required: "Campo obrigatório"
			},
			'data[User][employee_id]':{
				required: "Campo obrigatório"
			},
			'data[User][password]':{
				required: "Campo obrigatório"
			},
			'data[User][confirm_password]':{
				required: "Campo obrigatório",
				equalTo: "Senhas não conferem"
			}
		}
	});
	
	//Ocultação dos campos no formulário do edit	
	$("#UserEditForm #UserGroupId").attr('disabled', true);
	$("#UserEditForm #UserEmployeeId").attr('disabled', true);
	$("#UserEditForm #UserUsername").attr('disabled', true);
	
	//Login
	//validação de formulário
	$("#UserLoginForm").validate({ 
    	rules: { 			
			'data[User][username]':{
				required: true
			},
			'data[User][password]':{
				required: true
			}
		},
		messages: {
			'data[User][username]':{
				required: "Campo obrigatório"
			},
			'data[User][password]':{
				required: "Campo obrigatório"
			}
		}
	});
	
	//Areas
	//validação de formulário
	$("#AreaAddForm, #AreaEditForm").validate({ 
    	rules: { 
			'data[Area][name]':{
				required: true
			}
		},
		messages: {
			'data[Area][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
	//Cities
	//validação de formulário
	$("#CityAddForm, #CityEditForm").validate({ 
    	rules: { 
			'data[City][keycode]':{
				required: true,
				number: true,
				minlength: 6
			},
			'data[City][name]':{
				required: true
			}
		},
		messages: {
			'data[City][keycode]':{
				required: "Campo obrigatório.",
				minlength: "Quantidade mínima de dígitos é 6.",
				number: "Apenas números são permitidos."					
			},
			'data[City][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
	//Regions
	//validação de formulário
	$("#RegionAddForm").validate({ 
    	rules: {
			'data[Region][city_id]':{
				required: true
			},
			'data[Region][area_id]':{
				required: true
			}
		},
		messages: {			
			'data[Region][city_id]':{
				required: "Campo obrigatório"
			},
			'data[Region][area_id]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
	//Combobox
	$('#RegionAddForm #RegionAreaId').parent().hide();
	
	$('#RegionCityId').change(function() {
		if($(this).val() == 0) {
			$('#RegionAreaId').parent().hide('slow');
		}else {
			$('#RegionAreaId').parent().show('slow');
		}
	});	
	
});