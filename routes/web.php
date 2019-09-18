<?php

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
Route::get('/test', function () {
    $str = '[{&quot;id&quot;:1,&quot;name&quot;:&quot;manage_contents&quot;,&quot;guard_name&quot;:&quot;web&quot;,&quot;created_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;updated_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;pivot&quot;:{&quot;role_id&quot;:1,&quot;permission_id&quot;:1}},{&quot;id&quot;:2,&quot;name&quot;:&quot;manage_users&quot;,&quot;guard_name&quot;:&quot;web&quot;,&quot;created_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;updated_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;pivot&quot;:{&quot;role_id&quot;:1,&quot;permission_id&quot;:2}},{&quot;id&quot;:3,&quot;name&quot;:&quot;edit_settings&quot;,&quot;guard_name&quot;:&quot;web&quot;,&quot;created_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;updated_at&quot;:&quot;2019-08-16 14:49:36&quot;,&quot;pivot&quot;:{&quot;role_id&quot;:1,&quot;permission_id&quot;:3}}]';
    return html_entity_decode($str);
    return app_path('Http/routes/administrator.php');
    return config_path('administrator');
    return md5('123456');
    $str = "Bill & 'Steve'";
    echo htmlspecialchars($str, ENT_COMPAT); // 只转换双引号
    echo "<br>";
    echo htmlspecialchars($str, ENT_QUOTES); // 转换双引号和单引号
    echo "<br>";
    echo htmlspecialchars($str, ENT_NOQUOTES); // 不转换任何引号
});
Route::get('/', 'PagesController@root')->name('root');

//Auth::routes();

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);

//Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');
//Route::patch('/users/{user}', 'UsersController@update')->name('users.update');
Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::resource('categories', 'CategoriesController', ['only' => ['show']]);

Route::post('/upload_image', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::get('topics/{topic}/{slug?}', 'TopicsController@show')->name('topics.show');
Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);
Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
Route::get('permission-denied', 'PagesController@permissionDenied')->name('permission-denied');