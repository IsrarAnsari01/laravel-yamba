jQuery(document).ready(($) => {
    // For Subscribe
    $("#subs").click(function () {
        let url = $(this).attr("url");
        jQuery.ajax({
            url: url,
            method: "GET",
            caches: false,
            encode: true,
            success: function (response) {
                alert("Subscribe Successfully");
            },
        });
    });

    // For Unsubscribe
    $("#unsubs").click(function () {
        let url = $(this).attr("url");
        jQuery.ajax({
            url: url,
            method: "GET",
            caches: false,
            encode: true,
            success: function (response) {
                alert("Un-Subscribe Successfully");
            },
        });
    });
});
