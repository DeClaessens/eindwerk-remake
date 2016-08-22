$('document').ready(function(){
    if (window.location.hash && window.location.hash == '#_=_') {
        window.location.hash = '';
    }
    console.log('hello');

    $('.top-tracks-container ul li a').on('click', function(){
        console.log('a');
    });

    var tmp = '';
    $('.top-tracks-container ul li a i').on('click', function(e){
        e.preventDefault();
        if(tmp != ''){
            tmp[0].pause();
        }
        var trackid = $(this).data('trackid');
        tmp = $('#'+ trackid);
        tmp.trigger('play');
        e.stopPropagation();
    });

    $("#tinderslide").jTinder({
        onDislike: function (item) {
            console.log(item.data('userid'));
        },
        onLike: function (item) {
            console.log(item.data('userid'));
            var token = $('.csrf').val();
            /*$.ajax({
                type: 'POST',
                url: '/swiperight/' + item.data('userid') + '/' + item.data('concertid'),
                data: { CSRF: csrf},
                dataType: 'json'
            });*/
            $.post(
                '/swiperight/' + item.data('userid') + '/' + item.data('concertid'),
                {
                    "_token": token
                }
            );
        }
    });
    holmes({
        input: '.search-concerts input', // default: input[type=search]
        find: '.concert-list a' // querySelectorAll that matches each of the results individually
    });

    holmes({
        input: '.search-matches input', // default: input[type=search]
        find: '.matches-container a' // querySelectorAll that matches each of the results individually
    });
    var slideDuration = 200;
    $('.nav-profile-image').on('click', function() {
        if($('.sub-menu').css('display') == 'none') {
            $('.sub-menu').stop(true, true).fadeIn({ duration: slideDuration, queue: false }).css('display', 'none').slideDown(slideDuration);
        } else {
            $('.sub-menu').stop(true, true).fadeOut({ duration: slideDuration, queue: false }).css('display', 'none').slideUp(slideDuration);

        }
    });

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

    var landingel = $('.concert-landing-card');
    var landingW = landingel.width();

    landingel.children('.concert-landing-image').css('height', landingW);


    $(".message-box").scrollTop($(".message-box")[0].scrollHeight);

});
