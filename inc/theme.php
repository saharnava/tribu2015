<?php

# Register custom image sizes.
add_action( 'init', 'tribund_register_image_sizes', 5 );

# Register custom menus.
add_action( 'init', 'tribund_register_menus', 5 );

# Register sidebars.
add_action( 'widgets_init', 'tribund_register_sidebars', 5 );

# Add custom scripts and styles
add_action( 'wp_enqueue_scripts', 'tribund_enqueue_scripts', 5 );
add_action( 'wp_enqueue_scripts', 'tribund_enqueue_styles',  5 );

# Init the auteurs custom post 
add_action('init', 'auteurs_init');
add_action( 'after_switch_theme', 'cp_rewrite_flush' );
add_filter( 'getarchives_where' , 'get_archives_with_ctp',10 , 2);
	
# Allow Disqus to work
remove_filter( 'comments_template', 'dsq_comments_template' );
add_filter( 'comments_template', 'dsq_comments_template', 99 ); // You can use any priority higher than '10'   
        
# Jetpack
add_action( 'loop_start', 'jptweak_remove_share' );
add_action('wp_print_styles', 'remove_jetpack_styles');
add_filter( 'jetpack_implode_frontend_css', '__return_false' );

# Search Form
add_theme_support( 'html5', array( 'search-form' ) );
	
/**
 * Registers custom image sizes for the theme.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tribund_register_image_sizes() {

	// Sets the 'post-thumbnail' size.
	//set_post_thumbnail_size( 150, 150, true );
	update_option( 'large_size_w', 1280 );
	update_option( 'large_crop', 0 );
	update_option( 'medium_size_w', 690 );
	update_option( 'medium_size_h', 350 );
	update_option( 'medium_crop', 1 );
	add_image_size('auteur', 120, 120, true);
	add_image_size('produit', 190, 190, true);
}

/**
 * Registers nav menu locations.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tribund_register_menus() {
	register_nav_menu( 'primary',    esc_html_x( 'Primary',    'nav menu location', 'tribu2015' ) );
	register_nav_menu( 'secondary',  esc_html_x( 'Secondary',  'nav menu location', 'tribu2015' ) );
}

/**
 * Registers sidebars.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tribund_register_sidebars() {

	hybrid_register_sidebar(
		array(
			'id'          => 'instagram-banner',
			'name'        => esc_html_x( 'Bandeau Instragram', 'sidebar', 'tribu2015' ),
			'description' => esc_html__( 'Réservée à Instagram sur la homepage', 'tribu2015' )
		)
	);

}

/**
 * Load scripts for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tribund_enqueue_scripts() {

	wp_register_script( 'tribu2015', trailingslashit( get_template_directory_uri() ) . "js/theme-settings.js", array( 'jquery' ), null, true );
	wp_register_script( 'mmenu', trailingslashit( get_template_directory_uri() ) . "js/jquery.mmenu.min.all.js", array( 'jquery' ), null, true );
	wp_register_script( 'actual', trailingslashit( get_template_directory_uri() ) . "js/jquery.actual.min.js", array( 'jquery' ), null, true );
	wp_register_script( 'imagesloaded', trailingslashit( get_template_directory_uri() ) . "js/imagesloaded.pkgd.min.js", array( 'jquery' ), null, true );
	wp_register_script( 'skrollr', trailingslashit( get_template_directory_uri() ) . "js/skrollr.min.js", array( 'jquery' ), null, true );

	wp_enqueue_script( 'tribu2015' );
	wp_enqueue_script( 'mmenu' );
	wp_enqueue_script( 'actual' );
	wp_enqueue_script( 'imagesloaded' );
	wp_enqueue_script( 'skrollr' );

}

/**
 * Load stylesheets for the front end.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function tribund_enqueue_styles() {

	// Load one-five base style.
	wp_enqueue_style( 'hybrid-one-five' );

	// Load gallery style if 'cleaner-gallery' is active.
	if ( current_theme_supports( 'cleaner-gallery' ) )
		wp_enqueue_style( 'hybrid-gallery' );

	//wp_enqueue_style( 'tribu2015-fonts', '//fonts.googleapis.com/css?family=Dosis:400,200,300,500,600,700,800' );
	wp_enqueue_style( 'tribu2015-fonts', '//fonts.googleapis.com/css?family=Lato:400,400i,700,700i' );
	
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css' );

	// Load active theme stylesheet.
	wp_enqueue_style( 'hybrid-style' );
	
	wp_enqueue_style( 'mmenu-style', trailingslashit( get_template_directory_uri() ) . "css/jquery.mmenu.all.css" );
	
}


/**
 * Custom Post Auteurs
 * Ajoute un contenu personnalisé pour la gestion des auteurs des billets
 *
 */
 
