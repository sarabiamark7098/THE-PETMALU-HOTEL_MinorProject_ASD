$(window).scroll(function() {
    if ($(document).scrollTop() > 400){
        $('nav').addClass('shrink');
    }else{
        $('nav').removeClass('shrink');
    }
});