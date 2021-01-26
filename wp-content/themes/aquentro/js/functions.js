/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function ($) {
    var body, masthead, menuToggle, siteNavigation, socialNavigation, siteHeaderMenu, resizeTimer;

    function initMainNavigation(container) {
        // Add dropdown toggle that displays child menu items.
        var dropdownToggle = $('<button />', {
            'class': 'dropdown-toggle',
            'aria-expanded': false
        }).append($('<span />', {
            'class': 'screen-reader-text',
            text: screenReaderText.expand
        }));

        container.find('.menu-item-has-children > a').after(dropdownToggle);

        // Toggle buttons and submenu items with active children menu items.
        container.find('.current-menu-ancestor > button').addClass('toggled-on');
        container.find('.current-menu-ancestor > .sub-menu').addClass('toggled-on');

        // Add menu items with submenus to aria-haspopup="true".
        container.find('.menu-item-has-children').attr('aria-haspopup', 'true');

        container.find('.dropdown-toggle').click(function (e) {
            var _this = $(this),
                screenReaderSpan = _this.find('.screen-reader-text');

            e.preventDefault();
            _this.toggleClass('toggled-on');
            _this.next('.children, .sub-menu').toggleClass('toggled-on');

            // jscs:disable
            _this.attr('aria-expanded', _this.attr('aria-expanded') === 'false' ? 'true' : 'false');
            // jscs:enable
            screenReaderSpan.text(screenReaderSpan.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand);
        });
    }

    initMainNavigation($('.main-navigation'));

    masthead = $('#masthead');
    menuToggle = masthead.find('#menu-toggle');

    // Scroll top when click on header
    (function () {
        $('#masthead a, #masthead button').click(function (event) {
            event.stopPropagation();
        });
        masthead.on('click', function (event) {
            var body = $("html, body");
            body.stop().animate({scrollTop: 0}, 500, 'swing', function () {
            });
        });
    })();

    // Enable menuToggle.
    (function () {
        // Return early if menuToggle is missing.
        if (!menuToggle.length) {
            return;
        }

        // Add an initial values for the attribute.
        menuToggle.add(siteNavigation).add(socialNavigation).attr('aria-expanded', 'false');

        menuToggle.on('click', function () {
            $(this).add(siteHeaderMenu).toggleClass('toggled-on');

            // jscs:disable
            $(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded', $(this).add(siteNavigation).add(socialNavigation).attr('aria-expanded') === 'false' ? 'true' : 'false');
            // jscs:enable
        });
    })();

    function subMenuPosition() {
        $('.sub-menu').each(function () {
            $(this).removeClass('toleft');
            if (($(this).parent().offset().left + $(this).parent().width() - $(window).width() + 170) > 0) {
                $(this).addClass('toleft');
            }
        });
    }

    subMenuPosition();
    $(window).resize(function () {
        subMenuPosition();
    });
    // Enable menuToggle.
    (function () {
        $(window).load(function () {
            $('.jetpack-testimonial-shortcode.column-1').each(function () {
                $(this).slick({
                    arrows: false,
                    dots: true,
                    rows: 1,
                });
            });

        });

    })();

    (function () {

        masthead.headroom({
            offset: 0,
            tolerance: {
                up: 20,
                down: 0
            },
            classes: {
                pinned: "nav-down",
                // when scrolling down
                unpinned: "nav-up",
                initial: "nav-top",
                // when above offset
                top: "nav-top",
                // when below offset
                notTop: "nav-not-top",
                // when at bottom of scoll area
                bottom: "",
                // when not at bottom of scroll area
                notBottom: "nav-not-bottom"
            }
        });

    })();

    (function () {
        window.sr = ScrollReveal();
        sr.reveal('.widget-area .widget, .site-main > *', {
            origin: 'bottom',
            duration: 500,
            delay: 200,
            scale: 1,
            viewFactor: 0,
            distance: '50px',
            mobile: false,
            easing: 'ease-out',
        });

        sr.reveal('.homepage-widget-area', {
            origin: 'bottom',
            duration: 600,
            easing: 'ease-out',
            delay: 0,
            scale: 1,
            viewFactor: 0,
            distance: '50px',
            mobile: false
        });

        if ($('#content').is(':visible')) {
            $('body').addClass('content-after-visible');
        }

    })();

    (function () {
        var vertical_menu = $('#content-left-menu-container'),
            thumb = $('#content').children('.post-thumbnail'),
            offset_top = $(window).height() + thumb.height();


        if (!(vertical_menu.length > 0)) {
            return;
        }

        $(window).scroll(function (e) {
            hideMenu();
        });

        vertical_menu.css('top', $(window).scrollTop() + $(window).height() - vertical_menu.width() / 2);

        function hideMenu() {

            if ($(window).scrollTop() >= offset_top) {
                vertical_menu.css('top', offset_top + $(window).height() - vertical_menu.width() / 2);
                vertical_menu.addClass('absolute');
            } else {
                vertical_menu.removeClass('absolute');
                vertical_menu.css('top', 50 + '%');
            }

            if (thumb.height() < vertical_menu.find('.content-left-menu li:last-child').offset().top) {
                vertical_menu.addClass('visible');
            } else {
                vertical_menu.removeClass('visible');
            }

        }

        hideMenu();
    })();

    var footer = $('#colophon'),
        content = $('#content');

    function initFooter() {
        if ($(window).width() > 991) {

            if ((footer.outerHeight() + content.outerHeight()) < $(window).height()) {
                content.css('min-height', ($(window).height() - footer.outerHeight()) + "px");
            }

            if (footer.outerHeight() > $(window).height()) {
                footer.addClass('relative');
                content.css('margin-bottom', '0');
            } else {
                footer.removeClass('relative');
                content.css('margin-bottom', footer.outerHeight() + 'px');
            }
        } else {
            content.css('margin-bottom', '0');
        }
    }

    initFooter();

    $(window).resize(function () {
        initFooter();
    });

    (function () {
        var toggle_btn = masthead.find('.menu-toggle');

        $(toggle_btn).click(function (e) {
            e.preventDefault();

            $('body').toggleClass('mobile-menu-opened');
            masthead.toggleClass('opened');

        });

    })()

})(jQuery);

