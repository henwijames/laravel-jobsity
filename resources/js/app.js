import "./bootstrap";
import "../css/app.css"; // Ensure CSS is still imported

import $ from "jquery";
window.$ = window.jQuery = $;

$(document).ready(function () {
    $("#mobile-menu-toggle").on("click", function () {
        console.log("clicked");
        var $this = $(this);
        var isExpanded = $this.attr("aria-expanded") === "false";
        console.log(isExpanded);

        if (isExpanded) {
            $("#mobile-menu").slideUp(300, function () {
                $(this).addClass("hidden");
            });
            $(".menu-icon-open").show();
            $(".menu-icon-close").hide();
            $this.attr("aria-expanded", "true");
        } else {
            $("#mobile-menu").removeClass("hidden").slideDown(300);
            $(".menu-icon-open").hide();
            $(".menu-icon-close").show();
            $this.attr("aria-expanded", "false");
        }
    });

    // // Handle resize
    // $(window).on("resize", function () {
    //     if ($(window).width() >= 768) {
    //         // md breakpoint
    //         $("#mobile-menu").addClass("hidden");
    //         $("#mobile-menu-toggle").attr("aria-expanded", "false");
    //         $(".menu-icon-open").show();
    //         $(".menu-icon-close").hide();
    //     }
    // });
});
