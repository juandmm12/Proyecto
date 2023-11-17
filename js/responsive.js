$(document).ready(function() {

    $('.fa-bars').click(function() {

        $(this).toggleClass('fa-times');
        $('.navbar').toggleClass('nav-toggle');

    });

    $(window).on('scroll load', function() {

        $('.fa-bars').removeClass('fa-times');
        $('.navbar').removeClass('nav-toggle');

        $('section').each(function() {

            var id = $(this).attr('id');
            var height = $(this).height();
            var offset = $(this).offset().top -200;
            var top = $(window).scrollTop();

            if(top >= offset && top < offset + height) {
                $('.navbar  a').removeClass('active');
                $('.navbar').find('[href="#'+id+'"]').addClass('active');
            }

        });

    });

});