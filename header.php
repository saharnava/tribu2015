<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?>>

<head <?php hybrid_attr( 'head' ); ?>>
<?php wp_head(); // Hook required for scripts, styles, and other <head> items. ?>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
</head>

<body <?php hybrid_attr( 'body' ); ?>>

	<div id="container">

		<header <?php hybrid_attr( 'header' ); ?>>
		
			<?php get_search_form(); ?>
			
			<div class="top">
					
				<div class="inside clearfix">
				
					<div <?php hybrid_attr( 'branding' ); ?>>
						<a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" width="200" height="96"></a>
						<div class="social">
							<a href="https://www.facebook.com/natureetdecouvertes" target="_blank" title="Nature & Découvertes sur Facebook" class="btn-facebook"><i></i></a>
							<a href="https://www.instagram.com/natureetdecouvertes/" target="_blank" title="Nature & Découvertes sur Instagram" class="btn-instagram"><i></i></a>
							<a href="https://twitter.com/netd_news?lang=fr" target="_blank" title="Nature & Découvertes sur Twitter" class="btn-twitter"><i></i></a>
							<a href="https://fr.pinterest.com/natureetd/" target="_blank" title="Nature & Découvertes sur Pintesrest" class="btn-pinterest"><i></i></a>
						</div>
					</div><!-- #branding -->
					
					<div id="secondary-nav">
					
						<a id="search-btn" class="navbar" href="#">
							<span class="bt-close"></span>
							<span class="bt-search"></span>
						</a>
					
					</div>
		
					<a href="#menu-primary" class="menu-toggle"><span></span></a>
		
					<?php hybrid_get_menu( 'primary' ); // Loads the menu/primary.php template. ?>
			
				</div>

			</div>

		</header><!-- #header -->

		<div id="main" class="main">
