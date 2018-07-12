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

Route::redirect('/' , 'info');

Auth::routes();




//web
Route::get('info', 'Web\InfoController@info')->name('info');
/*route::get('entrada/{slug}', 'Web\PageController@post')->name('post');
route::get('categoria/{slug}', 'Web\PageController@category')->name('category');
route::get('etiqueta/{slug}', 'Web\PageController@tag')->name('tag');
//*/

//admin
route::resource('clients', 		'Admin\ClientController');
route::resource('receptions',   'Admin\ReceptionController');
route::get('/printvoucherreception/{id}',		'Admin\ReceptionController@printvoucherreception')->name('printvoucherreception');


route::resource('empresas', 		'Admin\EmpresaController');

route::resource('deliveries', 		'Admin\DeliveryController');
route::get('/print/{id}',		'Admin\DeliveryController@print')->name('print');
route::get('/printvoucherdelivery/{id}',		'Admin\DeliveryController@printvoucherdelivery')->name('printvoucherdelivery');

	//complementos
route::resource('equipments', 		'Admin\EquipmentController');
route::resource('reasons', 		'Admin\ReasonController');

	//para manejar tipos de usuarios mas adelante
route::resource('manageusers', 		'Admin\ManageuserController');
route::get('/showSetting/{id}',		'Admin\ManageuserController@showSetting')->name('showSetting');
route::put('/setting/{id}',		'Admin\ManageuserController@setting')->name('setting');


//