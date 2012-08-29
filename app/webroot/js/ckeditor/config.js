/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};

CKEDITOR.editorConfig = function( config )
{
	config.toolbar = 'MyToolbar';
	
	config.resize_enabled = false;

	config.toolbar_MyToolbar =
	[
		//{ name: 'document', items : [ 'NewPage','Preview' ] },
		//{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		{ name: 'styles', items : [ 'Styles','Format', 'Font', 'FontSize' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink' ] },
		{ name: 'insert', items : [ 'Table'] }
		//{ name: 'tools', items : [ 'Maximize','-','About' ] }
	];

	config.toolbar = 'None';

	config.toolbar_None =
	[
		//{ name: 'document', items : [ 'NewPage','Preview' ] },
		//{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		//{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
		//{ name: 'styles', items : [ 'Styles','Format', 'Font', 'FontSize' ] },
		//{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		//{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		//{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		//{ name: 'links', items : [ 'Link','Unlink' ] },
		//{ name: 'insert', items : [ 'Table'] }
		//{ name: 'tools', items : [ 'Maximize','-','About' ] }
	];
};

