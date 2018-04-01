$(document).ready(function(){
    $(window).scroll( function(){

        if($(window).scrollTop() > 120)
        {
            $('.navbar-alumni').css('padding', '5px 16px');
            $('.card-alert').css({'top': '70px', 'background': 'rgba(255,255,255,0.75)!important'});
        }
        else
        {
            $('.navbar-alumni').css('padding', '24px 16px');
            $('.card-alert').css('top', '110px');
        }

    });
});