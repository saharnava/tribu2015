<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_page() ) : // If viewing a single page. ?>

		<header class="entry-header">
			<?php get_the_image( array(
				'size' => 'large',
				'link_to_post' => false
			) ); ?>
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><span class="texte-titre"><?php single_post_title(); ?></span></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php edit_post_link(); ?>
		</footer><!-- .entry-footer -->

	<?php endif; // End single page check. ?>

</article><!-- .entry -->