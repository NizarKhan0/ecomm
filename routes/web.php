<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\CompareController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ActiveUserController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorOrderController;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\VendorProductController;

//Homepage
// Route::get('/', function () {
//     return view('frontend.index');
// });


// Route::get('/', [IndexController::class, 'Index']);

Route::controller(IndexController::class)->group(function(){

    Route::get('/' , 'Index');
    Route::post('/search' , 'ProductSearch')->name('product.search');
    Route::post('/search-product' , 'SearchProduct');
   });

//Auth
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'VendorRegister'])->name('vendor.register');



Route::middleware(['auth'])->group(function () {

    //User Routes
    Route::post('/user/logout', [UserController::class, 'UserDestroy'])->name('user.logout');
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::put('/user/profile/update', [UserController::class, 'UserProfileUpdate'])->name('user.profile.update');
    Route::patch('/update/change/password', [UserController::class, 'UserUpdateChangePassword'])->name('user.password.update');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'role:admin'])->group(function () {

    //Admin Routes
    Route::post('/admin/logout', [AdminController::class, 'AdminDestroy'])->name('admin.logout');
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name(('admin.profile'));
    Route::put('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::put('/admin/change/password', [AdminController::class, 'AdminUpdateChangePassword'])->name('admin.password.update');

    //All Brand Routes
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::put('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::delete('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    //All Category Routes
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::put('/update/category', 'UpdateCategory')->name('update.category');
        Route::delete('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    //All SubCategory Routes
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/sub-category', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/sub-category', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/sub-category', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/sub-category/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::put('/update/sub-category', 'UpdateSubCategory')->name('update.subcategory');
        Route::delete('/delete/sub-category/{id}', 'DeleteSubCategory')->name('delete.subcategory');

        Route::get('/subcategory/ajax/{category_id}', 'GetSubCategory');
    });

    //All Manage Vendor Routes
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');

        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::patch('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');

        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::patch('/inactive/vendor/approve', 'InactiveVendorApprove')->name('inactive.vendor.approve');
    });

    //All Product Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'AllProduct')->name('all.product');
        Route::get('/add/product', 'AddProduct')->name('add.product');
        Route::post('/store/product', 'StoreProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
        Route::put('/update/product', 'UpdateProduct')->name('update.product');
        Route::delete('/delete/product/{id}', 'DeleteProduct')->name('delete.product');


        // For Product Stock
        Route::get('/product/stock', 'ProductStock')->name('product.stock');


        Route::patch('/update/product/thumbnail', 'UpdateProductThumbnail')->name('update.product.thumbnail');
        Route::patch('/update/product/multiimage', 'UpdateProductMultiImage')->name('update.product.multi.image');
        Route::get('/delete/product/multiimage/{id}', 'MultiImageDelete')->name('delete.product.multi.image');

        Route::get('inactive/product/{id}', 'InactiveProduct')->name('inactive.product');
        Route::get('active/product/{id}', 'ActiveProduct')->name('active.product');
    });


    //All Slider Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::put('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::delete('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    //All Banner Routes
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::put('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::delete('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    //All Coupon Routes
    Route::controller(CouponController::class)->group(function () {
        Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
        Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
        Route::post('/store/coupon', 'StoreCoupon')->name('store.coupon');
        Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
        Route::put('/update/coupon', 'UpdateCoupon')->name('update.coupon');
        Route::delete('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
    });

    //All Shipping Area Routes
    Route::controller(ShippingAreaController::class)->group(function () {
        Route::get('/all/division', 'AllDivision')->name('all.division');
        Route::get('/add/division', 'AddDivision')->name('add.division');
        Route::post('/store/division', 'StoreDivision')->name('store.division');
        Route::get('/edit/division/{id}', 'EditDivision')->name('edit.division');
        Route::put('/update/division', 'UpdateDivision')->name('update.division');
        Route::delete('/delete/division/{id}', 'DeleteDivision')->name('delete.division');

        Route::get('/all/district', 'AllDistrict')->name('all.district');
        Route::get('/add/district', 'AddDistrict')->name('add.district');
        Route::post('/store/district', 'StoreDistrict')->name('store.district');
        Route::get('/edit/district/{id}', 'EditDistrict')->name('edit.district');
        Route::put('/update/district', 'UpdateDistrict')->name('update.district');
        Route::delete('/delete/district/{id}', 'DeleteDistrict')->name('delete.district');
        Route::get('/district/ajax/{division_id}', 'GetDistrict');

        Route::get('/all/state', 'AllState')->name('all.state');
        Route::get('/add/state', 'AddState')->name('add.state');
        Route::post('/store/state', 'StoreState')->name('store.state');
        Route::get('/edit/state/{id}', 'EditState')->name('edit.state');
        Route::put('/update/state', 'UpdateState')->name('update.state');
        Route::delete('/delete/state/{id}', 'DeleteState')->name('delete.state');
    });
});


