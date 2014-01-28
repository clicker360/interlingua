<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function custom_cursosregulares() { 
	// creating (registering) the custom type 
	register_post_type( 'cursosregulares', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Cursos Regulares', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Cursos', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos los Cursos', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Curso', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo Curso', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver Curso', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar Curso', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron Cursos.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron Cursos en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de Curso', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'cursosregulares', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'cursosregulares', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'cursosregulares');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'cursosregulares');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_cursosregulares');

// let's create the function for the custom type
function custom_cursosjovenes() { 
	// creating (registering) the custom type 
	register_post_type( 'cursosjovenes', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Cursos Niños / Adolecentes', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Cursos', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos los Cursos', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Curso', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo Curso', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver Curso', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar Curso', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron Cursos.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron Cursos en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de Curso', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'cursosjovenes', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'cursosjovenes', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'cursosjovenes');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'cursosjovenes');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_cursosjovenes');

// let's create the function for the custom type
function custom_cursosempresas() { 
	// creating (registering) the custom type 
	register_post_type( 'cursosempresas', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Cursos Empresas', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Cursos', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos los Cursos', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Curso', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo Curso', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver Curso', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar Curso', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron Cursos.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron Cursos en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de Curso', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'cursosempresas', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'cursosempresas', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'cursosempresas');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'cursosempresas');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_cursosempresas');

// let's create the function for the custom type
function custom_cursosdiversos() { 
	// creating (registering) the custom type 
	register_post_type( 'cursosdiversos', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Cursos Especiales', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Cursos', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos los Cursos', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Curso', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo Curso', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver Curso', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar Curso', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron Cursos.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron Cursos en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de Curso', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'cursosdiversos', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'cursosdiversos', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'cursosdiversos');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'cursosdiversos');
	
} 


	// adding the function to the Wordpress init
	add_action( 'init', 'custom_cursosdiversos');



// let's create the function for the custom type
function custom_faq() { 
	// creating (registering) the custom type 
	register_post_type( 'faq', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('faq', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('faq', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos las F.A.Q.', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Pagina de F.A.Q.', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo F.A.Q.', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver F.A.Q.', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar F.A.Q.', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron F.A.Q.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron F.A.Q. en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de F.A.Q.', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'faq', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'faq', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'faq');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'faq');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'custom_faq');
	

// let's create the function for the custom type
function custom_plantel() { 
	// creating (registering) the custom type 
	register_post_type( 'plantel', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Planteles', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Planteles', 'bonestheme'), /* This is the individual type */
			'all_items' => __('Todos los Planteles', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Agregar Nuevo', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Agregar Plantel', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Editar', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Editar', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('Nuevo Plantel', 'bonestheme'), /* New Display Title */
			'view_item' => __('Ver Plantel', 'bonestheme'), /* View Display Title */
			'search_items' => __('Buscar Plantel', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('No se encontraron Planteles', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('No se encontraron Planteles en la Papelera', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'Este es un ejemplo de Plantel', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/library/images/custom-curso-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'faq', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'faq', /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('category', 'plantel');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('post_tag', 'plantel');
	
} 


	// adding the function to the Wordpress init
	add_action( 'init', 'custom_plantel');

	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'custom_cat', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Custom Categories', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Category', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Categories', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Categories', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Category', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Category:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Category', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Category', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Category', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Category Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true, 
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'custom-slug' ),
    	)
    );   
    
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'custom_tag', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Custom Tags', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Custom Tag', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Custom Tags', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Custom Tags', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Custom Tag', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Custom Tag:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Custom Tag', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Custom Tag', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Custom Tag', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Custom Tag Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_admin_column' => true,
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>
