jQuery(document).ready(function($) {
    $(".link").click(function() {
        window.location = $(this).data("href");
    });
});
