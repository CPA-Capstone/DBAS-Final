<?php

Route::get('/', 'SessionsController@create')->name('home');
Route::post('/', 'SessionsController@store');
Route::get('/headhome', 'SessionsController@head');
Route::get('/logout', 'SessionsController@destroy');
Route::get('/changepassword', 'SessionsController@password');
Route::post('/changepassword','SessionsController@changepassword');

Route::get('/programs/create', 'ProgramController@create');
Route::post('/programs', 'ProgramController@store');
Route::get('/programs/{program}/edit', 'ProgramController@edit');
Route::patch('/programs/{program}/edit', 'ProgramController@update');

Route::get('/campustargets', 'CampusTargetController@show');
Route::get('/campustargets/create', 'CampusTargetController@create');
Route::post('/campustargets', 'CampusTargetController@store');
Route::get('/campustargets/{campustarget}/edit', 'CampusTargetController@edit');
Route::patch('/campustargets/{campustarget}/edit', 'CampusTargetController@update');

Route::get('/committeemembertargets', 'CommitteeMemberTargetController@show');
Route::get('/committeemembertargets/create', 'CommitteeMemberTargetController@create');
Route::post('/committeemembertargets', 'CommitteeMemberTargetController@store');
Route::get('/committeemembertargets/{committeemembertarget}/edit', 'CommitteeMemberTargetController@edit');
Route::patch('/committeemembertargets/{committeemembertarget}/edit', 'CommitteeMemberTargetController@update');

Route::get('/donortypetargets', 'DonorTypeTargetController@show');
Route::get('/donortypetargets/create', 'DonorTypeTargetController@create');
Route::post('/donortypetargets', 'DonorTypeTargetController@store');
Route::get('/donortypetargets/{donortypetarget}/edit', 'DonorTypeTargetController@edit');
Route::patch('/donortypetargets/{donortypetarget}/edit', 'DonorTypeTargetController@update');

Route::get('/donorprojections', 'DonorProjectionController@show');
Route::get('/donorprojections/create', 'DonorProjectionController@create');
Route::post('/donorprojections', 'DonorProjectionController@store');
Route::get('/donorprojections/{donorprojection}/edit', 'DonorProjectionController@edit');
Route::patch('/donorprojections/{donorprojection}/edit', 'DonorProjectionController@update');

Route::get('/memberhome', 'CommitteeMemberController@home');
Route::get('/committeemembers/create', 'CommitteeMemberController@create');
Route::post('/committeemembers', 'CommitteeMemberController@store');
Route::get('/committeemembers/{committeemember}/edit', 'CommitteeMemberController@edit');
Route::patch('/committeemembers/{committeemember}/edit', 'CommitteeMemberController@update');
Route::get('/committeemembers/{committeemember}/donors', 'CommitteeMemberController@show');
Route::post('/committeemembers/{committeemember}/assign', 'CommitteeMemberController@assign');
Route::post('/committeemembers/{committeemember}/unassign', 'CommitteeMemberController@unassign');

Route::post('/reports/campus', 'ReportController@campus');
Route::post('/reports/type', 'ReportController@type');
Route::post('/reports/program', 'ReportController@program');
Route::post('/reports/list', 'ReportController@list');
Route::post('/reports/donor', 'ReportController@donor');
Route::post('/reports/performance', 'ReportController@performance');

Route::get('/member/makedonation', 'DonationController@create');
Route::post('/member/makedonation', 'DonationController@store');
Route::get('/member/{donation}/editdonation', 'DonationController@edit');
Route::patch('/member/{donation}/editdonation', 'DonationController@update');
Route::get('/member/pastdonations', 'DonationController@show');
Route::get('/donations/show', 'DonationController@list');
Route::get('/donation/create', 'DonationController@add');
Route::post('/donation', 'DonationController@insert');

Route::get('/donor/adddonor', 'DonorController@create');
Route::post('/donor/adddonor', 'DonorController@store');
Route::get('/donor/{donor}/editdonor', 'DonorController@edit');
Route::patch('/donor/{donor}/editdonor', 'DonorController@update');