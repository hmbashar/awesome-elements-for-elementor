(function ($) {
	'use strict';

	// -------------------------------------------------------
	// Testimonial / team-member carousels initialised via
	// data-carousel attribute (set in each widget's PHP template).
	// This replaces the previous approach of injecting inline <script>
	// tags from PHP, which bypassed CSP and made editor preview awkward.
	// -------------------------------------------------------
	function aefe_init_carousels() {
		$('.aefe-owl-carousel[data-carousel]').each(function () {
			var $el     = $(this);
			var config  = $el.data('carousel');

			if (!config || $el.hasClass('owl-loaded')) {
				return;
			}

			// Map our serialised nav icons back to the owlCarousel navText option
			var navText = ['', ''];
			if (config.navLeft  !== undefined) { navText[0] = config.navLeft;  }
			if (config.navRight !== undefined) { navText[1] = config.navRight; }

			$el.owlCarousel({
				loop:                config.loop      || false,
				autoplay:            config.autoplay  || false,
				autoplayHoverPause:  config.autoplayHoverPause !== undefined ? config.autoplayHoverPause : true,
				navText:             navText,
				responsive:          config.responsive || {},
			});
		});
	}

	// Run on document ready
	$(document).ready(function () {
		aefe_init_carousels();
	});

	// Re-run inside the Elementor editor after widgets are rendered
	$(window).on('elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/widget', function () {
			aefe_init_carousels();
		});
	});

	// -------------------------------------------------------
	// Team-member slider (hardcoded style — Owl Carousel).
	// Settings are now driven via data attributes written by
	// teammember-one.php when the slider mode is selected.
	// The fallback below kicks in only when no data-carousel
	// attribute is present (e.g. cached markup from older version).
	// -------------------------------------------------------
	$(document).ready(function () {
		$('.aefe-tm-our-talent-slider-content:not([data-carousel]):not(.owl-loaded)').owlCarousel({
			items:    4,
			autoplay: true,
			loop:     true,
			margin:   25,
			dots:     false,
			nav:      true,
			navText:  ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
			responsive: {
				0:    { items: 1 },
				600:  { items: 2 },
				800:  { items: 3 },
				1000: { items: 4 },
			},
		});

		// Team-member style three slider (fallback)
		$('.aefe-tm-sth-our-team-content-area:not([data-carousel]):not(.owl-loaded)').owlCarousel({
			items:    3,
			autoplay: true,
			nav:      false,
			dots:     false,
			margin:   32,
			loop:     true,
			responsive: {
				0:    { items: 1 },
				600:  { items: 1 },
				750:  { items: 2 },
				1000: { items: 3 },
			},
		});
	});

	// -------------------------------------------------------
	// Skills progress bars
	// -------------------------------------------------------
	$(document).ready(function () {
		// Style two bar
		$('.aefe_sk_st_progressbar').each(function () {
			var $bar   = $(this);
			var target = $bar.attr('data-perc');
			$bar.find('.aefe_skst_bar').animate({ width: target }, 3000);
			$bar.find('.aefe_skill_bar_st_label').animate({ left: target }, 3000);
		});

		// Style one bar
		$('.aefe_skill_barfiller').each(function () {
			var $bar   = $(this);
			var target = $bar.attr('data-perc');
			$bar.find('.aefe_skill_fill.aefe-skills-skill').animate({ width: target }, 1000);
		});
	});

})(jQuery);
