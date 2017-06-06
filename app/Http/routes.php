<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('frontend.welcome');
});
// staff routes
Route::get('/staff/confrim/{id}', [
    'uses' => 'StaffController@confirm',
    'as' => 'staff.confirm',
]);


Route::get('/staff/info', [
    'uses' => 'StaffController@viewStaff',
    'as' => 'staff.view.frontend',
]);

Route::get('/staff/register', [
    'uses' => 'StaffController@register',
    'as' => 'staff.register',
]);
Route::post('/staff/register', [
    'uses' => 'StaffController@postregister',
    'as' => 'staff.register.post',
]);

Route::post('/staff/confrim/update/{id}', [
    'uses' => 'StaffController@confirmpost',
    'as' => 'staff.confirm.update',
]);

Route::get('/user/adminregister', [
    'uses' => 'UsersController@adminregistration',
    'as'   => 'admin.register.frontend'
]);
Route::post('/user/adminregister', [
    'uses' => 'UsersController@adminregistrationPost',
    'as'   => 'admin.register.post'
]);
//  start contact
 Route::post('/contact/store', [
     'uses' => 'ContactController@store',
     'as'   => 'contact.store',
 ]);
 //  end contact
// staff routes

Route::auth();

Route::group(['middleware' => 'auth'], function () {
   // get the books by the levels
   Route::get('/books', [
      'uses' => 'BooksController@getBooksByLevel',
      'as'   => 'books.level',
   ]);
   // get single book
   Route::get('/books/single/{id}', [
      'uses' => 'BooksController@getSingleBook',
      'as'   => 'book.single',
   ]);
   // view pdf
   Route::get('/books/view/pdf/{id}', [
       'uses' => 'BooksController@viewPDF',
       'as'   => 'user.view.pdf',
   ]);
   // download pdf
   Route::get('/books/download/pdf/{id}', [
       'uses' => 'BooksController@downloadPDF',
       'as'   => 'user.download.pdf',
   ]);
   // like pdf
   Route::post('/book/like', [
       'uses' => 'BooksController@likeBook',
       'as'   => 'like',
   ]);

   // download
   Route::post('/book/adddownload', [
       'uses' => 'BooksController@DBook',
       'as'   => 'user.download.profile',
   ]);

   // filter category
   Route::get('/books/category/{cat_id}', [
       'uses' => 'BooksController@filterCategoury',
       'as'   => 'books.category.filter',
   ]);
   // filter Specialization
    Route::get('/books/Specialization/{Specialization_id}', [
      'uses' => 'BooksController@filterSpecialization',
      'as'   => 'books.Specialization.filter',
   ]);
   // search
    Route::get('/books/search', [
      'uses' => 'BooksController@search',
      'as'   => 'books.search',
   ]);

    // profile start
    Route::get('/profile', [
        'uses' => 'UsersController@profile',
        'as'   => 'user.profile'
    ]);
    // profile end
    // profile start
    Route::post('/profile/update/{id}', [
        'uses' => 'UsersController@proUpdate',
        'as'   => 'user.pro.update'
    ]);
    // profile end

});

