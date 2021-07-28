<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;





// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();



Route::get('/', [HomeController::class, 'index'])->name('home'); //Homepage Route

Route::get('/post/{post}', [PostController::class, 'show'])->name('post');


//--------- Search Bar ----------


Route::post('/search', [HomeController::class, 'search_employee'])->name('search.employee'); 



Route::middleware('auth')->group(function(){


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/posts/create', [PostController::class, 'create'])->name('post.create');

Route::post('/admin/posts', [PostController::class, 'store'])->name('post.store');

Route::post('/comment/{post}', [CommentController::class, 'store'])->name('comment.store');

Route::get('/profile', [HomeController::class, 'show'])->name('user.show');

Route::put('/profile', [HomeController::class, 'update'])->name('user.update');

Route::get('/your_post', [PostController::class, 'view_all_post'])->name('user.posts');

Route::get('/view_all_post', [PostController::class, 'view_all_users_post'])->name('user_all.posts');

Route::get('/delete_post/{post}', [PostController::class, 'delete_post'])->name('post_delete');

Route::get('/edit_post/{post}', [PostController::class, 'edit_post'])->name('post_edit');

Route::put('/update/{post}', [PostController::class, 'update'])->name('post.update');

Route::get('/like/{post}', [LikeController::class, 'liked_post'])->name('post.like');

Route::get('/unlike/{post}', [LikeController::class, 'unliked_post'])->name('post.unlike');


Route::get('/admin/role', [RoleController::class, 'create_role'])->name('create.role');

Route::post('/admin/create_role', [RoleController::class, 'store'])->name('role.store');

Route::get('/admin/all_roles', [RoleController::class, 'show'])->name('show.roles');

Route::get('/admin/role/delete/{role}', [RoleController::class, 'delete'])->name('role_delete');

Route::get('/admin/role/edit/{role}', [RoleController::class, 'edit'])->name('role_edit');

Route::post('/admin/role/update/{role}', [RoleController::class, 'update'])->name('role_update');

/////////////// ROLE MANAGEMENT ////

Route::get('/user_role_manage', [RoleController::class, 'user_role_manage'])->name('user_role_manage');

Route::get('/add_user_role/{user}', [RoleController::class, 'add_user_role'])->name('add_user_role');

Route::post('/user_role_create/{user}', [RoleController::class, 'user_role_create'])->name('user_role_create');

Route::get('/delete_user_role/{user}', [RoleController::class, 'delete_user_role'])->name('delele_user_role');
Route::post('/user_role_deleted/{user}', [RoleController::class, 'user_role_deleted'])->name('user_role_deleted');




///////////  KAJ NAI 
Route::resource('category', CategoryController::class);

// Route::resource('employee', EmployeeController::class);
//EMPLOYEE DATA PDF//
Route::get('/emp_print/{id}', [InvoiceController::class, 'emp_data_print'])->name('emp_data_print');
//EMPLOYEE GUEST DATA PDF//
Route::get('/print_page', [InvoiceController::class, 'print_page'])->name('print.page');


//----GO TO ADMIN DASHBOARD AND SHOW REPORT FORM----//
Route::get('/admin_reports', [AdminController::class, 'admin_reports'])->name('admin.reports');
//---- GO TO ADMIN DASHBOARD AND SHOW TODAY'S EMPLOYEE GUEST----//
Route::get('/today_emp_guest', [AdminController::class, 'today_emp_guest'])->name('admin.today_emp_guest');
//---- GO TO ADMIN DASHBOARD AND SHOW TODAY'S MANAGEMENT GUEST----//
Route::get('/today_management_guest', [AdminController::class, 'today_management_guest'])->name('admin.today_management_guest');
//----GO TO ADMIN DASHBOARD AND SHOW TODAY'S SPECIAL GUEST----//
Route::get('/today_special_guest', [AdminController::class, 'today_special_guest'])->name('admin.today_special_guest');
//----GO TO ADMIN DASHBOARD AND SHOW REPORTS----//
Route::post('/report_generates', [AdminController::class, 'report_generates'])->name('report.generates');

//----GO TO MANAGEMENT DASHBOARD----//
Route::resource('guest', GuestController::class);
//----GO TO MANAGEMENT DASHBOARD AND SHOW EMPLOYEE GUEST FORM ----//
Route::get('/guest_employee', 'GuestController@employeeindex')->name('guest.employee');
//----GO TO MANAGEMENT DASHBOARD AND SHOW MANAGEMENT GUEST FORM ----//
Route::get('/management', 'GuestController@managementindex')->name('guest.management');
//----GO TO MANAGEMENT DASHBOARD AND SHOW SPECIAL GUEST FORM ----//
Route::get('/special', 'GuestController@specialindex')->name('guest.special');
//----GO TO ADMIN DASHBOARD AND SHOW ALL EMPLOYEE DETAIL'S----//
Route::get('/view_all_employee','GuestController@view_employee')->name('guest.view_all_employee');
//----GO TO MANAGEMENT DESHBOARD----//
Route::resource('attendance', AttendanceController::class);
Route::get('/emp_getToken/{id}', 'AttendanceController@attendance_get_token')->name('attendance.get_token');
//----GO TO MANAGEMENT DASHBOARD----//
Route::resource('employee', EmployeeController::class);
//----GO TO MANAGEMENT DASHBOARD AND SHOW ALL EMPLOYEE DETAIL'S----//
Route::get('/manager_view_employee', 'EmployeeController@manager_view_employee')->name('employee.view_employee');

Route::get('emp_name_search', 'EmployeeController@emp_name_search'); ///JS auto name search


Route::resource('product',ProductController::class);
Route::post('/add_product', 'ProductController@add_product')->name('product.add_product');
Route::get('/product_list','ProductController@product_list')->name('product.product_list');
Route::get('/expense_counter/{id}', 'ProductController@expense_counter')->name('product.expense');

Route::resource('expense', ExpenseController::class);
// Route::get('/invoice_home','ExpenseController@invoice_home')->name('expense.invoice_home');
Route::get('/today_invoice','ExpenseController@today_invoice')->name('today.invoice');

Route::get('/invoice_image','ItemController@invoice_image')->name('invoice_image.show');

Route::post('/store_invoice','ItemController@store_invoice')->name('invoice_image.store');



Route::get('itemPdfView',array('as'=>'itemPdfView','uses'=>'ItemController@itemPdfView'));

//////



Route::get('product_unit_search', 'ProductController@product_unit_search');





});