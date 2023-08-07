// * SB Admin 2 v4.1.3

!function ($) {
    "use strict";
    $("#sidebarToggle, #sidebarToggleTop").on("click", function () {
        $("body").toggleClass("sidebar-toggled"),
            $(".sidebar").toggleClass("toggled"),
            $(".sidebar").hasClass("toggled") && $(".sidebar .collapse").collapse("hide")
    });
    $(window).resize(function () {
        $(window).width() < 768 && $(".sidebar .collapse").collapse("hide"),
            $(window).width() < 480 && !$(".sidebar").hasClass("toggled") && ($("body").addClass("sidebar-toggled"),
                $(".sidebar").addClass("toggled"),
                $(".sidebar .collapse").collapse("hide"))
    });
    $("body.fixed-nav .sidebar").on("mousewheel DOMMouseScroll wheel", function (e) {
        var o; 768 < $(window).width() && (o = (o = e.originalEvent).wheelDelta || -o.detail, this.scrollTop += 30 * (o < 0 ? 1 : -1), e.preventDefault())
    });
    if ($(window).width() < 768) {
        $("#sidebarToggle").trigger('click');
    }
}(jQuery);