var postId = $("#title-post").attr("id-post");
// var postId = null;

$(document).ready(function () {
    getComments();

    firebase.auth().onAuthStateChanged(function (user) {
        // document.getElementById('quickstart-verify-email').disabled = true;
        if (user) {
            // User is signed in.
            document
                .getElementById("submitComment")
                .addEventListener("click", submitComment);
        } else {
            // User is signed out.
        }
    });
});

function submitComment() {
    const content = document.getElementById("contentComment").value;
    // console.log("content: ", content);

    $.ajax({
        url: route("StoreComment", { postId: postId }),
        type: "POST",
        data: {
            content: content,
        },
        success: function (res) {
            // console.log(data);
            // toastr.success('Đã gửi bình luận thành công');
            console.log(res);
            document.getElementById("contentComment").value = "";
            getComments();
        },
    });
}

function getComments() {
    $.ajax({
        url: route("GetComments", { postId: postId }),
        method: "GET",
        success: function (data) {
            console.log("comment:", data);
            if (data[0]["comments"]["total"] > 0) {
                data = data[0]["comments"]["data"];
                // console.log(data);
                var html = "";
                for (const comment of data) {
                    html += `<div class="comment">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <div class="comment_container">
                        <div></div>
                        <div class="comment_container-name-user">
                            Cáo ẩn danh
                        </div>
                        <div class="comment_container-content">
                            ${comment["content"]}
                        </div>
                    </div>
                </div>`;
                }

                var container = document.getElementById("commentBox");
                container.innerHTML = html;
            }
        },
    });
}