Route::middleware(['auth', 'role:vendor'])->group(function () {

    //Vendor Routes
    Route::post('/vendor/logout', [VendorController::class, 'VendorDestroy'])->name('vendor.logout');
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/profile', [VendorController::class, 'VendorProfile'])->name('vendor.profile');
    Route::put('/vendor/profile/store', [VendorController::class, 'VendorProfileStore'])->name('vendor.profile.store');
    Route::get('/Vendor/change/password', [VendorController::class, 'VendorChangePassword'])->name('vendor.change.password');
    Route::put('/update/change/password', [VendorController::class, 'VendorUpdateChangePassword'])->name('vendor.change.password.update');

    //All Product Routes
    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::put('/vendor/update/product', 'VendorUpdateProduct')->name('vendor.update.product');
        Route::delete('/vendor/delete/product/{id}', 'VendorDeleteProduct')->name('vendor.delete.product');

        Route::get('/vendor/inactive/product/{id}', 'VendorInactiveProduct')->name('vendor.inactive.product');
        Route::get('/vendor/active/product/{id}', 'VendorActiveProduct')->name('vendor.active.product');

        Route::patch('/vendor/update/product/thumbnail', 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');
        Route::patch('/vendor/update/product/multiimage', 'VendorUpdateProductMultiImage')->name('vendor.update.product.multi.image');
        Route::get('/vendor/delete/product/multiimage/{id}', 'VendorMultiImageDelete')->name('vendor.delete.product.multi.image');


        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubCategory');
    });
});

//Frontend Product Details All Routes
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);

Route::get('/vendor/details/{id}', [IndexController::class, 'VendorDetails'])->name('vendor.details');

Route::get('/vendor/all', [IndexController::class, 'VendorAll'])->name('vendor.all');

Route::get('/product/category/{id}/{slug}', [IndexController::class, 'CatWiseProduct']);

Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);

//Product View Modal
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

// Get Data from mini Cart
Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
/// Add to cart store data For Product Details Page
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);

//Add To WishList
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);

//Checkout Route
Route::controller(CheckoutController::class)->group(function () {
    Route::get('/district-get/ajax/{division_id}', 'DistrictGetAjax');
    Route::get('/state-get/ajax/{districts_id}', 'StateGetAjax');
    Route::post('/checkout/store', 'CheckoutStore')->name('checkout.store');
});


// Stripe All Route
Route::controller(StripeController::class)->group(function () {
    Route::post('/stripe/order', 'StripeOrder')->name('stripe.order');
    Route::post('/cash/order', 'CashOrder')->name('cash.order');
});

// Admin Order All Route
Route::controller(OrderController::class)->group(function () {
    Route::get('/pending/order', 'PendingOrder')->name('pending.order');
    Route::get('/admin/order/details/{order_id}', 'AdminOrderDetails')->name('admin.order.details');
    Route::get('/admin/confirmed/order', 'AdminConfirmedOrder')->name('admin.confirmed.order');
    Route::get('/admin/processing/order', 'AdminProcessingOrder')->name('admin.processing.order');
    Route::get('/admin/delivered/order', 'AdminDeliveredOrder')->name('admin.delivered.order');
    Route::get('/pending/confirm/{order_id}', 'PendingToConfirm')->name('pending-confirm');
    Route::get('/confirm/processing/{order_id}', 'ConfirmToProcess')->name('confirm-processing');
    Route::get('/processing/delivered/{order_id}', 'ProcessToDelivered')->name('processing-delivered');
    Route::get('/admin/invoice/download/{order_id}', 'AdminInvoiceDownload')->name('admin.invoice.download');
    Route::post('/return/order/{order_id}', 'ReturnOrder')->name('return.order');
    Route::get('/return/order/page', 'ReturnOrderPage')->name('return.order.page');
    // Order Tracking
    Route::get('/user/track/order', 'UserTrackOrder')->name('user.track.order');
    Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');
});


// Return Order All Route
Route::controller(ReturnController::class)->group(function () {
    Route::get('/return/request', 'ReturnRequest')->name('return.request');
    Route::get('/return/request/approved/{order_id}', 'ReturnRequestApproved')->name('return.request.approved');
    Route::get('/complete/return/request', 'CompleteReturnRequest')->name('complete.return.request');
});



