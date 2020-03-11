<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|use App\Role;
*/
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::user() != null){
        return redirect('/home');
    }
    else{
        return view('welcome');
    }
    
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => 'auth'], function(){

    //route for the Administrator role
    Route::group(['middleware' => ['role_or_permission:administrator|Show Division|Create Division|Edit Division|Update Division|Delete Division|Delete Documents|Restore Documents|Restore All Documents|Delete Permanently Documents|Delete Permanently All Documents|Show User Roles|Delete Users']], function(){

        Route::resource('/role', 'RoleController')->except([
        'create', 'show', 'edit', 'update'
        ]);
        Route::get('/role/destroy/{id}','RoleController@destroy')->name('role.destroy');
        Route::get('/user/roles/{id}', 'UserController@roles')->name('user.roles');
        Route::put('/user/roles/{id}', 'UserController@setRole')->name('user.set_role');

        Route::post('/user/permission', 'UserController@addPermission')->name('user.add_permission');
        Route::get('/user/roles_permission', 'UserController@rolePermission')->name('user.roles_permission');
        Route::put('/user/permission/{role}', 'UserController@setRolePermission')->name('user.setRolePermission');

        Route::get('/user/delete/{id}','UserController@delete');

        Route::get('/division','DivisionController@index')->name('division.index');
        Route::get('/division/add_division','DivisionController@add_division');
        Route::post('/division/store','DivisionController@store');
        Route::get('/division/edit/{id}','DivisionController@edit');
        Route::post('/division/update/{id}','DivisionController@update');
        Route::get('/division/delete/{id}','DivisionController@delete');

        Route::get('/document/delete/{id}','DocumentController@delete');
        Route::get('/document/restore/{id}','DocumentController@restore');
        Route::get('/document/restore_all','DocumentController@restore_all');
        Route::get('/document/delete_permanently/{id}','DocumentController@delete_permanently');
        Route::get('/document/delete_permanently_all','DocumentController@delete_permanently_all');

    });
    //end route for the Administrator role

    //route for the Manager role
    Route::group(['middleware' => ['role_or_permission:administrator|manager|Create Box|Create Racks|Edit Racks|Update Racks']],function(){

        Route::get('/user' , 'UserController@index')->name('user.index');
        Route::get('/user/create' , 'UserController@create')->name('user.create');
        Route::post('/user/create_user' , 'UserController@create_user')->name('user.create_user');
      
       
        
        // Route::resource('/user', 'UserController')->except([
        // 'show'
        // ]);

        

        Route::post('/box/store' , 'BoxController@store');
        Route::get('/box/edit_box/{id}','BoxController@edit_box');
        Route::post('/box/update/{id}','BoxController@update');
        Route::get('/box/delete/{id}','BoxController@delete');

        Route::get('/rack/add_box/{id}','RackController@add_box');
        Route::get('/rack/add_rack','RackController@add_rack')->name('rack.add_rack');
        Route::post('/rack/store','RackController@store')->name('rack.store');
        Route::get('/rack/edit/{id}','RackController@edit');
        Route::post('/rack/update/{id}','RackController@update');
        Route::get('/rack/delete/{id}','RackController@delete');
       
    });
    //end route for the Manager role

    //route for the Administrator, Manager and Staff role
    Route::group(['middleware' => ['role_or_permission:administrator|manager|staff|Show Documents|Create Documents|Detail Documents|Edit Documents|Update Documents|Show Trash Documents|Print Documents|Show Box|Update Status Box|Detail Box|Show Racks|Detail Racks']],function(){

        Route::get('/document' , 'DocumentController@index')->name('document.index');
        Route::get('/document/add_document' , 'DocumentController@add_document');
        Route::post('/document/store' , 'DocumentController@store');
        Route::get('/document/detail/{id}','DocumentController@detail');
        Route::get('/document/edit/{id}','DocumentController@edit');
        Route::post('/document/update/{id}','DocumentController@update');
        Route::get('/document/delete_file/{id}','DocumentController@delete_file'); 
        
        Route::get('/document/trash','DocumentController@trash');
       
        Route::get('/document/ref_number' , 'DocumentController@ref_number');
        // Route::get('/document/search' , 'DocumentController@search');
        Route::post('/document/boxSearch' , 'DocumentController@boxSearch')->name('document.boxSearch');
        Route::get('/document/print_pdf/{id}','DocumentController@print_pdf');

        Route::get('getDocuments', [

            'uses' => 'DocumentController@getDocuments',
            'as' => 'ajax.get.documents',

        ]);

        Route::get('/user/profile/{id}' , 'UserController@profile');
        Route::get('/user/change_password_form','UserController@changePasswordForm')->name('user.changePasswordForm');
        Route::post('/user/change_password','UserController@changePassword')->name('user.changePassword');
        Route::get('/user/edit/{id}','UserController@edit');
        Route::get('/user/edit_profile/{id}','UserController@edit_profile');
        Route::post('/user/update_profile/{id}','UserController@update_profile');

        
        Route::get('/box' , 'BoxController@index')->name('box.index');
        Route::get('/box/update/status/{id}','BoxController@updateStatus');
        
        Route::get('/box/view_data/{id}' , 'BoxController@view_data');

        Route::get('/rack','RackController@index')->name('rack.index');
        Route::get('/rack/detail/{id}','RackController@detail');
        Route::get('/rack/qr_code/{id}','RackController@qr_code');

    });
  
    Route::get('/dashboard','DashboardController@index')->name('dashboard.index'); 
    Route::get('/box/search','BoxController@search');
    Route::get('/box/print_data_box/{id}' ,'BoxController@print_data_box');
   

});

  
      

  
      


