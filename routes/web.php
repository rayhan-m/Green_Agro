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
    return view('auth.login');
});

Auth::routes();


Route::group(['prefix' => 'admin','middleware'=>['auth','admin']], function () {
    Route::get('dashboard', 'BackEndController@Dashboard')->name('admin.dashboard');
    Route::get('general-setting', 'GeneralSettingController@index')->name('general_setting');
    Route::POST('update-general-setting', 'GeneralSettingController@update')->name('update-general-setting');
    Route::POST('update-logo', 'GeneralSettingController@updateLogo')->name('update-logo');
    Route::POST('update-fav', 'GeneralSettingController@updateFav')->name('update-fav');

// Seller routes 
    Route::get('seller', 'SellerController@index')->name('seller');
    Route::POST('seller', 'SellerController@store')->name('seller_submit');
    Route::POST('seller-update', 'SellerController@update')->name('seller_update');
    Route::get('seller-delete/{id}', 'SellerController@destroy');
// Buyer routes 
    Route::get('buyer', 'BuyerController@index')->name('buyer');
    Route::POST('buyer', 'BuyerController@store')->name('buyer_submit');
    Route::POST('buyer-update', 'BuyerController@update')->name('buyer_update');
    Route::get('buyer-delete/{id}', 'BuyerController@destroy');

// Seller routes 
    Route::get('bread', 'BreadController@index')->name('bread');
    Route::POST('bread', 'BreadController@store')->name('bread_submit');
    Route::POST('bread-update', 'BreadController@update')->name('bread_update');
    Route::get('bread-delete/{id}', 'BreadController@destroy');
// Cow Routes 
    Route::get('cow-list', 'CowController@index')->name('cow_list');
    Route::get('add-cow', 'CowController@create')->name('add_cow');
    Route::post('add-cow', 'CowController@store')->name('cow_create');
    Route::get('edit-cow/{id}', 'CowController@edit');
    Route::get('cow-delete/{id}', 'CowController@destroy');
    Route::post('update-cow', 'CowController@update')->name('update_cow');
    Route::get('view-active-cow/{id}', 'CowController@showActiveCow');
    Route::get('view-sold-cow/{id}', 'CowController@showSoldCow');
// sell cow 
    Route::get('sell-cow', 'CowController@sellCow')->name('sell_cow');
    Route::post('cow-info', 'CowController@CowInfo');   
    Route::post('sell-cow', 'CowController@sellCowSubmit')->name('sell_cow_submit');
    
// Milk Routes 
    Route::get('milk-stock', 'MilkController@MilkStock')->name('milk_stock');
    Route::get('collect-milk', 'MilkController@CollectMilk')->name('collect_milk');
    Route::post('collect-milk', 'MilkController@CollectMilkStore')->name('collect_milk_submit');
    Route::get('milk-stock-updated/{id}/{quantity}', 'MilkController@MilkStockUpdated');
    Route::get('collect-milk-active/{id}', 'MilkController@');
    Route::get('collect-milk-delete/{id}', 'MilkController@destroy');
    Route::post('collect-milk-update', 'MilkController@CollectMilkUpdate');

    // Milk Buyer routes 
    Route::get('milk-buyer', 'MilkBuyerController@index')->name('milk_buyer');
    Route::POST('milk-buyer', 'MilkBuyerController@store')->name('milk_buyer_submit');
    Route::POST('milk-buyer-update', 'MilkBuyerController@update')->name('milk_buyer_update');
    Route::get('milk-buyer-delete/{id}', 'MilkBuyerController@destroy');
    // Sell milks routes 
    Route::get('sell-milk', 'SellMilkController@index')->name('sell_milk');
    Route::POST('sell-milk', 'SellMilkController@store')->name('sell_milk_submit');
    Route::POST('sell-milk-update', 'SellMilkController@update')->name('sell_milk_update');
    Route::get('sell-milk-delete/{id}', 'SellMilkController@destroy');
    Route::get('milk-stock-reduce/{id}/{quantity}', 'SellMilkController@MilkStockReduce');

    // Food Category Routes
    Route::get('food-category', 'FoodCategoryController@FoodCategory')->name('food.category');
    Route::POST('food-category', 'FoodCategoryController@FoodCategoryStore')->name('food_category_submit');
    Route::get('category-active/{id}', 'FoodCategoryController@FoodCategoryActive');
    Route::get('category-deactive/{id}', 'FoodCategoryController@FoodCategoryDeactive');
    Route::get('category-delete/{id}', 'FoodCategoryController@FoodCategoryDelete');
    Route::post('category-update', 'FoodCategoryController@FoodCategoryUpdate');
    // Product Routes
    Route::get('food', 'FoodController@FoodList')->name('food');
    Route::POST('food', 'FoodController@FoodStore')->name('food_submit');
    Route::get('food-active/{id}', 'FoodController@FoodActive');
    Route::get('food-deactive/{id}', 'FoodController@FoodDeactive');
    Route::get('food-delete/{id}', 'FoodController@FoodDelete');
    Route::post('food-update', 'FoodController@FoodUpdate');

    // Buy Food Routes
    Route::get('buy-food', 'BuyFoodController@BuyFoodList')->name('buy_food');
    Route::POST('buy-food', 'BuyFoodController@BuyFoodStore')->name('buy_food_submit');
    Route::post('buy-food-update', 'BuyFoodController@BuyFoodUpdate');
    Route::get('buy-food-delete/{id}', 'BuyFoodController@BuyFoodDelete');
    Route::get('food-stock-updated/{id}/{product_id}/{quantity}', 'BuyFoodController@FoodStockUpdated');

    Route::get('food-stock', 'FoodController@FoodStock')->name('food_stock');

    // Feed Food Route
    
    Route::get('feed-food', 'FeedFoodController@index')->name('feed_food');
    Route::get('add-feed-food', 'FeedFoodController@create')->name('add_feed_food');
    Route::post('add-feed-food', 'FeedFoodController@store')->name('feed_food_create');
    Route::get('get-food-item', 'FeedFoodController@getFoodItem');
    Route::get('feed-food-delete/{id}', 'FeedFoodController@FeedFoodDelete');
    Route::get('feed-food-updated/{id}', 'FeedFoodController@FeedFoodStockUpdated');

    // Staff Route
    
    Route::get('staff-list', 'StaffController@index')->name('staff_list');
    Route::get('add-staff', 'StaffController@create')->name('add_staff');
    Route::post('add-staff', 'StaffController@store')->name('staff_create');
    Route::get('edit-staff/{id}', 'StaffController@edit');
    Route::get('staff-delete/{id}', 'StaffController@destroy');
    Route::post('update-staff', 'StaffController@update')->name('staff_update');
    Route::get('view-staff/{id}', 'StaffController@show');

    // Staff Payment Route 
    Route::get('staff-payment', 'StaffPaymentController@StaffPayment')->name('staff_payment');
    Route::post('staff-payment-create', 'StaffPaymentController@StaffInfo');
    Route::get('staff-payment-create', 'StaffPaymentController@StaffPaymentCreate')->name('staff_payment_create');
    Route::POST('staff-payment', 'StaffPaymentController@StaffPaymentStore')->name('staff_payment_submit');
    Route::get('staff-payment-delete/{id}', 'StaffPaymentController@StaffPaymentDelete');
    Route::get('staff-payment-active/{id}', 'StaffPaymentController@StaffPaymentActive');
    Route::get('staff-payment-deactive/{id}', 'StaffPaymentController@StaffPaymentDeactive');
    
    // Milk Payment Route 
    Route::get('milk-payment', 'MilkPaymentController@MilkPayment')->name('milk_payment');
    Route::post('milk-payment-create', 'MilkPaymentController@MilkInfo');
    Route::get('milk-payment-create', 'MilkPaymentController@MilkPaymentCreate')->name('milk_payment_create');
    Route::POST('milk-payment', 'MilkPaymentController@MilkPaymentStore')->name('milk_payment_submit');
    Route::get('milk-payment-delete/{id}', 'MilkPaymentController@MilkPaymentDelete');
    Route::get('milk-payment-active/{id}', 'MilkPaymentController@MilkPaymentActive');
    Route::get('milk-payment-deactive/{id}', 'MilkPaymentController@MilkPaymentDeactive');

    // Inoice
    Route::get('invoice/{id}', 'MilkPaymentController@Invoice');

        // Report Routes 
    Route::post('sell-report', 'ReportController@SellReport')->name('sell_report');
    Route::get('sell-report-search', 'ReportController@SellReportSearch')->name('sell_report_search');

    Route::post('cow-sell-report', 'ReportController@CowSellReport')->name('cow_sell_report');
    Route::get('cow-sell-report-search', 'ReportController@CowSellReportSearch')->name('cow_sell_report_search');

    Route::post('expense-report', 'ReportController@ExpenseReport')->name('expense_report');
    Route::get('expense-report-search', 'ReportController@ExpenseReportSearch')->name('expense_report_search');
    
    Route::get('income-summery-search', 'ReportController@IncomeSummerySearch')->name('income_summery_search');
    Route::post('income-summery', 'ReportController@IncomeSummery')->name('income_summery');

    // Expenses Type Routes
    Route::get('expense-type', 'ExpenseController@ExpenseType')->name('expense_type');
    Route::POST('expense-type', 'ExpenseController@ExpenseTypeStore')->name('expense_type_submit');
    Route::get('expense-type-active/{id}', 'ExpenseController@ExpenseTypeActive');
    Route::get('expense-type-deactive/{id}', 'ExpenseController@ExpenseTypeDeactive');
    Route::get('expense-type-delete/{id}', 'ExpenseController@ExpenseTypeDelete');
    Route::post('expense-type-update', 'ExpenseController@ExpenseTypeUpdate');

    // Expenses Routes
    Route::get('expenses', 'ExpenseController@Expenses')->name('expenses');
    Route::POST('expenses', 'ExpenseController@ExpensesStore')->name('expenses_submit');
    Route::get('expenses-active/{id}', 'ExpenseController@ExpensesActive');
    Route::get('expenses-deactive/{id}', 'ExpenseController@ExpensesDeactive');
    Route::get('expenses-delete/{id}', 'ExpenseController@ExpensesDelete');
    Route::post('expenses-update', 'ExpenseController@ExpensesUpdate');

    // Profile 
    Route::get('profile', 'GeneralSettingController@Profile');
    Route::POST('update-profile-image', 'GeneralSettingController@updateprofileImage')->name('update-profile-image');
    Route::POST('update-profile-info', 'GeneralSettingController@updateprofileInfo')->name('update-profile-info');
    Route::post('change-pass', 'GeneralSettingController@passwordUpdate');

    

});
Route::group(['prefix' => 'customer','middleware'=>['auth','customer']], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});