function auteurs_init() {
	register_post_type('auteur', array(
		'label' => 'Auteurs',
		'singular_label' => 'Auteur',
		'labels' => array(
			'name'               => 'Auteurs',
			'singular_name'      => 'Auteur',
			'add_new'            => 'Ajouter',
			'add_new_item'       => 'Ajouter un nouvel auteur',
			'edit_item'          => 'Modifier',
			'new_item'           => 'Nouvelle',
			'all_items'          => 'Tous les auteurs',
			'view_item'          => 'Afficher',
			'search_items'       => 'Rechercher',
			'not_found'          => 'Aucun auteur',
			'not_found_in_trash' => 'Aucun auteur dans la corbeille', 
			'parent_item_colon'  => '',
			'menu_name'          => 'Auteurs'
		),
		'description'   => 'Tous les auteurs',
		'public' => true,
		'show_ui' => true,
		'menu_position' => 6,
		'capability_type' => 'post',
		'hierarchical' => false,
		'yarpp_support'	=> true,
		'supports' => array('title'),
		'show_in_rest' => true,
		'rest_base' => 'auteur',
		'rest_controller_class' => 'WP_REST_Posts_Controller'
	));
}

function cp_rewrite_flush() {
    flush_rewrite_rules();
}


/**
 * Ajouter les Custom Post à la fonction wp_get_archives()
 *
 */
 
if ( ! function_exists( 'get_archives_with_ctp' )) :
function get_archives_with_ctp( $where , $r ) {
    $args = array( 'public' => true , '_builtin' => false );
    $output = 'names'; $operator = 'and';
    $post_types = get_post_types( $args , $output , $operator );
    $post_types = array_merge( $post_types , array( 'post','CUSTOM_POST_TYPE_NAME' ) );
    $post_types = "'" . implode( "' , '" , $post_types ) . "'";
    return str_replace( "post_type = 'post'" , "post_type IN ( $post_types )" , $where );
}
endif;

/**
 * ajouter les ACF à la rest API
 *
 */

function slug_register_featured() {
    register_api_field( 'post',
        'featured',
        array(
            'get_callback'    => 'get_meta_to_response',
            'update_callback' => null,
            'schema'          => null,
        )
    );
}
add_action( 'rest_api_init', 'slug_register_featured' );

function get_meta_to_response( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name, true );
}


/**
 * Afficher l'auteur sur un article
 *
 */

