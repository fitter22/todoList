<?php
use App\Task;
use Illuminate\Http\Request;


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

Route::get('/', 'TaskController@index');

Route::get('/projects', 'ProjectController@index');
Route::post('/projects', 'ProjectController@store');
Route::delete('/projects/{projectId}', 'ProjectController@destroy');

Route::get('/project/{projectId}/tasks', 'TaskController@index');
Route::post('/project/{projectId}/task', 'TaskController@store');
Route::delete('/project/{projectId}/task/{task}', 'TaskController@destroy');

Auth::routes();
