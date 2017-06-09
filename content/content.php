<article <?php hybrid_attr( 'post' ); ?>>

	<meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="https://google.com/article"/>

	<?php if ( is_singular( get_post_type() ) ) : // If viewing a single post. ?>
	
		<?php
			global $post;
			$thumb = get_post_thumbnail_id( $post->ID );
			$thumb_src = wp_get_attachment_url( $thumb );
			$thumb_data = wp_get_attachment_metadata( $thumb );
			if (isset($thumb_data['width'])) $thumb_width = $thumb_data['width'];
			if (isset($thumb_data['height'])) $thumb_height = $thumb_data['height'];
		?>

		<header class="entry-header">
		
			<?php
			
			get_the_image( array(
				'size'			=>	'large',
				'link_to_post'	=>	false,
				'before'		=>	'<div class="entry-thumbnail" id="entryBanner"><div class="hasBackground" style="background-image:url(' . $thumb_src . ')" data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -150px;" data-bottom-top="background-position: 50% 150px;" data-anchor-target="#entryBanner" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">',
				'after'			=>	'<meta itemprop="url" content="' . $thumb_src . '"><meta itemprop="width" content="' . $thumb_width . '"><meta itemprop="height" content="' . $thumb_height . '"></div></div>'
			) ); ?>

			<div class="entry-meta">
				<div class="meta-content">
					<?php
						if ( function_exists( 'sharing_display' ) ) sharing_display( '', true );
					?>
					<div class="wp-post-rating">
						<?php if(function_exists('the_ratings')) { ?>
						<p class="post-ratings-title">Noter&nbsp;:</p>
						<?php the_ratings('span'); } ?>
					</div>
				</div>
			</div>

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><span class="texte-titre"><?php single_post_title(); ?></span></h1>
			
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_modified_date(); ?></time>
			<meta itemprop="dateModified" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"/>
			
			<div class="entry-byline">
				<div class="entry-summary" itemprop="headline"><?php tribu_excerpt(); ?></div>
			</div><!-- .entry-byline -->
			
			<div <?php hybrid_attr( 'entry-author vcard author' ); ?> itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><?php post_auteur(); ?></div>
			
			<?php the_content(); ?>
			
			<?php edit_post_link(); ?>

			<?php related_products(); ?>
			
		</div><!-- .entry-content -->
		
		<?php comments_template( '', true ); // Loads the comments.php template. ?>

		<footer class="entry-footer">
			<?php related_entries(); ?>
			<?php post_in_cat(); ?>
		</footer><!-- .entry-footer -->

	<?php elseif ( is_search() ) : // If viewing search results. ?>
	
		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
			
			<h3 <?php hybrid_attr( 'entry-category' ); ?>><?php the_category(' - ', 'single'); ?></h3>

			<div class="entry-byline">
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php cat_auteur(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_modified_date(); ?></time>
				<meta itemprop="dateModified" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"/>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php tribu_excerptshort(); ?>
			<p><a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__( 'Read more', 'tribu2015' ); ?></a>
			<?php edit_post_link(esc_html__( 'Edit', 'tribu2015' ), ' ', ''); ?></p>
		</div><!-- .entry-summary -->

	<?php elseif( is_front_page() ) : // If viewing frontpage. ?>

		<?php
			global $post;
			$thumb = get_post_thumbnail_id(  );
			$thumb_src = wp_get_attachment_url( $thumb );
			$thumb_data = wp_get_attachment_metadata( $thumb );
			if (isset($thumb_data['width'])) $thumb_width = $thumb_data['width'];
			if (isset($thumb_data['height'])) $thumb_height = $thumb_data['height'];
		?>

		<?php get_the_image( array(
			'size' => 'medium',
			'before' => '<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">',
			'after' => '<meta itemprop="url" content="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '"><meta itemprop="width" content="' . $thumb_width . '"><meta itemprop="height" content="' . $thumb_height . '"></div>'
		) ); ?>

		<header class="entry-header">

			<?php the_title( '<h3 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h3>' ); ?>

			<div class="entry-byline">
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php cat_auteur(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_modified_date(); ?></time>
				<meta itemprop="dateModified" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"/>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php tribu_excerptshort(); ?>
			<p><a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__( 'Read more', 'tribu2015' ); ?></a>
			<?php edit_post_link(esc_html__( 'Edit', 'tribu2015' ), ' ', ''); ?></p>
		</div><!-- .entry-summary -->

	<?php else : // If not viewing a single post. ?>

		<?php
			global $post;
			$thumb = get_post_thumbnail_id(  );
			$thumb_src = wp_get_attachment_url( $thumb );
			$thumb_data = wp_get_attachment_metadata( $thumb );
			if (isset($thumb_data['width'])) $thumb_width = $thumb_data['width'];
			if (isset($thumb_data['height'])) $thumb_height = $thumb_data['height'];
		?>

		<?php get_the_image( array(
			'size' => 'medium',
			'before' => '<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">',
			'after' => '<meta itemprop="url" content="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '"><meta itemprop="width" content="' . $thumb_width . '"><meta itemprop="height" content="' . $thumb_height . '"></div>'
		) ); ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . get_permalink() . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-byline">
				<span <?php hybrid_attr( 'entry-author' ); ?>><?php cat_auteur(); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_modified_date(); ?></time>
				<meta itemprop="dateModified" content="<?php echo get_the_time( 'Y-m-d\TH:i:sP' ); ?>"/>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-summary' ); ?>>
			<?php tribu_excerptshort(); ?>
			<p><a href="<?php the_permalink(); ?>" class="button"><?php echo esc_html__( 'Read more', 'tribu2015' ); ?></a>
			<?php edit_post_link(esc_html__( 'Edit', 'tribu2015' ), ' ', ''); ?></p>
		</div><!-- .entry-summary -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->