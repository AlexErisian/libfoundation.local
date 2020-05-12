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

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Foundation'], function () {
    Route::resource('posts', 'PostController')
        ->only(['index', 'show']);
});

Route::name('admin.')->group(function () {
    Route::group([
        'namespace' => 'Foundation\Admin',
        'prefix' => 'admin',
        'middleware' => 'role:admin',
    ],
        function () {
            Route::get('/', 'BaseController@panel')->name('panel');
            Route::resource('libraries', 'LibraryController');
            Route::resource('printing-authors', 'PrintingAuthorController');
            Route::resource('printing-genres', 'PrintingGenreController');
            Route::resource('printing-pubhouses', 'PrintingPubhouseController');
            Route::resource('printing-types', 'PrintingTypeController');
            Route::resource('printings', 'PrintingController');
            Route::resource('printing-comments', 'PrintingCommentController');
            Route::resource('printing-registrations', 'PrintingRegistrationController')
                ->only(['index', 'edit', 'update']);
            Route::resource('printing-writing-offs', 'PrintingWritingOffController')
                ->only(['index', 'edit', 'update']);
            Route::resource('readercards', 'ReadercardController');
            Route::resource('roles', 'RoleController')
                ->only(['index']);
            Route::resource('users', 'UserController');
            Route::resource('posts', 'PostController');
            Route::resource('bookshelves', 'BookshelfController');
            Route::resource('printing-genre-links', 'PrintingGenreLinkController')
                ->only(['index']);
            Route::resource('library-services', 'LibraryServiceController')
                ->only(['index', 'edit', 'update']);
        });
});


