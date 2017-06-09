<?php
/*
YARPP Template: Liste articles
Description: Ce modèle affiche une liste de billets en relation avec le lien vers l'article.
Author: Teamhair Na Ri
*/

// BEGIN MODIFICATION: ad function ampify() credits to https://gist.github.com/adactio/73f404568bf5e0d000a6
function ampify($html='') {
    # Replace img, audio, and video elements with amp custom elements
    $html = str_ireplace(
        ['<img','<video','/video>','<audio','/audio>'],
        ['<amp-img','<amp-video','/amp-video>','<amp-audio','/amp-audio>'],
        $html
    );
    # Add closing tags to amp-img custom element
    $html = preg_replace('/<amp-img(.*?)\/?>/', '<amp-img$1></amp-img>',$html);
    # Whitelist of HTML tags allowed by AMP
    $html = strip_tags($html,'<h1><h2><h3><h4><h5><h6><a><p><ul><ol><li><blockquote><q><cite><ins><del><strong><em><code><pre><svg><table><thead><tbody><tfoot><th><tr><td><dl><dt><dd><article><section><header><footer><aside><figure><time><abbr><div><span><hr><small><br><amp-img><amp-audio><amp-video><amp-ad><amp-anim><amp-carousel><amp-fit-rext><amp-image-lightbox><amp-instagram><amp-lightbox><amp-twitter><amp-youtube>');
    return $html;
}
// END MODIFICATION: ad function ampify() credits to https://gist.github.com/adactio/73f404568bf5e0d000a6

?>

<?php if ($amp) : ?>

<div class="amp-wp-related">

	<h2>Vous aimerez aussi</h2>
		
	<?php if ( have_posts() ) { ?>
		
		<ul>
				
			<?php
				
			$postsArray = array();
				
			while (have_posts()) : the_post();
				
				$post_excerpt = get_field('post_intro', $post->ID);
				$post_intro = wp_html_excerpt($post_excerpt, 160, '...');
				$post_permalink = get_permalink() . 'amp';
			
				$postsArray[] = '<li><h3 class="entry-title"><a href="'. $post_permalink .'" rel="bookmark">'. get_the_title() .'</a></h3><div class="entry-summary">' . $post_intro . '</div></li>';
				
			endwhile;
			
			echo implode( $postsArray ); // print out a list of the related items, separated by commas ?>
				
		</ul>
			
	<?php } ?>
		
</div>

<?php else : ?>

	<h2>Vous aimerez aussi</h2>
	
	<?php if ( have_posts() ) { ?>
	
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
	
	<?php } else {?>
	
	<p>Aucun billet</p>
	
	<?php } ?>

<?php endif; ?>