<?php

define('NIMBUS_ROOT', get_template_directory_uri());


include_once ('includes/nimbus_menu.php');
include_once ('includes/nimbus_short_codes.php');
include_once ('includes/nimbus_meta_boxes.php');
include_once('wp-load.php');
include_once ('includes/quote_db.php');





//Elimina la inserción de parrafor automaticamente
remove_filter('the_content', 'wpautop');


/**
 * Register Styles 
 */
if(!function_exists('nimbus_enqueue_style')){
	function nimbus_enqueue_styles(){
		wp_enqueue_style('bootstrap_css',NIMBUS_ROOT.'/css/bootstrap.min.css',false,null);	
		wp_enqueue_style('stylish-portolio',NIMBUS_ROOT.'/css/stylish-portfolio.css',false,null);	
		wp_enqueue_style('fuelux_css',NIMBUS_ROOT.'/js/plugins/fuelux/css/fuelux.css',false,null);
		wp_enqueue_style('nimbus-style',NIMBUS_ROOT.'/css/nimbus-style.css',false,null);
		wp_enqueue_style('font-awesome',NIMBUS_ROOT.'/font-awesome/css/font-awesome.css',false,null);
		wp_enqueue_style('style-icon',NIMBUS_ROOT.'/iconmoon/style.css',false,null);
		wp_enqueue_style('bootstrap-select_css',NIMBUS_ROOT.'/css/bootstrap-select.min.css',false,null);
		wp_enqueue_style('fonts-googleapis','http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic',false,null);	
		//wp_enqueue_style('slidorion-css',NIMBUS_ROOT.'/js/plugins/slidorion/css/slidorion.css',false,null);
		//wp_enqueue_style('slidorion-style-css',NIMBUS_ROOT.'/js/plugins/slidorion/css/slidorion-style.css',false,null);
	}
	add_action('wp_enqueue_scripts','nimbus_enqueue_styles');
}

/**
 * Register Scripts javascript
 */
if(!function_exists('nimbus_enqueue_scripts')){
	function nimbus_enqueue_scripts(){
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap-js',NIMBUS_ROOT.'/js/bootstrap.min.js');
		wp_enqueue_script('nimbus-scroll',NIMBUS_ROOT.'/js/libraries/nimbus-scroll.js');
		wp_enqueue_script('nimbus-functions',NIMBUS_ROOT.'/js/libraries/nimbus-functions.js');
		wp_enqueue_script('fuelux-js',NIMBUS_ROOT.'/js/plugins/fuelux/js/fuelux.min.js');
		wp_enqueue_script('slidorion-js',NIMBUS_ROOT.'/js/plugins/slidorion/js/jquery.slidorion.js');
		wp_enqueue_script('jquery-easing-js',NIMBUS_ROOT.'/js/plugins/slidorion/js/jquery.easing.js');
		wp_enqueue_script('nimbus-cot-js',NIMBUS_ROOT.'/js/libraries/nimbus-cot.js');
		wp_enqueue_script('bootstrap-select-js',NIMBUS_ROOT.'/js/bootstrap-select.min.js');
	}
	add_action('wp_enqueue_scripts', 'nimbus_enqueue_scripts');
}

