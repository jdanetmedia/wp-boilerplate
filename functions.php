<?php

/* Stylesheet + Javascript fil registreres */

function bmn_script_enqueue() {
	
	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/bmn.css', array(), '1.0', 'all');
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/bmn.js', array(), '1.0', true);
	
}

add_action('wp_enqueue_scripts', 'bmn_script_enqueue');

/* Tilføj jQuery bibliotek */

if (!is_admin()) add_action("wp_enqueue_scripts", "my_jquery_enqueue", 11);

function my_jquery_enqueue() {
   wp_deregister_script('jquery');
   wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js", false, null);
   wp_enqueue_script('jquery');
}

/* ------------------------------------------------ */

/* Registrering af menuer */

function bmn_theme_setup() {
	
	add_theme_support('menus');
	
	register_nav_menu('primary', 'Primær navigation');
	register_nav_menu('footermenu', 'Footer navigation');

}

add_action('init', 'bmn_theme_setup');

/* ------------------------------------------------ */

/* Tilføj custom background funktionalitet */

function own_background() {
	add_theme_support('custom-background');
}

add_action('init', 'own_background');

/* ------------------------------------------------ */

/* Tilføj custom header uden brug af funktion */

$defaults = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 1200,
	'height'                 => 600,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

/* ------------------------------------------------ */

/* Tilføj featured images uden brug af funktion */

add_theme_support('post-thumbnails');

/* ------------------------------------------------ */

/* Tilføj forskellige post formats */

add_theme_support('post-formats',array('aside', 'image', 'video'));

/* ------------------------------------------------ */

/* Registrer sidebar og widget area */

function bmn_widget_setup() {
	register_sidebar(
		array(
			'name' => 'Sidebar',
			'id' => 'sidebar-1',
			'class' => 'custom',
			'description' => 'Standard højre sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name' => 'Home CTA',
			'id' => 'home-cta',
			'class' => 'custom',
			'description' => 'Widgets til de tre bokse på forsiden',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init','bmn_widget_setup');

/* ------------------------------------------------ */

/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Produkter', 'Post Type General Name', 'bmn' ),
		'singular_name'       => _x( 'Produkt', 'Post Type Singular Name', 'bmn' ),
		'menu_name'           => __( 'Produkter', 'bmn' ),
		'parent_item_colon'   => __( 'Parent produkt', 'bmn' ),
		'all_items'           => __( 'Alle produkter', 'bmn' ),
		'view_item'           => __( 'Vis produkt', 'bmn' ),
		'add_new_item'        => __( 'Tilføj nyt produkt', 'bmn' ),
		'add_new'             => __( 'Tilføj nyt', 'bmn' ),
		'edit_item'           => __( 'Rediger produkt', 'bmn' ),
		'update_item'         => __( 'Opdater produkt', 'bmn' ),
		'search_items'        => __( 'Søg produkt', 'bmn' ),
		'not_found'           => __( 'Ikke fundet', 'bmn' ),
		'not_found_in_trash'  => __( 'Ikke fundet i trash', 'bmn' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'produkter', 'twentythirteen' ),
		'description'         => __( 'Contenttype til brug til produkter', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'taxonomy'),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array( 'category' ),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'produkter', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type', 0 );

// Replaces the excerpt "Read More" text by a link
function new_excerpt_more($more) {
       global $post;
	return '<p><a class="moretag" href="'. get_permalink($post->ID) . '">Læs mere</a></p>';
}
add_filter('excerpt_more', 'new_excerpt_more');
