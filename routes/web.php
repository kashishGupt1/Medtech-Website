<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\ProductWebController;
use App\Http\Controllers\Web\RequestQuoteController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ExhibitionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\BroucherController;
use App\Http\Controllers\MetaTagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/', [HomeController::class, 'homepage'])->name('home');



Route::get('/contact-us', [ContactUsController::class, 'create'])->name('contact_us');
Route::get('/reload-captcha', function () {
    return response()->json(['captcha' => captcha_img()]);
});


Route::get('/about-us', [AboutUsController::class, 'index'])->name('about');

// Route::get('/category', function () {
//     return view('categories_list');
// });
Route::get('/category', [HomeController::class, 'showActivecategory'])->name('category');


Route::get('/certifications', [CertificateController::class, 'show'])->name('certifications.show');


Route::get('/exhibitions', [ExhibitionController::class, 'showExhibitions'])->name('exhibitions');

Route::get('/exhibitions/{slug}', [ExhibitionController::class, 'exhibitionDetails'])->name('exhibitions.details');




Route::post('/request-quote', [RequestQuoteController::class, 'store'])->name('request.quote');
Route::post('/book-appointmentt', [RequestQuoteController::class, 'exhibitionAppointmentstore'])->name('book.exhibition.appointment');


Route::get('/blog', [BlogController::class, 'blogPage'])->name('blog.list');
Route::get('/blog/{slug}', [BlogController::class, 'blogDetails'])->name('blog.details');

Route::get('/search', [ProductWebController::class, 'search'])->name('search');
Route::get('/thank-you', [ProductWebController::class, 'requestQuoteThankYou'])->name('request.quote.thank.you');



Route::get('/privacy-policy', function () {
    return view('privacy_policy');
});

