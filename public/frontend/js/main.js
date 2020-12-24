$(window).scroll(function () {
    var scroll = $(window).scrollTop();
    // var offset = $("header").

    if (scroll >= 100) {
        $(".logo").removeClass("logo-large");
        $(".logo").addClass("logo-small");
    } else {
        $(".logo").addClass("logo-large");
        $(".logo").removeClass("logo-small");
    }

    if (scroll >= 0) {
        $("#affix").addClass("affix");
    } else {
        $("#affix").removeClass("affix");
    }
});

var headerHeight = $("header").height();

$('a[href*="#"]')
    // Remove links that don't actually link to anything
    .not('[href="#"]')
    .not('[href="#0"]')
    .on("click", function (event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Store hash
            var hash = this.hash;
            $("html, body").animate(
                {
                    scrollTop: $(hash).offset().top - headerHeight,
                },
                300,
                function () {
                    // Add hash (#) to URL when done scrolling (default click behavior), without jumping to hash
                    if (history.pushState) {
                        history.pushState(null, null, hash);
                    } else {
                        window.location.hash = hash;
                    }
                }
            );
            return false;
        } // End if
    });

$(".togglerHide").change(function () {
    var dataToHide = $(this).attr("data-toHide");
    var dataToShow = $(this).attr("data-toShow");
    var onCheckedId = $(this).attr("data-id");

    if ($(`${onCheckedId}`).is(":checked")) {
        $(`.${dataToHide}`).addClass("d-none");
        $(`.${dataToShow}`).removeClass("d-none");
        $(`.${dataToShow}`).find("input").prop("required", true);
        $(`.${dataToHide}`).find("input").prop("required", false);
    }
});

$("#imageGallery").lightSlider({
    gallery: true,
    item: 1,
    loop: true,
    thumbItem: 4,
    slideMargin: 0,
    enableDrag: true,
    currentPagerPosition: "left",
});
$("#datePicker").flatpickr({
    enableTime: true,
    minDate: "today",
    maxDate: new Date().fp_incr(14),
    dateFormat: "Y-m-d H:i",
});

$(".options-input").change(function () {
    $("#price").text($(this).children("option:selected").attr("data-price"));
});

var counter = 0;

$(".inc-counter").click(function () {
    counter++;
    $(".no-of-item").text(counter);
});
$(".dec-counter").click(function () {
    if (counter > 1) {
        counter--;
        $(".no-of-item").text(counter);
    }
});
