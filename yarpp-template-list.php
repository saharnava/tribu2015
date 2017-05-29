<?php
/*
YARPP Template: Liste articles
Description: Ce modèle affiche une liste de billets en relation avec le lien vers l'article.
Author: Teamhair Na Ri
*/
?>

<h2>Vous aimerez aussi</h2>

<?php if ( have_posts() ) : ?>

<ul>

	<?php
	
	$postsArray = array();
	
	while (have_posts()) : the_post();
	
		$post_excerpt = get_field('post_intro', $post->ID);
		$post_intro = wp_html_excerpt($post_excerpt, 160, '...');
	
		$postsArray[] = '<li><h3 class="entry-title"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h3><div class="entry-summary">' . $post_intro . '</div></li>';
	
	endwhile;

	echo implode( $postsArray ); // print out a list of the related items, separated by commas ?>

</ul>

<?php else :?>

<p>Aucun billet</p>

<?php endif; ?>