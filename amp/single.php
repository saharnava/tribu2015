<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
	<?php global $post; $post_id = $post->ID; ?>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<article class="amp-wp-article">

	<?php $this->load_parts( array( 'featured-image' ) ); ?>

	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
		<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author' ) ) ); ?>
	</header>

	<div class="amp-wp-article-content">
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php related_products( $amp = true ); ?>
		<?php related_posts($args = array(), $reference_ID = false, $echo = true, $amp = true); ?>
		<?php post_in_cat( $amp = true ); ?>
	</div>

	<footer class="amp-wp-article-footer">
		<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', array( 'meta-taxonomy' ) ) ); ?>
		<?php
			if ( function_exists( 'sharing_display' ) ) sharing_display( '', true );
		?>
		<!-- <div class="sharedaddy sd-sharing-enabled"><div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing"><h3 class="sd-title">Partager sur</h3><div class="sd-content"><ul><li class="share-facebook"><a rel="nofollow" data-shared="sharing-facebook-8284" class="share-facebook sd-button share-icon no-text" href="http://tribu.natureetdecouvertes.com/yoga-aider-a-devenir-mere/?share=facebook&amp;nb=1" target="_blank" title="Cliquez pour partager sur Facebook"><span><span class="share-count">239</span></span><span class="sharing-screen-reader-text">Cliquez pour partager sur Facebook(ouvre dans une nouvelle fenêtre)<span class="share-count">239</span></span></a></li><li class="share-pinterest"><a rel="nofollow" data-shared="sharing-pinterest-8284" class="share-pinterest sd-button share-icon no-text" href="http://tribu.natureetdecouvertes.com/yoga-aider-a-devenir-mere/?share=pinterest&amp;nb=1" target="_blank" title="Cliquez pour partager sur Pinterest"><span><span class="share-count">1</span></span><span class="sharing-screen-reader-text">Cliquez pour partager sur Pinterest(ouvre dans une nouvelle fenêtre)<span class="share-count">1</span></span></a></li><li class="share-twitter"><a rel="nofollow" data-shared="sharing-twitter-8284" class="share-twitter sd-button share-icon no-text" href="http://tribu.natureetdecouvertes.com/yoga-aider-a-devenir-mere/?share=twitter&amp;nb=1" target="_blank" title="Cliquez pour partager sur Twitter"><span></span><span class="sharing-screen-reader-text">Cliquez pour partager sur Twitter(ouvre dans une nouvelle fenêtre)</span></a></li><li class="share-end"></li></ul></div></div></div> -->
		<div class="amp-wp-view-desktop">
			<a href="<?php echo esc_url( get_permalink( get_queried_object_id() ) ); ?>">Afficher la version originale</a>
		</div>
	</footer>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>
