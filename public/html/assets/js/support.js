$(document).ready(function() {
    $(".support-new-conversation").on("click", function() {
        const url = $(this).attr("data-template");

        if(url) {
            $.ajax({
                url,
                method: "GET",
                success: function(html) {
                  $(".support__body").html(html);
                }
            });
        }
    });

    if($(".support").length) {
        console.log("kajshdaskhd");
        $.ajax({
            url: "users/get-chat-messages/19",
            method: "GET",
            success: function(data) {
              console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
});