function redirectPostItem(url) {
    window.location.href = url;
}

$(document).ready(function () {
    $.ajax({
        url: route("getTags"),
        type: "GET",
        success: function (res) {
            // console.log(res["data"]);
            var data = res["data"];
            var html = "";
            console.log(data);
            for (const tag of data) {
                html += `<div class="card" onclick="redirectPostItem('${route(
                    "postsTopic",
                    { topicId: tag["id"], topicName: tag["tag_name"] }
                )}')">${tag["tag_name"]}</div>`;
            }

            var container = document.getElementById("alltopic");
            container.insertAdjacentHTML("beforeend", html);
        },
    });
});
