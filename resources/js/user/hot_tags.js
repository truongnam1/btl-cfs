function redirectPostItem(url) {
    window.location.href = url;
}

$(document).ready(function () {
    $.ajax({
        url: route("topTags"),
        type: "GET",
        success: function (res) {
            // console.log(res["data"]);
            if (res.status) {
                var data = res["data"];
                var html = "";
                console.log(data);
                for (const tag of data) {
                    html += `<a href="${route("postsTopic", {
                        topicId: tag["id"],
                        topicName: tag["tag_name"],
                    })}">${tag["tag_name"]}</a>`;
                }

                var container = document.getElementById("all_topic");
                container.insertAdjacentHTML("beforebegin", html);
            }
        },
    });
});
