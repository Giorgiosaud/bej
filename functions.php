<?php
#recuerda eliminar readme.html de la carpeta raiz de wordpress
#crea archivo robots.tx en la raiz con el siguiente contenido
/*
User-agent: *

Disallow: /feed/
Disallow: /trackback/
Disallow: /wp-admin/
Disallow: /wp-content/
Disallow: /wp-includes/
Disallow: /xmlrpc.php
Disallow: /wp-
*/
/*

desactiva editor de codigo en el administrador para evitar daños futuros añadiendo a wp-config esta linea
define('DISALLOW_FILE_EDIT', true);
desactiva actualizacion de plugins  tambien añadiendo
define('DISALLOW_FILE_MODS', true);
cambia los valores de AUTH / SALT

usa prefijos de base de datos distintos
 */

// desactiva errores de pagina login
function login_errors_message() {
	return 'Ooooops!';
}
add_filter('login_errors', 'login_errors_message');
// Elimina basura del head
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
// elimina el codigo HTML de los comentarios
add_filter('pre_comment_content', 'wp_specialchars');

if(function_exists('acf_add_options_page')){
	acf_add_options_page(array(
		'page_title'=>'Theme Options',
		'menu_title'=>'Theme Options',
		'menu_slug'=>'theme-options',
		'capability'=>'edit_posts',
		'parent_slug'=>'',
		'position'=>false,
		'icon_url'=>false,
		'redirect'=>true
		));
	acf_add_options_sub_page(array(
		'page_title'=>'Main Options',
		'menu_title'=>'Main Options',
		'menu_slug'=>'main-options',
		'capability'=>'edit_posts',
		'parent_slug'=>'theme-options',
		'position'=>false,
		'icon_url'=>false,
		));
	acf_add_options_sub_page(array(
		'page_title'=>'Social Network',
		'menu_title'=>'Social Network',
		'menu_slug'=>'social-network',
		'capability'=>'edit_posts',
		'parent_slug'=>'theme-options',
		'position'=>false,
		'icon_url'=>false,
		));
	acf_add_options_sub_page(array(
		'page_title'=>'Footer',
		'menu_title'=>'Footer',
		'menu_slug'=>'footer',
		'capability'=>'edit_posts',
		'parent_slug'=>'theme-options',
		'position'=>false,
		'icon_url'=>false,
		));
	
	

}
include_once "vendor/autoload.php";

$tema=new \WordpressBase\Initializer();
add_filter('wp_nav_menu_items','add_todaysdate_in_menu', 10, 2);
function add_todaysdate_in_menu( $items, $args ) {
	// var_dump($args);	
	if( $args->fallback_cb == 'menu-principal')  {
		if(get_header_image()){
			$CustomHeader='<li class="Menu__customTitle"><a href="/" title="Home"><img src="'.get_header_image().'" alt="'.get_bloginfo( 'title' ).'" /></a></li>';
		}
		else{
			$CustomHeader='<li class="Menu__customTitle"><a href="/" title="Home">'.get_bloginfo( 'title' ).'</a></li>';	
		}
		$SocialNetwork='';
		if( have_rows('social_networks', 'option') ):

			while( have_rows('social_networks', 'option') ): 
				the_row();
				$logo=get_sub_field('logo');
				
				$SocialNetwork.='<li class="Menu__social-network"><a href="'.get_sub_field('link').'"><span class="socicon socicon-'.$logo.'"></span></a></li>';
				endwhile;
		endif;
		$iconHamburger='<li class="Menu__toogleButton"><button id="Menu__collapse"type="button" class="navbar-toggle collapsed"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button></li>';
		$newItems=$CustomHeader.$items.$SocialNetwork.$iconHamburger;

	}
	return $newItems;
}
add_action( 'wp_ajax_send_contact', 'send_contact' );
add_action( 'wp_ajax_nopriv_send_contact', 'send_contact' );

function send_contact() {
	$emailTo= get_field('emailTo', 'option');
	$headers = 'From: Norelly Web <web@obamacaresalud.net>' . "\r\n";
	$mensaje=$_POST['name'].' '.$_POST['last_name'];
	$mensaje.=" contact you by the webpage: ";
	$mensaje.=" Phone Number ".$_POST['phone'];
	$mensaje.=" Email: ".$_POST['email'];
	$mensaje.=" and said: ".$_POST['message'];
	$asunto="Contacto Web";
	wp_mail($emailTo,$asunto,$mensaje,$headers);
	echo $mensaje;
	echo 'enviado';
	die();
}

//[foobar]
function class_func( $atts ,$content){
	$a = shortcode_atts( array(
		'nombre' => 'clase',
	), $atts );

	return '<div class="'.$a['nombre'].'">'.do_shortcode($content).'</div>';
}
add_shortcode( 'class', 'class_func' );
function article_func( $atts ,$content){
	$a = shortcode_atts( array(
		'nombre' => 'article',
	), $atts );

	return '<article class="'.$a['nombre'].'">'.do_shortcode($content).'</article>';
}
add_shortcode( 'article', 'article_func' );
function span_func( $atts ,$content){
	$a = shortcode_atts( array(
		'nombre' => 'destacado',
	), $atts );

	return '<span class="'.$a['nombre'].'">'.do_shortcode($content).'</span>';
}
add_shortcode( 'span', 'span_func' );
show_admin_bar( false );
// var_dump($tema);
// define( 'ACF_LITE', true );

// wp_enqueue_script( 'mi-script-ajax',get_bloginfo('stylesheet_directory') . '/js/ajax-search.js', array( 'jquery' ) );
// ahora declaramos la variable MyAjax y le pasamos el valor url (wp-admin/admin-ajax.php) al script ajax-search.js
// wp_localize_script( 'mi-script-ajax', 'MyAjax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
//Para manejar admin-ajax tenemos que añadir estas dos acciones.
//IMPORTANTE!! Para que funcione reemplazar "enviar_correo" por vuestra action definida en ajax-search.js
add_action('wp_ajax_enviar_correo', 'enviar_correo_callback');
add_action('wp_ajax_nopriv_enviar_correo', 'enviar_correo_callback');
function enviar_correo_callback() {
	$mailTo=get_field('emailTo', 'option');
	$headers='From: Global Bej Web Page <info@globalbej.com>' . "\r\n";
	$body='Te ha Contactado '.$_POST['nombre'].' cuyo correo es '.$_POST['email'].' y te contacto para lo siguiente: ';
	$body .= $_POST['mensaje'];
	$subj = 'Contact Us Web';
	wp_mail( $mailTo, $subj, $body,$headers );
	$subj = 'Contact Us Web (copied)';
	wp_mail( $_POST['email'], $subj, $body,$headers );
	echo 'We will put in touch with you as soon as possible from'.$mailTo;

	die(); // Siempre hay que terminar con die
}