Route::post('enquiry', [WebController::class, 'createEnquiry']);
Route::post('/contact-us/store', [ContactUsController::class, 'store'])->name('contact.store');
Route::post('career', [WebController::class, 'career']);
Route::post('/newsletter/add', [ContactUsController::class, 'add'])->name('newsletter.add');





Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/home-banner', [HomeController::class, 'create'])->name('admin.home-banner');
    Route::post('/admin/banner/store', [HomeController::class, 'bannerAdd'])->name('admin.banner.store');
    Route::get('/admin/banner-list', [HomeController::class, 'index'])->name('admin.home.banner.list');
    Route::get('banner/edit/{id}', [HomeController::class, 'edit'])->name('admin.banner.edit');
    Route::post('banner/update/{id}', [HomeController::class, 'update'])->name('admin.banner.update');
    

    Route::get('/admin/about-us', [AboutUsController::class, 'edit'])->name('admin.about_us');
    Route::get('/admin/about', [AboutUsController::class, 'edit'])->name('admin.about.edit');
    Route::post('/admin/about', [AboutUsController::class, 'store'])->name('admin.about.store');
    Route::post('admin/about/{id}', [AboutUsController::class, 'update'])->name('admin.about.update');

    
    Route::get('/admin/meta-tags', function () {
        return view('admin.meta_tags');
    });
    Route::post('/admin/meta-tags/save', [MetaTagController::class, 'storeOrUpdate'])->name('meta-tags.save');
    Route::post('/admin/meta-tags/get', [MetaTagController::class, 'getMetaTag'])->name('meta-tags.get');
    
    Route::get('/admin/footer-website', function () {
        return view('admin.footer_website');
    });

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/admin/login');
    })->name('logout');

    Route::get('/admin/profile', function () {
        return view('admin.company-profile');
    })->name('admin.company.profile');
    Route::post('/admin/profile/update', [UserController::class, 'update'])->name('admin.profile.update');

    Route::get('/admin/contact', [ContactUsController::class, 'index'])->name('admin.contact.list');
    
    Route::get('/admin/add-category', [ProductCategoryController::class, 'create'])->name('admin.category-add');
    Route::post('/admin/add-category', [ProductCategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category-list', [ProductCategoryController::class, 'index'])->name('admin.category-list');
    Route::get('/admin/edit-category/{id}', [ProductCategoryController::class, 'edit'])->name('admin.category-edit');
    Route::post('/admin/update-category/{id}', [ProductCategoryController::class, 'update'])->name('admin.category.update');
    Route::post('/admin/category/toggle-checkbox', [ProductCategoryController::class, 'toggleCheckbox'])
        ->name('admin.category.toggleCheckbox');

    Route::get('/admin/add-product', [ProductController::class, 'create'])->name('admin.product.add');
    Route::post('/admin/add-product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product-list', [ProductController::class, 'index'])->name('admin.product.list');
    Route::get('/admin/product/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::post('/admin/product/toggle-checkbox', [ProductController::class, 'toggleCheckbox'])
        ->name('admin.product.toggleCheckbox');
        
    Route::get('/admin/book-appointments', [RequestQuoteController::class, 'getExhibitionAppointments'])->name('admin.exhibition.appointment');
    Route::get('/admin/request-quote', [RequestQuoteController::class, 'create'])->name('admin.request.quote');
    Route::get('/admin/newsletter', [ContactUsController::class, 'newsLetterList'])->name('admin.newsletter.list');
    
    Route::get('/admin/brouchers-list', [BroucherController::class, 'index'])->name('admin.brouchers.list');
    Route::get('/admin/add-brochures', [BroucherController::class, 'create'])->name('admin.brouchers.add');
    Route::post('/admin/add-brochures', [BroucherController::class, 'store'])->name('admin.brouchers.store');
    Route::get('/admin/edit-brochures/{id}', [BroucherController::class, 'edit'])->name('admin.brouchers.edit');
    Route::post('/admin/update-brochures/{id}', [BroucherController::class, 'update'])->name('admin.brouchers.update');
    Route::get('/download-broucher', [BroucherController::class, 'downloadLatest'])->name('web.broucher.download');

    Route::get('/admin/add-blog', [BlogController::class, 'create'])->name('admin.blog.add');
    Route::get('/admin/blog-list', [BlogController::class, 'index'])->name('admin.blog.list');
    Route::post('/admin/store-blog', [BlogController::class, 'store'])->name('admin.blog.store');
    Route::get('/admin/edit-blog/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
    Route::post('/admin/update/{id}', [BlogController::class, 'update'])->name('admin.blog.update');

    Route::get('/admin/add-certificate', function () {
        return view('admin.certificate-add');
    })->name('admin.certificate.add');
    Route::post('/admin/certificate/store', [CertificateController::class, 'store'])->name('admin.certificate.store');
    Route::get('/admin/certificate-list', [CertificateController::class, 'index'])->name('admin.certificate.list');
    Route::get('/admin/certificate/edit/{id}', [CertificateController::class, 'edit'])->name('admin.certificate.edit');
    Route::put('/admin/certificate/update/{id}', [CertificateController::class, 'update'])->name('admin.certificate.update');
    
    Route::get('/admin/add-exhibition', [ExhibitionController::class, 'create'])->name('admin.exhibition.add');
    Route::post('/admin/exhibition/store', [ExhibitionController::class, 'store'])->name('admin.exhibition.store');
    Route::get('/admin/exhibition-list', [ExhibitionController::class, 'index'])->name('admin.exhibition.list');
    Route::get('/edit-exhibition/{id}', [ExhibitionController::class, 'edit'])->name('admin.exhibition.edit');
    Route::post('/update-exhibition/{id}', [ExhibitionController::class, 'update'])->name('admin.exhibition.update');

});

Route::get('/{categorySlug}/{productSlug}', [ProductWebController::class, 'showProductDetail'])
    ->name('product.details')
    ->where('categorySlug', '^(?!admin|exhibitions).+$');
Route::get('/{slug?}', [ProductWebController::class, 'show'])
    ->name('category.show')
    ->where('categorySlug', '^(?!admin|exhibitions).+$');