function post_auteur(){

$auteurs = get_field('post_auteur');

	if( $auteurs ) {
		foreach( $auteurs as $auteur ){
			$auteur_ID = $auteur->ID;
			$auteur_url = get_permalink($auteur_ID);
			$auteur_name = get_field('auteur_prenom', $auteur_ID);
			$auteur_title = get_field('auteur_titre', $auteur_ID);
			$auteur_image = get_field('auteur_photo', $auteur_ID);
			if ( !empty($auteur_image) ) {
				$caption = $auteur_image['caption'];
				$alt = $auteur_image['alt'];
				$size = 'large';
				$thumb = $auteur_image['sizes'][ $size ];
				$width = $auteur_image['sizes'][ $size . '-width' ];
				$height = $auteur_image['sizes'][ $size . '-height' ];
				$image = '<img src="' . $thumb . '" alt="' . $alt . '" width="' . $width . '" height="' . $height . '" class="photo" />';
			}
			else{
				$image = '<img src="' . get_bloginfo('stylesheet_directory') . '/images/i-auteurdef.png" alt="' . get_bloginfo('name') . '" width="120" height="120" class="photo" />';
			}
			if( $auteur_title ){
				$auteur_content = '<span class="fn" itemprop="name">' . $auteur_name . '</span>, <span class="note">' . $auteur_title . '</span>';
			}
			else {
				$auteur_content = $auteur_name;
			}
			echo '<a href="' . $auteur_url . '">' . $image . '</a>';			
			echo '<p class="auteur-titre vcard author">Par <a href="' . $auteur_url . '">' . $auteur_content . '</a></p>';
		}
	}

}

function cat_auteur(){

	$auteurs = get_field('post_auteur');

		if( $auteurs ) {
		foreach( $auteurs as $auteur ){
			$auteur_ID = $auteur->ID;
			$auteur_url = get_permalink($auteur_ID);
			$auteur_name = get_field('auteur_prenom', $auteur_ID);
			$auteur_title = get_field('auteur_titre', $auteur_ID);
			if( $auteur_title ){
				$auteur_content = '<span class="fn" itemprop="name">' . $auteur_name . '</span>, <span class="note">' . $auteur_title . '</span>';
			}
			else {
				$auteur_content = '<span class="fn" itemprop="name">' . $auteur_name . '</span>';
			}
			echo '<span class="vcard author">Par <a href="' . $auteur_url . '">' . $auteur_content . '</a></span>';
		}
	}
	
}


/**
 * Les 5 derniers articles de la même catégorie
 *
 */
 
function post_in_cat( $amp = false ){
	unset($post);
	global $post;
	$categories = get_the_category();
	$category = $categories[0];
	$cat_ID = $category->category_parent;
	if ( $cat_ID != 0 ){
		$myposts = get_posts("numberposts=4&category=$cat_ID&exclude=$post->ID&post_status=publish");
	}
	else {
		$myposts = get_posts("numberposts=4&category=$category->ID&exclude=$post->ID&post_status=publish");
	}
	
	$post_list = '<div class="cat-related">';
	if ( $amp ) {
		$post_list .= '<div class="amp-wp-related">';
	}

	$post_list .= '<h2>Dans la m&ecirc;me cat&eacute;gorie</h2>';
	$post_list .= '<ul>';
	foreach($myposts as $post) {
		setup_postdata( $post );
		$post_titre =  get_the_title( $post->ID );
		if ( $amp ) {
			$post_url = get_permalink( $post->ID ) . 'amp';
		}
		else {
			$post_url = get_permalink( $post->ID );
		}
		$post_excerpt = get_field('post_intro', $post->ID);
		$post_intro = wp_html_excerpt($post_excerpt, 160, '...');
		
		$post_list .= '<li>';
		$post_list .= '<h3 class="entry-title"><a href="' . $post_url . '" title="' . $post_titre . '" rel="bookmark">' . $post_titre . '</a></h3>';
		$post_list .= '<div class="entry-summary">' . $post_intro . '</div>';
		$post_list .= '</li>';
	}
	$post_list .= '</ul>';
	if ( $amp ) {
		$post_list .= '</div>';
	}	
	$post_list .= '</div>';
	echo $post_list;
	wp_reset_postdata();
	
}


/**
 * Jetpack sharing
 *
 */
if ( ! function_exists( 'jptweak_remove_share' )) :
function jptweak_remove_share() {
    remove_filter( 'the_content', 'sharing_display',19 );
    remove_filter( 'the_excerpt', 'sharing_display',19 );
    remove_filter( 'the_content', array( 'Jetpack_Likes', 'post_likes' ), 30, 1 ); 
} 
endif;

