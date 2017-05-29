<?php if ( is_singular( 'post' ) ) : // If viewing a single post page. ?>

<?php elseif ( is_home() || is_archive() || is_search() || is_singular( 'auteur' ) ) : // If viewing the blog, an archive, or search results. ?>

	<?php the_posts_pagination(
		array( 
			'prev_text' => esc_html_x( 'Previous', 'posts navigation', 'tribu2015' ), 
			'next_text' => esc_html_x( 'Next',     'posts navigation', 'tribu2015' )
		) 
	); ?>

<?php endif; // End check for type of page being viewed. ?>