// Vendor Order All Route
Route::controller(VendorOrderController::class)->group(function () {
    Route::get('/vendor/order', 'VendorOrder')->name('vendor.order');
    Route::get('/vendor/return/order', 'VendorReturnOrder')->name('vendor.return.order');
    Route::get('/vendor/complete/return/order', 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
    Route::get('/vendor/order/details/{order_id}', 'VendorOrderDetails')->name('vendor.order.details');
});



// Report All Route
Route::controller(ReportController::class)->group(function () {
    Route::get('/report/view', 'ReportView')->name('report.view');
    Route::post('/search/by/date', 'SearchByDate')->name('search-by-date');
    Route::post('/search/by/month', 'SearchByMonth')->name('search-by-month');
    Route::post('/search/by/year', 'SearchByYear')->name('search-by-year');
    Route::get('/order/by/user', 'OrderByUser')->name('order.by.user');
    Route::post('/search/by/user', 'SearchByUser')->name('search-by-user');
});


// Active user and vendor All Route
Route::controller(ActiveUserController::class)->group(function () {

    Route::get('/all/user', 'AllUser')->name('all-user');
    Route::get('/all/vendor', 'AllVendor')->name('all-vendor');
});


// Blog Post All Route
Route::controller(BlogController::class)->group(function () {

    Route::get('/admin/blog/post', 'AllBlogPost')->name('admin.blog.post');
    Route::get('/admin/add/blog/post', 'AddBlogPost')->name('add.blog.post');
    Route::post('/admin/store/blog/post', 'StoreBlogPost')->name('store.blog.post');
    Route::get('/admin/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
    Route::post('/admin/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
    Route::get('/admin/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
});


// Frontend Blog Post All Route
Route::controller(BlogController::class)->group(function () {

    Route::get('/blog', 'AllBlog')->name('home.blog');
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');
    Route::get('/post/details/{id}/{slug}', 'BlogDetails');
    Route::get('/post/category/{id}/{slug}', 'BlogPostCategory');
});


Route::controller(ReviewController::class)->group(function () {

    Route::post('/store/review', 'StoreReview')->name('store.review');
    Route::get('/pending/review', 'PendingReview')->name('pending.review');
    Route::get('/review/approve/{id}', 'ReviewApprove')->name('review.approve');
    Route::get('/review/approve/{id}', 'ReviewApprove')->name('review.approve');
    Route::get('/publish/review', 'PublishReview')->name('publish.review');
    Route::get('/review/delete/{id}', 'ReviewDelete')->name('review.delete');

    Route::get('/vendor/all/review', 'VendorAllReview')->name('vendor.all.review');

});

// Site Setting All Route
Route::controller(SiteSettingController::class)->group(function () {

    Route::get('/site/setting', 'SiteSetting')->name('site.setting');
    Route::post('/site/setting/update', 'SiteSettingUpdate')->name('site.setting.update');
    Route::get('/seo/setting', 'SeoSetting')->name('seo.setting');
    Route::post('/seo/setting/update', 'SeoSettingUpdate')->name('seo.setting.update');

});


// User Dashboard All Route
Route::controller(AllUserController::class)->group(function () {
    Route::get('/user/account/page', 'UserAccount')->name('user.account.page');
    Route::get('/user/change/password', 'UserChangePassword')->name('user.change.password');
    Route::get('/user/order/page', 'UserOrderPage')->name('user.order.page');
    Route::get('/user/order_details/{order_id}', 'UserOrderDetails');
    Route::get('/user/invoice_download/{order_id}', 'UserOrderInvoice');
});

/// Add to Compare
Route::post('/add-to-compare/{product_id}', [CompareController::class, 'AddToCompare']);

//Coupon Apply
Route::post('/coupon-apply', [CartController::class, 'CouponApply']);
Route::get('/coupon-calculation', [CartController::class, 'CouponCalculation']);
Route::get('/coupon-remove', [CartController::class, 'CouponRemove']);

//Checkout Page Route
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

// Cart All Route
Route::controller(CartController::class)->group(function () {
    Route::get('/mycart', 'MyCart')->name('mycart');
    Route::get('/get-cart-product', 'GetCartProduct');
    Route::get('/cart-remove/{rowId}', 'CartRemove');

    Route::get('/cart-decrement/{rowId}', 'CartDecrement');
    Route::get('/cart-increment/{rowId}', 'CartIncrement');
});


Route::middleware(['auth', 'role:user'])->group(function () {

    // Wishlist All Route
    Route::controller(WishlistController::class)->group(function () {
        Route::get('/wishlist', 'AllWishlist')->name('wishlist');
        Route::get('/get-wishlist-product', 'GetWishlistProduct');
        Route::get('/wishlist-remove/{id}', 'WishlistRemove');
    });

    // Compare All Route
    Route::controller(CompareController::class)->group(function () {
        Route::get('/compare', 'AllCompare')->name('compare');
        Route::get('/get-compare-product', 'GetCompareProduct');
        Route::get('/compare-remove/{id}', 'CompareRemove');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
