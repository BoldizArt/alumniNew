$(document).ready(function()
{
    // Set variables
    var windowHeight = $(window).height();
    var block = false;
    /*var mainHeight = (windowHeight-175-121);

    // Set the minimum content height
    $('.main-content').css('min-height', mainHeight);*/

    // ONSCROLL
    $(document).scroll( function()
    {
        var documentTop = $(document).scrollTop();
        
        // STATISTICS
        if(typeof($('.statistics-container').position()) != 'undefined')
        {
            // On scroll check the document position
            var statisticTop = $('.statistics-container').position().top;
            var statistics = (statisticTop-(windowHeight));
            
            // Counter function
            function counter(block)
            {
                $('.statistic-count').each(function()
                {
                    $(this).prop('Counter',0).animate(
                    {
                        Counter: $(this).text()
                    }, 
                    {
                        duration: 1250,
                        easing: 'swing',
                        step: function(now)
                        {
                            $(this).text(Math.ceil(now));
                        }
                    });
                });

                // If the block variable true, return false and vice versa
                return !block;
            }

            // If the statistics conteiner visible, run the counter function
            if(documentTop > statistics && block == false)
            {
                block = counter(block)
            }

            // If the statistics container does not visible, change the block value to false
            if(documentTop < statistics)
            {
                block = false
            }
        }
        // STATISTICS END


        // if the document position bigger than 200, change the nav bar size
        if(documentTop > 120)
        {
            $('.navbar-alumni').removeClass('nav-on').addClass('nav-off')
            $('.card-alert').css({'top': '70px'});
        }
        else
        {
            $('.navbar-alumni').removeClass('nav-off').addClass('nav-on')
            $('.card-alert').css('top', '110px');
        }
    });
    // ONSCROLL END


    // SEARCH
    // Replace the profiles container with response
    function replace(response){
        $('#replaceProfiles').html(response.result);
    }

    // Search function
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
    // SEARCH END


    // POPUP ALERT
    $(document).on('contextmenu', '.locked', function(e){
        e.preventDefault();
        $('#imageModal').fadeIn(480);
    });
    // POPUP ALERT END


    // IMAGE UPLOAD
    // On image click, user can upload a picture
    $(document).on('click', '#ajaxImageUpload', function(e){
        $('#ajaxImageInput').click();
        $('#ajaxImage').removeClass('-alert');
        $('#imageError').text('');
    });

    // On upload, get the file and sent to the PHP controller
    $(document).on('change', '#ajaxImageInput', function(e)
    {
        if(($('#ajaxImageInput').val().length) > 2)
        {
            // Set variables
            var $url = $('#ajaxImageForm').attr('action');
            var formData = new FormData($('#ajaxImageForm')[0]);
            
            // console.info(formData);
            $.ajax({
                type: "POST",
                url: $url,
                data: formData,
                cache: false,
                contentType: false,
                enctype: 'multipart/form-data',
                processData: false,
                success: function(response)
                {
                    // console.info(response);
                    if(typeof(response.error) !== 'undefined')
                    {
                        $('#ajaxImage').addClass('-alert');
                        $('#imageError').text(response.error.customMessages.mimes);
                    }
                    else if (typeof(response.url) !== 'undefined')
                    {
                        $('#ajaxImage').attr('src', '/images/'+response.url);
                        $('.profile-picture-name').val(response.url);
                    }
                }
            });
        }
    });

    // Close the alert card
    $(document).on('click', '.-close', function(e){
        $(this).parent('.-card').fadeOut(480);
    });

    // Animate scroll top
    $(document).on('click', '.up-to-top', function(){
        $("html, body").stop()
            .animate(
                {
                    scrollTop:0
                }, 540, 'swing'
            );
    });

});