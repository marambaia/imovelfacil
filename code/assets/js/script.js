/*global jQuery:false */
var $ = jQuery.noConflict();

$(document).ready(function($) {
	"use strict";
	/* ---------------------------------------------------------------------- */
	/*	Slider - [Flexslider]
	/* ---------------------------------------------------------------------- */
	try {
		$('.flexslider').flexslider({
			animation: "fade",
			controlNav: "thumbnails",
			controlsContainer: ".slider-wrapper"
		});
	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	Testimonials
	/* ---------------------------------------------------------------------- */
	$('.testimonials').slides({
		generateNextPrev: false,
		effect: 'fade',
		container: 'testimonials-container'
	});
	
	
	/* ---------------------------------------------------------------------- */
	/*	Boxes
	/* ---------------------------------------------------------------------- */
	$('.box').slides({
		generateNextPrev: true,
		generatePagination: false,
		effect: 'slide',
		container: 'images-available-container'
	});

	/* ---------------------------------------------------------------------- */
	/*	Custom File Upload
	/* ---------------------------------------------------------------------- */
	$('input[type="file"]').each(function(){
		$(this).hide();
		$(this).after('<div class="file-container"><a href="javascript:void(0);" class="button-file">' + $(this).attr('data-value') + '</a><span class="file-name">No File Choosen</span></div>');
	});

	$('.file-container').on('click', function(){
		$(this).prev('input[type="file"]').trigger('click');
	});

	$('input[type="file"]').bind('change', function(){
		var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
		$(this).next('div.file-container').find('.file-name').text(filename);
	});

	/* ---------------------------------------------------------------------- */
	/*	Custom SelectBox
	/* ---------------------------------------------------------------------- */
	try {
		$('.select').selectbox();
	} catch(err) {

	}

	/* ---------------------------------------------------------------------- */
	/*	Quick Search = Show/Hide
	/* ---------------------------------------------------------------------- */
	$('.show-hide').on("click", function(){
		$("#quick-search .slideToggle").slideToggle("slow");
		return false;
	});


	/* ---------------------------------------------------------------------- */
	/*	Custom Checkbox
	/* ---------------------------------------------------------------------- */
	$('.switcher a.on').bind('click', function(){
		$(this).parent().find('.switcher-bg span').animate({'left': '39px'}, 200);
		$(this).parent().find('input.custom-style').attr({'checked':'checked'});
		$('#categoria').val('2');
		return false;
	});

	$('.switcher a.off').bind('click', function(){
		$(this).parent().find('.switcher-bg span').animate({'left': '0px'}, 200);
		$(this).parent().find('input.custom-style').removeAttr('checked');
		$('#categoria').val('1');
		return false;
	});

	/* ---------------------------------------------------------------------- */
	/*	Box Item Hover
	/* ---------------------------------------------------------------------- */
	$('.box .slides_control > div').each(function(){
		$(this).append('<div class="box-item-hover"><p class="title">' + $(this).find(' > a').attr('data-title') + '</p></div>');
		
		var beds = $(this).find(' > a').attr('data-beds');
		var baths = $(this).find(' > a').attr('data-baths');
		var map = $(this).find(' > a').attr('data-map');
		if(typeof beds !== "undefined") {
			$(this).find('.box-item-hover').append('<p class="beds">'+royal.bed+': ' + beds + '</p>');
		}
		if(typeof baths !== "undefined") {
			$(this).find('.box-item-hover').append('<p class="baths">'+royal.bath+': ' + baths + '</p>');
		}
		if(map) {
			$(this).find('.box-item-hover').append('<a href="' + map + '" class="map-link"></a>');
		}
		
	});

	$('.box .slides_control > div').live('mouseenter', function(){
		$(this).closest('.thumbnail-container').find('.banner').fadeOut();
		$(this).find('.box-item-hover').stop(true,true).fadeIn();
	}).live('mouseleave', function(){
		$(this).find('.box-item-hover').stop(true,true).fadeOut();
		$(this).closest('.thumbnail-container').find('.banner').fadeIn();
	});
	
	
	// Contact Form
	$('#send_message').click(function(e){
		e.preventDefault();
		var error = false;
		var name = $('#contact_name').val();
		var email = $('#contact_email').val();
		var message = $('#contact_message').val();

		if(name.length === 0){
			error = true;
			$('#name_error').fadeIn(500);
		}else{
			$('#name_error').fadeOut(500);
		}
		if(email.length === 0 || email.indexOf('@') === '-1'){
			error = true;
			$('#email_error').fadeIn(500);
		}else{
			$('#email_error').fadeOut(500);
		}
		if(message.length === 0){
			error = true;
			$('#message_error').fadeIn(500);
		}else{
			$('#message_error').fadeOut(500);
		}

		if(error === false){
			$('#send_message').attr({'disabled' : 'true', 'value' : 'Enviando...' });

			var contactformurl = mysiteurl+"/mensagem/enviar";
			$.post(contactformurl, $("#contactform").serialize(),function(result){
				if(result === 'sent'){
					$('#cf_submit_p').remove();
					$('#mail_success').fadeIn(500);
				}else{
					$('#mail_fail').fadeIn(500);
					$('#send_message').removeAttr('disabled').attr('value', 'Enviar Mensagem');
				}
			});
		}
	});
	
	// Visita Form
	$('#send_message_visita').click(function(e){
		e.preventDefault();
		var error = false;
		var name = $('#contact_name').val();
		var address = $('#contact_address').val();

		if(name.length === 0){
			error = true;
			$('#name_error').fadeIn(500);
		}else{
			$('#name_error').fadeOut(500);
		}
		if(address.length === 0){
			error = true;
			$('#address_error').fadeIn(500);
		}else{
			$('#address_error').fadeOut(500);
		}

		if(error === false){
			$('#send_message_visita').attr({'disabled' : 'true', 'value' : 'Enviando...' });

			var contactformurl = mysiteurl+"/mensagem/enviar_visita";
			$.post(contactformurl, $("#contactform").serialize(),function(result){
				if(result === 'sent'){
					$('#cf_submit_p').remove();
					$('#mail_success').fadeIn(500);
				}else{
					$('#mail_fail').fadeIn(500);
					$('#send_message').removeAttr('disabled').attr('value', 'Enviar Mensagem');
				}
			});
		}
	});
});

	/* ---------------------------------------------------------------------- */
	/*	Back to top
	/* ---------------------------------------------------------------------- */
	
$(function() {
	"use strict";
	$(window).scroll(function() {
		if($(this).scrollTop() !== 0) {
			$('#back-to-top').fadeIn();	
		} else {
			$('#back-to-top').fadeOut();
		}
	});
 
	$('#back-to-top').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});	
});



/*!
 * jQuery Cookie Plugin
 */
(function($) {
	"use strict";
    $.cookie = function(key, value, options) {

        // key and at least value given, set cookie...
        if (arguments.length > 1 && (!/Object/.test(Object.prototype.toString.call(value)) || value === null || value === undefined)) {
            options = $.extend({}, options);

            if (value === null || value === undefined) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path    ? '; path=' + options.path : '',
                options.domain  ? '; domain=' + options.domain : '',
                options.secure  ? '; secure' : ''
            ].join(''));
        }

        // key and possibly options given, get cookie...
        options = value || {};
        var decode = options.raw ? function(s) { return s; } : decodeURIComponent;

        var pairs = document.cookie.split('; ');
        for (var i = 0, pair; pair === pairs[i] && pairs[i].split('='); i++) {
            if (decode(pair[0]) === key) { return decode(pair[1] || ''); } // IE saves cookies with empty string as "c; ", e.g. without "=" as opposed to EOMB, thus pair[1] may be undefined
        }
        return null;
    };
})(jQuery);