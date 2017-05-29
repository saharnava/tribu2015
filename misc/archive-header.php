<?php if ( is_category() ) : ?>

	<?php
	
		// vars
		$queried_object = get_queried_object(); 
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;  

		// load thumbnail for this taxonomy term (term object)
		$cat_img = get_field('cat_img', $queried_object);

		// load thumbnail for this taxonomy term (term string)
		$cat_img = get_field('cat_img', $taxonomy . '_' . $term_id);
	
		if ( !empty($cat_img) ) : ?>

	<header id="archiveBanner" <?php hybrid_attr( 'archive-header' ); ?>>
	
		<div class="hasBackground" style="background-image:url(<?php echo $cat_img['url'];; ?>);" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -150px;" data-bottom-top="background-position: 50% 150px;" data-anchor-target="#archiveBanner">

	<?php else: ?>
		
	<header <?php hybrid_attr( 'archive-header' ); ?>>	
		
	<?php endif; ?>

			<div <?php hybrid_attr( 'archive-content' ); ?>>
			
				<div <?php hybrid_attr( 'archive-title' ); ?>>
				
				<h1><?php the_archive_title(); ?></h1>
				
		<?php if ( ! is_paged() && $desc = get_the_archive_description() ) : // Check if we're on page/1. ?>
	
			<div <?php hybrid_attr( 'archive-description' ); ?>>
				<?php echo $desc; ?>
			</div><!-- .archive-description -->
	
		<?php endif; // End paged check. ?>
							
				</div>
			
			</div>

	<?php if ( !empty($cat_img) ) : ?>
		
	</div>
	
	<?php endif; ?>
		
	</header><!-- .archive-header -->

<?php elseif ( is_search() ) : ?>

	<header <?php hybrid_attr( 'archive-header' ); ?>>	
		
			<h1><span class="texte-titre"><?php esc_html_e( 'Search Results', 'tribu2015' ); ?></span></h1>
			
	</header>
			
	<?php if ( ! is_paged() ) : // Check if we're on page/1. ?>

		<div <?php hybrid_attr( 'archive-description' ); ?>>
			<?php esc_html_e( 'You made a search about', 'tribu2015' ); ?> : &laquo;&nbsp;<strong><?php echo esc_html( get_search_query( false ) ); ?></strong>&nbsp;&raquo;.
		</div><!-- .search-description -->

	<?php endif; // End paged check. ?>
						
<?php endif; ?>