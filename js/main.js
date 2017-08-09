$(window).on('load resize',windowSize);

$(document).on('ready',windowSize);

function windowSize(){
    if ($(window).width() <= '1150'){
        var windowWidth = $(window).width();
        var imgHeight = $('.connected-carousels .stage .carousel li img').height();
        $('.connected-carousels .stage .carousel li').width(windowWidth);
        $('.connected-carousels .carousel-stage').height(imgHeight);
        $('.connected-carousels .stage .carousel li').height(imgHeight);
        $('.connected-carousels .stage .carousel li').css('line-height', imgHeight + 'px');
        $('.connected-carousels .prev-stage').width(windowWidth/2).height(imgHeight);
        $('.connected-carousels .next-stage').width(windowWidth/2).height(imgHeight);
    }
}

$(function() {
	var imgWidth = $('.all-about .about a img').width();
	var imgHeight = $('.all-about .about a img').height();

	if (imgHeight > imgWidth) {
		$('.all-about .about a img').addClass('rectangular');
	}
});

$(document).ready(function() {

	// show / hide sub-menu
	$('header .navigation .main-menu .menu-item').click(function() {
		$(this).children('.sub-menu').toggleClass('active');
		// return false;
	});

	$('header .navigation .main-menu .menu-item').mouseenter(function() {
		$(this).children('.sub-menu').addClass('active');
	});

	$('header .navigation .main-menu .menu-item').mouseleave(function() {
		$(this).children('.sub-menu').removeClass('active');
	});

	// filters
	$('.filters .filters-title a').click(function() {
		if ($(this).parents('.filters').hasClass('categories')) {
			$('.filters.series .filters-title a').removeClass('active');
			$('.filters.series .filters-list').slideUp(400);
		}

		if ($(this).parents('.filters').hasClass('series')) {
			$('.filters.categories .filters-title a').removeClass('active');
			$('.filters.categories .filters-list').slideUp(400);
		}
		// open this filters
		$(this).toggleClass('active');
		$(this).parents('.filters').children('.filters-list').slideToggle(400);
		return false;
	});

	// filters location
	$('.filters-location .filters-title a').click(function() {
		if ($(this).parents('.filters-location').hasClass('type')) {
			$('.filters-location.country .filters-title a').removeClass('active');
			$('.filters-location.country .filters-list').slideUp(400);
			$('.filters-location.region .filters-title a').removeClass('active');
			$('.filters-location.region .filters-list').slideUp(400);
			$('.filters-location.city .filters-title a').removeClass('active');
			$('.filters-location.city .filters-list').slideUp(400);
		}

		if ($(this).parents('.filters-location').hasClass('country')) {
			$('.filters-location.type .filters-title a').removeClass('active');
			$('.filters-location.type .filters-list').slideUp(400);
			$('.filters-location.region .filters-title a').removeClass('active');
			$('.filters-location.region .filters-list').slideUp(400);
			$('.filters-location.city .filters-title a').removeClass('active');
			$('.filters-location.city .filters-list').slideUp(400);
		}

		if ($(this).parents('.filters-location').hasClass('region')) {
			$('.filters-location.type .filters-title a').removeClass('active');
			$('.filters-location.type .filters-list').slideUp(400);
			$('.filters-location.country .filters-title a').removeClass('active');
			$('.filters-location.country .filters-list').slideUp(400);
			$('.filters-location.city .filters-title a').removeClass('active');
			$('.filters-location.city .filters-list').slideUp(400);
		}

		if ($(this).parents('.filters-location').hasClass('city')) {
			$('.filters-location.type .filters-title a').removeClass('active');
			$('.filters-location.type .filters-list').slideUp(400);
			$('.filters-location.country .filters-title a').removeClass('active');
			$('.filters-location.country .filters-list').slideUp(400);
			$('.filters-location.region .filters-title a').removeClass('active');
			$('.filters-location.region .filters-list').slideUp(400);
		}
		// open this filters
		$(this).toggleClass('active');
		$(this).parents('.filters-location').children('.filters-list').slideToggle(400);
		return false;
	});

	// close filters
	/*$('body').click(function(e) {
		if ($('div').hasClass('filters')) {
			if ($(e.target).closest('.filters').length==0) {
				$('.filters-title a').removeClass('active');
				$('.filters-list').slideUp(400);
			}
		}
		if ($('div').hasClass('filters-location')) {
			if ($(e.target).closest('.filters-location').length==0) {
				$('.filters-title a').removeClass('active');
				$('.filters-list').slideUp(400);
			}
		}
	});*/

	// filters
	$('.tabs .tabs-navigation a').click(function() {
		var tab = $(this).attr('href');
		if ($(this).hasClass('active')) {
			return false;
		}
		else {
			$('.tabs .tabs-navigation a').removeClass('active');
			$(this).addClass('active');
			$('.tabs .all-tabs .tab').slideUp(400);
			$('.tabs .all-tabs .tab'+ tab +'').slideDown(400);
		}
		return false;
	});

	// show hide text
	$('.tabs .all-tabs .tab a').click(function() {
		var linkHref = $(this).attr('href');
		$('div'+ linkHref +'').slideToggle(800);
		return false;
	});

	// fancybox
    if ($('a').hasClass('fancybox')) {
    	$(".fancybox").fancybox({
    		'loop': 'false'
    	});
    }



   $('a[rel="production-galery"]').each(function() {
        // note the use of "this" rather than a function argument
        $(this).fancybox({
            'autoScale': true,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic',
            'speedIn': 500,
            'speedOut': 300,
            'autoDimensions': true,
            'centerOnScroll': true
        });
        return false;
    });

    // Photo replacement
    $('.product-page .thumbs li a').click(function() {
    	$('.product-page .main-photo img').fadeOut(0);
    	var newImg = $(this).attr('href');
      var largeImg =  $(this).children().attr('data-large_image');
      $('.product-page .main-photo a').attr('href', largeImg);
    	$('.product-page .main-photo img').attr('src', newImg).fadeIn(400);
    	return false;
    });

    // ask question product
    $('.product-page .ask-question .button a').click(function() {
		$.fancybox.open({
			href : '#form'
		});
		return false;
    });

    // ask question product
    $('.lacotion-question .ask-question .button a').click(function() {
		$.fancybox.open({
			href : '#form-lacotion'
		});
		return false;
    });

    $('.category-description .read-more.show-text').click(function() {
    	$(this).parent().children('.description-content').toggleClass('active');
    	$(this).fadeOut(0);
    	return false;
    });

    $('header .navigation .mobile-menu').click(function() {
    	$('header .navigation .main-menu').slideToggle(1000);
    });

    $('header .content .search .show-search').click(function() {
    	$('header .search form').toggleClass('active');
    	if ($(this).children('.fa').hasClass('fa-search')) {
    		$(this).children('.fa').removeClass('fa-search').addClass('fa-times');
    	}

    	else {
    		$(this).children('.fa').removeClass('fa-times').addClass('fa-search');
    	}
    });

    $('.all-filters .filters-title').click(function() {
    	// if ($(window).width() <= '980') {
    	// 	$('.all-filters fieldset').fadeToggle(1000);
    	// 	$(this).toggleClass('active');
    	// 	return false;
    	// }
    	$('.all-filters .widget_layered_nav').slideToggle(800);
    });

    // interiors-foto
    $('.interiors-foto li a').click(function() {
    	var interiorTitle = $(this).attr('title');
    	var interiorImg = $(this).children('img').attr('src');
    	var interiorDesc = $(this).attr('data-desc');
      var interiorUrl = $(this).attr('data-url');
    	$('#modal-interior .interior-title').text(interiorTitle);
    	$('#modal-interior .modal-img img').attr('src', interiorImg);
    	$('#modal-interior .modal-text p').text(interiorDesc);
      $('#modal-interior .modal-text a').attr('href', interiorUrl);
    	$.fancybox.open({
			href : '#modal-interior'
		});
		return false;
    });

    // filters interiors
    $('.filters.interiors .filters-list a').click(function() {
    	var interiorFoto = $(this).attr('data-class');
    	$('.interiors-foto .interior-foto').fadeOut(400);
    	if (interiorFoto == 'all') {
    		$('.interiors-foto .interior-foto').fadeIn(400);
    	}
    	else {
    		$('.interiors-foto .interior-foto.'+interiorFoto+'').fadeIn(400);
    	}
    	$('.filters.interiors .filters-list').slideUp(400);
    	$('.filters.interiors .filters-title a').removeClass('active');
    	return false;
    });

    // download certificate
    $('body').on('click', '.fancybox-title span.download', function() {
    	var a = document.createElement('a');
		a.href = $('img.fancybox-image').attr('src');
		a.download = $('img.fancybox-image').attr('src');
		document.body.appendChild(a);
		a.click();
		document.body.removeChild(a);
    });

    // show footer
    $('footer').mouseenter(function() {
    	$('footer .hide-block').stop().slideDown();
    });

    $('footer').mouseleave(function() {
    	$('footer .hide-block').stop().slideUp();
    });

    $('.footer-bottom .show-footer a').click(function() {
    	$('footer .hide-block').slideToggle();
    	return false;
    });

    //Widget fix
      if($('.widget_layered_nav').length === 0) {
        $('.all-filters').remove();
      }
});
