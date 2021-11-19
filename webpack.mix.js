const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

// mix.css("resources/css/app.css", "public/css");
// mix.sass("resources/scss/style.scss", "public/css");
// mix.sass("resources/scss/test.scss", "public/css");

mix.copy(
    "resources/css/admin/sb-admin-2.min.css",
    "public/css/admin/sb-admin-2.min.css"
);
mix.copy(
    "resources/js/admin/sb-admin-2.min.js",
    "public/js/admin/sb-admin-2.min.js"
);

// admin dashboard
mix.copy(
    "resources/js/admin/dashboard/dashboard.js",
    "public/js/admin/dashboard/"
).version();

//admin
mix.sass("resources/scss/admin/style-admin-custom.scss", "public/css/admin/");
mix.copy("resources/js/admin/admin-base.js", "public/js/admin/");

// login
mix.css(
    "resources/css/admin/style-login.css",
    "public/css/admin/style-login.css"
).version();
mix.scripts(
    [
        "resources/js/admin/login/login.js",
        "resources/js/admin/login/firebase-login.js",
    ],
    "public/js/admin/login/login.js"
).version();

// role
mix.sass("resources/scss/admin/role-list.scss", "public/css/admin/")
    .version()
    .sass("resources/scss/admin/view-role.scss", "public/css/admin/")
    .version();
mix.copy(
    "resources/js/admin/role/role-list.js",
    "public/js/admin/role/"
).version();
mix.copy(
    "resources/js/admin/role/role-view.js",
    "public/js/admin/role/"
).version();

//permission
mix.copy(
    "resources/js/admin/permission/permission.js",
    "public/js/admin/permission/"
).version();
mix.copy(
    "resources/js/admin/permission/datatable.js",
    "public/js/admin/permission/"
).version();

//tag
mix.copy("resources/js/admin/tag/tag.js", "public/js/admin/tag/").version();
mix.copy(
    "resources/js/admin/tag/datatable.js",
    "public/js/admin/tag/"
).version();

// manage user
mix.copy(
    "resources/js/admin/manage-user/user.js",
    "public/js/admin/"
).version();
mix.copy(
    "resources/js/admin/manage-user/datatable.js",
    "public/js/admin/"
).version();

// admin profile
mix.copy(
    "resources/js/admin/profile/overview.js",
    "public/js/admin/profile/"
).version();

mix.sass("resources/scss/components/font.scss", "public/css/components");
mix.sass("resources/scss/style_header.scss", "public/css");
mix.sass("resources/scss/style_home_page.scss", "public/css");
mix.sass("resources/scss/style_login.scss", "public/css");
mix.sass("resources/scss/style_post_page.scss", "public/css");
mix.sass("resources/scss/style_topic_page.scss", "public/css");
mix.sass("resources/scss/style_post_editor.scss", "public/css");
mix.sass("resources/scss/style_detail_post.scss", "public/css");
mix.sass("resources/scss/style_profile_page.scss", "public/css");
mix.copy("resources/js/user/tags.js", "public/js/user");
mix.copy("resources/js/user/post_all.js", "public/js/user");
mix.copy("resources/js/user/react-like.js", "public/js/user");
mix.copy("resources/js/user/post-editor.js", "public/js/user");
mix.copy("resources/js/user/detail-post.js", "public/js/user");
mix.copy("resources/js/user/comment.js", "public/js/user");
mix.copy("resources/js/user/topic_page.js", "public/js/user");
mix.copy("resources/js/user/hot_tags.js", "public/js/user");
mix.copy("resources/js/user/post_user.js", "public/js/user");
