<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('main');
})->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Foundation'], function () {
    Route::resource('posts', 'PostController')
        ->only(['index', 'show']);
});

Route::group(['namespace' => 'Foundation\Admin',
    'prefix' => 'admin',],
    function () {
        Route::get('/', 'BaseController@panel')
            ->name('admin.panel');
        Route::resource('libraries', 'LibraryController')
            ->names('admin.libraries');
        Route::resource('printing-authors', 'PrintingAuthorController')
            ->names('admin.printing-authors');
        Route::resource('printing-genres', 'PrintingGenreController')
            ->names('admin.printing-genres');
        Route::resource('printing-pubhouses', 'PrintingPubhouseController')
            ->names('admin.printing-pubhouses');
        Route::resource('printing-types', 'PrintingTypeController')
            ->names('admin.printing-types');
        Route::resource('printings', 'PrintingController')
            ->names('admin.printings');
        Route::resource('printing-comments', 'PrintingCommentController')
            ->names('admin.printing-comments');
        Route::resource('printing-registrations', 'PrintingRegistrationController')
            ->names('admin.printing-registrations');
        Route::resource('printing-writing-offs', 'PrintingWritingOffController')
            ->names('admin.printing-writing-offs');
        Route::resource('readercards', 'ReadercardController')
            ->names('admin.readercards');
        Route::resource('roles', 'RoleController')
            ->only(['index'])
            ->names('admin.roles');
        Route::resource('users', 'UserController')
            ->names('admin.users');
        Route::resource('posts', 'PostController')
            ->names('admin.posts');
        Route::resource('library-printing-links', 'LibraryPrintingLinkController')
            ->names('admin.library-printing-links');
        Route::resource('printing-genre-links', 'PrintingGenreLinkController')
            ->names('admin.printing-genre-links');
        Route::resource('library-services', 'LibraryServiceController')
            ->names('admin.library-services');
    });