/**
 * Register menus
 */
 if(!function_exists('nimbus_register_menus')){
 	function nimbus_register_menus(){
 		/**
		 * Register Nav Menu Home
		 */
 		register_nav_menus(array(
			'nimbus_nav_menu_home' => __('Home Menu', 'nimbus')
		));
		
		/**
		 * Registramos un menu para las páginas
		 */
 		register_nav_menus(array(
			'nimbus_nav_menu_page' => __('Page Menu', 'nimbus')
		));
 	}
 	add_action('after_setup_theme','nimbus_register_menus');
 }
 
 
 /**
  * Register custon post types Home Section
  */
 if(!function_exists('nimbus_register_post_types')){
 	function nimbus_register_post_types(){
 		//Register Home Section
 		$nimbus_home_section_args = array(
			'labels'	=> array(
				'name'               => 'Home Sections',
				'singular_name'      => 'Home Section',
				'menu_name'			 => 'Home Sections',
				'name_admin_bar'     => 'Home Sections',
				'all_items'			 => 'Home Sections',
				'add_new'            => 'Add New Section',
				'add_new_item'       => 'Add New Item',
				'edit_item'          => 'Edit Item',
				'new_item'           => 'New Item',
				'view_item'			 => 'View Item',
				'search_items'       => 'Search Item',
				'not_fount'			 => 'Not Fount',
				'not_fount_in_trash' => 'Not Fount In Trash',
			),
			'description'		  => 'Sección usada para el Home',
			'public'			  => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => 'public',
			'show_ui'			  => true,
			'show_in_nav_menus'	  => 'public',
			'show_in_menu'		  => true,
			'show_in_admin_bar'	  => true,
			'menu_positio'        => 5,
			'query_var'			  => 'home_section'
		);
		register_post_type('nimbus_home_section',$nimbus_home_section_args);
 	}
	add_action('init','nimbus_register_post_types');
 }




/**
 * Register Meta Boxes
 */
if(!function_exists('nimbus_add_meta_boxes')){
	function nimbus_add_meta_boxes(){
		add_meta_box(
			'home_section_position',
			__('Posición en el Home'),
			'nimbus_home_section_meta_box',
			'nimbus_home_section'
		);
		
		add_meta_box(
			'home_section_id',
			__('ID de la sección'),
			'nimbus_home_section_id_meta_box',
			'nimbus_home_section'
		);
		
		add_meta_box(
			'home_section_class',
			__('Clases de la sección'),
			'nimbus_home_section_class_meta_box',
			'nimbus_home_section'
		);
		
		add_meta_box(
			'home_section_bg_img',
			__('URL Background Image'),
			'nimbus_home_section_bg_img_meta_box',
			'nimbus_home_section'
		);
	}
	add_action('add_meta_boxes','nimbus_add_meta_boxes');
}




 /**
  * Register custon post types Home Section
  */
 if(!function_exists('nimbus_register_footer_section_post_types')){
 	function nimbus_register_footer_section_post_types(){
 		//Register Footer Section
 		register_post_type( 'footer_section',
			array(
				'labels' => array(
					'name' => __( 'Footer Sections' ),
					'singular_name' => __( 'Footer Section' )
				),
				'public' => true,
				'has_archive' => true,
			)
		);
 	}
	add_action('init','nimbus_register_footer_section_post_types');
 }
 
 /**
  * Opciones del tema Nimbus
  */
if(!function_exists('nimbus_options_theme')){
	function nimbus_options_theme(){
		add_theme_page( 'Opciones Theme', 'Opciones Theme', 'edit_theme_options', 'opciones_theme', 'nimbus_theme_page' );
	}
	add_action('admin_menu','nimbus_options_theme');
}

function nimbus_theme_page(){
	echo "Página de configuración del tema";
}

/**
 * Hook para procesar el formulario de cotizaciones Aéreas
 */
if(!function_exists('processes_quote_form_aereo')){
 	function processes_quote_form_aereo(){
 		ob_start();
		$template = locate_template("/templates/quote_result_aereo.php");
		load_template($template);
		$template_content = ob_get_contents();
		ob_end_clean();
		echo $template_content;
    	die();
 	}
	add_action('admin_post_opx_quote_aereo','processes_quote_form_aereo');
	add_action('admin_post_nopriv_opx_quote_aereo', 'processes_quote_form_aereo');
}


/**
 * Hook para procesar el formulario de cotizaciones Marítimas
 */
if(!function_exists('processes_quote_form_maritimo')){
 	function processes_quote_form_maritimo(){
 		ob_start();
		$template = locate_template("/templates/quote_result_maritimo.php");
		load_template($template);
		$template_content = ob_get_contents();
		ob_end_clean();
		echo $template_content;
    	die();
 	}
	add_action('admin_post_opx_quote_maritimo','processes_quote_form_maritimo');
	add_action('admin_post_nopriv_opx_quote_maritimo', 'processes_quote_form_maritimo');
}
 
















