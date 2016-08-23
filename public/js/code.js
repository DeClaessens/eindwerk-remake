$('document').ready(function(){
    if (window.location.hash && window.location.hash == '#_=_') {
        window.location.hash = '';
    }

    holmes({
        input: '.search-concerts input',
        find: '.concert-list a'
    });

    holmes({
        input: '.search-matches input',
        find: '.matches-container a'
    });
    var slideDuration = 200;
    $('.nav-profile-image').on('click', function() {
        if($('.sub-menu').css('display') == 'none') {
            $('.sub-menu').stop(true, true).fadeIn({ duration: slideDuration, queue: false }).css('display', 'none').slideDown(slideDuration);
        } else {
            $('.sub-menu').stop(true, true).fadeOut({ duration: slideDuration, queue: false }).css('display', 'none').slideUp(slideDuration);

        }
    });

    resizeImages();
    $(window).resize(function(){
        resizeImages()
    });

    $('.custom-upload-button').on('click', function(){
        $('.image-upload').trigger('click');
    });



    $('.image-upload').change(function(){
        readURL(this);
    });

    $(".message-box").scrollTop($(".message-box")[0].scrollHeight);
});

$

function resizeImages() {
        $('.concert-list a').each(function(){
            var el = $(this);
            var w = el.width();

            el.children('.concert-image-container').css('height', w);
        });

        $('.matches-container .match').each(function(){
            var el = $(this);
            var w = el.width();

            el.children('.match-image').css('height', w);
        });
        /*
        var landingel = $('.concert-landing-card');
        var landingW = landingel.width();

        landingel.children('.concert-landing-image').css('height', landingW);
        */
}

function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.uploaded-profile-image').css('background', "url('" + e.target.result + "') center center no-repeat")
                .css('background-size', 'cover')
                .css('display', 'block');
        };

        reader.readAsDataURL(input.files[0]);
    }
}