
window.onload = function() {

    $(".schedule ul li h3").on("click", function(){
        $(this).next().slideToggle();
         $(this).toggleClass("open");
    });

}

