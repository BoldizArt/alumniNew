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

    // Post and replace function
    function replace(response){
        $('#replaceProfiles').html(response.result);
    }

    // Post and replace function
    function get(KEY_WORDS){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/search',
            type: 'POST',
            data: {_token: CSRF_TOKEN, keywords: KEY_WORDS},
            dataType: 'JSON',
            success: function (response) {
                // console.info(response.result);
                replace(response);
            }
        });
    }

    // On form submit function
    $(document).on('submit','#searchForm',function(event){
        event.preventDefault();
        var KEY_WORDS = $('#keyWords').val();
        get(KEY_WORDS);
    });

    // On keydovn function
    $(document).on('input','#keyWords',function(event){
        var KEY_WORDS = $('#keyWords').val();
        if(KEY_WORDS.length > 2)
        {
            get(KEY_WORDS);
        }
        else if(KEY_WORDS.length < 1)
        {
            get(' ');
        }
    });

$(document).on('contextmenu', '.locked', function(e){
    e.preventDefault();
    $('#imageModal').fadeIn(480);
});

});

