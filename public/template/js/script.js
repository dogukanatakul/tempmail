$(window).on("load", function () {
    $(".loader").delay(1000).fadeOut("slow");
});

$(document).ready(function () {
    $("#currentYear").text((new Date()).getFullYear());
    attachTopScroller(".scrollUp");
});

function attachTopScroller(elementId) {
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $(elementId).fadeIn();
        } else {
            $(elementId).fadeOut();
        }
    });
    // Scroll To Top Animation
    $(elementId).click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 1000);
        return false;
    });
};

setInterval(refreshPage, 5000);

function refreshPage() {
    $.get(refreshURL, function (data) {
        if (data == "true") {
            window.location.reload()
        }
    });
}

function copyToClipboard(text) {
    var dummy = document.createElement("textarea");
    document.body.appendChild(dummy);
    dummy.value = text;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
}
