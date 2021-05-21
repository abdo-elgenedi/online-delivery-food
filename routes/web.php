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

###################################################################

#####################Admin Management Routes#######################

###################################################################

###################################################################

###################Start Admin Profile Routes######################

###################################################################





Route::group(['prefix'=>'admin','namespace'=>'Auth'],function (){
    Route::get('/register','RegisteradminController@adminRegister')->name('admin.getregister');
    Route::post('/register','RegisteradminController@create')->name('admin.register');
    Route::get('/login','LoginController@getAdminLogin')->name('admin.getlogin');
    Route::post('/login','LoginController@adminLogin')->name('admin.login');
});
Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){
    Route::get('/','DashboardController@index')->name('admin.index');
    Route::get('/profile','DashboardController@getProfile')->name('admin.getprofile');
    Route::post('/profile','DashboardController@updateProfile')->name('admin.updateprofile');
    Route::post('/updatephoto','DashboardController@updatephoto')->name('admin.updatephoto');


###################################################################

#####################End Admin Profile Routes######################

###################################################################





###################################################################

##################Start Main Categories Routes#####################

###################################################################

Route::group(['prefix'=>'maincategories'],function (){
    Route::get('/','MainCategoryController@index')->name('admin.maincategories');
    Route::get('create','MainCategoryController@create')->name('admin.maincategories.create');
    Route::post('create','MainCategoryController@store')->name('admin.maincategories.store');
    Route::get('edit/{id}','MainCategoryController@edit')->name('admin.maincategories.edit');
    Route::post('update','MainCategoryController@update')->name('admin.maincategories.update');
    Route::get('delete','MainCategoryController@delete')->name('admin.maincategories.delete');
    Route::get('changeStatus','MainCategoryController@changeStatus')->name('admin.maincategories.changeStatus');
});
###################################################################

#####################End Main Categories Routes####################

###################################################################



###################################################################

#################Start Categories Level 1 Routes###################

###################################################################

Route::group(['prefix'=>'subcategories'],function (){
    Route::group(['prefix'=>'categorieslevel1'],function () {
        Route::get('/', 'CategoryLevel1Controller@index')->name('admin.categorieslevel1');
        Route::get('create', 'CategoryLevel1Controller@create')->name('admin.categorieslevel1.create');
        Route::post('create', 'CategoryLevel1Controller@store')->name('admin.categorieslevel1.store');
        Route::get('edit/{id}', 'CategoryLevel1Controller@edit')->name('admin.categorieslevel1.edit');
        Route::post('update', 'CategoryLevel1Controller@update')->name('admin.categorieslevel1.update');
        Route::get('delete', 'CategoryLevel1Controller@delete')->name('admin.categorieslevel1.delete');
        Route::get('changeStatus', 'CategoryLevel1Controller@changeStatus')->name('admin.categorieslevel1.changeStatus');
    });

});
###################################################################

###################End Categories Level 1 Routes###################

###################################################################






###################################################################

#################Start Cities Routes###################

###################################################################

Route::group(['prefix'=>'cities'],function (){
        Route::get('/', 'CityController@index')->name('admin.cities');
        Route::get('create', 'CityController@create')->name('admin.cities.create');
        Route::post('create', 'CityController@store')->name('admin.cities.store');
        Route::get('edit/{id}', 'CityController@edit')->name('admin.cities.edit');
        Route::post('update', 'CityController@update')->name('admin.cities.update');
        Route::get('delete', 'CityController@delete')->name('admin.cities.delete');

});
###################################################################

###################End Cities Routes###################

###################################################################



###################################################################

#################Start States Routes###################

###################################################################

Route::group(['prefix'=>'states'],function (){
        Route::get('/', 'StateController@index')->name('admin.states');
        Route::get('create', 'StateController@create')->name('admin.states.create');
        Route::post('create', 'StateController@store')->name('admin.states.store');
        Route::get('edit/{id}', 'StateController@edit')->name('admin.states.edit');
        Route::post('update', 'StateController@update')->name('admin.states.update');
        Route::get('delete', 'StateController@delete')->name('admin.states.delete');

});
###################################################################

###################End States Routes###################

###################################################################




###################################################################

##################Start Sub Categories Routes######################

###################################################################
/*
Route::group(['prefix'=>'admin/subcategories','namespace'=>'Admin'],function (){
    Route::get('/','SubCategoryController@index')->name('admin.subcategories');
    Route::get('create','SubCategoryController@create')->name('admin.subcategories.create');
    Route::post('create','SubCategoryController@store')->name('admin.subcategories.store');
    Route::get('edit/{id}','SubCategoryController@edit')->name('admin.subcategories.edit');
    Route::post('update','SubCategoryController@update')->name('admin.subcategories.update');
    Route::get('delete/{id}','SubCategoryController@delete')->name('admin.subcategories.delete');
    Route::get('changeStatus/{id}','SubCategoryController@changeStatus')->name('admin.subcategories.changeStatus');


});
*/
###################################################################

####################End Sub Categories Routes######################

###################################################################






###################################################################

########################Start Products Routes######################

###################################################################

Route::group(['prefix'=>'subcategories'],function (){
    Route::get('/','SubCategoryController@index')->name('admin.subcategories');
    Route::get('create','SubCategoryController@create')->name('admin.subcategories.create');
    Route::post('create','SubCategoryController@store')->name('admin.subcategories.store');
    Route::get('edit/{id}','SubCategoryController@edit')->name('admin.subcategories.edit');
    Route::post('update','SubCategoryController@update')->name('admin.subcategories.update');
    Route::get('delete/{id}','SubCategoryController@delete')->name('admin.subcategories.delete');
    Route::get('changeStatus/{id}','SubCategoryController@changeStatus')->name('admin.subcategories.changeStatus');


});

###################################################################

######################End Products Routes##########################

###################################################################







###################################################################

######################Start Vendors Routes#########################

###################################################################

Route::group(['prefix'=>'vendors'],function (){
    Route::get('/','VendorController@index')->name('admin.vendors');
    Route::get('/pending','VendorController@pending')->name('admin.vendors.pending');
    Route::post('/pendingaction','VendorController@pendingAction')->name('admin.vendors.pendingaction');
    Route::post('/details','VendorController@vendorDetails')->name('admin.vendors.details');
    Route::get('edit/{id}','VendorController@edit')->name('admin.vendors.edit');
    Route::post('update','VendorController@update')->name('admin.vendors.update');
    Route::get('delete','VendorController@delete')->name('admin.vendors.delete');
    Route::get('changeStatus','VendorController@changeStatus')->name('admin.vendors.changeStatus');

});

###################################################################

#########################/End Vendors Routes#######################

###################################################################




###################################################################

######################Start Vendors Routes#########################

###################################################################

Route::group(['prefix'=>'users'],function (){
    Route::get('/','CustomerController@index')->name('admin.users');
    Route::post('/details','CustomerController@userDetails')->name('admin.users.details');
    Route::get('delete','CustomerController@delete')->name('admin.users.delete');
    Route::get('changeStatus','CustomerController@changeStatus')->name('admin.users.changeStatus');

});

###################################################################

#########################/End Vendors Routes#######################

###################################################################



###################################################################

######################Start Orders Routes#########################

###################################################################
Route::group(['prefix'=>'orders'],function (){

    Route::get('/','OrderController@orders')->name('admin.orders');
    Route::post('/details','OrderController@orderDetails')->name('admin.order.details');

});

});


