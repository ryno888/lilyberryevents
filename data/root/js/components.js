$(document).ready(function($){
    //================================================================================
    $('body').on('click', '.collapseText', function(){
        var element = $(this);
        if(element.hasClass('fa-arrow-up')){
            $('#demo').addClass('hidden');
            $(this).removeClass('fa-arrow-up');
            $(this).addClass('fa-arrow-down');
            $(".packageLabel").text("View Packages");
        }else{
            $('#demo').removeClass('hidden');
            $(this).removeClass('fa-arrow-down');
            $(this).addClass('fa-arrow-up');
            $(".packageLabel").text("Hide Packages");
        }
    });
    
    //================================================================================
    $("body").on("click", ".previewImage", function(){
        var imgdata = $(this).attr('src');
        $('.jqmOverlay, .jqmPreviewImage').fadeIn({duration : 400, queue : false});
        $('.previewImageData').attr("src", imgdata);
    });
    //================================================================================
    //================================================================================
    $('.jqmClose').click(function(){
        $('.jqmCloseTarget').fadeOut({duration : 400, queue : false});
    });
    //================================================================================
});