if ( ! function_exists( 'remove_jetpack_styles' )) :
function remove_jetpack_styles(){
	wp_deregister_style('sharedaddy'); // Sharedaddy
	wp_deregister_style('sharing'); // Sharedaddy Sharing
}
endif;

/**
 * L'extrait
 *
 */
 

function tribu_excerpt(){
	global $post;
	$post_intro = get_field('post_intro', $post->ID);
	if($post_intro){
		echo $post_intro;
	}
}

function tribu_excerptshort(){
	global $post;
	$post_intro = get_field('post_intro', $post->ID);
	$post_intro = preg_replace( ' (\[.*?\])','', $post_intro );
	$post_intro = strip_shortcodes( $post_intro );
	$post_intro = strip_tags( $post_intro );
	$post_intro = substr( $post_intro, 0, 200 );
	$post_intro = substr( $post_intro, 0, strripos( $post_intro, ' ' ) );
	$post_intro = trim( preg_replace( '/\s+/', ' ', $post_intro ) );
	
	$post_short = '<p>' . $post_intro . '...</p>';
	echo $post_short;
}



function my_acf_format_value( $value, $post_id, $field ) {
	
	// run do_shortcode on all textarea values
	$value = do_shortcode($value);
	
	
	// return
	return $value;
}

add_filter('acf/format_value/type=textarea', 'my_acf_format_value', 10, 3);

/*
 * Ajouter even/odd au post
 *
 */

function oddeven_post_class ( $classes ) {
   global $current_class;
   $classes[] = $current_class;
   $current_class = ($current_class == 'odd') ? 'even' : 'odd';
   return $classes;
}
add_filter ( 'post_class' , 'oddeven_post_class' );
global $current_class;
$current_class = 'odd';

/*
 * Ajouter un container autour des sub-menus
 *
 */

class walker_sublevel_container extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}

/*
 * Permettre l'affichage de la pagination dans les cutoms posts auteur.
 *
 */

remove_filter('template_redirect', 'redirect_canonical');


/*
 * Afficher les produits reliés
 *
 */
 
function related_products( $amp = false ) {
	 
	global $post;
	
	$rows = get_field('todo_produit', $post->ID);
	
	$todo_titre = get_field('todo_titre', $post->ID);
	if ($todo_titre):
		$entete = '<h2 class="produits-titre">' . $todo_titre . '</h2>';
	endif;
	
	if ( $rows ) {
		
		if ($amp) {
			$liste = '<div class="amp-wp-related-products">';
		}
		else {
			$liste = '<div class="produits clearfix">';
		}

		if ( isset( $entete ) ) $liste .= $entete;		
		$liste .= '<ul class="todo">';
		
		foreach($rows as $row) {
			setup_postdata( $row );

			$image = $row['todo_produitimg'];
				$thumb = $image['sizes']['produit'];
				$thumbWidth = $image['sizes'][ 'produit-width' ];
				$thumbHeight = $image['sizes'][ 'produit-height' ];
			$titre = $row['todo_produitnom'];
			$prix = $row['todo_produitprix'];
			$lien = $row['todo_produitlien'];

			$liste .= '<li class="produit">';
			$liste .= '<a href="' . $lien . '" target="_blank">';
						
			if ($amp){
				$liste .= '<amp-img alt="' . $image['alt'] . '" src="' . $thumb . '" width="' . $thumbWidth . '" height="' . $thumbHeight . '"></amp-img><br />';
			}
			else {
				$liste .= '<img src="' . $thumb . '" alt="' . $image['alt'] . '" /><br/>';
			}
			
			$liste .= '<span class="produit_titre">';
			$liste .= $titre;
			$liste .= '</span><br/>';
			$liste .= '<span class="produit_prix">';
			$liste .= $prix;
			$liste .= '</span>';
			$liste .= '</a>';
			$liste .= '</li>';
			
		}
		
		$liste .= '</ul>';
		$liste .= '</div>';
		wp_reset_postdata();
	}
	
	echo $liste;
	
	setup_postdata($post);
	 
}

