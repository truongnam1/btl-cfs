<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageTagController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\Role\ManagePermissionController;
use App\Http\Controllers\Admin\Role\ManageRoleController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ReactsController;
use App\Http\Controllers\User\TagController;
use App\Http\Controllers\User\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::prefix('user')->group(function () {
    Route::prefix('post')->group(function () {
        Route::get('/', [PostController::class, 'homeIndex']);
        Route::post('/', [PostController::class, 'store'])->middleware('authApi')->name('create-post');
        Route::get('/', [PostController::class, 'index'])->name('getPosts');

        Route::get('get-post-modal/{postId}', [PostController::class, 'getPostModal'])->name('getPostModal');
        Route::get('get-user-post/{user_id}', [PostController::class, 'getUserPost'])->name('getUserPost');
        Route::post('delete-user-post', [PostController::class, 'deleteUserPost'])->name('deleteUserPost');
    });

    Route::prefix('react')->group(function () {
        Route::get('user-add-post-react/{postId}', [ReactsController::class, 'UserAddPostReact'])->middleware('authApi')
        ->name('UserAddPostReact');

        Route::get('user-remove-post-react/{postId}', [ReactsController::class, 'UserRemovePostReact'])->middleware('authApi')
        ->name('UserRemovePostReact');

        Route::get('check-post-react/{postId}', [ReactsController::class, 'checkPostReact'])->middleware('authApi')
        ->name('CheckPostReact');
    });

    Route::prefix('tag')->group(function () {

        Route::get('/', [TagController::class, 'getTags'])->name('getTags');
        Route::get('/top-tags', [TagController::class, 'getTopTags'])->name('topTags');

        Route::post('/', [TagController::class, 'store'])->middleware('authApi');

        Route::post('/', [TagController::class, 'store'])->middleware('authApi');
    });

    Route::prefix('comment')->group(function () {
        Route::post('store-comment/{postId}', [CommentController::class, 'store'])->middleware('authApi')->name('StoreComment');

        Route::get('get-comments/{postId}', [CommentController::class, 'get'])->name('GetComments');
    });
});




Route::prefix('admin')->group(function () {
    //test
    Route::get('test-token', [LoginController::class, 'testToken']);
    // login
    Route::post('login', [LoginController::class, 'signIn'])->name('api-login');
    Route::get('login/verify/{idToken}', [LoginController::class, 'verifyIdToken']);
});

// danh cho admin
Route::prefix('admin')->middleware('authApi')->group(function () {



    // Route::prefix('auth')->group(function () {
    //     Route::get('sign-out', [LoginController::class, 'verifyIdToken']);
    // });


    Route::prefix('manage-user')->group(function () {
        Route::post('register', [ManageUserController::class, 'registerUser'])->middleware('permission:manage.user.*')->name('api-register-user');
        Route::get('get-users-table', [ManageUserController::class, 'getUsersTable'])->middleware('permission:manage.user.view-manage')->name('api-get-users-table');

        Route::get('active-user/{idUser}', [ManageUserController::class, 'activeUser'])->middleware('permission:manage.user.active-user')->name('api-active-user');
        Route::get('disable-user/{idUser}', [ManageUserController::class, 'disableUser'])->middleware('permission:manage.user.disable-user')->name('api-disable-user');
        Route::get('delete-user/{idUser}', [ManageUserController::class, 'deleteUser'])->middleware('permission:manage.user.*')->name('api-delete-user');
        Route::post('update-profile-user/{idUser}', [ManageUserController::class, 'updateProfileUser'])->middleware('permission:manage.user.*')->name('api-update-profile-user');
        Route::get('reset-password/{idUser}', [ManageUserController::class, 'sendEmailResetPassword'])->middleware('permission:manage.user.change-password')->name('api-admin-reset-password');



        Route::get('get-user-table/{idUser}', [ManageUserController::class, 'getUserTable'])->middleware('permission:manage.user.view-manage')->name('api-get-user-table');



        Route::get('create-multi-user/{number}', [ManageUserController::class, 'createMultiUser'])->middleware('permission:manage.user.*');
        Route::get('get-all-user-firebase', [ManageUserController::class, 'getAllUserFirebase'])->middleware('permission:manage.user.*');
        Route::get('delete-all-user-firebase', [ManageUserController::class, 'deleteAllUserFirebase'])->middleware('permission:manage.user.*');
    });

    Route::prefix('role')->group(function () {
        Route::get('/', [ManageRoleController::class, 'getRoles'])->middleware('permission:manage.role.view-manage')
            ->name('api-get-roles');
        Route::get('/roles-card', [ManageRoleController::class, 'getRolesCard'])->middleware('permission:manage.role.view-manage');
        Route::post('/{nameRole}', [ManageRoleController::class, 'updatePermissionassignRole'])->middleware('permission:manage.role.edit');
        Route::get('/{nameRole}', [ManageRoleController::class, 'getRole'])->middleware('permission:manage.role.view-manage')
            ->name('api-get-role');

        Route::get('per-to-role', [ManageRoleController::class, 'perToRole'])->middleware('permission:manage.role.view-manage');
        Route::get('test/get-role-view/{nameRole}', [ManageRoleController::class, 'getRoleView'])->middleware('permission:manage.role.view-manage');
    });

    Route::prefix('permission')->group(function () {
        Route::get('get-permissions-table', [ManagePermissionController::class, 'getPermissionsTable'])->middleware('permission:manage.permission.view-manage')
            ->name('api-get-permissions-table');

        Route::get('get-permission-table/{permissionId}', [ManagePermissionController::class, 'getPermissionTable'])->middleware('permission:manage.permission.view-manage')
            ->name('api-get-permission-table');

        Route::get('/{idPermission}', [ManagePermissionController::class, 'updateDescPermission'])->middleware('permission:manage.permission.edit')
        ->name('api-update-permission');
    });

    Route::prefix('tag')->middleware('permission:manage.tag.view-manage')->group(function () {
        Route::get('get-tags', [ManageTagController::class, 'getTags']);

        Route::get('get-tag-table', [ManageTagController::class, 'getTagTable'])
        ->name('api-get-tag-table');

        Route::post('/', [ManageTagController::class, 'store'])->middleware('permission:manage.tag.*')
        ->name('api-admin-store-tag');
        Route::post('/{idTag}', [ManageTagController::class, 'update'])->middleware('permission:manage.tag.edit')
        ->name('api-admin-update-tag');

        Route::delete('/{tagId}', [ManageTagController::class, 'deleteTag'])->middleware('permission:manage.tag.delete')
        ->name('api-admin-delete-tag');
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('report-general', [DashboardController::class, 'reportGeneral'])->name('api-report-general');
        Route::get('report-quantity-user', [DashboardController::class, 'dataQuantityUser'])->name('api-report-quantity-user');
    });

    Route::prefix('profile')->group(function () {
        Route::get('get-role', [ProfileAdminController::class, 'getRoleUser'])->name('api-profile-role');
    });
});
