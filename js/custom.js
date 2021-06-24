;
(function ($) {


    /*
    * Focus fix for search box
     */
    $('input.search-field').focus(function () {
        $('html, body').animate({
            scrollTop: $(this).offset().top - '50px'
        }, 'fast');
    });


    $(document).ready(function () {
        $('.small-carousel').owlCarousel({
            loop: true,
            margin: 30,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                320: {
                    items: 1
                },
                400: {
                    items: 1
                },
                768: {
                    items: 2
                },
                1024: {
                    items: 2
                },
                1200: {
                    items: 3
                }
            }
        })
        // sideNav - Start --------------------------------------------------
        $(".button-collapse").sideNav();
        // sideNav - End --------------------------------------------------
        // main-searchbox - Start --------------------------------------------------
        $(".search-trigger").on("click", function () {
            $('#myNav').css("height", "100%");
        });
        $(".closebtn").on("click", function () {
            $('#myNav').css("height", "0%");
        });
        // main-searchbox - End --------------------------------------------------
        // sidebar testimonial --------------------------------------------------
        $('.carousel.carousel-slider').carousel({
            items: 1,
            fullWidth: true,
            autoPlay: true,
            stopOnHover: true,
            slideSpeed: 200,
            paginationSpeed: 800,
            rewindSpeed: 1000,
        });
        // main top slider --------------------------------------------------
        $('.slider').slider();
        // -----------------------------------------------------------------
        // --- 1 --- back to top
        // -----------------------------------------------------------------
        $(window).scroll(function () {
            if ($(this).scrollTop() > 200) {
                $('.backToTop:hidden').stop(true, true).fadeIn();
            } else {
                $('.backToTop').stop(true, true).fadeOut();
            }
        });
        $(function () {
            $(".scroll").click(function () {
                $("html,body").animate({
                    scrollTop: $(".thetop").offset().top - 100
                }, "slow");
                return false
            })
        });
        // -----------------------------------------------------------------
        // ---  select2
        // -----------------------------------------------------------------
        function initselect2() {
            $('select').select2();
        }

        initselect2();
        // -----------------------------------------------------------------
        // ---  Jquery colorbox
        // -----------------------------------------------------------------
        $('a[href*=".jpg"], a[href*=".jpeg"], a[href*=".png"], a[href*=".gif"]').colorbox({
            transition: 'elastic',
            speed: 350,
            rel: 'gallery',
            opacity: .85,
            closeButton: true,
            scalePhotos: true,
            maxWidth: '90%',
            maxHeight: '90%',
            title: function () {
                return $(this).find('img').attr('alt');
            }
        });

        // Select all links with hashes
        function smoothscroll() {
            $('a[href*="#"]')
            // Remove links that don't actually link to anything
                .not('[href="#"]')
                .not('[href="#0"]')
                .not('a.comment-reply-link')
                .click(function (event) {
                    // On-page links
                    if (
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') &&
                        location.hostname == this.hostname
                    ) {
                        // Figure out element to scroll to
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        // Does a scroll target exist?
                        if (target.length) {
                            // Only prevent default if animation is actually gonna happen
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: target.offset().top - 80
                            }, 800, function () {
                                // Callback after animation
                                // Must change focus!
                                var $target = $(target);
                                $target.focus();
                                if ($target.is(":focus")) { // Checking if the target was focused
                                    return false;
                                } else {
                                    $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                                    $target.focus(); // Set focus again
                                }
                                ;
                            });
                        }
                    }
                });
        }

        smoothscroll();
    });
})(jQuery);