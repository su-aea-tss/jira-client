<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for the package.
|
*/

Route::get('/jira-client', function (Request $request,\Illuminate\Support\Facades\App $app){
    return 'Hey from Jira';
});
