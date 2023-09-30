<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\SupAdminMiddelware;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\OrderController;
use App\Http\Controllers\FrontEnd\CartController;
use App\Http\Controllers\BackEnd\BannerController;
use App\Http\Controllers\BackEnd\CouponController;
use App\Http\Controllers\BackEnd\PayingController;
use App\Http\Controllers\BackEnd\ReturnController;
use App\Http\Controllers\BackEnd\SellerController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\FrontEnd\CoinController;
use App\Http\Controllers\BackEnd\OutOrderController;
use App\Http\Controllers\BackEnd\StaticPageController;
use App\Http\Controllers\BackEnd\SubCategoryController;
use App\Http\Controllers\BackEnd\ShopController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FrontEnd\ReviewController;

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


// Generate the standard authentication routes
Auth::routes(['logout' => false]);

Route::get('/check',  [PayingController::class, 'payment']);
//Product
Route::get('/', [ProductController::class, 'showall'])->name('home');
Route::post('/pp', [ProductController::class, 'store'])->name('store');
Route::get('/proudct/{name}', [ProductController::class, 'proudct'])->name('proudct');
Route::get('shop/{categoryslug?}/{subcategoryslug?}', [ShopController::class, 'index'])->name('shop');
//Cart
Route::get('/cart', [CartController::class,'cart'])->name('cart');
Route::get('/add-to-cart/{x}', [CartController::class,'addtocart'])->name('addtocart');;
Route::get('/cartt', [CartController::class,'cartt']);
Route::get('/add-to-cart/{id}', [CartController::class.'addToCart']);
Route::patch('/update-cart', [CartController::class,'update']);
Route::delete('/remove-from-cart', [CartController::class,'remove']);

Route::get('about_us', [StaticPageController::class, 'about']);
Route::get('privacy', [StaticPageController::class, 'privacy']);
Route::get('concat_us', [StaticPageController::class, 'concat_us']);
Route::get('privacy_return', [StaticPageController::class, 'privacy_return']);
//Order

Route::prefix('/Orders')->middleware(['web', 'auth'])->group(function () {
Route::post('/order',[OrderController::class, 'order'])->name('order');
Route::post('/coupon', [OrderController::class,'addcoupon'])->name('coupon');
Route::post('/add_rate', [OrderController::class,'add_rate'])->name('add_rate');
Route::get('add-review/{name?}/userreview',[ReviewController::class, 'add']);
Route::post('add-reviews',[ReviewController::class,'create_review'])->name('add-reviews');
Route::get('/show/{id}', [OrderController::class, 'show_order_detaeal']);
Route::get('/order/{id}/edit', [OrderController::class, 'edit_order_detaeal'])->name('orders.update');
Route::get('/show_out/{id}',[OrderController::class, 'show_out_order_detaeal']);
Route::post('/order',[OrderController::class, 'order'])->name('order');
Route::post('/coupon', [OrderController::class,'addcoupon'])->name('coupon');
Route::get('my_orders', [OrderController::class, 'my_orders']);});


Route::prefix('dashboard/Order')->middleware(['web', 'isSupAdmin'])->group(function () {
Route::get('/order-details', [OrderController::class,'all_order_detaeal'])->name('order_details.index');
Route::get('/edit/{id}', [OrderController::class, 'edit_order_detail'])->name('order.edit');
Route::put('/update/{id}', [OrderController::class, 'update_order_detaeal'])->name('order.update');
Route::post('/searchorder', [OrderController::class, 'searchorder'])->name('searchorder');
Route::post('/searchbyorder', [OrderController::class, 'searchbyorder'])->name('searchbyorder');
});

//OutOrder
Route::prefix('/Order')->middleware(['web', 'auth'])->group(function () {
Route::get('/out_orders', function () {return view('FrontEnd.out_order');});
Route::get('/show_out/{id?}',[OutOrderController::class, 'show_out_order_detaeal']);
Route::get('/after_out_orders', function () {return view('FrontEnd.after_out_orders');});
Route::get('/my_out_orders', [OutOrderController::class, 'my_out_order'])->middleware('auth');
Route::get('/show_out_m', function () {return view('FrontEnd.my_out_orders');})->name('my_out_orders');
Route::get('/out_orders', function () {return view('FrontEnd.out_order');});
Route::post('/Order_out', [OutOrderController::class,'Order_out'])->name('Order_out');
});

Route::prefix('dashboard/OutOrder')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/orderout-details', [OutOrderController::class,'all_order_detaeal'])->name('order_out_details');
    Route::get('/orderout-edit/{id}', [OutOrderController::class, 'edit_order_detail'])->name('order_out_details.edit');
    Route::put('/orderout-edit/{id}', [OutOrderController::class, 'update_order_detail'])->name('updateOrder');
    Route::post('/search_outorder_admin', [OutOrderController::class, 'search_order'])->name('search.outorder.admin');
    Route::post('/search_outorders', [OutOrderController::class, 'search_outorders'])->name('search_outorders.admin');
    });
