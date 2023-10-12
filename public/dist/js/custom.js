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

toastr.options = {
    closeButton: false,
    debug: false,
    newestOnTop: true,
    progressBar: true,
    positionClass: "toast-top-right",
    preventDuplicates: false,
    onclick: null,
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};
