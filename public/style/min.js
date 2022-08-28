$(document).ready(function() {
    $(".menu-toggler").on("click", function() {
        // $(this).toggleClass("open");
        $('body').toggleClass("menu_open");
        $("nav").slideToggle();
    });
});