//Returns
Route::prefix('/returns')->middleware(['web', 'auth'])->group(function () {
Route::get('/create/{id}', [ReturnController::class, 'create'])->name('FrontEnd.Return.Create');
Route::post('/return_order', [ReturnController::class, 'store'])->name('FrontEnd.Return.Store');
Route::get('/return_orders/{id}', [ReturnController::class, 'my_returns'])->name('FrontEnd.Show');
Route::get('/myindex', [ReturnController::class, 'index_show'])->name('FrontEnd.Index');
});


/** Sup-Admin */
Route::get('/dashboard', function () {
    return view('BackEnd.Admin.Index');
})->name('Dashboard')
    ->middleware(['web', 'isSupAdmin']);

Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('dashboard/Product')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('Product.Index');
    Route::get('/Create', [ProductController::class, 'create'])->name('Product.Create');
    Route::post('/Create', [ProductController::class, 'store'])->name('Product.Store');
    Route::get('/Edit/{id}/edit', [ProductController::class, 'edit'])->name('Product.Edit');
    Route::put('/Edit/{id}', [ProductController::class, 'update'])->name('Product.Update');
    Route::delete('/Destroy/{id}', [ProductController::class, 'destroy'])->name('Product.Destroy');
    Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
    Route::post('/searchall', [ProductController::class, 'search'])->name('searchall');
});

Route::prefix('dashboard/Category')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('Category.Index');
    Route::get('/Create', [CategoryController::class, 'create'])->name('Category.Create');
    Route::post('/Create', [CategoryController::class, 'store'])->name('Category.Store');
    Route::get('/Edit/{id}/edit', [CategoryController::class, 'edit'])->name('Category.Edit');
    Route::put('/Edit/{id}', [CategoryController::class, 'update'])->name('Category.Update');
    Route::delete('/Destroy/{id}', [CategoryController::class, 'destroy'])->name('Category.Destroy');
});
Route::prefix('dashboard/Subcategory')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/',[SubCategoryController::class, 'index'])->name('Subcategory.Index');
    Route::get('/Create', [SubCategoryController::class, 'create'])->name('Subcategory.Create');
    Route::post('/Create', [SubCategoryController::class, 'store'])->name('Subcategory.Store');
    Route::get('/Edit/{id}', [SubCategoryController::class, 'edit'])->name('Subcategory.Edit');
    Route::put('/Edit/{id}', [SubCategoryController::class, 'update'])->name('Subcategory.Update');
    Route::delete('/Destroy/{id}', [SubCategoryController::class, 'destroy'])->name('Subcategory.Destroy');
    });

Route::prefix('dashboard/Coupon')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [CouponController::class, 'index'])->name('Coupon.Index');
    Route::get('/Create', [CouponController::class, 'create'])->name('Coupon.Create');
    Route::post('/Create', [CouponController::class, 'store'])->name('Coupon.Store');
    Route::get('/Edit/{id}', [CouponController::class, 'edit'])->name('Coupon.Edit');
    Route::put('/Edit/{id}', [CouponController::class, 'update'])->name('Coupon.Update');
    Route::delete('/Destroy/{id}', [CouponController::class, 'destroy'])->name('Coupon.Destroy');
});

Route::prefix('dashboard/Paying')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [PayingController::class, 'index'])->name('Paying.Index');
    Route::get('/Create', [PayingController::class, 'create'])->name('Paying.Create');
    Route::post('/Create', [PayingController::class, 'store'])->name('Paying.Store');
    Route::get('/Edit/{id}', [PayingController::class, 'edit'])->name('Paying.Edit');
    Route::put('/Edit/{id}', [PayingController::class, 'update'])->name('Paying.Update');
    Route::post('/Destroy/{id}', [PayingController::class, 'destroy'])->name('Paying.Destroy');
});

Route::prefix('dashboard/Banner')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [BannerController::class, 'index'])->name('Banner.Index');
    Route::get('/Create', [BannerController::class, 'create'])->name('Banner.Create');
    Route::post('/Create', [BannerController::class, 'store'])->name('Banner.Store');
    Route::get('/Edit/{id}', [BannerController::class, 'edit'])->name('Banner.Edit');
    Route::put('/Edit/{id}', [BannerController::class, 'update'])->name('Banner.Update');
    Route::delete('/Destroy/{id}', [BannerController::class, 'destroy'])->name('Banner.Destroy');
});

Route::prefix('dashboard/Seller')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [SellerController::class, 'index'])->name('Seller.Index');
    Route::get('/Create', [SellerController::class, 'create'])->name('Seller.Create');
    Route::post('/Create', [SellerController::class, 'store'])->name('Seller.Store');
    Route::get('/Edit/{id}', [SellerController::class, 'edit'])->name('Seller.Edit');
    Route::put('/Edit/{id}', [SellerController::class, 'update'])->name('Seller.Update');
    Route::delete('/Destroy/{id}', [SellerController::class, 'destroy'])->name('Seller.Destroy');
    Route::get('/sellerdetail/{id}', [SellerController::class, 'index_detail'])->name('Seller.Detail');
    
});

