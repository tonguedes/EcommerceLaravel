<?php
use App\Http\Controllers\Admin\USerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();



Route::get('/', [FrontendController::class, 'index'])->name('index');
Route::get('/collections', [FrontendController::class, 'categories']);
Route::get('/collections/{category_slug}', [FrontendController::class, 'products']);
Route::get('/collections/{category_slug}/{product_slug}', [FrontendController::class, 'productView']);


Route::get('/new-arrivals',[FrontendController::class, 'newArrival']);
Route::get('/featured-products',[FrontendController::class, 'featuredProducts']);

Route::get('search',[FrontendController::class, 'searchProducts']);


Route::middleware(['auth'])->group(function (){

    Route::get('wishlist',[WishlistController::class,'index']);
    Route::get('cart',[CartController::class,'index']);
    Route::get('checkout',[CheckoutController::class,'index']);

    Route::get('orders',[OrderController::class,'index']);
    Route::get('orders/{order_id}',[OrderController::class,'show']);

    Route::get('profile',[App\Http\Controllers\Frontend\UserController::class,'index']);
    Route::post('profile',[App\Http\Controllers\Frontend\UserController::class,'updateUserDetails']);

});


Route::get('thank-you',[FrontendController::class, 'thankyou']);



//Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);
    Route::get('/brands', App\Livewire\Admin\Brand\Index::class);

    Route::get('settings',[SettingController::class, 'index']);
    Route::post('settings',[SettingController::class, 'store']);

    Route::controller(SliderController::class)->group(function () {
        Route::get('sliders', 'index');
        Route::get('sliders/create', 'create');
        Route::post('sliders/create', 'store');
        Route::get('sliders/{slider}/edit', 'edit');
        Route::put('sliders/{slider}', 'update');
        Route::get('sliders/{slider}/delete', 'destroy');

    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/category', 'index');
        Route::get('/category/create', 'create');
        Route::post('/category', 'store');
        Route::get('/category/{category}/edit', 'edit');
        Route::put('/category/{category}', 'update');

    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::get('/products/create', 'create');
        Route::post('/products', 'store');
        Route::get('/products/{product}/edit', 'edit');
        Route::put('/products/{product}', 'update');
        Route::get('products/{product_id}/delete', 'destroy');
        Route::put('/product-image/{product_image_id}/delete', 'destroyImage');

        Route::post('product-color/{prod_color_id}', 'updateProdColorQty');
        Route::get('product-color/{product_color_id}/delete', 'deleteprodColor');

    });

    Route::controller(ColorController::class)->group(function () {
        Route::get('/colors', 'index');
        Route::get('/colors/create', 'create');
        Route::post('/colors/create', 'store');
        Route::get('/colors/{color}/edit', 'edit');
        Route::put('/colors/{color_id}', 'update');
        Route::get('/colors/{color}/delete', 'destroy');
    });

    //admin/orders
    Route::controller(\App\Http\Controllers\Admin\OrdersController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::get('/orders/{order_Id}', 'show');
        Route::put('/orders/{order_Id}', 'updateOrderStatus');

        Route::get('/invoice/{order_Id}', 'viewInvoice');
        Route::get('/invoice/{order_Id}/generate', 'generateInvoice');



    });

    Route::controller(\App\Http\Controllers\Admin\USerController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('/users/{user_id}/edit', 'edit');
        Route::put('/users/{user_id}', 'update');
        Route::get('/users/{user_id}/delete', 'destroy');

    });



    //Route::get('category',[CategoryController::class, 'index']);
    //Route::get('category/create',[CategoryController::class, 'create']);
    //Route::post('category',[CategoryController::class, 'store']);


});
