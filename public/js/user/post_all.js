var sizeOfCards = ["card_small", "card_medium", "card_large"];

function redirectPostItem(url) {
    window.location.href = url;
}

$(document).ready(function() {
    var limit = 21;
    var start = 0;
    var topicId = null;
    var action = "inactive";
    try {
        topicId = document.getElementsByClassName("topicName")[0].id;
    } catch (err) {}
    // console.log(topicId);
    function load_data(limit, start) {
        var request;
        if (topicId) {
            request = { limit: limit, offset: start, topicId: topicId };
        } else {
            request = { limit: limit, offset: start };
        }
        $.ajax({
            url: route("getPosts"),
            method: "GET",
            data: request,
            cache: false,
            success: function(data) {
                console.log(data);
                var html = "";
                for (const post of data) {
                    sizeCard =
                        sizeOfCards[
                            Math.floor(Math.random() * sizeOfCards.length)
                        ];
                    html += `<div class="card ${sizeCard}" onclick="redirectPostItem('${route(
                        "item-post",
                        { postId: post._id }
                    )}')">
                                <div class="card_title">
                                    ${post["title"]}
                                </div>
                                <div class="card_content">
                                    ${post["content"]}
                                </div>
                                <div class="card_status">
                                    <div class="card_status-item like"><i class="fas fa-heart"></i>${
                                        post["reacts"]["total"]
                                    }</div>
                                    <div class="card_status-item comment"><i class="fas fa-comment"></i>${
                                        post["comments"]["total"]
                                    }</div>
                                    <div class="card_status-item view"><i class="fas fa-eye"></i>${
                                        post["views"]["total"]
                                    }</div>
                                </div>
                            </div>`;
                }

                var container = document.getElementById("load_data_message");
                container.insertAdjacentHTML("beforebegin", html);

                if (data == "") {
                    $("#load_data_message").html(
                        "<button type='button' class='btn btn-info'>No Data Found</button>"
                    );
                    action = "active";
                } else {
                    $("#load_data_message").html(
                        "<button type='button' class='btn btn-warning'>Please Wait....</button>"
                    );
                    action = "inactive";
                }
            },
        });
    }

    if (action == "inactive") {
        action = "active";
        load_data(limit, start);
    }
    $(window).scroll(function() {
        if (
            $(window).scrollTop() + $(window).height() >
            $("#pin_container").height() &&
            action == "inactive"
        ) {
            action = "active";
            start = start + limit;
            setTimeout(function() {
                load_data(limit, start);
            }, 500);
        }
    });
});