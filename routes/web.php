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

Route::name('librarian.')->group(function () {
    Route::group([
        'namespace' => 'Foundation\Librarian',
        'prefix' => 'librarian',
        'middleware' => 'role:librarian',
    ],
        function () {
            Route::get('/', 'BaseController@panel')->name('panel');
            Route::post('/', 'BaseController@setWorkingLibrary')->name('set-lib');
            Route::delete('/', 'BaseController@unsetWorkingLibrary')->name('unset-lib');
            Route::get('service', 'ServiceMovementController@listOptions')->name('service.options');
            Route::get('service/{bookshelf}', 'ServiceMovementController@specifyService')->name('service.specify');
            Route::post('service', 'ServiceMovementController@confirmService')->name('service.confirm');
            Route::get('service/get-back/{readercard?}', 'ServiceMovementController@listGetBack')->name('service.get-back');
            //Route::resource('library-services', 'LibraryServiceController');
        });
});

Route::name('admin.')->group(function () {
    Route::group([
        'namespace' => 'Foundation\Admin',
        'prefix' => 'admin',
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


