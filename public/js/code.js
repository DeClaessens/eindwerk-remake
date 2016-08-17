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

    $("#tinderslide").jTinder();
});
