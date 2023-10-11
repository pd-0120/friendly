var $sidebar_collapsed_checkbox = $("<input />", {
    type: "checkbox",
    value: 1,
    checked: $("body").hasClass("sidebar-collapse"),
    class: "mr-1",
}).on("click", function () {
    if ($(this).is(":checked")) {
        $("body").addClass("sidebar-collapse");
        $(window).trigger("resize");
    } else {
        $("body").removeClass("sidebar-collapse");
        $(window).trigger("resize");
    }
});

$(document).on(
    "collapsed.lte.pushmenu",
    '[data-widget="pushmenu"]',
    function () {
        $sidebar_collapsed_checkbox.prop("checked", true);
    }
);
$(document).on("shown.lte.pushmenu", '[data-widget="pushmenu"]', function () {
    $sidebar_collapsed_checkbox.prop("checked", false);
});
