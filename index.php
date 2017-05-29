<?php get_header(); // Loads the header.php template. ?>

<main <?php hybrid_attr( 'content' ); ?>>

	<?php if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {yoast_breadcrumb('<p id="breadcrumbs">','</p>');} ?>

	<?php if ( ( !is_front_page() && !is_404() && hybrid_is_plural() ) ) : // If viewing a multi-post page ?>

		<?php locate_template( array( 'misc/archive-header.php' ), true ); // Loads the misc/archive-header.php template. ?>
		
	<div class="loop-category">

		<?php if ( have_posts() ) : // Checks if any posts were found. ?>
	
			<?php while ( have_posts() ) : // Begins the loop through found posts. ?>
	
				<?php the_post(); // Loads the post data. ?>
	
				<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>
	
			<?php endwhile; // End found posts loop. ?>
	
			<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>
	
		<?php else : // If no posts were found. ?>
	
			<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>
	
		<?php endif; // End check for posts. ?>
		
	</div>
	
	<?php elseif ( is_singular() ) : ?>

		<?php if ( have_posts() ) : // Checks if any posts were found. ?>
	
			<?php while ( have_posts() ) : // Begins the loop through found posts. ?>
	
				<?php the_post(); // Loads the post data. ?>
	
				<?php hybrid_get_content_template(); // Loads the content/*.php template. ?>
	
			<?php endwhile; // End found posts loop. ?>
	
			<?php locate_template( array( 'misc/loop-nav.php' ), true ); // Loads the misc/loop-nav.php template. ?>
	
		<?php else : // If no posts were found. ?>
	
			<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>
	
		<?php endif; // End check for posts. ?>
		
	<?php elseif ( is_404() ) : ?>
		
		<?php locate_template( array( 'content/error.php' ), true ); // Loads the content/error.php template. ?>
			
	<?php endif; // End check for multi-post page. ?>
	
<?php get_footer(); // Loads the footer.php template. ?>