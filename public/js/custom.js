$(document).ready(function()
{
    // Set variables
    var windowHeight = $(window).height();
    var block = false;

    // Add tooltip to website.
    $('[data-toggle="tooltip"]').tooltip(); 

    // Resize content if smallert than needed
    contentHeight();

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
        contentHeight();
    }

    // Search function
    var replaced = false;
    var page = 1;
    function get(KEYWORDS, CATEGORY){
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/search?page='+page,
            type: 'POST',
            data: {_token: CSRF_TOKEN, keywords: KEYWORDS, category: CATEGORY},
            dataType: 'JSON',
            success: function (response) {
                // console.info(response.result);
                replaced = true;
                replace(response);
            }
        });
    }

    // On form submit function
    $(document).on('submit','#searchForm',function(event){
        event.preventDefault();
        var KEYWORDS = $('#keywords').val();
        var CATEGORY = $('#searchCategory').val();
        get(KEYWORDS, CATEGORY);
    });

    // On keydovn function
    $(document).on('input','#keywords',function(event){
        var KEYWORDS = $('#keywords').val();
        var CATEGORY = $('#searchCategory').val();  
        if(KEYWORDS.length > 2)
        {
            get(KEYWORDS, CATEGORY);
        }
        else if(KEYWORDS.length < 1)
        {
            get(' ', ' ');
        }
    });

    // On select chane
    $(document).on('change','#searchCategory',function(event){
        var KEYWORDS = $('#keywords').val();
        var CATEGORY = $('#searchCategory').val();      
        if(KEYWORDS.length > 2)
        {
            get(KEYWORDS, CATEGORY);
        }
    });

    // On pager click
    $(document).on('click', '.page-item:not(.active) .page-link', function(event){
        var KEYWORDS = $('#keywords').val();
        var CATEGORY = $('#searchCategory').val();
        var href = $(this).attr('href');
        if(RegExp('\\bsearch\\b').test(href)) {
            event.preventDefault();
            var hrefArray = href.split('=');
            page = hrefArray[1];
            get(KEYWORDS, CATEGORY);
        }

    })
    // SEARCH END


    // POPUP ALERT
    $(document).on('contextmenu', '.locked', function(e){
        e.preventDefault();
        $('#imageModal').fadeIn(480);
    });
    // POPUP ALERT END


    // IMAGE UPLOAD
    // Check after validation if an image is set. If isset url, change the profile image.
    var existsUrl = $('.profile-picture-name').val();

    if (typeof(existsUrl) != 'undefined' && existsUrl != '') {
        $('#ajaxImage').attr('src', '/images/'+existsUrl);
    }

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

    var modal = '#questionModal';

    // On no or close click, does not delete the profile, and close the modal
    $(modal+' .-no').click(function(){
        $(modal).hide();
        return false;
    });

    // Reaction on profile delete button click
    var submit = false;
    $(document).on('submit', '#profile-delete-form', function(e){
       
        if(!submit) {
            e.preventDefault();
            $(modal+' .question').text('Da li ste sigurni da želite da obrišete profil?');
            $(modal).show();

            // On yes click delete the profile and close the modal
            $(modal+' .-yes').click(function(){
                submit = true;
                $(modal).hide();
                $('#profile-delete-form').submit();
                return true;
            });
        }
    });

    // Reaction on right click on image
    $('img').contextmenu(function(){
        $(modal+' .-yes').hide();
        $(modal+' .question').text('Nemate dozvolu da skinete ovu sliku!');
        $(modal).show();
        return false;
    });

    // Setting up content height
    function contentHeight(){
        // Define content varibale.
        var mc = $('.main-content');

        // Get sizes
        var wh = $(window).height();
        var nh = $('nav').outerHeight();
        var fh = $('.footer').outerHeight();
        var ch = mc.outerHeight();

        // check if content height smller than needed.
        var m = 84;
        var h = wh - fh - nh - m;
        
        if(ch < h) {
            mc.css('min-height', h);
        }
    }

});