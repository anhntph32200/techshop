<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChipController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RamController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\view\DonHangController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DonHangController as DonHangController2;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\view\UseradminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromotionUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\WishlistItemController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register'])->name('register.post');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'Login'])->name('login.post');
Route::post('logout', [LoginController::class, 'Logout'])->name('logout');

// Hiển thị form yêu cầu quên mật khẩu
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
// Gửi email đặt lại mật khẩu
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
// Hiển thị form đặt lại mật khẩu
Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
// Xử lý đặt lại mật khẩu
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
// Các route yêu cầu quyền admin
Route::group(['middleware' => ['admin']], function () {

    Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
    Route::post('users/update', [UseradminController::class, 'update'])->name('users.update');


    Route::get('admin/users', [UseradminController::class, 'index'])->name('admin.users'); // Quản lý người dùng

    Route::resource('promotions', PromotionController::class);

    Route::resource('admin/pages/categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
});


//Profile
Route::get('/admin/pages/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/user/account', [ProfileController::class, 'account'])->name('user.profile')->middleware('auth');
Route::get('/user/edit', [ProfileController::class, 'edit'])->name('user.edit_profile')->middleware('auth');
Route::put('/user/update', [ProfileController::class, 'update'])->name('user.update')->middleware('auth');


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [UserController::class, 'index'])->name('index');
// Danh sách người dùng
Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/subcategories/{subCategory}', [UserController::class, 'showSubCategories'])->name('subcategories');
        Route::get('/filter', [UserController::class, 'filter'])->name('filter');
        Route::get('/products/{id}', [UserController::class, 'show'])->name('products.show');
    });

// Admin routes for product and attribute management
Route::prefix('admins')
    ->middleware(['auth', 'admin'])
    ->as('admins.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'Dashboard']);
        Route::post('/fillterDate', [DashboardController::class, 'Dashboard'])->name('fillterDate');
        Route::post('/fillterYear', [DashboardController::class, 'Dashboard'])->name('fillterYear');

        Route::prefix('products')
            ->as('products.')
            ->group(function () {
                Route::get('/', [ProductController::class, 'index'])->name('index');
                Route::get('/create', [ProductController::class, 'create'])->name('create');
                Route::post('/store', [ProductController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [ProductController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [ProductController::class, 'destroy'])->name('destroy');
                Route::get('/{id}', [ProductController::class, 'show'])->name('show');
            });

        Route::prefix('chips')
            ->as('chips.')
            ->group(function () {
                Route::get('/', [ChipController::class, 'index'])->name('index');
                Route::get('/create', [ChipController::class, 'create'])->name('create');
                Route::post('/store', [ChipController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ChipController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [ChipController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [ChipController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('rams')
            ->as('rams.')
            ->group(function () {
                Route::get('/', [RamController::class, 'index'])->name('index');
                Route::get('/create', [RamController::class, 'create'])->name('create');
                Route::post('/store', [RamController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [RamController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [RamController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [RamController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('storages')
            ->as('storages.')
            ->group(function () {
                Route::get('/', [StorageController::class, 'index'])->name('index');
                Route::get('/create', [StorageController::class, 'create'])->name('create');
                Route::post('/store', [StorageController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [StorageController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [StorageController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [StorageController::class, 'destroy'])->name('destroy');
            });

        Route::prefix('orders')
            ->as('orders.')
            ->group(function () {
                Route::get('/', [DonHangController::class, 'index'])->name('index');
                Route::get('/create', [DonHangController::class, 'create'])->name('create');
                Route::post('/store', [DonHangController::class, 'store'])->name('store');
                Route::get('/show/{id}', [DonHangController::class, 'show'])->name('show');
                Route::get('/{id}/edit', [DonHangController::class, 'edit'])->name('edit');
                Route::put('/{id}/update', [DonHangController::class, 'update'])->name('update');
                Route::delete('/{id}/destroy', [DonHangController::class, 'destroy'])->name('destroy');
            });
    });

// Cart routes (user)
Route::prefix('cart')
    ->as('cart.')
    ->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('/create', [CartController::class, 'create'])->name('create');
        Route::post('/store', [CartController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CartController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CartController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy', [CartController::class, 'destroy'])->name('destroy');
        Route::get('/myorder', [DonHangController2::class, 'index'])->name('myorder');
        Route::put('/editOrder/{id}', [DonHangController2::class, 'editOrder'])->name('editOrder');
        Route::get('/myordetail/{id}', [DonHangController2::class, 'myordetail'])->name('myordetail');
    });

// Hiển thị trang checkout
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/checkout/place', [OrderController::class, 'placeOrder'])->name('checkout.place');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.detail');


Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
Route::get('/vnpay_return', [OrderController::class, 'vnpayReturn'])->name('vnpay.return');
Route::post('/momo/ipn', [OrderController::class, 'ipn'])->name('order.ipn');
//Review

Route::middleware(['auth'])->group(function () {
    // Route cho người dùng bình thường tạo review
    Route::get('product/{productId}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('reviews/store/{product}', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Route quản lý review trong admin
    Route::get('/reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('admin.reviews.destroy');
    Route::patch('admin/reviews/{id}/toggle', [ReviewController::class, 'toggleVisibility'])->name('admin.reviews.toggleVisibility');
});

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

//Tin tức
Route::resource('news', NewsController::class);
Route::prefix('tins')->as('tins.')->group(function () {
    Route::get('/', [UserNewsController::class, 'index'])->name('index');
    Route::get('/{id}', [UserNewsController::class, 'show'])->name('show');
});
Route::get('/tins', [UserNewsController::class, 'index'])->name('tins.index');

Route::get('/cart-header', [CartController::class, 'getCartHeader'])->name('cart.header');


// sp yêu thích
Route::middleware(['auth'])->group(function () {
    Route::get('/wishlist', [WishlistItemController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', [WishlistItemController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{productId}', [WishlistItemController::class, 'removeFromWishlist'])->name('wishlist.remove');
});

Route::get('/admin/orders', [DonHangController::class, 'index'])->middleware('admin')->name('admins.orders.index');


// Giới thiệu
Route::get('/about', function () {
    return view('user.pages.about');
});
// Chính sách bảo mật và điều khoản
Route::get('/terms', function () {
    return view('user.pages.terms_condition');
});
Route::get('/contact', function () {
    return view('user.pages.contact');
});

Route::get('/promotion', [PromotionUserController::class, 'index'])->name('promotion');
