// var postId = document.getElementsByClassName("title")[0].id;
$(document).ready(function () {
    getPostModal();
});

function getPostModal() {
    $.ajax({
        url: route("getPostModal", { postId: postId }),
        type: "GET",
        success: function (res) {
            // console.log(res);
            var data = res["data"]["0"];
            // console.log(data);
            var time = data["created_at"];
            var like = data["reacts"]["total"];
            var view = data["views"]["total"];
            var comment = data["comments"]["total"];
            var idTags = data["tags"];

            document
                .getElementById("timePost")
                .insertAdjacentHTML("beforeend", time);
            document
                .getElementById("likeCount")
                .insertAdjacentHTML(
                    "beforeend",
                    `<div class="like-count">${like}</div>`
                );
            document
                .getElementById("viewCount")
                .insertAdjacentHTML(
                    "beforeend",
                    `<div class="view-count">${view}</div>`
                );
            document
                .getElementById("commentCount")
                .insertAdjacentHTML(
                    "beforeend",
                    `<div class="view-count">${comment}</div>`
                );

            getTagsNameModal(idTags);
        },
    });
}

function getTagsNameModal(idTags) {
    $.ajax({
        url: route("getTags"),
        type: "GET",
        data: { tags: idTags },
        success: function (res) {
            var html = "";
            tags = res["data"];
            for (const tag of tags) {
                html += `<div class="tag">${tag["tag_name"]}</div>`;
            }

            var container = document.getElementById("tags");
            container.insertAdjacentHTML("beforeend", html);
        },
    });
}
