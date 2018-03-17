$(document).ready(function () {
	
	
    $('.subMenu').smint({
        'scrollSpeed' : 1000
    });
    $(".my-rating-8").starRating({
        useFullStars: true
    });
	$('[data-toggle="popover"]').on('click', function(e) {e.preventDefault(); return true;});
    $('[data-toggle="popover"]').popover(); 
    $(' .slider-tourism').slick({
        centerMode: true,
        centerPadding: '0px',
        rtl: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1

                }
            },
            {
                breakpoint: 750,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.slider-comment').slick({
        centerMode: true,
        centerPadding: '300px',
        rtl: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 1,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    centerPadding: '100px'

                }
            },
            {
                breakpoint: 600,
                settings: {
                    centerPadding: '50px'
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerPadding: '0px'
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.slider-villas').slick({
        centerMode: true,
        centerPadding: '0px',
        rtl: true,
        autoplay: true,
        autoplaySpeed: 2000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.slider-footer').slick({
        arrows:false,
        centerMode: true,
        centerPadding: '0px',
        rtl: true,
        autoplay: true,
        autoplaySpeed: 3000,
        slidesToShow: 1,
        slidesToScroll: 1,
    });
    $('.slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-small',
        rtl: true
    });
    $('.slider-small').slick({
        centerPadding: '0px',
        slidesToShow: 6,
        slidesToScroll: 1,
        asNavFor: '.slider-single',
        dots: true,
        centerMode: true,
        focusOnSelect: true,
        rtl: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 2
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('[data-toggle="tooltip"]').tooltip()
    jQuery('.sticky-vila').theiaStickySidebar({
        // Settings
        additionalMarginTop: 30
    });
    $(".link-rent").click(function (e) {
        $(".ul-rent").toggleClass('show');
        e.preventDefault();
        e.stopPropagation();
    });
    $(".link-see").click(function (e) {
        $(".box-see").toggleClass('show');
        e.preventDefault();
        e.stopPropagation();
    });
    $(".link-see2").click(function (e) {
        $(".box-see2").toggleClass('show');
        e.preventDefault();
        e.stopPropagation();
    });

    $(".filter").click(function (e) {
        $(" .modal-filter").toggleClass('active');
        e.preventDefault();
        e.stopPropagation();
    });
    $(".close").click(function (e) {
        $(" .modal-filter").toggleClass('active');
        e.preventDefault();
        e.stopPropagation();
    });

    $('html').click(function () {
        if ($(".ul-rent").hasClass("show")) {
            $(".ul-rent").removeClass('show');
        }
    });
    $(document).scroll(function () {
        var topScroll = $(this).scrollTop();
        if (topScroll >= 500) {
            $('.sticky-form').addClass('active');

        } else {
            $('.sticky-form').removeClass('active');
        }
    });



});