###################################################################

######################Start Orders Routes#########################

###################################################################




###################################################################

#####################Vendor Management Routes#######################

###################################################################

###################################################################

###################Start Vendor Profile Routes######################

###################################################################

Route::group(['prefix'=>'vendor','namespace'=>'Auth'],function (){
    Route::get('/login','LoginController@getVendorLogin')->name('vendor.getlogin');
    Route::get('/getstates','RegisterVendorController@getStates')->name('vendor.register.getstates');
    Route::post('/login','LoginController@vendorLogin')->name('vendor.login');
    Route::get('/register','RegisterVendorController@register')->name('vendor.getregister');
    Route::post('/register','RegisterVendorController@create')->name('vendor.register');


});

Route::get('/vendorpending',function (){
    return view('vendor.pending');
})->name('vendor.pending');
Route::get('/vendorblocked',function (){
    return view('vendor.blocked');
})->name('vendor.blocked');

Route::group(['prefix'=>'vendor','namespace'=>'Vendor'],function (){
    Route::get('/','DashboardController@index')->name('vendor.index');
    Route::get('/profile','DashboardController@getProfile')->name('vendor.getprofile');
    Route::post('/profile','DashboardController@updateProfile')->name('vendor.updateprofile');
    Route::post('/updatephoto','DashboardController@updatephoto')->name('vendor.updatephoto');
    Route::get('/states','DashboardController@getStates')->name('vendor.profile.getstates');
    Route::post('/changepassword','DashboardController@changePassword')->name('vendor.changepassword');
    Route::get('/changestatus','DashboardController@status')->name('vendor.status');


###################################################################

#####################End Admin Profile Routes######################

###################################################################





###################################################################

########################Start Products Routes######################

###################################################################

Route::group(['prefix'=>'products'],function (){
    Route::get('/','ProductController@index')->name('vendor.products'); // get all products for the vendor
    Route::get('create','ProductController@create')->name('vendor.products.create'); // get the product creation view
    Route::post('create','ProductController@store')->name('vendor.products.store'); // store the product data
    Route::get('edit/{id}','ProductController@edit')->name('vendor.products.edit'); // get the product data to edit
    Route::post('update','ProductController@update')->name('vendor.products.update'); // update the product data
    Route::get('delete','ProductController@delete')->name('vendor.products.delete');  //delete the product
    Route::get('changeStatus','ProductController@changeStatus')->name('vendor.products.changeStatus'); // change product status

});

###################################################################

######################End Products Routes##########################

###################################################################




###################################################################

########################Start Categories Routes######################

###################################################################


    Route::group(['prefix'=>'categories'],function (){
        Route::get('/','CategoryController@index')->name('vendor.categories'); // get all products for the vendor
        Route::get('create','CategoryController@create')->name('vendor.categories.create'); // get the product creation view
        Route::post('create','CategoryController@store')->name('vendor.categories.store'); // store the product data
        Route::get('edit/{id}','CategoryController@edit')->name('vendor.categories.edit'); // get the product data to edit
        Route::post('update','CategoryController@update')->name('vendor.categories.update'); // update the product data
        Route::get('delete','CategoryController@delete')->name('vendor.categories.delete');  //delete the product

    });

###################################################################

######################End Categories Routes##########################

###################################################################





###################################################################

########################Start Main Categories Routes######################

###################################################################

Route::group(['prefix'=>'maincategories'],function (){
    Route::get('/','MainCategoryController@index')->name('vendor.maincategories'); // get all products for the vendor
    Route::get('create','MainCategoryController@create')->name('vendor.maincategories.create'); // get the product creation view
    Route::post('create','MainCategoryController@store')->name('vendor.maincategories.store'); // store the product data
    Route::get('delete','MainCategoryController@delete')->name('vendor.maincategories.delete');  //delete the product

});

###################################################################

######################End Main Categories Routes##########################

###################################################################




    ###################################################################

########################Start Orders Routes######################

###################################################################

    Route::group(['prefix'=>'orders'],function (){
        Route::get('/current','OrderController@currentOrders')->name('vendor.orders.current'); // get all products for the vendor
        Route::get('/completed','OrderController@completedOrders')->name('vendor.orders.completed'); // get the product creation view
        Route::get('/cancelled','OrderController@cancelledOrders')->name('vendor.orders.cancelled'); // store the product data
        Route::post('/details','OrderController@orderDetails')->name('vendor.orders.details');  //delete the product
        Route::post('/status','OrderController@orderStatus')->name('vendor.orders.status');  //delete the product

    });

###################################################################

######################End Orders Routes##########################

###################################################################
});





