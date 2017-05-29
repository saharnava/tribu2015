<article id="post-0">

	<header class="entry-header">
		<h1 class="entry-title"><?php esc_html_e( 'Nothing found', 'tribu2015' ); ?></h1>
	</header><!-- .entry-header -->

	<div <?php hybrid_attr( 'entry-content' ); ?>>
		<?php echo wpautop( esc_html__( 'Apologies, but no entries were found.', 'tribu2015' ) ); ?>
		<a href="<?php bloginfo('url'); ?>" class="button"><?php esc_html_e( 'Back to home', 'tribu2015' ); ?></a>
	</div><!-- .entry-content -->

</article><!-- .entry -->