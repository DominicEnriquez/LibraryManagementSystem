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

// Authenticated Page
Route::group(['middleware' => 'auth'], function() {
    
    // Book List Page
    Route::get('/', [
        'as' => 'home', 'uses' => 'BookController@showList'
    ]);
    Route::get('dt-book-list', [
        'as' => 'dt-book-list', 'uses' => 'BookController@getBookList'
    ]);
    Route::post('borrow-books', [
        'as' => 'do-borrow-books', 'uses' => 'BookController@doBorrowBooks'
    ]); 
    
    // Member Borrowed Books
    Route::get('borrow-books', [
        'as' => 'borrow-books', 'uses' => 'BookController@showBorrowBooks'
    ]);
    Route::get('dt-borrow-books', [
        'as' => 'dt-borrow-books', 'uses' => 'BookController@getBorrowBooks'
    ]);
    Route::post('return-books', [
        'as' => 'do-return-books', 'uses' => 'BookController@doReturnBooks'
    ]);   
    
    // Member Retured Books
    Route::get('return-books', [
        'as' => 'return-books', 'uses' => 'BookController@showReturnBooks'
    ]);
    Route::get('dt-return-books', [
        'as' => 'dt-return-books', 'uses' => 'BookController@getReturnBooks'
    ]);
    
    Route::group(['middleware' => 'can:admin-access', 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
        
        Route::group(['prefix' => 'member'], function() {
                    
            Route::get('/', [
                'as' => 'admin::member-list', 'uses' => 'MemberController@showList'
            ]);                    
            Route::get('dt-member-list', [
                'as' => 'admin::dt-member-list', 'uses' => 'MemberController@getMemberList'
            ]);
                    
            Route::get('add', [
                'as' => 'admin::member-add', 'uses' => 'MemberController@showAdd'
            ]);                    
            Route::post('add', [
                'as' => 'admin::do-member-add', 'uses' => 'MemberController@doAdd'
            ]);
                    
            Route::get('edit/{id}', [
                'as' => 'admin::member-edit', 'uses' => 'MemberController@showEdit'
            ]);
            Route::post('edit/{id}', [
                'as' => 'admin::do-member-edit', 'uses' => 'MemberController@doEdit'
            ]);
            
            Route::get('delete/{id}', [
                'as' => 'admin::do-member-delete', 'uses' => 'MemberController@doDelete'
            ]);
            
            Route::get('restore/{id}', [
                'as' => 'admin::do-member-retore', 'uses' => 'MemberController@doRestore'
            ]);
        });
        
        Route::group(['prefix' => 'book'], function() {
            
            Route::get('/', [
                'as' => 'admin::book-list', 'uses' => 'BookController@showList'
            ]);              
            Route::get('dt-book-list', [
                'as' => 'admin::dt-book-list', 'uses' => 'BookController@getBookList'
            ]);            
           
            Route::get('add', [
                'as' => 'admin::book-add', 'uses' => 'BookController@showAdd'
            ]);                    
            Route::post('add', [
                'as' => 'admin::do-book-add', 'uses' => 'BookController@doAdd'
            ]);
                    
            Route::get('edit/{id}', [
                'as' => 'admin::book-edit', 'uses' => 'BookController@showEdit'
            ]);                    
            Route::post('edit/{id}', [
                'as' => 'admin::do-book-edit', 'uses' => 'BookController@doEdit'
            ]);
            
            Route::get('delete/{id}', [
                'as' => 'admin::do-book-delete', 'uses' => 'BookController@doDelete'
            ]);
            
            Route::get('restore/{id}', [
                'as' => 'admin::do-book-restore', 'uses' => 'BookController@doRestore'
            ]);
        });
        
        Route::group(['prefix' => 'report'], function() {
           
            Route::get('/', [
                'as' => 'admin::report-loans', 'uses' => 'ReportController@showLoans'
            ]);                 
            Route::get('dt-report-loans', [
                'as' => 'admin::dt-report-loans', 'uses' => 'ReportController@getReportLoans'
            ]);             
           
            Route::get('quantities', [
                'as' => 'admin::report-quantities', 'uses' => 'ReportController@showQuantities'
            ]);                       
            Route::get('dt-report-quantities', [
                'as' => 'admin::dt-report-quantities', 'uses' => 'ReportController@getReportQuantities'
            ]);             
        });
    });
    
    Route::group(['prefix' => 'account'], function() {
        
        Route::get('profile', [
            'as' => 'account::profile', 'uses' => 'AccountController@showProfile'
        ]);        
        Route::post('profile', [
            'as' => 'account::do-profile', 'uses' => 'AccountController@doProfile'
        ]);
        
        Route::get('change-password', [
            'as' => 'account::change-password', 'uses' => 'AccountController@showChangePassword'
        ]);        
        Route::post('change-password', [
            'as' => 'account::do-change-password', 'uses' => 'AccountController@doChangePassword'
        ]);
    });
    
    Route::get('logout', [
        'as' => 'logout', 'uses' => 'AuthController@getLogout'
    ]);

});

// Public Page
Route::group(['middleware' => 'guest', 'prefix' => 'auth'], function() {
    
    Route::get('login', [
        'as' => 'auth::login', 'uses' => 'AuthController@showLogin'
    ]);
    
    Route::post('login', [
        'as' => 'auth::do-login', 'uses' => 'AuthController@postLogin'
    ]);
    
    Route::get('register', [
        'as' => 'auth::register', 'uses' => 'AuthController@showRegister'
    ]);
    
    Route::post('register', [
        'as' => 'auth::do-register', 'uses' => 'AuthController@doRegister'
    ]);
    
    Route::get('forgot-password', [
        'as' => 'auth::forgot-password', 'uses' => 'AuthController@showForgotPassword'
    ]);
    
    Route::post('forgot-password', [
        'as' => 'auth::do-forgot-password', 'uses' => 'AuthController@doForgotPassword'
    ]);
});