<?php

	$home_id = get_option( 'page_on_front' );

	if( have_rows( 'equipe', $home_id ) ) :
		
		while ( have_rows( 'equipe', $home_id ) ) : the_row();
		
			$equipe_accroche = get_sub_field( 'equipe_accroche', $home_id );
			$equipe_intro = get_sub_field( 'equipe_intro', $home_id );
			$equipe_url = get_sub_field( 'equipe_url', $home_id );
			$equipe_email = get_sub_field( 'equipe_email', $home_id );
			$equipe_image = get_sub_field( 'equipe_fond', $home_id );
			
?>
				
			<?php if( !empty($equipe_image) ) : $fond_url = $equipe_image['url']; ?>

	<div id="equipe" class="parallax">
	
		<div class="hasBackground" style="background-image:url('<?php echo $fond_url; ?>')" data-center="background-position: 50% 0px;" data-anchor-target="#ancre-equipe">

			<?php else : ?>

	<div id="equipe">

			<?php endif; ?>
			
			<div class="parallax-content">
			
				<h2 class="equipe-titre"><span class="texte-titre"><?php echo $equipe_accroche; ?></span></h2>
				
				<div class="equipe-texte"><?php echo $equipe_intro; ?></div>

				<div class="equipe-trombi">
				
				<?php $args = array(
						'post_type' => 'auteur',
						'posts_per_page' => -1,
						'orderby' => 'name',
						'order' => 'ASC'
					);
		
					$auteur_query = new WP_Query( $args ); ?>
					
				<?php if ( $auteur_query->have_posts() ) :
					
						while ( $auteur_query->have_posts() ) : $auteur_query->the_post(); ?>
		
					<div class="trombi-auteur">
					
						<?php
						
							$auteur_ID = $post->ID;
							$auteur_url = get_permalink($auteur_ID);
							$auteur_name = get_field('auteur_prenom', $auteur_ID);
							$auteur_title = get_field('auteur_titre', $auteur_ID);
							$auteur_image = get_field('auteur_photo', $auteur_ID);
		
							if ( !empty($auteur_image) ) :
								$caption = $auteur_image['caption'];
								$alt = $auteur_image['alt'];
								$size = 'large';
								$thumb = $auteur_image['sizes'][ $size ];
								$width = $auteur_image['sizes'][ $size . '-width' ];
								$height = $auteur_image['sizes'][ $size . '-height' ];
						?>
		
						<div class="auteur-photo"><a href="<?php echo $auteur_url; ?>"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a></div>
						
						<?php else: ?>
						
						<div class="auteur-photo"><a href="<?php echo $auteur_url; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/i-auteurdef.png" alt="<?php bloginfo('name'); ?>" width="140" height="140" /></a></div>
						
						<?php endif; ?>
						
						<?php if( !empty( $auteur_title ) ) : ?>
						
							<div class="auteur-nom"><p class="nom"><a href="<?php echo $auteur_url; ?>"><?php echo $auteur_name; ?></a></p><p class="titre"><?php echo $auteur_title; ?></p></div>
							
						<?php else : ?>
						
							<div class="auteur-nom"><p class="nom"><a href="<?php echo $auteur_url; ?>"><?php echo $auteur_name; ?></a></p></div>
						
						<?php endif; ?>
		
					</div>
					
				<?php endwhile; ?>
				
				<?php else : ?>
				
				<?php locate_template( array( 'content/error.php' ), true ); // Loads the loop-error.php template. ?>
						
				<?php endif; ?>
		
				<?php wp_reset_postdata(); ?>
			
				</div>
				
				<?php if( !empty( $equipe_url ) || !empty( $equipe_email ) ) : ?>
				
	<div id="ancre-equipe"></div>
				
				<div class="links clearfix">
				
					<?php if( !empty( $equipe_url ) ) : ?>
						
					<p class="link-equipe" itemscope itemtype="http://schema.org/Organization"><a href="<?php echo $equipe_url; ?>" alt="D&eacute;couvrir notre &eacute;quipe" itemprop="url" rel="bookmark" class="button">D&eacute;couvrir notre &eacute;quipe</a></p>
						
					<?php endif; ?>
					
					<?php if( !empty( $equipe_email ) ) : ?>
						
					<p class="link-mail" itemscope itemtype="http://schema.org/Organization"><a href="mailto:<?php echo $equipe_email; ?>" alt="Nous contacter" itemprop="email" rel="bookmark" class="button">Nous contacter</a></p>
						
					<?php endif; ?>
					
				</div>
				
				<?php endif; ?>
				
			</div>
			
		<?php if( !empty($equipe_image) ) : ?>
			
		</div>
		
		<?php endif; ?>
	
	</div>
		
