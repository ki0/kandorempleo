<?php

// Disable WordPress version reporting as a basic protection against attacks
function remove_generators() {
	return '';
}		

add_filter('the_generator','remove_generators');

// Add thumbnail support

add_theme_support( 'post-thumbnails' );

// Disable the admin bar, set to true if you want it to be visible.

show_admin_bar(FALSE);

// Shortcodes

include('shortcodes.php');

// Add theme support for Automatic Feed Links

add_theme_support( 'automatic-feed-links' );

// Custom Navigation

add_theme_support('nav-menus');

if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
		  // - Header Navigation
		  'header-menu' => 'Header Navigation',
		)
	);
}

// Sidebars

if (function_exists('register_sidebar')) {

	// Right Sidebar

	register_sidebar(array(
		'name'=> 'Right Sidebar',
		'id' => 'right_sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
	// Footer Sidebar
	
	register_sidebar(array(
		'name'=> 'Footer Sidebar',
		'id' => 'footer_sidebar',
		'before_widget' => '<div id="%1$s" class="four columns %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
}

// Comments

// Custom callback to list comments in the Foundation style
function custom_comments($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth;
  ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
        <div class="comment-author vcard"><?php commenter_link() ?></div>
        <div class="comment-meta"><?php printf(__('Posted %1$s at %2$s <span class="meta-sep">|</span> <a href="%3$s" title="Permalink to this comment">Permalink</a>', 'Foundation'),
                    get_comment_date(),
                    get_comment_time(),
                    '#comment-' . get_comment_ID() );
                    edit_comment_link(__('Edit', 'Foundation'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
  <?php if ($comment->comment_approved == '0') _e("\t\t\t\t\t<span class='unapproved'>Your comment is awaiting moderation.</span>\n", 'Foundation') ?>
          <div class="comment-content">
            <?php comment_text() ?>
        </div>
        <?php // echo the comment reply link
            if($args['type'] == 'all' || get_comment_type() == 'comment') :
                comment_reply_link(array_merge($args, array(
                    'reply_text' => __('Reply','Foundation'),
                    'login_text' => __('Log in to reply.','Foundation'),
                    'depth' => $depth,
                    'before' => '<div class="comment-reply-link">',
                    'after' => '</div>'
                )));
            endif;
        ?>
<?php } // end custom_comments

// Custom callback to list pings
function custom_pings($comment, $args, $depth) {
       $GLOBALS['comment'] = $comment;
        ?>
            <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
                <div class="comment-author"><?php printf(__('By %1$s on %2$s at %3$s', 'Foundation'),
                        get_comment_author_link(),
                        get_comment_date(),
                        get_comment_time() );
                        edit_comment_link(__('Edit', 'Foundation'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>'); ?></div>
    <?php if ($comment->comment_approved == '0') _e('\t\t\t\t\t<span class="unapproved">Your trackback is awaiting moderation.</span>\n', 'Foundation') ?>
            <div class="comment-content">
                <?php comment_text() ?>
            </div>
<?php } // end custom_pings

// Produces an avatar image with the hCard-compliant photo class
function commenter_link() {
    $commenter = get_comment_author_link();
    if ( ereg( '<a[^>]* class=[^>]+>', $commenter ) ) {
        $commenter = ereg_replace( '(<a[^>]* class=[\'"]?)', '\\1url ' , $commenter );
    } else {
        $commenter = ereg_replace( '(<a )/', '\\1class="url "' , $commenter );
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace( "class='avatar", "class='photo avatar", get_avatar( $avatar_email, 35 ) );
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
} // end commenter_link


// Custom Pagination
/**
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<ul class="pagination">', 'after' => '</ul>',
		'title' => __('<li class="unavailable"></li>'),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<li>$title</li>";
		$ellipsis = "<li class='unavailable'>...</li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<li class='current'><a href='#'>$i</a></li>" 
			: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";
	}
	return $output;
} 

$meta_boxes = array();

// Requerimientos
$meta_boxes[] = array(
    'id' => 'requerimientos',
    'title' => 'Requerimientos',
    'pages' => array('ofertas'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Requerimientos',
            'desc' => 'Requerimientos de la oferta',
            'id' => $prefix . 'requerimientos',
            'type' => 'textarea',
			'std' => ''
        )
    )
);

// cualificaciones
$meta_boxes[] = array(
    'id' => 'cualificaciones',
    'title' => 'Cualificaciones',
    'pages' => array('ofertas'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Cualificaiones',
            'desc' => 'Cualificaiones de la oferta',
            'id' => $prefix . 'cualificaiones',
            'type' => 'textarea',
			'std' => ''
        )
    )
);

foreach ($meta_boxes as $meta_box) {
    $my_box = new My_meta_box($meta_box);
}

class My_meta_box {

    protected $_meta_box;

    // create meta box based on given data
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
		add_action('save_post', array(&$this, 'save'));
    }

    /// Add meta box for multiple post types
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }

    // Callback function to show fields in meta box
    function show() {
        global $post;

        // Use nonce for verification
        echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

        echo '<table class="form-table">';

        foreach ($this->_meta_box['fields'] as $field) {
            // get current post meta data
            $meta = get_post_meta($post->ID, $field['id'], true);

            echo '<tr>',
                    '<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                    '<td>';
            switch ($field['type']) {
                case 'text':
                    echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                        '<br />', $field['desc'];
                    break;
                case 'textarea':
                    echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                        '<br />', $field['desc'];
                    break;
                case 'select':
                    echo '<select name="', $field['id'], '" id="', $field['id'], '">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
                    }
                    echo '</select>';
                    break;
                case 'radio':
                    foreach ($field['options'] as $option) {
                        echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
                    }
                    break;
                case 'checkbox':
                    echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
                    break;
            }
            echo     '<td>',
                '</tr>';
        }

        echo '</table>';
    }

    // Save data from meta box
    function save($post_id) {
        // verify nonce
        if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }

        // check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // check permissions
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        foreach ($this->_meta_box['fields'] as $field) {
            $old = get_post_meta($post_id, $field['id'], true);
            $new = $_POST[$field['id']];

            if ($new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
}

add_action( 'init', 'my_custom_init' );

function my_custom_init() {
    $labels = array(
        'name' => _x( 'Ofertas', 'post type general name' ), // Tip: _x('') is used for localization
        'singular_name' => _x( 'Oferta', 'post type singular name' ),
        'add_new' => _x( 'Añadir Nueva', 'oferta' ),
        'add_new_item' => __( 'Añadir nueva oferta' ),
        'edit_item' => __( 'Editar Oferta' ),
        'new_item' => __( 'Neuva Oferta' ),
        'view_item' => __( 'Ver Oferta' ),
        'search_items' => __( 'Buscar Oferta' ),
        'not_found' =>  __( 'No se encontraron ofertas' ),
        'not_found_in_trash' => __( 'No hay ofertas en la papelera' ),
        'parent_item_colon' => ''
    );

    $args = array( 'labels' => $labels, /* NOTICE: the $labels variable is used here... */
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title', 'editor','custom-fileds' )
    ); 

    register_post_type( 'Ofertas', $args ); /* Register it and move on */
}

add_action( 'init', 'create_perfil_taxonomies', 0 );

function create_perfil_taxonomies() {

  $labels = array(
    'name' => _x( 'Perfil', 'taxonomy general name' ),
    'singular_name' => _x( 'Perfil', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Perfil' ),
    'all_items' => __( 'Perfiles de la oferta' ),
    'parent_item' => __( 'Perfil Superior' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Editar perfil' ), 
    'update_item' => __( 'Actualizar perfil' ),
    'add_new_item' => __( 'Nuevo tipo de perfil' ),
    'new_item_name' => __( 'Nuevo perfil' ),
    'menu_name' => __( 'Perfiles' ),
  ); 	

  register_taxonomy('perfil',array('ofertas'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'perfil' ),
  ));

}

add_action( 'init', 'create_dpto_taxonomies', 0 );

//creamos la taxonomia departamento para los tipos de trabajo

function create_dpto_taxonomies() {

  $labels = array(
    'name' => _x( 'Departamento', 'taxonomy general name' ),
    'singular_name' => _x( 'Departamento', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'all_items' => __( 'Departamentos' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Editar departamento' ), 
    'update_item' => __( 'Actualizar departamento' ),
    'add_new_item' => __( 'Nuevo departamento' ),
    'new_item_name' => __( 'Nuevo departamento' ),
    'menu_name' => __( 'Departamentos' ),
  ); 	

  register_taxonomy('departamento',array('ofertas'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'departamento' ),
  ));

}

add_action( 'init', 'create_ha_taxonomies', 0 );

//creamos la taxonomia habilidades artisticas para los tipos de trabajo

function create_ha_taxonomies() {

  $labels = array(
    'name' => _x( 'Habilidad artistica', 'taxonomy general name' ),
    'singular_name' => _x( 'Habilidad artistica', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Habilidad' ),
    'all_items' => __( 'Habilidades artisticas' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Editar habilidad' ), 
    'update_item' => __( 'Actualizar habilidad' ),
    'add_new_item' => __( 'Nueva habilidad artistica' ),
    'new_item_name' => __( 'Nueva habilidad artistica' ),
    'menu_name' => __( 'Habilidades artisticas' ),
  ); 	

  register_taxonomy('habilidad-artistica',array('ofertas'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'habilidad-artistica' ),
  ));

}

add_action( 'init', 'create_ht_taxonomies', 0 );

//creamos la taxonomia habilidades artisticas para los tipos de trabajo

function create_ht_taxonomies() {

  $labels = array(
    'name' => _x( 'Habilidad tecnica', 'taxonomy general name' ),
    'singular_name' => _x( 'Habilidad tecnica', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Genres' ),
    'all_items' => __( 'Habilidades tecnicas' ),
    'parent_item' => __( 'Parent Genre' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'edit_item' => __( 'Editar habilidad' ), 
    'update_item' => __( 'Actualizar habilidad' ),
    'add_new_item' => __( 'Nueva habilidad tecnica' ),
    'new_item_name' => __( 'Nueva habilidad tecnica' ),
    'menu_name' => __( 'Habilidades tecnicas' ),
  ); 	

  register_taxonomy('habilidad-tecnica',array('ofertas'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'habilidad-tecnica' ),
  ));

}

add_action( 'init', 'create_software_taxonomies', 0 );

//creamos la taxonomia habilidades artisticas para los tipos de trabajo

function create_software_taxonomies() {

  $labels = array(
    'name' => _x( 'Habilidad software', 'taxonomy general name' ),
    'singular_name' => _x( 'Habilidad software', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search software' ),
    'all_items' => __( 'Habilidades software' ),
    'parent_item' => __( 'Parent software' ),
    'parent_item_colon' => __( 'Parent software:' ),
    'edit_item' => __( 'Editar software' ), 
    'update_item' => __( 'Actualizar software' ),
    'add_new_item' => __( 'Nueva habilidad de software' ),
    'new_item_name' => __( 'Nueva habilidad software' ),
    'menu_name' => __( 'Habilidad software' ),
  ); 	

  register_taxonomy('habilidad-software',array('ofertas'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'habilidad-software' ),
  ));

}

add_action( 'init', 'my_custom_init1' );

function my_custom_init1() {
    $labels = array(
        'name' => _x( 'Aspirantes', 'post type general name' ), // Tip: _x('') is used for localization
        'singular_name' => _x( 'Aspirantes', 'post type singular name' ),
		'view_item' => __( 'Ver Aspirantes' ),
        'search_items' => __( 'Buscar Aspirantes' ),
        'not_found' =>  __( 'No se encontraron aspirantes' ),
        'not_found_in_trash' => __( 'No hay aspirantes en la papelera' ),
        'parent_item_colon' => ''
    );

    $args = array( 'labels' => $labels, /* NOTICE: the $labels variable is used here... */
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => false,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array( 'title','custom-fileds')
    ); 

    register_post_type( 'Aspirantes', $args ); /* Register it and move on */
}

add_action( 'init', 'create_perfil_aspirantes_taxonomies', 0 );

function create_perfil_aspirantes_taxonomies() {

  $labels = array(
    'name' => _x( 'Perfil aspirante', 'taxonomy general name' ),
    'singular_name' => _x( 'Perfil aspirante', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar Perfil aspirante' ),
    'all_items' => __( 'Perfiles de la oferta' ),
    'parent_item' => __( 'Perfil Superior' ),
    'parent_item_colon' => __( 'Parent Genre:' ),
    'new_item_name' => __( 'Nuevo perfil aspirante' ),
    'menu_name' => __( 'Perfiles aspirantes' ),
  ); 	

  register_taxonomy('perfil-aspirante',array('aspirantes'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'perfil-aspirante' ),
  ));

}

add_action( 'init', 'create_departamentos_aspirantes_taxonomies', 0 );

function create_departamentos_aspirantes_taxonomies() {

  $labels = array(
    'name' => _x( 'Departamento', 'taxonomy general name' ),
    'singular_name' => _x( 'Departamento ', 'taxonomy singular name' ),
    'search_items' =>  __( 'Buscar departamento' ),
    'all_items' => __( 'Departamento de la oferta' ),
    'parent_item' => __( 'Perfil Superior' ),
    'parent_item_colon' => __( 'Departamento superior' ),
    'menu_name' => __( 'Departmaneto de la oferta' ),
  ); 	

  register_taxonomy('departamento-oferta',array('aspirantes'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'departamento-aspirante' ),
  ));

}





add_action( 'restrict_manage_posts', 'my_restrict_manage_posts' );
function my_restrict_manage_posts() {

    // only display these taxonomy filters on desired custom post_type listings
    global $typenow;
    if ($typenow == 'ofertas') {

        // create an array of taxonomy slugs you want to filter by - if you want to retrieve all taxonomies, could use get_taxonomies() to build the list
        $filters = array('departamento', 'perfil', 'habilidad-artistica', 'habilidad-tecnica', 'habilidad-software');

        foreach ($filters as $tax_slug) {
            // retrieve the taxonomy object
            $tax_obj = get_taxonomy($tax_slug);
            $tax_name = $tax_obj->labels->name;

            // output html for taxonomy dropdown filter
            echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
            echo "<option value=''>Mostrar $tax_name</option>";
            generate_taxonomy_options($tax_slug,0,0);
            echo "</select>";
        }
    }
}

function generate_taxonomy_options($tax_slug, $parent = '', $level = 0) {
    $args = array('show_empty' => 1);
    if(!is_null($parent)) {
        $args = array('parent' => $parent);
    }
    $terms = get_terms($tax_slug,$args);
    $tab='';
    for($i=0;$i<$level;$i++){
        $tab.='--';
    }
    foreach ($terms as $term) {
        // output each select option line, check against the last $_GET to show the current option selected
        echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
        generate_taxonomy_options($tax_slug, $term->term_id, $level+1);
    }

}


add_action("manage_posts_custom_column",  "portfolio_custom_columns");
add_filter("manage_edit-ofertas_columns", "portfolio_edit_columns");
 
function portfolio_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Oferta",
    "description" => "Descripcion",
    "perfil" => "Perfil",
    "departamento" => "Departamento",
	"habilidad-tecnica" => "Habilidad Tecnica",
	"habilidad-artistica" => "Habilidad Artistica",
	"habilidad-software" => "Habilidad Software",
  );
 
  return $columns;
}
function portfolio_custom_columns($column){
  global $post;
 
  switch ($column) {
    case "description":
      the_excerpt();
      break;
    case "perfil":
      $custom = get_post_custom();
      echo get_the_term_list($post->ID, 'perfil', '', ', ','');
      break;
    case "departamento":
      echo get_the_term_list($post->ID, 'departamento', '', ', ','');
      break;
    case "habilidad-tecnica":
      echo get_the_term_list($post->ID, 'habilidad-tecnica', '', ', ','');
      break;
	case "habilidad-artistica":
      echo get_the_term_list($post->ID, 'habilidad-artistica', '', ', ','');
      break;
	case "habilidad-software":
      echo get_the_term_list($post->ID, 'habilidad-software', '', ', ','');
      break;

  }
}















?>