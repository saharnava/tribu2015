<?php
// Get content width
$content_max_width       = absint( $this->get( 'content_max_width' ) );

// Get template colors
$theme_color             = $this->get_customizer_setting( 'theme_color' );
$text_color              = $this->get_customizer_setting( 'text_color' );
$muted_text_color        = $this->get_customizer_setting( 'muted_text_color' );
$border_color            = $this->get_customizer_setting( 'border_color' );
$link_color              = $this->get_customizer_setting( 'link_color' );
$header_background_color = $this->get_customizer_setting( 'header_background_color' );
$header_color            = $this->get_customizer_setting( 'header_color' );
?>
/* Generic WP styling */

@media only screen and (min-width: 640px) {
	.alignright {
		float: right;
	}
	
	.alignleft {
		float: left;
	}
	
	.aligncenter {
		display: block;
		margin-left: auto;
		margin-right: auto;
	}
}

.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}

.amp-wp-unknown-size img {
	/** Worst case scenario when we can't figure out dimensions for an image. **/
	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Template Styles */

.amp-wp-content,
.amp-wp-title-bar div {
	<?php if ( $content_max_width > 0 ) : ?>
	margin: 0 auto;
	max-width: <?php echo sprintf( '%dpx', $content_max_width ); ?>;
	<?php endif; ?>
}

* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

html {
	background: <?php echo sanitize_hex_color( $header_background_color ); ?>;
}

body {
	background: <?php echo sanitize_hex_color( $theme_color ); ?>;
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-family: 'Lato', Arial, sans-serif;
	font-weight: 300;
	line-height: 1.75em;
}

p,
ol,
ul,
figure {
	margin: 0 0 1em;
	padding: 0;
}

a,
a:visited {
	color: #d63625;
	text-decoration: none;
}

a:hover,
a:active,
a:focus {
	text-decoration: underline;
}

h2{font-weight: 400;text-transform: uppercase;}

/* Quotes */

blockquote {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	background: rgba(127,127,127,.125);
	border-left: 2px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	margin: 8px 0 24px 0;
	padding: 16px;
}

blockquote p:last-child {
	margin-bottom: 0;
}

/* UI Fonts */

.amp-wp-meta,
.amp-wp-header div,
.amp-wp-title,
.wp-caption-text,
.amp-wp-tax-category,
.amp-wp-tax-tag,
.amp-wp-comments-link,
.amp-wp-footer p,
.back-to-top {
	font-family: 'Lato', Arial, sans-serif;
}

/* Header */

.amp-wp-header {
	background-color: #FFFFFF;
	border-bottom: 1px solid #e6e6e6;
}

.amp-wp-header div {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	font-size: 1em;
	font-weight: 400;
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: .875em 16px;
	position: relative;
}

.amp-wp-header a {
	color: <?php echo sanitize_hex_color( $header_color ); ?>;
	text-decoration: none;
}

/* Site Icon */

.amp-wp-header .amp-wp-site-icon {
	/** site icon is 32px **/
	background-color: <?php echo sanitize_hex_color( $header_color ); ?>;
	border: 1px solid <?php echo sanitize_hex_color(  $header_color ); ?>;
	border-radius: 50%;
	position: absolute;
	right: 18px;
	top: 10px;
}

/* Article */

.amp-wp-article {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	font-weight: 400;
	margin: 1.5em auto;
	max-width: 840px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

/* Article Header */

.amp-wp-article-header {
	align-items: center;
	align-content: stretch;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin: 1.5em 16px 1.5em;
}

.amp-wp-title {
	color: <?php echo sanitize_hex_color( $text_color ); ?>;
	display: block;
	flex: 1 0 100%;
	font-weight: 700;
	margin: 0 0 .625em;
	width: 100%;
	text-transform: uppercase;
	letter-spacing: 0.02em;
}

/* Article Meta */

.amp-wp-meta {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	display: inline-block;
	flex: 2 1 50%;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: 0;
}

.amp-wp-article-header .amp-wp-meta:last-of-type {
	text-align: right;
}

.amp-wp-article-header .amp-wp-meta:first-of-type {
	text-align: left;
}

.amp-wp-byline amp-img,
.amp-wp-byline .amp-wp-author {
	display: inline-block;
	vertical-align: middle;
}

.amp-wp-byline amp-img {
	border: 1px solid <?php echo sanitize_hex_color( $link_color ); ?>;
	border-radius: 50%;
	position: relative;
	margin-right: 6px;
}

.amp-wp-posted-on {
	text-align: right;
}

/* Featured image */

.amp-wp-article-featured-image {
	margin: 0 0 1em;
}
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

/* Article Content */

.amp-wp-article-content {
	margin: 0 16px;
}

.amp-wp-article-content ul,
.amp-wp-article-content ol {
	margin-left: 1em;
}

.amp-wp-article-content amp-img {
	margin: 0 auto;
}

.amp-wp-article-content amp-img.alignright {
	margin: 0 0 1em 16px;
}

.amp-wp-article-content amp-img.alignleft {
	margin: 0 16px 1em 0;
}

.amp-wp-related ul,
.amp-wp-related-products ul{
	list-style: none;
	margin: 0;
	padding: 0;
}
.amp-wp-related-products ul{
	text-align: center;	
}
.amp-wp-related ul h3{
	margin-bottom: 0;
}
.amp-wp-related-products .produit{
	margin-bottom: 20px;
	margin-right: 20px;
	padding: 10px;
	width: 240px;
	display: inline-block;
	vertical-align: top;
	height: 300px;
	border: 1px solid #E6E6E6;
}


/* Captions */

.wp-caption {
	padding: 0;
}

@media only screen and (min-width: 640px) {
	
	.wp-caption.alignleft {
		margin-right: 16px;
	}
	
	.wp-caption.alignright {
		margin-left: 16px;
	}

}
.wp-caption .wp-caption-text {
	border-bottom: 1px solid <?php echo sanitize_hex_color( $border_color ); ?>;
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	margin: 0;
	padding: .66em 10px .75em;
}

/* AMP Media */

amp-carousel {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}
amp-iframe,
amp-youtube,
amp-instagram,
amp-vine {
	background: <?php echo sanitize_hex_color( $border_color ); ?>;
	margin: 0 -16px 1.5em;
}

.amp-wp-article-content amp-carousel amp-img {
	border: none;
}

amp-carousel > amp-img > img {
	object-fit: contain;
}

.amp-wp-iframe-placeholder {
	background: <?php echo sanitize_hex_color( $border_color ); ?> url( <?php echo esc_url( $this->get( 'placeholder_image_url' ) ); ?> ) no-repeat center 40%;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Article Footer Meta */

.amp-wp-article-footer .amp-wp-meta {
	display: block;
}

.amp-wp-tax-category,
.amp-wp-tax-tag {
	color: #000000;
	font-size: .875em;
	line-height: 1.5em;
	margin: 1.5em 16px;
}

.amp-wp-comments-link {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .875em;
	line-height: 1.5em;
	text-align: center;
	margin: 2.25em 0 1.5em;
}

.amp-wp-comments-link a {
	border-style: solid;
	border-color: <?php echo sanitize_hex_color( $border_color ); ?>;
	border-width: 1px 1px 2px;
	border-radius: 4px;
	background-color: transparent;
	color: <?php echo sanitize_hex_color( $link_color ); ?>;
	cursor: pointer;
	display: block;
	font-size: 14px;
	font-weight: 600;
	line-height: 18px;
	margin: 0 auto;
	max-width: 200px;
	padding: 11px 16px;
	text-decoration: none;
	width: 50%;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}
.amp-wp-view-desktop {
	margin: 1.5em 16px;
	text-align: center;
	padding: 12px 0;
}
.amp-wp-view-desktop a,
.amp-wp-view-desktop a:visited{
	padding: 6px 10px;
	border: 1px solid #d63625;
	border-radius: 32px;
	background: #FFFFFF;
	-webkit-transition: background-color 0.2s ease;
			transition: background-color 0.2s ease;
}
.amp-wp-view-desktop a:hover,
.amp-wp-view-desktop a:active,
.amp-wp-view-desktop a:focus {
	text-decoration: none;
	background: #d63625;
	color: #FFFFFF;
}

.sharedaddy {
	width: 100%;
    color: #000000;
    font-size: .875em;
    line-height: 1.5em;
    margin: 1.5em 0;
    padding: 16px;
    border-top: 1px solid #E6E6E6;
    border-bottom: 1px solid #E6E6E6;
}
.sharedaddy h3 {
	margin: 0;
}
.sharedaddy ul{
	list-style: none;
	margin: 10px 0 0 0;
	padding: 0;
}
.sharedaddy ul > li {
	margin: 0 10px 0 0;
	padding: 0;
	display: inline;
}
.sharedaddy a,
.sharedaddy a:link,
.sharedaddy a:visited,
.sharedaddy a:hover {
    font-style: normal;
    border: none;
}
.sharedaddy a.sd-button {
    display: inline-block;
    text-decoration: none;
    font-weight: 400;
    vertical-align: middle;
    
}
.sharedaddy .no-text {
    width: 30px;
    height: 30px;
}
li.share-facebook a.sd-button > span {
    background-image: url(<?php echo get_stylesheet_directory_uri( ) ?>/images/bt-share-facebook.png);
}
li.share-pinterest a.sd-button > span {
    background-image: url(<?php echo get_stylesheet_directory_uri( ) ?>/images/bt-share-pinterest.png);
}
li.share-twitter a.sd-button > span {
    background-image: url(<?php echo get_stylesheet_directory_uri( ) ?>/images/bt-share-twitter.png);
}
.sd-social-icon a.sd-button > span {
    width: 30px;
    height: 30px;
    text-indent: -9999px;
    background-position: center center;
    background-repeat: no-repeat;
}
a.sd-button > span {
    display: block;
    opacity: 1;
}
.entry-meta a.sd-button .share-count {
    display: none;
}
a.sd-button span.sharing-screen-reader-text {
    display: none;
}

/* AMP Footer */

.amp-wp-footer {
	border-top: 1px solid #E6E6E6;
	margin: calc(1.5em - 1px) 0 0;
}

.amp-wp-footer div {
	margin: 0 auto;
	max-width: calc(840px - 32px);
	padding: 1.25em 16px 1.25em;
	position: relative;
}

.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}

.amp-wp-footer p {
	color: <?php echo sanitize_hex_color( $muted_text_color ); ?>;
	font-size: .8em;
	line-height: 1.5em;
	margin: 0 85px 0 0;
}

.amp-wp-footer a {
	text-decoration: none;
}

.back-to-top {
	bottom: 1.275em;
	font-size: .8em;
	font-weight: 600;
	line-height: 2em;
	position: absolute;
	right: 16px;
}
