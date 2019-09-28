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
// 路由返回视图
//Route::get('/', function () {
//    return view('welcome');
//});
// 后台
// Route::get('/','index\IndexController@index');

Route::get('/mail','MailController@index');
Route::get('wechat/get_access_token','wechat\WechatController@get_access_token'); //获取access_token
Route::get('/wechat/get_user_list','wechat\WechatController@get_user_list'); //获取用户列表
Route::get('/wechat/get_user_info','wechat\WechatController@get_user_info'); //获取用户详情
Route::get('wechat/login','wechat\WechatController@wechat_login');
Route::get('wechat/code','wechat\WechatController@code');
Route::get('wechat/upload','wechat\WechatController@upload');
Route::post('wechat/upload_do','wechat\WechatController@upload_do');
Route::get('wechat/menu/create_menu','wechat\MenuController@create_menu');
Route::get('wechat/menu/create','wechat\MenuController@create');
// Route::any('wechat/menu/create_do','wechat\MenuController@create_do');

Route::get('agent/menu_list','wechat\MenuController@menu_list');
Route::post('agent/create_menu','wechat\MenuController@create_menu');
Route::get('agent/load_menu','wechat\MenuController@load_menu');
Route::get('agent/del_menu','wechat\MenuController@del_menu');

// Route::any('wechat/event','wechat\MenuController@event');


Route::prefix('admin')->middleware('CheckLogin')->group(function(){
    Route::get('foot','admin\usercontroller@foot')->name('foot');
    Route::get('main','admin\usercontroller@main')->name('main');
    Route::get('head','admin\usercontroller@head')->name('head');
    Route::get('left','admin\usercontroller@left')->name('left');
    
    Route::get('/user/user','admin\usercontroller@user')->name('user');
    Route::get('index','admin\usercontroller@index')->name('index');
    Route::get('/user/edit/{crm_id}','admin\usercontroller@edit')->name('edit');
    Route::get('/user/delete/{crm_id}','admin\usercontroller@delete')->name('delete');
    Route::post('/user/update/{crm_id}','admin\usercontroller@update')->name('update');
    // Route::get('login','usercontroller@login')->name('login');
    // Route::post('logindo','usercontroller@logindo')->name('logindo');
    Route::post('/user/user_do','admin\usercontroller@user_do')->name('user_do');
    Route::get('brand/list','admin\BrandController@list')->name('list');
    Route::get('brand/add','admin\BrandController@add')->name('add');
    Route::get('brand/edit/{brand_id}','admin\BrandController@edit');
    Route::get('brand/delete/{brand_id}','admin\BrandController@delete');
    Route::post('brand/update/{brand_id}','admin\BrandController@update');
    Route::post('brand/add_do','admin\BrandController@add_do')->name('add_do');
    Route::get('cate/create','admin\CateController@create');
    Route::get('cate/index','admin\CateController@index');
    Route::post('cate/save','admin\CateController@save');
    Route::get('goods/add','admin\GoodsController@add');
    Route::get('goods/list','admin\GoodsController@list');
    Route::post('goods/add_do','admin\GoodsController@add_do');
});
Route::get('admin/login','admin\LoginController@login');
Route::post('admin/login/logindo','admin\LoginController@logindo')->name('logindo');

Route::prefix('exam')->group(function(){
    Route::get('create','exam\LinkController@create')->name('create');
    Route::post('create_do','exam\LinkController@create_do')->name('create_do');
    Route::post('save','exam\LinkController@save')->name('save');
    Route::get('index','exam\LinkController@index');
    Route::get('edit/{url_id}','exam\LinkController@edit');
    Route::get('delete/{url_id}','exam\LinkController@delete');
    Route::post('update/{url_id}','exam\LinkController@update');


});

Route::prefix('/article')->group(function(){
    Route::get('create','article\ArticleController@create');
    Route::post('create_do','article\ArticleController@create_do');
    Route::post('save','article\ArticleController@save');
    Route::get('index','article\ArticleController@index');
    Route::get('login','article\ArticleController@login');
    Route::get('logout','article\ArticleController@logout');
    Route::post('logindo','article\ArticleController@logindo');
    Route::post('likes','article\ArticleController@likes');
    

});

Route::prefix('')->group(function(){
    Route::get('','index\IndexController@index');
    Route::get('reg','index\IndexController@reg');
    // Route::get('reg/sends','index\IndexController@sends');
    Route::post('reg/sendemail','index\IndexController@sendemail');
    Route::post('reg/regdo','index\IndexController@regdo');
    Route::get('login','index\IndexController@login');
    Route::get('wechat_login','index\IndexController@wechat_login');
    Route::post('login/logindo','index\IndexController@logindo');
    Route::get('lists/{id}','index\IndexController@lists');
    Route::get('goods/{id}','index\IndexController@goods');
    Route::get('car/index','index\CarController@index');
    Route::post('car/create','index\CarController@create');
    // Route::get('wechat/code','wechat\WechatController@code');
});

