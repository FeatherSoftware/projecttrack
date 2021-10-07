<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('index');
});
Route::post('/login', 'LoginController@login');
Route::get('/employeeattendance', 'AttendanceController@employeeattendance');
Route::post('/addAttendance', 'AttendanceController@addAttendance');
Route::get('/attendanceTable', 'AttendanceController@attendanceTable');
Route::post('/updateAttendance', 'AttendanceController@updateAttendance');
Route::get('attendanceTrack','AttendanceController@attendanceTrack');

//Employee Table
Route::get('/employeeTable', 'EmployeeController@employeeTable');
Route::get('/AddEmployee', 'EmployeeController@AddEmployee');
Route::post('/SubmitEmployee', 'EmployeeController@SubmitEmployee');
Route::get('/ChangePassword', 'EmployeeController@ChangePassword');
Route::post('/UpdatePassword', 'EmployeeController@UpdatePassword');
Route::get('EditEmployee/{id}','EmployeeController@EditEmployee');
Route::get('DeleteEmployee/{id}','EmployeeController@DeleteEmployee');
Route::post('UpdateEmployee','EmployeeController@UpdateEmployee');
Route::get('dashboard','EmployeeController@dashboard');

//ProjectTable
Route::get('projectTable','ProjectController@projectTable');
Route::get('AddProject','ProjectController@AddProject');
Route::post('SubmitProject','ProjectController@SubmitProject');
Route::get('EditProject/{id}','ProjectController@EditProject');
Route::post('UpdateProject','ProjectController@UpdateProject');
Route::get('DeleteProject/{id}','ProjectController@DeleteProject');


//ClientTable
Route::get('clientTable','ProjectController@clientTable');
Route::get('AddClient','ProjectController@AddClient');
Route::post('SubmitClient','ProjectController@SubmitClient');
Route::get('EditClient/{id}','ProjectController@EditClient');
Route::post('UpdateClient','ProjectController@UpdateClient');
Route::get('DeleteClient/{id}','ProjectController@DeleteClient');

//Client Log In
Route::get('client','ProjectController@client');
Route::post('clientLogin','ProjectController@clientLogin');

//Project Employee
Route::get('ProjectEmployee','ProjectController@ProjectEmployee');
Route::get('ProjectStart/{id}','ProjectController@ProjectStart');
//Route::get('ProjectHold/{id}/{Started}','ProjectController@ProjectCompleted');
Route::get('ProjectComplete/{id}/Started','ProjectController@ProjectComplete');
