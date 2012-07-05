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
	
	//UnitiyType
	//validação de formulário
	$("#UnityTypeAddForm, #UnityTypeEditForm").validate({ 
    	rules: { 			
			'data[UnityType][name]':{
				required: true
			}
		},
		messages: {
			
			'data[UnityType][name]':{
				required: "Campo obrigatório."
			}
		}
	});
	
	//HealthDistrict
	//validação de formulário
	$("#HealthDistrictAddForm, #HealthDistrictEditForm").validate({ 
    	rules: { 			
			'data[HealthDistrict][name]':{
				required: true
			}
		},
		messages: {
			
			'data[HealthDistrict][name]':{
				required: "Campo obrigatório."
			}
		}
	});
	
	//Unities
	//---------------------	
	//Combobox
	$('#UnityAddForm #UnityRegionId').parent().hide();
	
	$('#UnityCityId').change(function() {
		if($(this).val() == 0) {
			$('#UnityRegionId').parent().hide('slow');
		}else {
			$('#UnityRegionId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#UnityAddForm, #UnityEditForm").validate({ 
    	rules: { 
			'data[Unity][cnes]':{
				required: true,
			},
			'data[Unity][cnpj]':{
				required: true
			},
			'data[Unity][name]':{
				required: true
			},
			'data[Unity][city_id]':{
				required: true,
			},
			'data[Unity][region_id]':{
				required: true,
			},
			'data[Unity][health_district_id]':{
				required: true,
			},
			'data[Unity][unity_type_id]':{
				required: true,
			}
		},
		messages: {
			'data[Unity][cnes]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][cnpj]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][name]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][city_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][region_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][health_district_id]':{
				required: "Este campo é obrigatório"
			},
			'data[Unity][unity_type_id]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
	//-------------------------
	//Unity_sector
	//validação de formulário
	$("#UnitySectorAddForm, #UnitySectorEditForm").validate({ 
    	rules: { 
			'data[UnitySector][unity_id]':{
				required: true,
			},
			'data[UnitySector][sector_id]':{
				required: true
			}
		},
		messages: {
			'data[UnitySector][unity_id]':{
				required: "Este campo é obrigatório"
			},
			'data[UnitySector][sector_id]':{
				required: "Este campo é obrigatório"
			}
		}
	});
	
	//Combobox
	$('#UnitySectorAddForm #UnitySectorSectorId').parent().hide();
	
	$('#UnitySectorUnityId').change(function() {
		if($(this).val() == 0) {
			$('#UnitySectorSectorId').parent().hide('slow');
		}else {
			$('#UnitySectorSectorId').parent().show('slow');
		}
	});	
	
	//--------------------
	//Sector
	//validação de formulário
	$("#SectorAddForm, #SectorEditForm").validate({ 
    	rules: { 
			'data[Sector][name]':{
				required: true
			}
		},
		messages: {
			'data[Sector][name]':{
				required: "Campo obrigatório."
			}
		}
	}); 
	
	//-------------------
	//Employees
	//Combobox
	$('#EmployeeAddForm #sector').parent().hide();
	
	$('#unity_id').change(function() {
		if($(this).val() == 0) {
			$('#sector').parent().hide('slow');
		}else {
			$('#sector').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#EmployeeAddForm, #EmployeeEditForm").validate({ 
    	rules: { 
			'data[Employee][registration]':{
				required: true,
				number: true,
				minlength: 6
			},
			'data[Employee][Unity]':{
				required: true
			},
			'data[Employee][unity_sector_id]':{
				required: true
			},
			'data[Employee][name]':{
				required: true,
				minlength: 3
			}
		},
		messages: {
			'data[Employee][registration]':{
				required: "Este campo é obrigatório.",
				minlength: "Quantidade mínima de dígitos é 6.",
				number: "Apenas números são permitidos."					
			},
			'data[Employee][Unity]':{
				required: "Selecione uma unidade."
			},
			'data[Employee][unity_sector_id]':{
				required: "Selecione um setor"
			},
			'data[Employee][name]':{
				required: "Este campo é obrigatório.",
				minlength: "Nome muito pequeno."
			}
		}
	});
	
	//---------------------
	//Items
	//validação de formulário
	$("#ItemAddForm, #ItemEditForm").validate({ 
    	rules: { 
			'data[Item][item_class_id]':{
				required: true,
			},
			'data[Item][pngc_code_id]':{
				required: true
			},
			'data[Item][name]':{
				required: true
			},
			'data[Item][description]':{
				required: true
			}
		},
		messages: {
			'data[Item][item_class_id]':{
				required: "Campo obrigatório"
			},
			'data[Item][pngc_code_id]':{
				required: "Campo obrigatório"
			},
			'data[Item][name]':{
				required: "Campo obrigatório"
			},
			'data[Item][description]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	
});