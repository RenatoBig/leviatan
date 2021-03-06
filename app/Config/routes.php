<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	//Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/', array('controller'=>'pages', 'action'=>'home'));
	
	Router::connect('/admin/acl', 
		array(
			'plugin' => 'acl', 
			'controller' => 'acl', 
			'action' => 'index', 
			'admin' => true
		)
	);
	
	Router::parseExtensions('pdf');
	
	//URLs AMIGÁVEIS
	Router::connect(
		'/item/:titulo-:id.html',
		array('controller'=>'items', 'action'=>'view'),
		array(
			'pass'=>array('id'),
			'id'=>'[0-9]+'
		)
	);		
	//------
	Router::connect(
		'/itens/classe/:titulo-:id.html',
		array('controller'=>'item_classes', 'action'=>'view'),
		array(
			'pass'=>array('id'),
			'id'=>'[0-9]+'
		)
	);
	//-----
	Router::connect(
		'/item/pngc/:titulo-:id.html',
		array('controller'=>'pngc_codes', 'action'=>'view'),
		array(
			'pass'=>array('id'),
			'id'=>'[0-9]+'
		)
	);
	//-----
	Router::connect(
		'/item/grupo/:titulo-:id.html',
		array('controller'=>'item_groups', 'action'=>'view'),
		array(
			'pass'=>array('id'),
			'id'=>'[0-9]+'
		)
	);
	//-----
	Router::connect(
		'/pedidos',
		array('controller'=>'orders', 'action'=>'index'),
		array()			
	);
	//-----
	Router::connect(
			'/itens',
			array('controller'=>'items', 'action'=>'index'),
			array()
	);
	
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	//Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
	

