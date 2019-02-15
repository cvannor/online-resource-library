jQuery(document).ready(function(){
    $('a[href^="#drop"]').on('click',function(){
        $('.sub-menu').slideToggle();
    });
});
