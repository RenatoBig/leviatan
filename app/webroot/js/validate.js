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
	//---------------------------------------
	//Statuses
	$("#StatusAddForm, #StatusEditForm").validate({ 
    	rules: { 
			'data[Status][name]':{
				required: true
			}
		},
		messages: {
			'data[Status][name]':{
				required: "Campo obrigatório."
			}
		}
	});
	//--------------------------------------------
	//PNGC
	//Combobox
	$('#PngcCodeAddForm #PngcCodeInputSubcategoryId').parent().hide();
	
	$('#PngcCodeInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#PngcCodeInputSubcategoryId').parent().hide('slow');
		}else {
			$('#PngcCodeInputSubcategoryId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#PngcCodeAddForm, #PngcCodeEditForm").validate({ 
    	rules: { 
			'data[PngcCode][keycode]':{
				required: true,
			},
			'data[PngcCode][expense_group_id]':{
				required: true
			},
			'data[PngcCode][functional_unit_id]':{
				required: true
			},
			'data[PngcCode][input_category_id]':{
				required: true
			},
			'data[PngcCode][input_subcategory_id]':{
				required: true
			},
			'data[PngcCode][measure_type_id]':{
				required: true
			}
		},
		messages: {
			'data[PngcCode][keycode]':{
				required: "Este campo é obrigatório",
			},
			'data[PngcCode][expense_group_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][functional_unit_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][input_category_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][input_subcategory_id]':{
				required: "Este campo é obrigatório"
			},
			'data[PngcCode][measure_type_id]':{
				required: "Este campo é obrigatório"
			}
		}
	}); 
	
	//-----------------------------
	//MeasureType
	//validação de formulário
	$("#MeasureTypeAddForm, #MeasureTypeEditForm").validate({ 
    	rules: { 
			'data[MeasureType][name]':{
				required: true,
			},
			'data[MeasureType][description]':{
				required: true,
			}
		},
		messages: {
			'data[MeasureType][name]':{
				required: "Campo obrigatório.",
			},
			'data[MeasureType][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	//--------------------------------------
	//ItemGroup
	//validação de formulário
	$("#ItemGroupAddForm, #ItemGroupEditForm").validate({ 
    	rules: { 
			'data[ItemGroup][group_type_id]':{
				required: true,
			},
			'data[ItemGroup][name]':{
				required: true
			},
			'data[ItemGroup][keycode]':{
				required: true
			}
		},
		messages: {
			'data[ItemGroup][group_type_id]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemGroup][name]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemGroup][keycode]':{
				required: "Este campo é obrigatório"
			}
		}
	});
	//---------------------------------
	//ItemClass
	//validação de formulário
	$("#ItemClassAddForm, #ItemClassEditForm").validate({ 
    	rules: { 
			'data[ItemClass][item_group_id]':{
				required: true,
			},
			'data[ItemClass][name]':{
				required: true
			},
			'data[ItemClass][keycode]':{
				required: true
			}
		},
		messages: {
			'data[ItemClass][item_group_id]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemClass][name]':{
				required: "Este campo é obrigatório"
			},
			'data[ItemClass][keycode]':{
				required: "Este campo é obrigatório"
			}
		}
	});
	//-----------------------------------
	//InputSubcategory
	//validação de formulário
	$("#InputSubcategoryAddForm, #InputSubcategoryEditForm").validate({ 
    	rules: { 			
			'data[InputSubcategory][name]':{
				required: true
			},
			'data[InputSubcategory][description]':{
				required: true
			}
		},
		messages: {
			'data[InputSubcategory][name]':{
				required: "Campo obrigatório"
			},
			'data[InputSubcategory][description]':{
				required: "Campo obrigatório"
			}
		}
	});
	//---------------------------
	//InputCategory
	//validação de formulário
	$("#InputCategoryAddForm, #InputCategoryEditForm").validate({ 
    	rules: { 			
			'data[InputCategory][name]':{
				required: true
			},
			'data[InputCategory][description]':{
				required: true
			}
		},
		messages: {
			'data[InputCategory][name]':{
				required: "Campo obrigatório"
			},
			'data[InputCategory][description]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	//------------------------------
	//Input
	//Combobox
	$('#InputAddForm #InputInputSubcategoryId').parent().hide();
	
	$('#InputInputCategoryId').change(function() {
		if($(this).val() == 0) {
			$('#InputInputSubcategoryId').parent().hide('slow');
		}else {
			$('#InputInputSubcategoryId').parent().show('slow');
		}
	});	

	//validação de formulário
	$("#InputAddForm, #InputEditForm").validate({ 
    	rules: { 			
			'data[Input][input_category_id]':{
				required: true
			},
			'data[Input][input_subcategory_id]':{
				required: true
			}
		},
		messages: {
			'data[Input][input_category_id]':{
				required: "Campo obrigatório"
			},
			'data[Input][input_subcategory_id]':{
				required: "Campo obrigatório"
			}
		}
	}); 
	//-------------------
	//GroupType
	//validação de formulário
	$("#GroupTypeAddForm, #GroupTypeEditForm").validate({ 
    	rules: { 
			'data[GroupType][name]':{
				required: true,
			}
		},
		messages: {
			'data[GroupType][name]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	//-------------------------------------
	//FunctionalUnity
	//validação de formulário
	$("#FunctionalUnitAddForm, #FunctionalUnitEditForm").validate({ 
    	rules: { 
			'data[FunctionalUnit][name]':{
				required: true,
			},
			'data[FunctionalUnit][description]':{
				required: true,
			}
		},
		messages: {
			'data[FunctionalUnit][name]':{
				required: "Campo obrigatório.",
			},
			'data[FunctionalUnit][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
	//---------------------------------
	//ExpenseGroup
	//validação de formulário
	$("#ExpenseGroupAddForm, #ExpenseGroupEditForm").validate({ 
    	rules: { 
			'data[ExpenseGroup][name]':{
				required: true,
			},
			'data[ExpenseGroup][description]':{
				required: true,
			}
		},
		messages: {
			'data[ExpenseGroup][name]':{
				required: "Campo obrigatório.",
			},
			'data[ExpenseGroup][description]':{
				required: "Campo obrigatório.",
			}
		}
	}); 
});