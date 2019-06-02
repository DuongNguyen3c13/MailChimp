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
Route::get('/home', ['uses' => 'MailChimpController@index']);

Route::get('/create-list', ['uses' => 'MailChimpController@createList'])->name(CREATE_NEW_LIST);
Route::get('/get-list', ['uses' => 'MailChimpController@getList']);
Route::get('/add-mails', ['uses' => 'MailChimpController@addMails'])->name(ADD_NEW_MAIL);
Route::get('/store-mails', ['uses' => 'MailChimpController@storeMails'])->name(STORE_NEW_MAIL);
Route::get('/set-sender', ['uses' => 'MailChimpController@setSender'])->name(SET_SENDER);
Route::get('/create-campaign', ['uses' => 'MailChimpController@createCampaign'])->name(CREATE_NEW_CAMPAIGN);
Route::get('/send-mail', ['uses' => 'MailChimpController@sendMail']);
