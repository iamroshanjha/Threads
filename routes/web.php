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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');




Route::get('/question', 'ForumController@getPost');

Route::post('/post', 'ForumController@putPost');

Route::get('/question/{slug}', 'ForumController@viewPost');

Route::post('/reply', 'ForumController@saveReply');

Route::delete('/delete_post', 'ForumController@deletePost');

Route::delete('/delete_reply', 'ForumController@deleteReply');


Route::get('/question/{slug1}/reply1/{slug}', 'ForumController@viewReplyThread');


Route::get('{id}/get_edit_post', 'ForumController@getEditPost');

Route::post('edit_post', 'ForumController@saveEditPost');


Route::get('cancel', 'ForumController@cancel');

Route::get('/question/reply/like/{id}','ForumController@replyLike');

Route::post('/reply1', 'ForumController@saveReplyThread');

Route::delete('/delete_reply_thread', 'ForumController@deleteReplyThread');

Route::get('/myquestions', 'HomeController@viewMyPosts');


Route::post('/profileselection', 'HomeController@setProfile');




