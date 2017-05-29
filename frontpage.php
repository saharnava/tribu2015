<?php

/**
 *
 * Template Name: Page d'accueil
 *
 */

get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

<?php if( have_rows('media_une') ) :
	
		while ( have_rows('media_une') ) : the_row();
		
			$media = 'media_' . get_sub_field('type_media');

			if ( $media == 'media_image' ) :
				$image = get_sub_field($media);
				$title = $image['title'];
				$url = $image['url']; ?>
				
	<div id="homeBanner" class="parallax">
	
		 <div class="hasBackground" style="background-image: url('<?php echo $url; ?>')" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -150px;" data-bottom-top="background-position: 50% 150px;" data-anchor-target="#homeBanner">
				
		<?php elseif ( $media == 'media_video' ) : ?>
		
	<div id="homeBanner" class="parallax">
	
		<div class="embed-video">
			
			<?php get_sub_field($media); ?>
			
		<?php endif; ?>
				
		<?php
			
			$home_logo = get_sub_field( 'home_logo' );
				
			if ( !empty($home_logo) ) :
				$logo_url = $home_logo['url'];
				$logo_title = $home_logo['title'];
				$logo_alt = $home_logo['alt'];
				
		?>
			
			<div id="textBanner" class="parallax-content">
				<img src="<?php echo $logo_url; ?>" alt="<?php echo $logo_alt; ?>" />
				<div class="home-social">
					<a href="https://www.facebook.com/natureetdecouvertes" target="_blank" title="Nature & Découvertes sur Facebook" class="btn-facebook"><i></i></a>
					<a href="https://www.instagram.com/natureetdecouvertes/" target="_blank" title="Nature & Découvertes sur Instagram" class="btn-instagram"><i></i></a>
					<a href="https://twitter.com/netd_news?lang=fr" target="_blank" title="Nature & Découvertes sur Twitter" class="btn-twitter"><i></i></a>
					<a href="https://fr.pinterest.com/natureetd/" target="_blank" title="Nature & Découvertes sur Pintesrest" class="btn-pinterest"><i></i></a>
					
				</div>
			</div>
			
		<?php endif; ?>
			
			<div id="flechebas"></div>

		</div>

	</div>
				
<?php endwhile;

	endif;

?>

	<div id="last-posts" class="home-content" itemprop="mainEntityOfPage" itemscope="itemscope" itemType="http://schema.org/Blog">
	
		<div class="banner-content">
		
		<?php if ( get_field( 'articles_accroche' ) ) { ?>
			<h2><span class="texte-titre"><?php the_field( 'articles_accroche' ); ?></span></h2>
		<?php } ?>

		<?php
		
			$args = array(
				'post_type' => 'post',
				'posts_per_page' => 6,
				'orderby' => 'date',
				'order' => 'DESC'
			);

			$home_query = new WP_Query( $args );

		?>
	
		<?php if ( $home_query->have_posts() ) { ?>
		
			<?php while ( $home_query->have_posts() ) { ?>
		
				<?php $home_query->the_post(); // Loads the post data. ?>
		
				<?php hybrid_get_content_template(); // Loads the content template. ?>
		
			<?php } // End while loop. ?>
			
		<?php } else { ?>
		
			<?php locate_template( array( 'content/error.php' ), true ); // Loads the loop-error.php template. ?>
		
		<?php } // End if check.
			
			wp_reset_postdata();
		?>
		
		</div>
	
	</div>
	
<?php if ( !empty(get_field( 'facebook_accroche' ) )) { ?>

	<div id="facebook" class="home-content clearfix">
	
		<div class="banner-content">
	
		<h2><span class="texte-titre"><?php the_field( 'facebook_accroche' ); ?></span></h2>
				
		<?php tribu_facebook(); ?>
		
		<div class="social-button"><a href="https://www.facebook.com/natureetdecouvertes" target="_blank" title="Nature & Découvertes sur Facebook" class="button">Découvrir la suite sur Facebook</a></div>
		
		</div>
	
	</div>
	
<?php } ?>

<?php if ( !empty(get_field( 'instagram_accroche' )) ) { ?>

	<div id="instagram" class="home-content clearfix">
	
		<div class="banner-content">
	
		<h2><span class="texte-titre"><?php the_field( 'instagram_accroche' ); ?></span></h2>
		
		<?php if ( is_active_sidebar( 'instagram-banner' ) ) : ?>
		
				<?php dynamic_sidebar( 'instagram-banner' ); ?>
		
		<?php endif; ?>
				
		<div class="social-button"><a href="https://www.instagram.com/natureetdecouvertes/" target="_blank" title="Nature & Découvertes sur Instagram" class="button">Découvrir la suite sur Instagram</a></div>
		
		</div>
	
	</div>
	
<?php } ?>

<?php get_footer(); // Loads the footer.php template. ?>