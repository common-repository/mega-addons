( function( $ ) {
	"use strict";

    //Accordion
    $('.mega-addons-accordion-item:first-child').addClass('active');
    $('.mega-addons-accordion-item:first-child .collapse').addClass('show');
    $('.collapse').on('shown.bs.collapse', function() {
        $(this).parent().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function() {
        $(this).parent().removeClass('active');
    });

    // Popup Video
    $('.mega-addons-popup-video,.mega-addons-popup-url').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    // testimonials slide
    $('.mega-addons-testimonials').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        speed: 500,
    });

    // Counter
    $('.mega-addons-count').counterUp({
        delay: 10,
        time: 1000
    });

	
	// Make sure you run this code under Elementor.
	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/infobox.default', function( $scope, $ ) {
			console.log( $scope );
			// $scope.find('.infobox').hide();
		} );
	} );
	
} )( jQuery );
