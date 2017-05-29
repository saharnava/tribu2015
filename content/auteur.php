<div class="loop-category">

<?php

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
	'post_type'			=>	'post',
	'posts_per_page'	=>	10,
	'meta_query'		=>	array(
		array(
			'key'		=>	'post_auteur',
			'value'		=>	'"' . get_the_ID() . '"',
			'compare'	=>	'LIKE'
		)
	),
	'orderby'			=>	'date',
	'order'				=>	'DESC',
	'paged'				=>	$paged
);

query_posts( $args );

?>

<?php if ( have_posts() ) : // Checks if any posts were found. ?>
	
	<?php while ( have_posts() ) : // Begins the loop through found posts. ?>
		
	<?php the_post(); // Loads the post data. ?>
		
	<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>
		
	<?php endwhile; // End found posts loop. ?>
	
	<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>
	
<?php else : // If no posts were found. ?>
	
	<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>
	
<?php endif; // End check for posts. ?>

<?php wp_reset_query(); ?>

</div>

<footer <?php hybrid_attr( 'auteur-fiche' ); ?>>

	<div class="auteur-intro clearfix">
	
	<?php

		$auteur_name = get_field('auteur_prenom');
		if ( get_field('auteur_titre') ) $auteur_title = get_field('auteur_titre');
		if ( get_field('auteur_photo') ) $auteur_image = get_field('auteur_photo');
		if ( get_field('auteur_site') ) $auteur_site = get_field('auteur_site');
		if ( get_field('auteur_url') ) $auteur_url = get_field('auteur_url');
		if ( get_field('auteur_bio') ) $auteur_bio = get_field('auteur_bio');
	
	?>
	
		<div class="auteur-id">
		
			<h1 class="auteur-nom"><?php echo $auteur_name; ?></h1>
			
			<?php if ( !empty($auteur_title) ) : ?>
			<h2 class="auteur-titre"><?php echo $auteur_title; ?></h2>
			<?php endif; ?>
			
			<?php if ( have_rows('auteur_social') ) : ?>
			<div class="auteur-sociaux">
				<?php while( have_rows('auteur_social') ) : the_row(); ?>
					<?php
					$soc_icon = get_sub_field('auteur_socialicon');
					$soc_url = get_sub_field('auteur_socialurl');
					?>
					<a href="<?php echo $soc_url; ?>" target="_blank"><img src="<?php echo $soc_icon['url']; ?>" /></a>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		
		</div>
		
		<div class="auteur-photo">
		
		<?php if ( !empty($auteur_image) ) : 
		
			$caption = $auteur_image['caption'];
			$alt = $auteur_image['alt'];
			$size = 'large';
			$thumb = $auteur_image['sizes'][ $size ];
			$width = $auteur_image['sizes'][ $size . '-width' ];
			$height = $auteur_image['sizes'][ $size . '-height' ];
		?>
		
			<img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
			
		<?php else : ?>
		
			<img src="<?php bloginfo('stylesheet_directory'); ?>'/images/i-auteurdef.png" alt="<?php echo $auteur_name; ?>" width="400" height="400" />
		
		<?php endif; ?>
		
		</div>
	
	</div>
	
	<?php if ( !empty( $auteur_bio ) || !empty( $auteur_url ) ) : ?>
	
	<div class="auteur-bio">
	
		<?php if ( !empty( $auteur_bio ) ) : echo $auteur_bio; endif; ?>
		
		<?php if ( !empty( $auteur_url ) && !empty( $auteur_site ) ) : ?>
		
		<p><a href="<?php echo $auteur_url; ?>" target="_blank" title="<?php echo $auteur_site; ?>" class="auteur-link"><span><?php echo $auteur_site; ?></span></a></p>
		
		<?php endif; ?>
	
	</div>
	
	<?php endif; ?>

</footer>