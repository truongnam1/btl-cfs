<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\Role\ManagePermissionController;
use App\Http\Controllers\Admin\ManageReportPostController;
use App\Http\Controllers\Admin\Role\ManageRoleController;
use App\Http\Controllers\Admin\ManageTagController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ProfileAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Firebase\ContactController;
use App\Http\Controllers\Firebase\AuthController;
use App\Http\Controllers\Firebase\VoteController;
use App\Http\Controllers\FirebaseLoginController;
use App\Http\Controllers\IdController;
use App\Http\Controllers\MongoController;
use App\Http\Controllers\RoleTestController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\AuthController as UserAuthController;
use App\Http\Controllers\User\HomePageController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("post_of_topic", function () {
    return view('layout.posts_of_topic');
});

Route::get('/home_page', function () {
    return view('layout.home_page');
})->name('home_page');

Route::get('/topic_page', function () {
    return view('layout.topic_page');
})->name('topic_page');

Route::get('/post_page', function () {
    return view('layout.post_page');
})->name('post_page');

Route::get('/header', function () {
    return view('layout.header');
});

Route::get('/login', function () {
    return view('layout.login');
})->name('login');

Route::get('create-post', function () {
    return 'view tạo bài viết';
});

Route::get('profile_page', function () {
    return view('layout.profile_page');
})->name('profile-user');



Route::get('/post_editor', function () {
    return view('layout.post_editor');
});
//ví dụ 
Route::get('home-page-test', function () {
    return view('layout.home-page-test', ['title' => 'Trang chủ']);
});

Route::get('indextest', function () {
    return view('indextest');
});

// user

//user
Route::prefix('user')->group(function () {
    Route::get('logout', [UserAuthController::class, 'signOut'])->name("user-logout");

    Route::prefix('auth')->group(function () {
        Route::post('register',[UserAuthController::class, 'register'])->name('api-register-user');
        Route::post('login',[UserAuthController::class, 'login'])->name('api-login-user');
    });

    // Route::prefix('post')->group(function () {
    //     Route::get('/', [PostController::class, 'index'])->name('getPosts');
    // });
});

// Route::get('posts_of_topic/{topicId}/{topicName}', [PostController::class, 'getPostOfTopic'])->name('post_topic'); 
Route::get('/', [HomePageController::class, 'homePage'])->name('home');
Route::get('/topic/{topicName}/{topicId}', [HomePageController::class, 'topicPage'])->name('postsTopic');
Route::get('post/{postId}', [PostController::class, 'getPost'])->name('item-post');
Route::prefix('user')->group(function () {
    Route::get('/me', [ProfileController::class, 'index'])->name('my-profile');
});



// bên dưới này để test
Route::get("auth", [AuthController::class, 'index']);
Route::get("auth/get/{id}", [AuthController::class, 'getUser']);
Route::get("auth/create-user", [AuthController::class, 'createUser']);
Route::get("auth/verify-user", [AuthController::class, 'verifyUser']);
Route::get("auth/verify-token-user/{token}", [AuthController::class, 'verifyToken']);
Route::get("auth/update-user/{idUser}", [AuthController::class, 'updateUser']);

Route::get("auth/create-user-google", [AuthController::class, 'loginGoogle']);
Route::get("auth/verify-idToken/{idToken}", [AuthController::class, 'verifyIdToken']);


Route::get("auth-client/login", [FirebaseLoginController::class, 'index']);
Route::get("auth-client/login-last", [FirebaseLoginController::class, 'loginLast']);
Route::get("auth-client/login-email", [FirebaseLoginController::class, 'loginEmail']);
Route::get("auth-client/login-facebook", [FirebaseLoginController::class, 'loginFacebook']);
Route::get("auth-client/login-google", [FirebaseLoginController::class, 'loginGoogle']);

Route::get("auth-client/login-phone1", [FirebaseLoginController::class, 'loginPhone1']);
Route::get("auth-client/login-phone2", [FirebaseLoginController::class, 'loginPhone2']);
Route::get("auth-client/login-phone3", [FirebaseLoginController::class, 'loginPhone3']);

// mongo
Route::get("mongo/create", [MongoController::class, 'create']);
Route::get("mongo/get", [MongoController::class, 'get']);
Route::get("mongo/get2", [MongoController::class, 'get2']);

// id

Route::get("id", [IdController::class, 'index']);

// role
Route::get("role/create-per", [RoleTestController::class, 'createPer']);
Route::get("role/create-role", [RoleTestController::class, 'createRole']);
Route::get("role/role-has-per", [RoleTestController::class, 'roleHasPer']);

Route::get("role/user-ass-role", [RoleTestController::class, 'userAssignRoles']);
Route::get("role/user-ass-per", [RoleTestController::class, 'userAssPer']);




Route::get("role/create-user", [RoleTestController::class, 'createUser']);
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});

Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name("admin-login");
    Route::post('login', [LoginController::class, 'signIn'])->name("admin-login-post");
    Route::get('logout', [LoginController::class, 'signOut'])->name("admin-logout");
    Route::get('forgot-password', [LoginController::class, 'forgotPassword'])->name("admin-forgot-password");


});


// admin
Route::prefix('admin')->middleware('auth')->group(function () {


    Route::get('/', [DashboardController::class, 'index'])->name("admin-dashboard");

    Route::prefix('profile')->group(function () {
        Route::get('overview', [ProfileAdminController::class, 'overview'])->name("admin-profile-overview");
        // Route::get('setting', [ProfileAdminController::class, 'setting'])->name("admin-profile-setting");
    });

    Route::prefix('manage-user')->group(function () {
        Route::get('/', [ManageUserController::class, 'index'])->middleware('permission:manage.user.view-manage')
        ->name("manage-user");
        Route::get('/profile-user/{idUser}', [ManageUserController::class, 'profileUser'])->middleware('permission:manage.user.view-profile')
        ->name("manage-profile-user");
    });

    // quản lý phân quyền
    Route::prefix('role')->group(function () {
        Route::get('role-list', [ManageRoleController::class, 'roleList'])->middleware('permission:manage.role.view-manage')
        ->name("role-roleList");
        Route::get('role-list/{nameRole}', [ManageRoleController::class, 'viewRole'])->middleware('permission:manage.role.view-manage')
        ->name("role-viewRole");

        Route::get('permissions', [ManagePermissionController::class, 'index'])->middleware('permission:manage.permission.view-manage')
        ->name("role-permission");
    });


    Route::get('report-post', [ManageReportPostController::class, 'index'])->middleware('permission:manage.posts-report.view-manage')
    ->name("admin-reportPost");

    Route::get('tags', [ManageTagController::class, 'index'])->middleware('permission:manage.tag.view-manage')
    ->name("admin-tag");
});

