<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/sign-in/github', [HomeController::class, 'github'])->name('github');
Route::get('/sign-in/github/redirect', [HomeController::class,'githubRedirect']);

//Routes of posts
Route::get('/view-posts', [PostController::class, 'index'])->name('view_posts');
Route::get('/create-post', [PostController::class, 'create'])->name('create_post')->middleware('role:writer|admin');
Route::post('/save-post', [PostController::class, 'store'])->name('store_post');
Route::get('/edit-post', [PostController::class, 'edit'])->name('edit_post')->middleware('permission:edit post');
Route::post('/update-post', [PostController::class, 'update'])->name('update_post');
Route::get('/delete-post/{slug}', [PostController::class, 'destroy'])->name('delete_post');

//Route for roles and permission
Route::get('/view-roles', [RolePermissionController::class, 'viewRoles'])->name('view_roles')->middleware('role:admin');
Route::get('/edit-role', [RolePermissionController::class, 'editRole'])->name('edit_role')->middleware('role:admin');
Route::post('/update-role', [RolePermissionController::class, 'updateRole'])->name('update_role')->middleware('role:admin');
Route::post('/role-permission-add',[RolePermissionController::class, 'givePermission'])->name('role_permissions_add')->middleware('role:admin');
Route::get('/role-permission-delete/{role}/{permission}',[RolePermissionController::class, 'removePermission'])->name('role_permissions_delete')->middleware('role:admin');
Route::get('/view-permissions', [RolePermissionController::class, 'viewPermissions'])->name('view_permissions')->middleware('role:admin');

//Route for users
Route::get('/view-users', [UserController::class,'viewUsers'])->name('view_users')->middleware('role:admin');
Route::get('/show-user/{user}', [UserController::class, 'show'])->name('show_user');
Route::post('/users-add-role/{user}/roles', [UserController::class, 'assignRole'])->name('users_add_role');
Route::get('/users-remove-role/{user}/{role}', [UserController::class, 'removeRole'])->name('users_remove_role');