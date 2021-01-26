(function ($) {
    var WidgetAdvancedCarousel = function( $scope, $ ) {
        $scope.find('.aquentro-slider-wrapper').each(function (e) {
            var slider = $(this).find('.aquentro-slider'),
                that = $(this);
            slider.on('init reInit afterChange', function(event, slick, currentSlide, nextSlide){
                //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
                var i = (currentSlide !== undefined ? currentSlide : 0) + 1,
                    counter = that.find('.slider-counter'),
                    total = slick.slideCount<10 ? "0"+slick.slideCount : slick.slideCount;
                if(i<10){
                    i = "0"+i;
                }
                counter.find('.current').text(i);
                counter.find('.total').text("/ "+total);
            });
            slider.slick({
                dots: false,
                infinite: false,
                speed: 600,
                arrows: true,
                rows: 0,
                slidesToShow: 1,
                slidesToScroll: 1,
            });

        });
    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/aquentro-carousel.default', WidgetAdvancedCarousel );
    } );
})(jQuery);