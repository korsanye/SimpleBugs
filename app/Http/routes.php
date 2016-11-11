<?php

Route::get('/login', 'LoginController@show');
Route::get('/logout', 'LoginController@logout');
Route::post('/login', 'LoginController@authenticate');
Route::get('/forgotpassword', 'PasswordController@forgotPassword');
Route::post('/forgotpassword', 'PasswordController@postForgotPassword');
Route::get('/password/reset/{token}', 'PasswordController@resetView');
Route::post('/password/reset/{token}', 'PasswordController@postResetView');

Route::get('email', function() {
   return view('mails.singlecolumn');
});


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'IssuesController@overview');
    Route::get('/issues/', 'IssuesController@overview');
    Route::get('/issues/projects', 'IssuesController@byproject');
    Route::get('/issues/priority', 'IssuesController@bypriority');
    Route::get('/issues/mine', 'IssuesController@myissues');
    Route::get('/create', 'IssuesController@issueform');
    Route::post('/create', 'IssuesController@storeissue');
    Route::get('/issues/{id}', 'IssuesController@userissues');
    Route::get('/issue/{id}', 'IssuesController@showissue');
    Route::post('/issue/{id}', 'IssuesController@addcomment');
    Route::post('/search', 'SearchController@search');

    Route::get('/edit/{id}', 'IssuesController@showEdit');
    Route::post('/edit/{id}', 'IssuesController@postEdit');

    //Route::get('/ajax/users', 'AjaxController@userlist');

});

// Routes protected for admins
Route::group(['middleware' => ['auth', 'isadmin']], function() {

    Route::get('/admin', 'AdminController@overview');

    Route::get('/admin/users', 'UsersController@overview');
    Route::get('/admin/users/inactive', 'UsersController@inactiveOverview');
    Route::get('/admin/user/create', 'UsersController@showcreate');
    Route::post('/admin/user/create', 'UsersController@postcreate');
    Route::get('/admin/user/edit/{id}', 'UsersController@showedit');
    Route::post('/admin/user/edit/{id}', 'UsersController@postedit');
    Route::get('/admin/user/delete/{id}', 'UsersController@delete');
    Route::post('/admin/user/delete/{id}', 'UsersController@confirmdelete');
    Route::get('/admin/user/activate/{id}', 'UsersController@activate');

    Route::get('/admin/projects', 'ProjectsController@overview');
    Route::get('/admin/project/edit/{id}', 'ProjectsController@edit');
    Route::post('/admin/project/edit/{id}', 'ProjectsController@postedit');
    Route::get('/admin/project/delete/{id}', 'ProjectsController@delete');
    Route::post('/admin/project/delete/{id}', 'ProjectsController@postdelete');
    Route::get('/admin/project/create', 'ProjectsController@create');
    Route::post('/admin/project/create', 'ProjectsController@postcreate');

    Route::get('/admin/categories', 'CategoriesController@overview');
    Route::get('/admin/category/edit/{id}', 'CategoriesController@edit');
    Route::post('/admin/category/edit/{id}', 'CategoriesController@postedit');
    Route::get('/admin/category/delete/{id}', 'CategoriesController@delete');
    Route::post('/admin/category/delete/{id}', 'CategoriesController@postdelete');
    Route::get('/admin/category/create', 'CategoriesController@create');
    Route::post('/admin/category/create', 'CategoriesController@postcreate');

    Route::get('/admin/priorities', 'PrioritiesController@overview');
    Route::get('/admin/priority/edit/{id}', 'PrioritiesController@edit');
    Route::post('/admin/priority/edit/{id}', 'PrioritiesController@postedit');
    Route::get('/admin/priority/delete/{id}', 'PrioritiesController@delete');
    Route::post('/admin/priority/delete/{id}', 'PrioritiesController@postdelete');
    Route::get('/admin/priority/up/{id}', 'PrioritiesController@up');
    Route::get('/admin/priority/down/{id}', 'PrioritiesController@down');
    Route::get('/admin/priority/default/{id}', 'PrioritiesController@makedefault');
    Route::get('/admin/priority/create', 'PrioritiesController@create');
    Route::post('/admin/priority/create', 'PrioritiesController@postcreate');

    Route::get('/admin/milestones', 'MilestonesController@overview');
    Route::get('/admin/milestone/edit/{id}', 'MilestonesController@edit');
    Route::post('/admin/milestone/edit/{id}', 'MilestonesController@postedit');
    Route::get('/admin/milestone/delete/{id}', 'MilestonesController@delete');
    Route::post('/admin/milestone/delete/{id}', 'MilestonesController@postdelete');
    Route::get('/admin/milestone/create', 'MilestonesController@create');
    Route::post('/admin/milestone/create', 'MilestonesController@postcreate');



});