Route::group(['middleware' => 'staff'], function () {
    Route::group(['prefix' => 'staff'], function () {

        Route::get('/', [
            'uses' => 'StaffController@index',
            'as'   => 'staff.index',
        ]);
        Route::get('/create', [
            'uses' => 'StaffController@create',
            'as'   => 'staff.create',
        ]);
        // ajax link
        Route::post('/books/subject', [
            'uses' => 'BooksController@subjectAjax',
            'as'   => 'staff.book.subject.ajax'
        ]);
        // ajax link
        Route::post('/store', [
            'uses' => 'StaffController@store',
            'as'   => 'staff.book.store',
        ]);

        Route::get('/view/pdf/{id}', [
            'uses' => 'StaffController@viewPDF',
            'as'   => 'staff.view.pdf',
        ]);
        Route::get('/download/pdf/{id}', [
            'uses' => 'StaffController@downloadPDF',
            'as'   => 'staff.download.pdf',
        ]);
        Route::get('/delete/re/{id}', [
            'uses' => 'StaffController@deleteRe',
            'as'   => 'staff.delete.re',
        ]);

    });
});
Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('/', [
            'uses' => 'HomeController@index',
            'as'   => 'dashboard',
        ]);
        // Levels Start
        Route::get('/level', [
            'uses' => 'LevelsController@index',
            'as'   => 'level.index',
        ]);
        Route::get('/level/create', [
            'uses' => 'LevelsController@create',
            'as'   => 'level.create',
        ]);
        Route::post('/level/store', [
            'uses' => 'LevelsController@store',
            'as'   => 'level.store',
        ]);
        Route::get('/level/delete/{id}', [
            'uses' => 'LevelsController@delete',
            'as'   => 'level.delete',
        ]);
        // Levels End

        // cats Start
        Route::get('/cat', [
            'uses' => 'CatsController@index',
            'as'   => 'cat.index',
        ]);
        Route::get('/cat/create', [
            'uses' => 'CatsController@create',
            'as'   => 'cat.create',
        ]);
        Route::post('/cat/store', [
            'uses' => 'CatsController@store',
            'as'   => 'cat.store',
        ]);
        Route::get('/cat/edit/{id}', [
            'uses' => 'CatsController@edit',
            'as'   => 'cat.edit',
        ]);
        Route::post('/cat/update/{id}', [
            'uses' => 'CatsController@update',
            'as'   => 'cat.update',
        ]);
        Route::get('/cat/delete/{id}', [
            'uses' => 'CatsController@delete',
            'as'   => 'cat.delete',
        ]);
        // cats End


        // start users
        Route::get('/users', [
            'uses' => 'UsersController@index',
            'as'   => 'user.index'
        ]);
        Route::get('/users/adminrequests', [
            'uses' => 'UsersController@adminRequests',
            'as'   => 'user.index.admin.requests'
        ]);
        Route::get('/users/staffrequests', [
            'uses' => 'UsersController@staffRequests',
            'as'   => 'user.index.staff.requests'
        ]);

        Route::get('/users/adminrequests/approve/{id}', [
            'uses' => 'UsersController@adminRequestsApprove',
            'as'   => 'user.index.admin.approve'
        ]);
        Route::get('/users/staffrequests/approve/{id}', [
            'uses' => 'UsersController@staffRequestsApprove',
            'as'   => 'user.index.staff.approve'
        ]);

        Route::get('/staff/preview', [
            'uses' => 'StaffController@staffPreview',
            'as'   => 'staff.preview'
        ]);
        Route::get('/users/create', [
            'uses' => 'UsersController@create',
            'as'   => 'user.create',
        ]);
        Route::post('/users/store', [
            'uses' => 'UsersController@store',
            'as'   => 'user.store',
        ]);
        Route::get('/users/edit/{id}', [
            'uses' => 'UsersController@edit',
            'as'   => 'user.edit',
        ]);
        Route::post('/users/update/{id}', [
            'uses' => 'UsersController@update',
            'as'   => 'user.update',
        ]);
        Route::get('/users/delete/{id}', [
            'uses' => 'UsersController@delete',
            'as'   => 'user.delete',
        ]);
        // end users

        // start specializations
        Route::get('/specializations', [
            'uses' => 'SpecializationController@index',
            'as'   => 'specialization.index'
        ]);
        Route::get('/specializations/create', [
            'uses' => 'SpecializationController@create',
            'as'   => 'specialization.create',
        ]);
        Route::post('/specializations/store', [
            'uses' => 'SpecializationController@store',
            'as'   => 'specialization.store',
        ]);
        Route::get('/specializations/edit/{id}', [
            'uses' => 'SpecializationController@edit',
            'as'   => 'specialization.edit',
        ]);
        Route::post('/specializations/update/{id}', [
            'uses' => 'SpecializationController@update',
            'as'   => 'specialization.update',
        ]);
        Route::get('/specializations/delete/{id}', [
            'uses' => 'SpecializationController@delete',
            'as'   => 'specialization.delete',
        ]);
        // end specializations


        // start subjects
        Route::get('/subjects', [
            'uses' => 'SubjectsController@index',
            'as'   => 'subject.index'
        ]);
        Route::get('/subjects/create', [
            'uses' => 'SubjectsController@create',
            'as'   => 'subject.create',
        ]);
        Route::post('/subjects/store', [
            'uses' => 'SubjectsController@store',
            'as'   => 'subject.store',
        ]);
        Route::get('/subjects/edit/{id}', [
            'uses' => 'SubjectsController@edit',
            'as'   => 'subject.edit',
        ]);
        Route::post('/subjects/update/{id}', [
            'uses' => 'SubjectsController@update',
            'as'   => 'subject.update',
        ]);
        Route::get('/subjects/delete/{id}', [
            'uses' => 'SubjectsController@delete',
            'as'   => 'subject.delete',
        ]);
        // end subjects


        // start books
        Route::get('/books', [
            'uses' => 'BooksController@index',
            'as'   => 'book.index'
        ]);
        Route::get('/books/tables', [
            'uses' => 'BooksController@indexTable',
            'as'   => 'book.index.table'
        ]);
        Route::get('/books/delete/re', [
            'uses' => 'BooksController@deleteReGet',
            'as'   => 'book.index.table.delete'
        ]);
        Route::get('/books/cardView', [
           'uses' => 'BooksController@showBooks',
           'as'   => 'show.ajax.book'
        ]);
        Route::get('/books/create', [
            'uses' => 'BooksController@create',
            'as'   => 'book.create',
        ]);
        Route::post('/books/store', [
            'uses' => 'BooksController@store',
            'as'   => 'book.store',
        ]);
        Route::get('/books/edit/{id}', [
            'uses' => 'BooksController@edit',
            'as'   => 'book.edit',
        ]);
        Route::post('/books/update/{id}', [
            'uses' => 'BooksController@update',
            'as'   => 'book.update',
        ]);
        Route::get('/books/delete/{id}', [
            'uses' => 'BooksController@delete',
            'as'   => 'book.delete',
        ]);
        Route::get('/books/singleShow/{id}', [
            'uses' => 'BooksController@singleShowBook',
            'as'   => 'books.single',
        ]);
        Route::get('/books/view/pdf/{id}', [
            'uses' => 'BooksController@viewPDF',
            'as'   => 'view.pdf',
        ]);
        Route::get('/books/download/pdf/{id}', [
            'uses' => 'BooksController@downloadPDF',
            'as'   => 'download.pdf',
        ]);
        // ajax link
        Route::post('/books/subject', [
            'uses' => 'BooksController@subjectAjax',
            'as'   => 'book.subject.ajax'
        ]);
        // ajax link
        // end books

      //  start site setting
      Route::get('/site_setting', [
          'uses' => 'SiteSettingController@index',
          'as'   => 'setting.index'
      ]);
      Route::post('/site_setting/update', [
          'uses' => 'SiteSettingController@store',
          'as'   => 'setting.update'
      ]);

      //  end site setting



      //  start contacts
      Route::get('/contacts', [
          'uses' => 'ContactController@index',
          'as'   => 'contact.index'
      ]);

      Route::get('/contacts/delete/{id}', [
          'uses' => 'ContactController@destroy',
          'as'   => 'contact.delete'
      ]);

      //  end contacts


    });
});
