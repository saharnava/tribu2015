<?php
/**
 * Search Form Template
 * The search form template displays the search form.
 */
?>
			<div id="search-bar" class="collapse">

				<form method="get" class="search-form" name="search" action="<?php echo trailingslashit( home_url() ); ?>">
					<label class="screen-reader-text" for="s"></label>
					<input class="search_input" type="text" name="s" id="hide-a-bar" placeholder="<?php echo esc_html__( 'Search', 'tribu2015' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" />
					<input id="searchsubmit" type="hidden" value="search" />
				</form><!-- .search-form -->
			
			</div>