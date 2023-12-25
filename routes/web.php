<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('news', \App\Http\Controllers\NewsController::class);
    Route::resource('games', \App\Http\Controllers\GamesController::class);
    Route::put('users/change-password',[App\Http\Controllers\UsersController::class, 'changePassword'])->name('users.change-password');
    Route::put('users/update-settings',[App\Http\Controllers\UsersController::class, 'updateSettings'])->name('users.change-settings');
    Route::get('users/settings',[App\Http\Controllers\UsersController::class, 'settings'])->name('users.settings');
    Route::get('users/favorites',[App\Http\Controllers\UsersController::class, 'favorites'])->name('users.favorites');
    Route::post('users/update-favorites',[App\Http\Controllers\UsersController::class, 'updateFavorites'])->name('users.favorites-update');
    Route::post('users/update-file-favorites',[App\Http\Controllers\UsersController::class, 'updateFavoriteFiles'])->name('users.favorite-files-update');
    Route::post('users/update-notification-seen',[App\Http\Controllers\UsersController::class, 'updateNotificationSeen']);
    Route::get('promos/ongoing', [\App\Http\Controllers\PromosController::class, 'ongoing'])->name('promos.ongoing');
    Route::get('promos/upcoming', [\App\Http\Controllers\PromosController::class, 'upcoming'])->name('promos.upcoming');
    Route::get('promos/ended', [\App\Http\Controllers\PromosController::class, 'ended'])->name('promos.ended');
    Route::resource('promos', \App\Http\Controllers\PromosController::class);
    Route::get('roadmap', [\App\Http\Controllers\GamesController::class, 'roadmap'])->name('games.roadmap');
    Route::get('roadmap/export-csv', [\App\Http\Controllers\GamesController::class, 'exportCSV'])->name('games.export-csv');
    Route::get('users/notifications', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('users.notifications');
    Route::get('users/supports', [\App\Http\Controllers\UsersController::class, 'supports'])->name('users.supports');
    Route::get('users/new-conversation', [\App\Http\Controllers\UsersController::class, 'usersNewConversation'])->name('users.new-conversation');
    Route::post('users/add-conversation', [\App\Http\Controllers\UsersController::class, 'usersAddConversation'])->name('users.add-conversation');
    Route::get('users/get-chat-messages/{id}', [\App\Http\Controllers\UsersController::class, 'getChatMessages'])->name('users.get-chat-messages');
    Route::post('users/add-chat-message', [\App\Http\Controllers\UsersController::class, 'addChatNewMessage'])->name('users.add-chat-message');
    Route::get('users/get-chat-new-messages', [\App\Http\Controllers\UsersController::class, 'getChatNewMessages'])->name('users.get-chat-new-messages');
    Route::get('medias/download-folder', [\App\Http\Controllers\MediaController::class, 'downloadFolder'])->name('medias.download-folder');
    Route::get('medias/download-file', [\App\Http\Controllers\MediaController::class, 'downloadFile'])->name('medias.download-file');
    Route::get('medias/get-path-data', [\App\Http\Controllers\MediaController::class, 'getPathData'])->name('medias.get-path-data');
    Route::post('medias/get-file-url', [\App\Http\Controllers\MediaController::class, 'getFileUrl'])->name('medias.get-file-url');
    Route::post('medias/get-files-url', [\App\Http\Controllers\MediaController::class, 'getFilesUrls'])->name('medias.get-files-url');
    Route::get('medias', [\App\Http\Controllers\MediaController::class, 'index'])->name('medias.index');
    Route::get('compliance', [\App\Http\Controllers\ComplianceController::class, 'index'])->name('compliance.index');


//    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
});
