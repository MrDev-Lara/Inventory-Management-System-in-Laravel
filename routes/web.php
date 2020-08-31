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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//For Employee
Route::get('add-employee', 'EmployeeController@employee')->name('add-employee');
Route::post('insert-employee', 'EmployeeController@insertEmployee');
Route::get('all-employee', 'EmployeeController@employeelist')->name('all-employee');
Route::get('deleteemployee/{id}', 'EmployeeController@deleteemployee');
Route::get('editemployee/{id}', 'EmployeeController@editemployee');
Route::post('update-employee/{id}', 'EmployeeController@updateemployee');

//For Customer
Route::get('add-customer', 'CustomerController@customer')->name('add-customer');
Route::post('insert-customer', 'CustomerController@insertCustomer');
Route::get('all-customer', 'CustomerController@customerlist')->name('all-customer');
Route::get('deletecustomer/{id}', 'CustomerController@deletecustomer');

//For Salary
Route::get('give-salary', 'SalaryController@salary')->name('give-salary');
Route::post('insert-salary', 'SalaryController@insertSalary');
Route::get('all-salary', 'SalaryController@salarylist')->name('all-salary');
Route::get('last-month-salary', 'SalaryController@lastmonthsalary')->name('last-month-salary');
Route::get('pay_last_month{id}', 'SalaryController@paylastmonthsalary');
Route::post('last_month', 'SalaryController@lastmonthdone');
Route::get('all-month-salary', 'SalaryController@allsalarylist')->name('all-month-salary');

//For Product Category
Route::get('add_category', 'CategoryController@category')->name('add_category');
Route::post('insert-category', 'CategoryController@insertCategory');
Route::get('all-category', 'CategoryController@allcategory')->name('all-category');
Route::get('deletecategory/{id}', 'CategoryController@deletecategory');
Route::get('editcategory/{id}', 'CategoryController@editcaegory');
Route::post('edit-category/{id}', 'CategoryController@categoryedit');

//For Product
Route::get('add-product', 'ProductController@products')->name('add-product');
Route::post('insert-product', 'ProductController@insertProduct');
Route::get('all-product', 'ProductController@allproduct')->name('all-product');
Route::get('deleteproduct/{id}', 'ProductController@deleteproduct');

//For Product ExcelSheet
Route::get('export_import-product', 'ProductController@exportproducts')->name('export_import-product');
Route::get('export', 'ProductController@export')->name('export');
Route::post('import', 'ProductController@import');

//For Expense
Route::get('add-expense', 'ExpenseController@expense')->name('add-expense');
Route::post('insert-expense', 'ExpenseController@insertExpense');
Route::get('today-expense', 'ExpenseController@todayexpense')->name('today-expense');
Route::get('monthly-expense', 'ExpenseController@monthlyexpense')->name('monthly-expense');

//For Attendance
Route::get('take-attendance', 'AttendanceController@attendance')->name('take-attendance');
Route::post('insert-attendance', 'AttendanceController@insertAttendance');
Route::get('all-attendance', 'AttendanceController@allattendance')->name('all-attendance');
Route::get('viewattendance/{edit_date}', 'AttendanceController@viewbydate');
Route::get('deleteattendance/{edit_date}', 'AttendanceController@deletebydate');
Route::get('editattendance/{edit_date}', 'AttendanceController@editbydate');
Route::post('update-attendance', 'AttendanceController@updateAttendance');

//For POS
Route::get('pos', 'PosController@POS')->name('pos');
Route::post('/add-cart', 'PosController@addCart');
Route::post('/update-cart/{rowId}', 'PosController@updateCart');
Route::get('/delete-item/{rowId}', 'PosController@deleteItem');
Route::post('/invoice', 'PosController@invoice')->name('/invoice');
Route::post('/order', 'PosController@Order');
Route::get('pending-order', 'PosController@Pending')->name('pending-order');
Route::get('vieworderbyid/{id}', 'PosController@ViewOrderById');
Route::get('completeorder/{id}', 'PosController@complete');
Route::get('completed-order', 'PosController@CompletedOrders')->name('completed-order');

