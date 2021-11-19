var ckeditorPost = null;

$(document).ready(function() {
    $("#ModalCreatePost [name=submit_data]").on("click", submitPost);
    ckeditorPost = CKEDITOR.replace("post_content");
});

function submitPost() {
    var title = $("#ModalCreatePost [name=post_title]").val();
    console.log(`title`, title);
    const content = ckeditorPost.getData();
    console.log("content", data);
    var tags = dropdownTags.getValue(true);
    console.log(`tags`, tags);

    var data = {
        title: title,
        content: content,
        "tags-id": tags,
    };
    post(data);
}

function post(data) {
    $.ajax({
        url: route("create-post"),
        type: "POST",
        data: data,
        success: function(res) {
            console.log(res);
            redirectHomePage(route('home'));
        },
    });
}

function redirectHomePage(url) {
    console.log(url);
    window.location.href = url;
}