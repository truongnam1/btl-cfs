var dropdownTags = null;
var dataTags = null;

$(document).ready(function() {
    $.ajax({
        url: route("getTags"),
        type: "GET",
        success: function(res) {
            // console.log(res["data"]);
            var data = res["data"];
            createMultiSelect(data);

            // console.log(choices);
        },
    });
});



function createMultiSelect(data) {
    var choices = [];
    for (const tag of data) {
        // console.log(tag["tag_name"]);
        var tag_id = tag["id"];
        var tag_name = tag["tag_name"];
        choices.push({ value: tag_id, label: tag_name });
    }

    dropdownTags = new Choices("#choices-multiple-remove-button", {
        removeItemButton: true,
        // maxItemCount: 5,
        searchResultLimit: 5,
        // renderChoiceLimit: 5,
        choices: choices,
    });
}