/*
 * Mur Facebook de Nature & Découvertes
 *
 */

function tribu_facebook(){
	$page_id = '86664673840';
	$access_token = '1874168346189094|lls6Hrb3c7EqquWP8tmlgBiQ9O8';
	$json_object = @file_get_contents('https://graph.facebook.com/' . $page_id . 
	'?fields=posts.limit(6)%7Bcreated_time%2Cname%2Cid%2Cmessage%2Cdescription%2Ctype%2Cobject_id%2Clink%2Ccaption%7D&access_token=' . $access_token);
	$fbdata = json_decode($json_object);
	//var_dump($fbdata);

	
foreach ($fbdata->posts->data as $news ) :
		setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
		$news_date = strftime('%e %B %G', strtotime($news->created_time));
		$news_type = $news->type;
		
		if (!empty($news->name)) {
			$news_title = htmlspecialchars($news->name);
		}

		// Identifier les liens et les retranscrire en code HTML
		$patterns = array ('/(https?:\/\/\S*)/i');
		$replace  = array ('<a href="\1" target="_blank">\1</a>');
		if (isset($news->message)) $news->message = preg_replace($patterns, $replace, $news->message);
		if (isset($news->description)) $news->description = preg_replace($patterns, $replace, $news->description);
	
		// Identifier les hashtags et les retranscrire en code HTML
		$patterns = array ('/#(\S*)/i');
		$replace  = array ('<a href="https://www.facebook.com/hashtag/\1" target="_blank">#\1</a>');
		if (isset($news->message)) $news->message = preg_replace($patterns, $replace, $news->message);
		if (isset($news->description)) $news->description = preg_replace($patterns, $replace, $news->description);

		if (isset($news->message)) {
			$nudemessage = strip_tags($news->message);
			$nbcar = strlen($nudemessage);
			if($nbcar < 220){
				$news_intro = $news->message;
			}
			else {
				$news_intro = substr($news->message, 0, 220) . '...';
			}
		}
		
		if ($news->type == 'photo') {
			
			if (isset($news->id)) $news_id = $news->id;
			$photo_objectid = $news->object_id;
			$photo_object = @file_get_contents('https://graph.facebook.com/' . $photo_objectid . 
	'?fields=images&access_token=' . $access_token);
			$photodata = json_decode($photo_object);
			$photo_medium = $photodata->images[3];
			$img_src = $photo_medium->source;

			$news_link = 'https://www.facebook.com/permalink.php?story_fbid=' . $news_id . '&id=' . $page_id . '&substory_index=0';
			if (isset($news->link)) $img_link = $news->link;
			if (isset($news->description)) {
				$nudedesc = strip_tags($news->description);
				$nbcar2 = strlen($nudedesc);
				if ($nbcar2 < 220) {
					$img_desc = $news->description;
				}
				else {
					$img_desc = substr($news->description, 0, 220) . '...';
				}
			}
			
		}
		if ($news->type == 'video') {
			$news_id = $news->id;
			$news_link = $news->link;
			$json_pic = @file_get_contents('https://graph.facebook.com/' . $news_id . 
			'?fields=full_picture&access_token=' . $access_token);
			$picdata = json_decode($json_pic);
			$video_thumb = $picdata->full_picture;
			if (!empty($news->description)) {
				$nudedesc = strip_tags($news->description);
				$nbcar2 = strlen($nudedesc);
				if ($nbcar2 < 220) {
					$video_desc = $news->description;
				}
				else {
					$video_desc = substr($news->description, 0, 220) . '...';
				}
			}
			else {$video_desc= '';}
			
		}
		if ($news->type == 'event') {
			$news_link = $news->link;
			$news_id = $news->object_id;
			$json_thumb = @file_get_contents('https://graph.facebook.com/' . $news_id . 
			'?fields=cover&access_token=' . $access_token);
			$thumbdata = json_decode($json_thumb);
			$news_thumb = $thumbdata->cover->source;
			$news_caption = $news->caption;
			if (isset($news->description)) {
				$nudedesc = strip_tags($news->description);
				$nbcar2 = strlen($nudedesc);
				if ($nbcar2 < 220) {
					$news_desc = $news->description;
				}
				else {
					$news_desc = substr($news->description, 0, 220) . '...';
				}
			}
		}
		if ($news->type == 'link') {
			$news_id = $news->id;
			$news_link = $news->link;
			$json_pic = @file_get_contents('https://graph.facebook.com/' . $news_id . 
			'?fields=full_picture&access_token=' . $access_token);
			$picdata = json_decode($json_pic);
			$picurl = str_replace('https://scontent.xx.fbcdn.net/t45.1600-4/', 'https://scontent-cdg2-1.xx.fbcdn.net/t45.1600-4/p476x249/', $picdata->full_picture);
			$news_thumb = $picurl;
			if (isset($news->description)) {
				$nudedesc = strip_tags($news->description);
				$nbcar2 = strlen($nudedesc);
				if ($nbcar2 < 220) {
					$news_caption = $news->description;
				}
				else {
					$$news_caption = substr($news->description, 0, 220) . '...';
				}
			}
		}
		if ($news->type == 'note') {
			$news_id = $news->id;
			$news_link = $news->link;
			$json_pic = @file_get_contents('https://graph.facebook.com/' . $news_id . 
			'?fields=full_picture&access_token=' . $access_token);
			$picdata = json_decode($json_pic);
			$news_thumb = $picdata->full_picture;
			if (isset($news->description)) {
				$nudedesc = strip_tags($news->description);
				$nbcar2 = strlen($nudedesc);
				if ($nbcar2 < 220) {
					$news_desc = $news->description;
				}
				else {
					$$news_desc = substr($news->description, 0, 220) . '...';
				}
			}
		}
		if ($news->type == 'status') {
			$news_id = $news->id;
			$news_link = "https://www.facebook.com/natureetdecouvertes/";
			$json_status = @file_get_contents('https://graph.facebook.com/' . $news_id . 
			'?fields=full_picture&access_token=' . $access_token);
		}
?>
		<article <?php post_class( $news_type ); ?> itemscope="itemscope" itemtype="http://schema.org/CreativeWork">
			<?php if ($news->type == 'photo'){ ?>
			<header class="entry-header" style="background-image:url(<?php echo $img_src; ?>)">
				<a href="<?php echo $img_link; ?>" target="_blank"><img src="<?php echo $img_src; ?>" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<div class="entry-content">
				<?php if ( !empty($news_intro) || !empty($img_desc) ) { ?>
				<p class="entry-summary">
					<?php if ( !empty($news_intro) && empty($img_desc) ) : echo $news_intro; ?>
					<?php elseif ( empty($news_intro) && !empty($img_desc) ) : echo $img_desc; ?>
					<?php else : echo $news_intro; ?>
					<?php endif; ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ($news->type == 'video'){ ?>
			<header class="entry-header" style="background-image:url(<?php echo $video_thumb; ?>)">
				<a href="<?php echo $news_link; ?>" target="_blank"><img src="<?php echo $video_thumb; ?>" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<div class="entry-content">
				<?php if ( !empty($news_intro) || !empty($video_desc) ) { ?>
				<p class="entry-summary">
					<?php if ( !empty($news_intro) && empty($video_desc) ) : echo $news_intro; ?>
					<?php elseif ( empty($news_intro) && !empty($video_desc) ) : echo $video_desc; ?>
					<?php else : echo $news_intro; ?>
					<?php endif; ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ($news->type == 'link'){ ?>
			<header class="entry-header" style="background-image:url(<?php echo $news_thumb; ?>)">
				<a href="<?php echo $news_link; ?>" target="_blank"><img src="<?php echo $news_thumb; ?>" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<div class="entry-content">
				<?php if ( !empty($news_intro) || !empty($news_desc) ) { ?>
				<p class="entry-summary">
					<?php if ( !empty($news_intro) && empty($news_desc) ) : echo $news_intro; ?>
					<?php elseif ( empty($news_intro) && !empty($news_desc) ) : echo $news_desc; ?>
					<?php else : echo $news_intro; ?>
					<?php endif; ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ($news->type == 'note'){ ?>
			<header class="entry-header" style="background-image:url(<?php echo $news_thumb; ?>)">
				<a href="<?php echo $news_link; ?>" target="_blank"><img src="<?php echo $news_thumb; ?>" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<div class="entry-content">
				<?php if ( !empty($news_intro) || !empty($news_desc) ) { ?>
				<p class="entry-summary">
					<?php if ( !empty($news_intro) && empty($news_desc) ) : echo $news_intro; ?>
					<?php elseif ( empty($news_intro) && !empty($news_desc) ) : echo $news_desc; ?>
					<?php else : echo $news_intro; ?>
					<?php endif; ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if ($news->type == 'event'){ ?>
			<header class="entry-header" style="background-image:url(<?php echo $news_thumb; ?>)">
				<a href="<?php echo $news_link; ?>" target="_blank"><img src="<?php echo $news_thumb; ?>" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<div class="entry-content">
				<?php if ( !empty($news_intro) || !empty($news_desc) ) { ?>
				<p class="entry-summary">
					<?php if ( !empty($news_intro) && empty($news_desc) ) : echo $news_intro; ?>
					<?php elseif ( empty($news_intro) && !empty($news_desc) ) : echo $news_desc; ?>
					<?php else : echo $news_intro; ?>
					<?php endif; ?>
				</p>
				<?php } ?>
			</div>
			<?php } ?>
			<?php if($news->type == 'status') { ?>
			<header class="entry-header" style="background-image:url(<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png)">
				<a href="<?php echo $news_link; ?>" target="_blank"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/logo.png" alt="<?php echo $news_title; ?>" title="<?php echo $news_title; ?>" class="fb-img" /></a>
			</header>
			<?php } ?>
		</article>
		
<?php endforeach;	
}


/*
 * AMP : personnalisation de l'affichage du plugin AMP Auttomatic
 *
 */

function amp_auteur(){
	$auteurs = get_field('post_auteur');
	if( $auteurs ) {
		foreach( $auteurs as $auteur ){
			$auteur_ID = $auteur->ID;
			$auteur_url = get_permalink($auteur_ID);
			$auteur_name = get_field('auteur_prenom', $auteur_ID);
			$auteur_title = get_field('auteur_titre', $auteur_ID);
			echo '<a href="' . $auteur_url . '" class="post-author-avatar">';
			echo '</a> Par <a href="' . $auteur_url . '">' . $auteur_name . '</a>, ' . $auteur_title;
		}
	}
}

function amp_pixauteur() {
	$auteurs = get_field('post_auteur');

	if( $auteurs ) {
		foreach( $auteurs as $auteur ){
			$auteur_ID = $auteur->ID;
			$auteur_image = get_field('auteur_photo', $auteur_ID);
		
			if ( !empty($auteur_image) ) {
				$size = 'auteur';
				$url = $auteur_image['sizes'][ $size ];
			}
			else{
				$url = get_bloginfo('stylesheet_directory') . '/images/i-auteurdef.png';
			}
			echo '<amp-img src="' . $url . '" width="26" height="26" layout="fixed"></amp-img>';
		}
	}
}