Route::prefix('dashboard/User')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('User.Index');
    Route::get('/Edit/{id}', [UserController::class, 'edit'])->name('User.Edit');
    Route::put('/Edit/{id}', [UserController::class, 'update'])->name('User.Update');
});

Route::prefix('dashboard/Return')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/returns', [ReturnController::class, 'index'])->name('BackEnd.Return.Index');
    Route::get('/returns/{id}/edit', [ReturnController::class, 'edit'])->name('BackEnd.Return.Edit');
    Route::put('/returns/{id}', [ReturnController::class,'update'])->name('BackEnd.Return.Update');
    Route::post('/search_orders', [OrderController::class,'search_orders'])->name('search.order.admin');
    Route::post('/search_return', [ReturnController::class,'search_return'])->name('search.return');
});

//StaticPage
Route::prefix('dashboard/static')->middleware(['web', 'isSupAdmin'])->group(function () {
//Route::get('/static_pages/create', [StaticPageController::class, 'create'])->name('static_pages.create');
//Route::post('/static_pages', [StaticPageController::class, 'store'])->name('static_pages.store');
Route::get('/static_pages/{static_page}/edit', [StaticPageController::class, 'edit'])->name('static_pages.edit');
Route::put('/static_pages/{static_page}', [StaticPageController::class, 'update'])->name('static_pages.update');
Route::get('/static_pages', [StaticPageController::class, 'index'])->name('static_pages.index');
});

//Coins
Route::prefix('dashboard/Coin')->middleware(['web', 'isSupAdmin'])->group(function () {
    Route::get('/', [CoinController::class, 'coin'])->name('coin.index');
    Route::get('/add_coin', [CoinController::class, 'create'])->name('coin.create');
    Route::post('/add_coin', [CoinController::class,'add_coin'])->name('add_coin');
    Route::get('/edit/{id}/edit_coin', [CoinController::class, 'edit'])->name('coin.edit');
    Route::put('/edit_coin/{id}', [CoinController::class, 'update_coin'])->name('edit_coin');
    Route::get('/coins/{id?}', [CoinController::class, 'coins']);
    Route::delete('/destroy/{id}', [CoinController::class, 'destroy'])->name('coin.destroy');
    });

/** Admin Route */
Route::get('/dashboard/service', function () {
    return view('BackEnd.User.Index');
})->name('DashboardService')
    ->middleware(['web', 'isAdmin']);

Route::prefix('dashboard/service')->middleware(['web', 'isAdmin'])->group(function () {
    Route::get('/products', [ProductController::class, 'index_service'])->name('Product.Show');
    Route::post('/searchuser', [ProductController::class, 'search_user'])->name('searchuser');
});

Route::prefix('dashboard/service/Seller')->middleware(['web', 'isAdmin'])->group(function () {
    Route::get('/sellerdetailuser/{id}', [SellerController::class, 'index_detail_user'])->name('Seller.Detail.User');
    Route::get('/seller', [SellerController::class, 'index_user'])->name('Seller.Show');
});
Route::prefix('dashboard/service/Return')->middleware(['web', 'isAdmin'])->group(function () {
    Route::get('/return', [ReturnController::class, 'index_user'])->name('User.Return.Index');
    Route::get('/return/{id}/edit', [ReturnController::class, 'edit_user'])->name('User.Return.Edit');
    Route::put('/return/{id}', [ReturnController::class, 'update_user'])->name('User.Return.Update');
    Route::post('/search_ret', [ReturnController::class, 'search_orders'])->name('User.search.return');
    });
Route::prefix('dashboard/service/OutOrder')->middleware(['web', 'isAdmin'])->group(function () {
        Route::get('/orderout-details', [OutOrderController::class,'all_order_user'])->name('User.order_out_details');
        Route::get('/orderout-edit/{id}', [OutOrderController::class, 'edit_order_user'])->name('User.order_out_details.edit');
        Route::put('/orderout-edit/{id}', [OutOrderController::class, 'update_order_user'])->name('User.updateOrder');
        Route::post('/search_outorder', [OutOrderController::class, 'search_orders'])->name('search.outorder.user');
        Route::post('/search_for_outorder', [OutOrderController::class, 'search_for_outorder'])->name('search_for_outorder');
        });
        Route::prefix('dashboard/service/Order')->middleware(['web', 'isAdmin'])->group(function () {
            Route::get('/order-details', [OrderController::class,'all_order_user'])->name('User.order_details.index');
            Route::get('/edit/{id}', [OrderController::class, 'edit_order_user'])->name('edit_order_user');
            Route::put('/update/{id}', [OrderController::class, 'update_order_user'])->name('update_order_user');
            Route::post('/search_order', [OrderController::class, 'search_order'])->name('search.order.user');
            Route::post('/searchfororder', [OrderController::class, 'searchfororder'])->name('searchfororder');
            });