Route::get('/','HomeController@index')->name('welcome');
Route::get('/states','HomeController@getStates')->name('home.getStates');

Route::group(['namespace'=>'Customer'],function (){

    Route::group(['prefix'=>'profile','middleware'=>'auth:web'],function (){
       Route::get('/','ProfileController@index')->name('customer.profile');
       Route::post('/image','ProfileController@image')->name('customer.profile.image');
       Route::post('/update','ProfileController@update')->name('customer.profile.update');
       Route::post('/password','ProfileController@password')->name('customer.profile.password');
    });

    Route::group(['prefix'=>'findrests'],function (){

        Route::get('/','SearchController@findByLocation')->name('find.rests');
        Route::get('/filters','SearchController@filter')->name('find.rests.filters');
    });

    Route::group(['prefix'=>'menu'],function (){

        Route::get('/{id}','MenuController@getRestMenu')->name('menu.rests');

    });

    Route::group(['prefix'=>'cart'],function (){

        Route::post('/','CartController@addItem')->name('cart.add');
        Route::post('/plus','CartController@plusItem')->name('cart.plus');
        Route::post('/minus','CartController@minusItem')->name('cart.minus');
        Route::post('/deleteitem','CartController@deleteItem')->name('cart.deleteitem');
        Route::post('/clear','CartController@clearCart')->name('cart.clear');

    });

    Route::group(['prefix'=>'checkout','middleware'=>'auth:web'],function (){

        Route::post('/','CheckoutController@checkout')->name('checkout');
        Route::get('/order','CheckoutController@order')->name('order');

    });
    Route::group(['prefix'=>'orders','middleware'=>'auth:web'],function (){

        Route::get('/current','OrderController@currentOrders')->name('current.orders');
        Route::get('/previous','OrderController@previousOrders')->name('previous.orders');
        Route::post('/details','OrderController@orderDetails')->name('order.details');
        Route::post('/tracking','OrderController@orderTracking')->name('order.tracking');

    });

});

Route::get('/session',function (){
   session()->remove('cart');
   return redirect()->back();
});

Route::get('test',function (){
    return view('customer.orders.ordertracking');
});


Auth::routes();
