<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<script async custom-element="amp-social-share" src="https://cdn.ampproject.org/v0/amp-social-share-0.1.js"></script>
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
		<div class="sharedaddy sd-sharing-enabled">
			<div class="robots-nocontent sd-block sd-social sd-social-icon sd-sharing">
				<h3 class="sd-title">Partager sur</h3>
				<div class="sd-content">
					<amp-social-share type="facebook" data-param-app_id="1874168346189094" width="40" height="40" class="sd-button"></amp-social-share>
					<amp-social-share type="pinterest" data-param-media="<?php echo get_the_post_thumbnail_url(); ?>" width="40" height="40" class="sd-button"></amp-social-share>
					<amp-social-share type="twitter" width="40" height="40" class="sd-button"></amp-social-share>
					<amp-social-share type="whatsapp" width="40" height="40" class="sd-button"></amp-social-share>
				</div>
			</div>
		</div>
		<div class="amp-wp-view-desktop">
			<a href="<?php echo esc_url( get_permalink( get_queried_object_id() ) ); ?>">Afficher la version originale</a>
		</div>
	</footer>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

<amp-analytics type="googleanalytics">
<script type="application/json">
{
  "vars": {
    "account": "UA-2369445-14"
  },
  "triggers": {
    "trackPageview": {
      "on": "visible",
      "request": "pageview"
    }
  }
}
</script>
</amp-analytics>

</body>
</html>