Route::prefix('/test')->group(function(){
    Route::get('/add','test\TestController@add');
    Route::post('/add_do','test\TestController@add_do');
    Route::get('/list','test\TestController@list');
    Route::get('/delete/{id}','test\TestController@delete');
    Route::get('edit/{id}','test\TestController@edit');
    Route::post('update/{id}','test\TestController@update');
});

Route::prefix('student')->group(function(){
    Route::get('add','student\StudentController@add');
    Route::post('add_do','student\StudentController@add_do');
    Route::get('list','student\StudentController@list');
    Route::get('delete/{id}','student\StudentController@delete');
    Route::get('edit/{id}','student\StudentController@edit');

});
Route::prefix('football')->group(function(){
    Route::get('add','football\FootBallController@add');
    Route::post('add_do','football\FootBallController@add_do');
    Route::get('list','football\FootBallController@list');
    Route::get('guess/{id}','football\FootBallController@guess');
    Route::post('guess_do/{id}','football\FootBallController@guess_do');
    Route::get('result/{id}','football\FootBallController@result');
    Route::get('lookresult/{id}','football\FootBallController@lookresult');
    Route::post('result_do/{id}','football\FootBallController@result_do');
});

Route::prefix('role')->middleware('Login')->group(function(){
    Route::get('add','role\RoleController@add');
    Route::get('useradd','role\RoleController@useradd');
    Route::post('useradd_do','role\RoleController@useradd_do');
    Route::post('add_do','role\RoleController@add_do');
    Route::get('list','role\RoleController@list');
    Route::get('huout/{id}','role\RoleController@huout');
    Route::post('huout_do','role\RoleController@huout_do');
    Route::get('logout','role\RoleController@logout');
    Route::get('userlist','role\RoleController@userlist');
    Route::get('guanli','role\RoleController@guanli');
    Route::post('delete','role\RoleController@delete');
    Route::post('update','role\RoleController@update');
    
});
Route::get('role/login','role\RoleController@login');
Route::post('role/logindo','role\RoleController@logindo');


// Route::prefix('admin/brand')->group(function(){
//     Route::get('foot','BrandController@foot')->name('foot');
//     Route::get('main','BrandController@main')->name('main');
//     Route::get('head','BrandController@head')->name('head');
//     Route::get('left','BrandController@left')->name('left');
//     Route::get('list','BrandController@list')->name('list');
//     Route::get('add','BrandController@add')->name('add');
// });

Route::get('likeyou/get_user_list/{id}','likeyou\WechatController@getUserList');
Route::get('likeyou/get_tag_list','likeyou\WechatController@getTagList');
Route::get('likeyou/createTag','likeyou\WechatController@createTag');
Route::post('likeyou/createfans/{id}','likeyou\WechatController@createfans');
Route::get('likeyou/sendmsg/{id}','likeyou\WechatController@sendmsg');
Route::post('likeyou/sendmsg_do/{id}','likeyou\WechatController@sendmsg_do');
Route::post('likeyou/create_do','likeyou\WechatController@create_do');
Route::get('likeyou/login','likeyou\WechatController@login');
Route::get('likeyou/wechat_login','likeyou\WechatController@wechat_login');
Route::get('likeyou/code','likeyou\WechatController@code');
Route::get('likeyou/create_qrcode','likeyou\WechatController@create_qrcode');
Route::get('likeyou/create_menu','likeyou\WechatController@create_menu');
Route::post('likeyou/menu_do','likeyou\WechatController@menu_do');
Route::get('likeyou/menu_list','likeyou\WechatController@menu_list');
// Route::any('wechat/event','likeyou\WechatController@event');
Route::get('likeyou/delete_menu/{id}','likeyou\WechatController@delete_menu');




Route::get('exam/get_wechat_access_token','exam\WechatController@get_wechat_access_token');
Route::any('wechat/event','exam/WechatController@event');














// 路由访问控制器和方法
// Route::get('/', 'usercontroller@admin');
// 第一种 令牌字段
// Route::get('/user', function(){
//     return '<form action="/useradd" method="post">'.csrf_field().'<input type="text" name="username"><button>提交</button></form>';
// });
// 第二种
// Route::get('/user', function(){
//     return '<form action="/useradd" method="post"><input type="hidden" name="_token" value='.csrf_token().'><input type="text" name="username"><button>提交</button></form>';
// });
// 第三种 线上使用
// Route::get('/user', function(){
//     return '<form action="/uid/78" method="">'.csrf_field().'<input type="text" name="username"><button>提交</button></form>';
// });
// match  支持多种路由
// Route::match(['post','get'],'/useradd', function(){
//     dd(request()->username);
// });
// any  支持多种路由
// Route::any('/useradd', function(){
//     dd(request()->username);
// });
// 根目录  视图地址   传输内容
//Route::view('/', 'welcome', ['name' => '我的']);
// 正则传输
// Route::get('user/{id}', function($id){
//     echo $id;
// })->where('id','\d+');
// 
// Route::get('user/{id?}', function($id=90){
//     echo $id;
// })->name('uid');
// Route::get('/aa', function(){
//     return redirect()->route('uid');
// });
// 传输值到usercontroller控制器
// Route::get('user/{id}','usercontroller@admin');






// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
