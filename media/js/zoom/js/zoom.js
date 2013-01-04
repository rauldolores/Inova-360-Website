(function($) {
	$.zoom = function() {
		$('body').append('<div id="zoom"><a class="close"></a><a href="#previous" class="previous"></a><a href="#next" class="next"></a><div class="content loading"></div><div id="inova360MenuIzquierda" style="position: fixed; height: 100%; background-color: #000; width: 0px; z-index: 10000; right: 0px; padding: 20px; opacity: 0.0; top: 0px;"></div></div>');
		var zoom = $('#zoom'),
		    zoomContent = $('#zoom .content'),
		    zoomedIn = false,
		    openedImage = null,
		    windowWidth = $(window).width(),
		    windowHeight = $(window).height();
		
		zoom.hide();
		bindNavigation();
		bindChangeImageDimensions();
		bindScrollControl();
		
		function bindNavigation() {
			zoom.on('click', function(event) {
				event.preventDefault();
				if ($(event.target).attr('id') == 'zoom')
					close();
			});
			$('#zoom .close').on('click', close);
			$('#zoom .previous').on('click', openPrevious);
			$('#zoom .next').on('click', openNext);
			$(document).keydown(function(event) {
				if (!openedImage)
					return;
				if (event.which == 38 || event.which == 40)
					event.preventDefault();
				if (event.which == 27)
					close();
				if (event.which == 37 && !openedImage.hasClass('zoom'))
					openPrevious();
				if (event.which == 39 && !openedImage.hasClass('zoom'))
					openNext();
			});
			
			if ($('.gallery li a').length == 1)
				$('.gallery li a')[0].addClass('zoom');
			$('.zoom, .gallery li a').on('click', open);
		}
		
		function bindChangeImageDimensions() {
			$(window).on('resize', changeImageDimensions);
		}
		
		function bindScrollControl() {
			$(window).on('mousewheel DOMMouseScroll', function(event) {
  			if (!openedImage) return;
				event.stopPropagation();
				event.preventDefault();
				event.cancelBubble = false;
			});
		}
		
		function open(event) {
			if (event)
				event.preventDefault();
			var link = $(this),
			    src = link.attr('href');
			if (!src)
				return;
			var image = $(new Image()).hide();
			$('#zoom .previous, #zoom .next').show();
			if (link.hasClass('zoom'))
				$('#zoom .previous, #zoom .next').hide();
			if (!zoomedIn) {
				zoomedIn = true;
				zoom.show();
				$('body').addClass('zoomed');
			}
			zoomContent.html(image).delay(500).addClass('loading');
			image.load(render).attr('src', src);
			openedImage = link;
		}
		
		function openPrevious() {
			var prev = openedImage.parent('li').prev();
			if (prev.length == 0)
				prev = $('.gallery li:last-child');
			prev.find('a').trigger('click');
		}
		
		function openNext() {
			var next = openedImage.parent('li').next();
			if (next.length == 0)
				next = $('.gallery li:first-child');
			next.children('a').trigger('click');
		}
		
		function render() {
			var image = $(this),
			    borderWidth = parseInt(zoomContent.css('borderLeftWidth')),
			    maxImageWidth = windowWidth - (borderWidth * 2),
			    maxImageHeight = windowHeight - (borderWidth * 2),
			    imageWidth = image.width(),
			    imageHeight = image.height();
				mostrarSlideLateralDer();
				
				$('#idImagen').val(openedImage.attr('id'));
				CargaComentariosImagen();
				
			if (imageWidth == zoomContent.width() && imageWidth <= maxImageWidth && imageHeight == zoomContent.height() && imageHeight <= maxImageHeight) {
					show(image);
					return;
			}
			if (imageWidth > maxImageWidth || imageHeight > maxImageHeight) {
				var desiredHeight = maxImageHeight < imageHeight ? maxImageHeight : imageHeight,
				    desiredWidth  = maxImageWidth  < imageWidth  ? maxImageWidth  : imageWidth;
				if ( desiredHeight / imageHeight <= desiredWidth / imageWidth ) {
					image.width(imageWidth * desiredHeight / imageHeight);
					image.height(desiredHeight);
				} else {
					image.width(desiredWidth);
					image.height(imageHeight * desiredWidth / imageWidth);
				}
			}
			zoomContent.animate({
				width: image.width(),
				height: image.height(),
				marginTop: -(image.height() / 2) - borderWidth,
				marginLeft: -(image.width() / 2) - borderWidth
			}, 200, function(){
				show(image);
			});
			
			function show(image) {
				image.show();
				zoomContent.removeClass('loading');
			}
		}
		
		function close(event) {
			if (event) event.preventDefault();
			zoomedIn = false;
			openedImage = null;
			zoom.hide();
			ocultarSlideLateralDer();
			$('body').removeClass('zoomed');
			zoomContent.empty();
		}
		
		function changeImageDimensions() {
			windowWidth = $(window).width();
			windowHeight = $(window).height();
		}
	};
})(jQuery);
