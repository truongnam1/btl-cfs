var postIdDelete = null;

$(document).ready(function () {
    getUserPost();
});

function getUserPost() {
    var user_id = document.getElementsByClassName("name")[0].id;
    $.ajax({
        url: route("getUserPost", { user_id: user_id }),
        type: "GET",
        success: function (data) {
            console.log(data);
            var html = "";
            for (const post of data) {
                html += `<div class="card" id="${post._id}" >
                            <!--<button type="button" class="btn-close" onclick="deletePost('${
                                post._id
                            }')"></button> -->
                            <div class="dropdown no-arrow mb-4 dropdown-post-item">
                                       
                                <i class="fas fa-ellipsis-v fa-sm fa-fw mr-1" style="cursor: pointer;" data-bs-toggle="dropdown" aria-haspopup="true"></i>
                                <div class="dropdown-menu action-menu" aria-labelledby="dropdownMenuButton">

                                    <span class="dropdown-item action-item" data-bs-toggle="modal" data-bs-target="#modalDeletePost" onclick="getPostIdDelete('${
                                        post._id
                                    }')">Xoá bài viết</span>
                                </div>
                            </div>
                            <div onclick="redirectPostItem('${route(
                                "item-post",
                                { postId: post._id }
                            )}')">
                            <h1 class="post_title">${post.title}</h1>
                            <div class="post_status">
                               <i class="far fa-clock"></i>&nbsp
                               <div class="time">${post.created_at}</div>
                               <i class="fas fa-heart"></i>&nbsp
                               <div class="like">${post.reacts.total}</div>
                               &nbspLượt thích
                               <i class="fas fa-comment"></i>&nbsp
                               <div class="comment">${post.comments.total}</div>
                               &nbspLượt bình luận
                               <i class="fas fa-eye"></i>&nbsp
                               <div class="view">${post.views.total}</div>
                               &nbspLượt bình luận
                            </div>
                            <div class="post_content">${post.content}</div>
                            </div>
                         </div>`;
            }

            var container = document.getElementById("post-container");
            container.insertAdjacentHTML("beforeend", html);
        },
    });
}

function deletePost(postId = null) {
    if (postId == null) {
        postId = postIdDelete;
    }
    $.ajax({
        url: route("deleteUserPost"),
        type: "post",
        data: { postId: postId },
        success: function (data) {
            console.log(data);
            document.getElementById(postId).remove();
        },
    });
}

function getPostIdDelete(postId) {
    postIdDelete = postId;
    console.log(postIdDelete);
}

function redirectPostItem(url) {
    window.location.href = url;
}

function redirectPostItem(url) {
    window.location.href = url;
}