<?php	endwhile;

	endif;
	
?>

<?php

	if( have_rows( 'banner_ndstore', $home_id ) || have_rows( 'news_pres', $home_id ) ) : ?>
	
	<div id="ndstore">
	
		<div class="footer-content">
		
		<?php if( have_rows( 'banner_ndstore', $home_id ) ) : ?>
		
			<?php
				
				while ( have_rows( 'banner_ndstore', $home_id ) ) : the_row();
					
				$ndstore_accroche = get_sub_field( 'ndstore_accroche', $home_id );
				$ndstore_url = get_sub_field( 'ndstore_url', $home_id );
				$ndstore_image = get_sub_field( 'ndstore_banner', $home_id );
					
					if ( !empty( $ndstore_image ) ) {
						
						$alt = $ndstore_image['alt'];
						$size = 'large';
						$thumb = $ndstore_image['sizes'][ $size ];
						$width = $ndstore_image['sizes'][ $size . '-width' ];
						$height = $ndstore_image['sizes'][ $size . '-height' ];
					
					}
					
			?>
			
			<h2><?php echo $ndstore_accroche; ?></h2>

			<div id="store-banner">
				<a href="<?php echo $ndstore_url; ?>" target="_blank"><img src="<?php echo $thumb; ?>" alt="<?php echo $alt; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>
			</div>
			
			<?php endwhile; ?>
				
		<?php endif; ?>
				
		<?php if( have_rows( 'news_pres', $home_id ) ): ?>
		
			<div id="newsletter">
			
			<?php while ( have_rows( 'news_pres', $home_id ) ) : the_row();
						
					$news_titre = get_sub_field( 'news_titre', $home_id );
					$news_texte = get_sub_field( 'news_texte', $home_id );
							
			?>
			
				<h3 class="news-titre"><i class="fa fa-envelope-o fa-fw"></i><?php echo $news_titre; ?></h3>
				
				<div class="news-texte"><?php echo $news_texte; ?></div>
				
				<?php if ( function_exists( 'formulaire_abonnement_newsletter' ) ) : ?>
					
				<?php echo formulaire_abonnement_newsletter(); ?>
					
				<?php endif; ?>
					
				<div class="message"></div>

			<?php endwhile; ?>

			</div>
		
		<?php endif; ?>
		
		</div>
	
	</div>
	
<?php endif; ?>

</main><!-- #content -->

		</div><!-- #main -->

		<footer <?php hybrid_attr( 'footer' ); ?>>

			<p class="copyright">
				<?php printf(
					// Translators: 1 is current year, 2 is site name/link, 3 is WordPress name/link, and 4 is theme name/link.
					esc_html__( 'Copyright &#169; %1$s %2$s', 'tribu2015' ), 
					date_i18n( 'Y' ), hybrid_get_theme_link()
				); ?>
			</p><!-- .credit -->
			
			<?php hybrid_get_menu( 'secondary' ); // Loads the menu/secondary.php template. ?>

		</footer><!-- #footer -->

	</div><!-- #container -->

<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#ffffff",
      "text": "#000000"
    },
    "button": {
      "background": "transparent",
      "text": "#d63625",
      "border": "#d63625"
    }
  },
  "content": {
    "message": "Afin de vous garantir la meilleure expérience de navigation, le site de la Tribu Nature & Découvertes recourt à l'utilisation de cookies, en continuant votre navigation sur le site de la Tribu Nature & Découvertes vous en acceptez l'usage. Pour en savoir plus sur les cookies, ",
    "dismiss": "J'ai compris",
    "link": "cliquez ici.",
    "href": "https://www.natureetdecouvertes.com/cookies"
  }
})});
</script>
	<?php wp_footer(); // WordPress hook for loading JavaScript, toolbar, and other things in the footer. ?>

</body>
</html>