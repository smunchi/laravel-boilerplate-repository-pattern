<?php
Route::get('/', 'HomeController@index')->name('home');
Route::get('products', 'Products\ProductController@index')->name('backend.product.index');
Route::get('profile', 'Users\UserController@profile')->name('backend.profile.show');
Route::get('profile/edit', 'Users\UserController@profileEdit')->name('backend.profile.edit');

Route::prefix('buckets')->namespace('Buckets')->group(function () {
    Route::get('/', 'BucketController@index')->name('backend.bucket.index');
    Route::get('create', 'BucketController@create')->name('backend.bucket.create');
    Route::get('{bucketID}', 'BucketController@show')->name('backend.bucket.show');
    Route::get('{bucketID}/edit', 'BucketController@edit')->name('backend.bucket.edit');
});

Route::prefix('lender/buckets')->namespace('Buckets')->group(function () {
    Route::get('', 'LenderBucketController@index')->name('backend.lender.bucket.index');
    Route::get('{bucketID}', 'LenderBucketController@show')->name('backend.lender.bucket.show');
    Route::get('/{bucketID}/create', 'LenderBucketController@create')->name('backend.lender.bucket.create');
    Route::get('{bucketID}/edit', 'LenderBucketController@edit')->name('backend.lender.bucket.edit');
});

Route::namespace('Users')->group(function () {
    Route::prefix('lenders')->group(function () {
        Route::get('', 'LenderController@index')->name('backend.lender.index');
        Route::get('create', 'LenderController@create')->name('backend.lender.create');
        Route::get('{lenderID}', 'LenderController@show')->name('backend.lender.show');
        Route::get('{lenderID}/edit', 'LenderController@edit')->name('backend.lender.edit');
    });

    Route::prefix('customers')->group(function () {
        Route::get('', 'CustomerController@index')->name('backend.customer.index');
        Route::get('{customerID}', 'CustomerController@show')->name('backend.customer.show');
    });

    Route::prefix('admins')->group(function () {
        Route::get('', 'AdminUserController@index')->name('backend.admin.index');
    });
});

Route::prefix('applications')->namespace('Applications')->group(function () {
    Route::get('', 'ApplicationController@index')->name('backend.application.index');
    Route::get('{applicationID}', 'ApplicationController@show')->name('backend.application.show');
});

Route::prefix('config')->namespace('Config')->group(function () {
    Route::get('settings', 'SettingsController@index')->name('backend.settings.index');
    Route::get('loan-purpose', 'LoanPurposeController@index')->name('backend.loan.purpose.index');
});
