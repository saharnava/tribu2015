////////////////////////////////////////
// Variables
////////////////////////////////////////
 
var rsjqu = jQuery.noConflict();

var topOffest = (jQuery('body').hasClass('admin-bar')) ? 32 : 0;

var is_device = null;
if (navigator.userAgent.match( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/ )){
	is_device = 'mobile';
}
else {
	is_device = 'desktop';
}

var windowWidth = jQuery(window).width();

////////////////////////////////////////
// Bannière Homepage
////////////////////////////////////////

function hauteurHomeBanner(){
	
	// Home Banner
	var headerHeight = jQuery('.site-header').height();
	var windowHeight = jQuery(window).height()-topOffest;
	
	jQuery('.home #homeBanner .hasBackground').height(windowHeight);
	
}


////////////////////////////////////////
// Logo dans la bannière
////////////////////////////////////////

function homePicto() {
	
	// Home Picto
	var bannerText = jQuery('.home #homeBanner #textBanner');
	var bannerTextWidth = (jQuery('.home #homeBanner').actual('height')/2);
	var bannerTextTop = (jQuery('.home #homeBanner').actual('height')/3.75);
	bannerText.css({'margin-top': bannerTextTop+'px', 'width': bannerTextWidth});
	
}


////////////////////////////////////////
// Flèche sur la homepage
////////////////////////////////////////

function afficheHomeFleche() {
	
	// Home flèche bas
	var flecheBas = jQuery('.home #homeBanner #flechebas');
	var flecheBasHeight = (jQuery('.home #homeBanner').actual('height')/10);
	var flecheBasBottom = (jQuery('.home #homeBanner').actual('height')/20);
	flecheBas.css({'bottom': flecheBasBottom+'px', 'height': flecheBasHeight});

}


////////////////////////////////////////
// Menu homepage
////////////////////////////////////////

function classMenu(){
	var scrollTop = jQuery(window).scrollTop(); // our current vertical position from the top
	var header = jQuery(".site-header");
	var bannerHeight = jQuery('.home #homeBanner').actual('height');
	var headerHeight = jQuery('.site-header').height();
	var scrollMax = bannerHeight - headerHeight;
	if (scrollTop > scrollMax || jQuery(window).width() < 700) {	
		header.removeClass('transparent');
	} else {		
		header.addClass('transparent');
	}
}


////////////////////////////////////////
// Initialisation
////////////////////////////////////////

rsjqu(window).load(function() {

    // Search Button
    jQuery("a#search-btn").on( "click", function(){
        //event.preventDefault();
        jQuery("#search-bar").slideToggle();
        jQuery("#hide-a-bar").focus().get(0).setSelectionRange(0,0);
        jQuery(this).toggleClass('active');
        if( jQuery('#search-bar').hasClass('active') ) {
        	jQuery('#search-bar').removeClass('active');
        }
    });
    
});

rsjqu(document).ready(function(){
	
	jQuery('time').css({'position': 'absolute', 'left': '-10000px'});

	if ( is_device === 'mobile' ){
		jQuery('.hasBackground').css('background-attachment', 'scroll');
	}
	// Homepage
	jQuery('#container').imagesLoaded(function(){	
		if(jQuery('body').hasClass('home')){
			hauteurHomeBanner();
			homePicto();
			afficheHomeFleche();
			if ( is_device === 'desktop' ){
				classMenu();
			};
		}
		if( is_device === 'desktop' ){
			// Init Skrollr
			var s = skrollr.init();
			 
			// Refresh Skrollr after resizing our sections
			s.refresh(jQuery('.parallax'));
		}			
		jQuery('#container').css('opacity', '1' );	
	});
	
	// Menu Mobile
		jQuery("nav#menu-primary").mmenu({
			extensions		:	["border-none"],
			navbar			:	false,
			navbars			:	{
				height		:	1,
				content		:	[
					'<a href="https://www.facebook.com/natureetdecouvertes" target="_blank" title="Nature & Découvertes sur Facebook" class="btn-facebook"><i></i></a>',
					'<a href="https://www.instagram.com/natureetdecouvertes/" target="_blank" title="Nature & Découvertes sur Instagram" class="btn-instagram"><i></i></a>',
					'<a href="https://twitter.com/netd_news?lang=fr" target="_blank" title="Nature & Découvertes sur Twitter" class="btn-twitter"><i></i></a>',
					'<a href="https://fr.pinterest.com/natureetd/" target="_blank" title="Nature & Découvertes sur Pintesrest" class="btn-pinterest"><i></i></a>',
				],
				position	:	"bottom"
			},
			slidingSubmenus	:	false
		},{
			classNames: {
				inset		:	"sub-menu"
			},
			clone			:	true
		});

	// Resize Mobile
	jQuery(window).resize(function(){
		hauteurHomeBanner();
		homePicto();	
		afficheHomeFleche();	
	});
	
	// Clic Flèche
	jQuery('#flechebas').click(function(event){
		event.preventDefault();
		jQuery('html, body').animate({
			scrollTop: jQuery("#last-posts").offset().top
		}, 1000);
	});		
	
	// Menu en fondu sur la homepage
	if ( is_device === 'desktop' ){
		jQuery(window).scroll(function() {		
			classMenu();		
		});
	}

});