<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StoreAnalytic;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\PageOptionController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductCouponController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ZoomMeetingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProductCategorieController;
use App\Http\Controllers\ProductTaxController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\PlanRequestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentWallPaymentController;
use App\Http\Controllers\QuizSettingsController;
use App\Http\Controllers\QuizBankController;
use App\Http\Controllers\SubContentController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\LandingPageSectionsController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\RattingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ToyyibpayController;
use App\Http\Controllers\PayfastController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\NotificationTemplatesController;
// use App\Http\Controllers\PageOptionController;
// use App\Http\Controllers\PageOptionController;
use App\Http\Controllers\Student\Auth\StudentLoginController;
use App\Http\Controllers\Student\Auth\StudentForgotPasswordController;
use App\Http\Controllers\StudentlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserslogController;
use App\Http\Controllers\WebhookController;

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
    return view('welcome');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

/*STUDENT AUTH*/

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->name('verification.notice')->middleware('auth');

Route::get('/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->name('verification.verify')->middleware('auth');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->name('verification.verify')->middleware('auth');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->name('verification.send')->middleware('auth');

Route::get('/', [DashboardController::class, 'index'])->middleware('XSS')->name('dashboard');

Route::get('/change/mode', [DashboardController::class, 'changeMode'])->name('change.mode');

Route::get('profile', [DashboardController::class, 'profile'])->middleware(['XSS','auth',])->name('profile');

Route::put('change-password', [DashboardController::class, 'updatePassword'])->name('update.password');

Route::put('edit-profile', [DashboardController::class, 'editprofile'])->middleware(['XSS','auth',])->name('update.account');

Route::group(['middleware' => ['verified']], function (){


Route::resource('roles', RoleController::class)->middleware(['auth','XSS']);
Route::resource('permissions', PermissionController::class)->middleware(['auth','XSS']);
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['XSS','auth'])->name('dashboard');

// Users
Route::resource('users',UserController::class)->middleware(['auth','XSS']);
Route::get('users/reset/{id}',[UserController::class,'reset'])->name('users.reset')->middleware(['auth','XSS']);
Route::post('users/reset/{id}',[UserController::class,'updatePassword'])->name('users.resetpassword')->middleware(['auth','XSS']);

Route::middleware(['auth'])->group(function () {
    Route::resource('stores', StoreController::class);
    Route::post('store-setting/{id}', [StoreController::class,'savestoresetting'])->name('settings.store');
});

Route::middleware(['auth','XSS'])->group(function () {
    Route::get('change-language/{lang}', [LanguageController::class, 'changeLanquage'])->middleware(['auth','XSS'])->name('change.language');
    Route::get('manage-language/{lang}', [LanguageController::class, 'manageLanguage'])->middleware(['auth','XSS'])->name('manage.language');
    Route::post('store-language-data/{lang}', [LanguageController::class, 'storeLanguageData'])->middleware(['auth','XSS'])->name('store.language.data');
    Route::get('create-language', [LanguageController::class, 'createLanguage'])->middleware(['auth','XSS'])->name('create.language');
    Route::post('store-language', [LanguageController::class, 'storeLanguage'])->middleware(['auth','XSS'])->name('store.language');
    Route::delete('/lang/{lang}', [LanguageController::class, 'destroyLang'])->middleware(['auth','XSS'])->name('lang.destroy');
});

Route::middleware(['auth','XSS'])->group(function () {
    Route::get('store-grid/grid', [StoreController::class, 'grid'])->name('store.grid');
    Route::get('store-customDomain/customDomain', [StoreController::class, 'customDomain'])->name('store.customDomain');
    Route::get('store-subDomain/subDomain', [StoreController::class, 'subDomain'])->name('store.subDomain');
    Route::get('store-plan/{id}/plan', [StoreController::class, 'upgradePlan'])->name('plan.upgrade');
    Route::get('store-plan-active/{id}/plan/{pid}', [StoreController::class, 'activePlan'])->name('plan.active');
    Route::DELETE('store-delete/{id}', [StoreController::class, 'storedestroy'])->name('user.destroy');
    Route::DELETE('ownerstore-delete/{id}', [StoreController::class,'ownerstoredestroy'])->name('ownerstore.destroy');
    Route::get('store-edit/{id}', [StoreController::class,'storedit'])->name('user.edit');
    Route::put('store-update/{id}', [StoreController::class,'storeupdate'])->name('user.update');
});


Route::get('/store-change/{id}', [StoreController::class, 'changeCurrantStore'])->middleware(['auth','XSS'])->name('change_store');


Route::get('storeanalytic', [StoreAnalytic::class, 'index'])->middleware(['XSS','auth',])->name('storeanalytic');


Route::controller(SettingController::class)->middleware(['auth', 'XSS'])->group( function () {
    Route::post('business-setting', 'saveBusinessSettings')->name('business.setting');
    Route::post('company-setting', 'saveCompanySettings')->name('company.setting');
    Route::post('email-setting', 'saveEmailSettings')->name('email.setting');
    Route::post('system-setting', 'saveSystemSettings')->name('system.setting');
    Route::post('pusher-setting', 'savePusherSettings')->name('pusher.setting');
    Route::get('test', 'testMail')->name('test.mail');
    Route::post('test', 'testMail')->name('test.mail');
    Route::post('test-mail', 'testSendMail')->name('test.send.mail');
    Route::get('settings', 'index')->name('settings');
    Route::post('payment-setting', 'savePaymentSettings')->name('payment.setting');
    Route::post('owner-payment-setting/{slug?}', 'saveOwnerPaymentSettings')->name('owner.payment.setting');
    Route::post('owner-email-setting/{slug?}', 'saveOwneremailSettings')->name('owner.email.setting');
    Route::get('pixel-setting/create','CreatePixel')->name('owner.pixel.create');
    Route::post('pixel-setting/{slug?}','savePixelSettings')->name('owner.pixel.setting');
    Route::delete('pixel-delete/{id}','pixelDelete')->name('pixel.delete');
});

// google calender settings

Route::post('setting/google-calender',[SettingController::class,'saveGoogleCalenderSettings'])->name('google.calender.settings');

// Webhook Settings
Route::resource('webhook', WebhookController::class);


// certificate
Route::get('/certificate/preview/{template}/{color}/{gradiant?}', [SettingController::class, 'previewCertificate'])->middleware(['auth',])->name('certificate.preview');
Route::post('/certificate/template/setting', [SettingController::class, 'saveCertificateSettings'])->name('certificate.template.setting');
// ------------- //

// Route::resource('product_categorie', ProductCategorieController::class)->middleware(['auth','XSS']);
// Route::resource('product_tax', ProductTaxController::class)->middleware(['auth','XSS']);
Route::resource('shipping', ShippingController::class)->middleware(['auth','XSS']);
Route::resource('location', LocationController::class)->middleware(['auth','XSS']);
Route::resource('custom-page', PageOptionController::class)->middleware(['auth','XSS']);
Route::resource('blog', BlogController::class)->middleware(['auth','XSS']);

Route::get('blog-social', [BlogController::class, 'socialBlog'])->middleware(['auth','XSS'])->name('blog.social');
Route::get('store-social-blog', [BlogController::class, 'storeSocialblog'])->middleware(['auth','XSS'])->name('store.socialblog');


Route::resource('shipping', ShippingController::class)->middleware(['auth','XSS']);


Route::get('/plans', [PlanController::class, 'index']) ->middleware(['XSS','auth',])->name('plans.index');
Route::get('/plans/create', [PlanController::class, 'create'])->middleware(['auth','XSS'])->name('plans.create');
Route::post('/plans', [PlanController::class, 'store'])->middleware(['auth','XSS'])->name('plans.store');
Route::get('/plans/edit/{id}', [PlanController::class, 'edit'])->middleware(['auth','XSS'])->name('plans.edit');
Route::put('/plans/{id}', [PlanController::class, 'update'])->middleware(['auth','XSS'])->name('plans.update');
Route::post('/user-plans/', [PlanController::class, 'userPlan'])->middleware(['auth','XSS'])->name('update.user.plan');


Route::resource('orders', OrderController::class)->middleware(['auth','XSS']);

Route::get('order-receipt/{id}', [OrderController::class, 'receipt'])->middleware(['auth'])->name('order.receipt');

    // Route::controller(SubscriptionController::class)->group(function () {
    //     Route::resource('subscriptions');
    //     Route::post('subscriptions/{id}', 'store_email')->name('subscriptions.store_email');
    // });




// Route::middleware(['auth'])->group(function () {
//     Route::get('/product-variants/create', [ProductController::class,'productVariantsCreate'])->name('product.variants.create');
//     Route::get('/get-product-variants-possibilities', [ProductController::class,'getProductVariantsPossibilities'])->name('get.product.variants.possibilities');
//     Route::get('product/grid', [ProductController::class,'grid'])->name('product.grid');
//     Route::resource('product', ProductController::class);
//     Route::delete('product/{id}/delete', [ProductController::class,'fileDelete'])->name('products.file.delete');
//     Route::post('product/{id}/update', [ProductController::class,'productUpdate'])->name('products.update');
// });


// Route::get('get-products-variant-quantity', [ProductController::class, 'getProductsVariantQuantity'])->name('get.products.variant.quantity');

Route::resource('store-resource', StoreController::class)->middleware(['auth','XSS']);




// //Student Forgot Password Routes(theme)

// Route::get('{slug}/student-forgotpassword/',[ForgotPasswordController::class, 'studentLinkReques'])->name('student.forgotpassword.request');
// Route::post('{slug}/student-forgotpassword/email',[ForgotPasswordController::class, 'studentEmail'])->name('student.forgotpassword.email');

// /*Student Reset Password Routes(theme)*/

// Route::get('{slug}/student-forgotpassword/reset/{token}',[ForgotPasswordController::class, 'studentPassword'])->name('student.forgotpassword.reset');
// Route::post('{slug}/student-forgotpassword/reset',[ForgotPasswordController::class, 'editstudentPassword'])->name('student.forgotpassword.update');







Route::resource('coupons', CouponController::class)->middleware(['auth','XSS']);

Route::post('prepare-payment', [PlanController::class, 'preparePayment'])->middleware(['auth','XSS'])->name('prepare.payment');

Route::get('/payment/{code}', [PlanController::class, 'payment'])->middleware(['auth','XSS'])->name('payment');

Route::middleware(['auth','XSS'])->group(function () {
    Route::resource('plan_request', PlanRequestController::class);
});

Route::post('plan-pay-with-paypal', [PaypalController::class, 'planPayWithPaypal'])->middleware(['auth','XSS'])->name('plan.pay.with.paypal');

Route::get('{id}/{amount}/get-payment-status{slug?}', [PaypalController::class,'planGetPaymentStatus'])->name('plan.get.payment.status')->middleware(['XSS']);
// Route::get('{id}/get-store-payment-status', [PaypalController::class, 'storeGetPaymentStatus'])->middleware(['auth','XSS'])->name('get.store.payment.status');


Route::get(
    'qr-code', function (){
    return QrCode::generate();
}
);



Route::resource('product-coupon', ProductCouponController::class)->middleware(['auth', 'XSS']);





// Plan Purchase Payments methods
Route::get('plan/prepare-amount', [PlanController::class, 'planPrepareAmount'])->name('plan.prepare.amount');
Route::get('paystack-plan/{code}/{plan_id}', [PaymentController::class, 'paystackPlanGetPayment'])->middleware(['auth'])->name('paystack.plan.callback');
Route::get('flutterwave-plan/{code}/{plan_id}', [PaymentController::class, 'flutterwavePlanGetPayment'])->middleware(['auth'])->name('flutterwave.plan.callback');
Route::get('razorpay-plan/{code}/{plan_id}', [PaymentController::class, 'razorpayPlanGetPayment'])->middleware(['auth'])->name('razorpay.plan.callback');


Route::post('mercadopago-prepare-plan', [PaymentController::class, 'mercadopagoPaymentPrepare'])->middleware(['auth'])->name('mercadopago.prepare.plan');
Route::any('plan-mercado-callback/{plan_id}', [PaymentController::class, 'mercadopagoPaymentCallback'])->middleware(['auth'])->name('plan.mercado.callback');


Route::post('paytm-plan', [PaymentController::class, 'paytmPaymentPrepare'])->middleware(['auth'])->name('paytm.prepare.plan');
Route::post('paytm-prepare-plan', [PaymentController::class, 'paytmPlanGetPayment'])->middleware(['auth'])->name('plan.paytm.callback');


Route::post('mollie-prepare-plan', [PaymentController::class, 'molliePaymentPrepare'])->middleware(['auth'])->name('mollie.prepare.plan');
Route::get('mollie-payment-plan/{slug}/{plan_id}', [PaymentController::class, 'molliePlanGetPayment'])->middleware(['auth'])->name('plan.mollie.callback');


Route::post('coingate-prepare-plan', [PaymentController::class, 'coingatePaymentPrepare'])->middleware(['auth'])->name('coingate.prepare.plan');
Route::get('coingate-payment-plan', [PaymentController::class, 'coingatePlanGetPayment'])->middleware(['auth'])->name('coingate.mollie.callback');


Route::post('skrill-prepare-plan', [PaymentController::class, 'skrillPaymentPrepare'])->middleware(['auth'])->name('skrill.prepare.plan');
Route::post('skrill-payment-plan', [PaymentController::class, 'skrillPlanGetPayment'])->middleware(['auth'])->name('plan.skrill.callback');

Route::post('paymentwall', [PaymentWallPaymentController::class, 'paymentwall'])->name('paymentwall');
Route::post('plan-pay-with-paymentwall/{plan}', [PaymentWallPaymentController::class, 'paymeplanPayWithPaymentwallntwall'])->name('plan.pay.with.paymentwall');
Route::get('/plan/{flag}', [PaymentWallPaymentController::class, 'paymenterror'])->name('callback.error');
        // Route::get('/plans/{flag}', ['as' => 'error.plan.show','uses' => 'PaymentWallPaymentController@paymenterror']);


Route::post('toyyibpay-prepare-plan', [ToyyibpayController::class, 'toyyibpayPaymentPrepare'])->middleware(['auth'])->name('toyyibpay.prepare.plan');
Route::get('toyyibpay-payment-plan/{plan_id}/{amount}/{couponCode}', [ToyyibpayController::class, 'toyyibpayPlanGetPayment'])->middleware(['auth'])->name('plan.toyyibpay.callback');

Route::post('payfast-plan', [PayfastController::class, 'index'])->name('payfast.payment')->middleware(['auth']);
Route::get('payfast-plan/{success}', [PayfastController::class, 'success'])->name('payfast.payment.success')->middleware(['auth']);

/*LMS Owner*/

/*STORE EDIT*/
Route::post('{slug?}/store-edit', [StoreController::class, 'StoreEdit'])->middleware(['auth'])->name('store.storeedit');
Route::delete('{slug?}/brand/{id}/delete/', [StoreController::class, 'brandfileDelete'])->middleware(['auth'])->name('brand.file.delete');
Route::post('product-image-delete', [StoreController::class, 'image_delete'])->name('product.image.delete')->middleware(['auth', 'XSS']);
//Course
Route::resource('course', CourseController::class)->middleware(['auth','XSS']);
Route::put('course-seo-update/{id}/', [CourseController::class, 'CourseSeoUpdate'])->middleware(['auth'])->name('course.seo.update');
Route::post('course/getsubcategory', [CourseController::class, 'getsubcategory'])->middleware(['auth'])->name('course.getsubcategory');

/*Practices*/
Route::post('course/practices-files/{id}', [CourseController::class, 'practicesFiles'])->middleware(['auth'])->name('course.practicesfiles');
Route::delete('course/practices-files/{id}/delete', [CourseController::class, 'fileDelete'])->middleware(['auth'])->name('practices.file.delete');
Route::get('course/practices-files-name/{id}/file-name', [CourseController::class, 'editFileName'])->middleware(['auth'])->name('practices.filename.edit');
Route::put('course/practices-files-update/{id}/file-name', [CourseController::class, 'updateFileName'])->middleware(['auth'])->name('practices.filename.update');


//Category
Route::resource('category', CategoryController::class)->middleware(['auth','XSS']);

//Subcategory
Route::resource('subcategory', SubcategoryController::class)->middleware(['auth','XSS']);
Route::get('content/{id}', [SubcategoryController::class, 'viewcontent'])->middleware(['auth'])->name('subcategory.viewcontent');


//Quiz
Route::resource('setquiz', QuizSettingsController::class)->middleware(['auth']);

Route::resource('quizbank', QuizBankController::class)->middleware(['auth']);
Route::get('content/{id}', [QuizBankController::class, 'viewcontent'])->middleware(['auth'])->name('quizbank.viewcontent');


//Sub content
Route::resource('subcontent', SubContentController::class)->middleware(['auth']);
Route::get('content/{id}', [SubContentController::class, 'viewcontent'])->middleware(['auth'])->name('subcontent.viewcontent');
Route::delete('contents/{id}/delete', [SubContentController::class, 'fileDelete'])->middleware(['auth'])->name('subcontent.file.delete');
Route::post('contents/{id}/update', [SubContentController::class, 'ContentsUpdate'])->middleware(['auth'])->name('subcontent.update');

//Headers
Route::resource('{id}/headers', HeaderController::class)->middleware(['auth']);
Route::get('header/{id}', [HeaderController::class, 'viewpage'])->middleware(['auth'])->name('headers.viewpage');


//FAQs
Route::resource('{id}/faqs', FaqController::class)->middleware(['auth']);


//Chapters
Route::resource('{course_id}/{id}/chapters', ChaptersController::class)->middleware(['auth']);
Route::delete('chapters/{id}/delete', [ChaptersController::class, 'fileDelete'])->middleware(['auth'])->name('chapters.file.delete');
Route::post('chapters/{id}/update', [ChaptersController::class, 'ContentsUpdate'])->middleware(['auth'])->name('chapters.update');


//==================================== Custom Landing Page ====================================//

// Route::get('/landingpage', [LandingPageSectionsController::class, 'index'])->middleware(['auth','XSS'])->name('custom_landing_page.index');


// Plan Request Module
Route::get('plan_request', [PlanRequestController::class, 'index'])->middleware(['auth','XSS'])->name('plan_request.index');
Route::get('request_frequency/{id}', [PlanRequestController::class, 'requestView'])->middleware(['auth','XSS'])->name('request.view');
Route::get('request_send/{id}', [PlanRequestController::class, 'userRequest'])->middleware(['auth','XSS'])->name('send.request');
Route::get('request_response/{id}/{response}', [PlanRequestController::class, 'acceptRequest'])->middleware(['auth','XSS'])->name('response.request');
Route::get('request_cancel/{id}', [PlanRequestController::class, 'cancelRequest'])->middleware(['auth','XSS'])->name('request.cancel');
// End Plan Request Module

//==================================== Import/Export Data Route====================================//
Route::get('export/course', [CourseController::class, 'export'])->name('course.export');
Route::get('export/order', [OrderController::class, 'export'])->name('order.export');
Route::get('export/product-coupon', [ProductCouponController::class, 'export'])->name('product-coupon.export');
Route::get('import/product-coupon/file', [ProductCouponController::class, 'importFile'])->name('product-coupon.file.import');
Route::post('import/product-coupon', [ProductCouponController::class, 'import'])->name('product-coupon.import');

//==================================== Zoom-Meetings ====================================//
Route::any('zoom-meeting/calendar', [ZoomMeetingController::class, 'calender'])->middleware(['XSS','auth',])->name('zoom-meeting.calender');

Route::resource('zoom-meeting', ZoomMeetingController::class)->middleware(['auth','XSS']);

Route::get('get-students/{course_id}', [ZoomMeetingController::class, 'courseByStudentId'])->middleware(['XSS','auth',])->name('course.by.student.id');

Route::any('zoom-meeting/get_event_data', [ZoomMeetingController::class, 'get_event_data'])->name('zoom-meeting.get_event_data')->middleware(['auth', 'XSS']);

//==================================== Slack ====================================//
Route::post('setting/slack', [SettingController::class, 'slack'])->name('slack.setting');

//==================================== Telegram ====================================//
Route::post('setting/telegram', [SettingController::class, 'telegram'])->name('telegram.setting');

//==================================== Recaptcha ====================================//
Route::post('/recaptcha-settings', [SettingController::class, 'recaptchaSettingStore'])->middleware(['XSS','auth',])->name('recaptcha.settings.store');

//==================================== Download button ====================================//
Route::get('certificate/pdf/{id}', [StoreController::class, 'certificatedl'])->middleware(['XSS'])->name('certificate.pdf');

//==================================== Reset-password for store ====================================//
Route::any('store-reset-password/{id}', [StoreController::class, 'ownerPassword'])->name('store.reset');

Route::post('store-reset-password/{id}', [StoreController::class, 'ownerPasswordReset'])->name('store.password.update');

//==================================== storage setting ====================================//
Route::post('storage-settings', [SettingController::class, 'storageSettingStore'])->middleware(['XSS','auth',])->name('storage.setting.store');

//==================================== cache setting ====================================//
Route::get('/config-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'Clear Cache successfully.');
});


// student view
Route::get('student', [StoreController::class, 'studentindex'])->name('student.index')->middleware(['auth','XSS']);
Route::get('student/view/{id}', [StoreController::class, 'studentShow'])->name('student.show');
Route::get('student-export', [StoreController::class, 'studentExport'])->name('student.export');


// cookie consent setting
Route::any('setting/cookie-consent', [SettingController::class,'CookieConsentSettings'])->name('cookie.setting');
Route::any('/cookie-consent', [SettingController::class,'CookieConsent'])->name('cookie-consent');

// User Logs
Route::get('users-logs', [UserslogController::class, 'index'])->middleware(['auth','XSS'])->name('users.logs');
Route::get('users-logs/view/{id}', [UserslogController::class, 'view'])->middleware(['auth','XSS'])->name('userslog.view');
Route::delete('users-logs/delete/{id}', [UserslogController::class, 'destroy'])->middleware(['auth','XSS'])->name('userslog.destroy');

// Student Logs
Route::get('student-logs', [StudentlogController::class, 'index'])->middleware(['auth','XSS'])->name('student.logs');
Route::get('student-logs/view/{id}', [StudentlogController::class, 'view'])->middleware(['auth','XSS'])->name('studentlog.view');
Route::delete('student-logs/delete/{id}', [StudentlogController::class, 'destroy'])->middleware(['auth','XSS'])->name('studentlog.destroy');

// Notification
Route::resource('notification-templates', NotificationTemplatesController::class)->middleware(['auth','XSS',]);
Route::get('notification-templates/{id?}/{lang?}/', [NotificationTemplatesController::class, 'index'])->name('notification-templates.index');


});

Route::get('page/{slug?}/{store_slug?}', [StoreController::class, 'pageOptionSlug'])->name('pageoption.slug');
Route::get('store-blog/{slug?}', [StoreController::class, 'StoreBlog'])->name('store.blog');
Route::get('store-blog-view/{slug?}/blog/{id}', [StoreController::class, 'StoreBlogView'])->name('store.store_blog_view');


Route::get('store/{slug?}', [StoreController::class, 'storeSlug'])->name('store.slug');
Route::get('user-cart-item/{slug?}/cart', [StoreController::class, 'StoreCart'])->name('store.cart');
Route::post('store/{slug?}', [StoreController::class, 'changeTheme'])->name('store.changetheme');
Route::get('{slug?}/edit-products/{theme?}', [StoreController::class, 'Editproducts'])->middleware(['auth','XSS'])->name('store.editproducts');

    // Route::post('{slug?}/store-edit-products/{theme?}', 'StoreController@StoreEditProduct')->name('store.storeeditproducts')->middleware(['auth']);
    // Route::delete('{slug?}/{theme}/brand/{id}/delete/', 'StoreController@brandfileDelete')->name('brand.file.delete')->middleware(['auth']);


/*LMS STORE*/
Route::get('{slug?}/view-course/{id}', [StoreController::class, 'ViewCourse'])->name('store.viewcourse');
Route::get('{slug?}/tutor/{id}', [StoreController::class, 'tutor'])->name('store.tutor');
Route::get('{slug?}/search-data/{search}', [StoreController::class, 'searchData'])->name('store.searchData');
Route::post('{slug?}/filter', [StoreController::class, 'filter'])->name('store.filter');
Route::get('{slug?}/search/{search?}/{category?}', [StoreController::class, 'search'])->name('store.search');
Route::get('{slug}/checkout/{id}/{total}', [StoreController::class, 'checkout'])->name('store.checkout');
Route::get('{slug}/user-create', [StoreController::class, 'userCreate'])->name('store.usercreate');
Route::post('{slug}/user-create', [StoreController::class, 'userStore'])->name('store.userstore');
Route::get('{slug}/fullscreen/{course}/{id?}/{type?}', [StoreController::class, 'fullscreen'])->middleware(['studentAuth'])->name('store.fullscreen');



Route::get('{slug}/student-login', [StudentLoginController::class, 'showLoginForm'])->name('student.loginform');
Route::post('{slug}/student-login/{cart?}', [StudentLoginController::class, 'login'])->name('student.login');
Route::post('{slug}/student-logout', [StudentLoginController::class, 'logout'])->name('student.logout');

//Forgot Password Routes
Route::get('{slug}/student-password/',[StudentForgotPasswordController::class, 'showLinkRequestForm'])->name('student.password.request');
Route::post('{slug}/student-password/email',[StudentForgotPasswordController::class, 'postStudentEmail'])->name('student.password.email');
/*Reset Password Routes*/
Route::get('{slug}/student-password/reset/{token}',[StudentForgotPasswordController::class, 'getStudentPassword'])->name('student.password.reset');
Route::post('{slug}/student-password/reset',[StudentForgotPasswordController::class, 'updateStudentPassword'])->name('student.password.update');
/*Profile*/
Route::get('/{slug}/student-profile/{id}',[StudentLoginController::class, 'profile'])->middleware('studentAuth')->name('student.profile');
Route::put('{slug}/student-profile/{id}',[StudentLoginController::class, 'profileUpdate'])->middleware('studentAuth')->name('student.profile.update');
Route::put('{slug}/student-profile-password/{id}',[StudentLoginController::class, 'updatePassword'])->middleware('studentAuth')->name('student.profile.password');


// Payments Callbacks
Route::get('paystack/{slug}/{code}/{order_id}', [PaymentController::class, 'paystackPayment'])->name('paystack');
Route::get('flutterwave/{slug}/{tran_id}/{order_id}', [PaymentController::class, 'flutterwavePayment'])->name('flutterwave');
Route::get('razorpay/{slug}/{pay_id}/{order_id}', [PaymentController::class, 'razerpayPayment'])->name('razorpay');
Route::post('{slug}/paytm/prepare-payments/', [PaymentController::class, 'paytmOrder'])->name('paytm.prepare.payments');
Route::post('paytm/callback/', [PaymentController::class, 'paytmCallback'])->name('paytm.callback');
Route::post('{slug}/mollie/prepare-payments/', [PaymentController::class, 'mollieOrder'])->name('mollie.prepare.payments');
Route::get('{slug}/{order_id}/mollie/callback/', [PaymentController::class, 'mollieCallback'])->name('mollie.callback');
Route::post('{slug}/mercadopago/prepare-payments/', [PaymentController::class, 'mercadopagoPayment'])->name('mercadopago.prepare');
Route::any('{slug}/mercadopago/callback/', [PaymentController::class, 'mercadopagoCallback'])->name('mercado.callback');


Route::post('{slug}/coingate/prepare-payments/', [PaymentController::class, 'coingatePayment'])->name('coingate.prepare');
Route::get('coingate/callback', [PaymentController::class, 'coingateCallback'])->name('coingate.callback');


Route::post('{slug}/skrill/prepare-payments/', [PaymentController::class, 'skrillPayment'])->name('skrill.prepare.payments');
Route::get('skrill/callback', [PaymentController::class, 'skrillCallback'])->name('skrill.callback');

// Toyyinpay
Route::post('toyyibpay-prepare/{slug}', [ToyyibpayController::class, 'toyyibpayPayment'])->name('toyyibpay');
Route::get('toyyibpay-payment/{slug}/{amount}/{couponCode}', [ToyyibpayController::class, 'toyyibpayGetPayment'])->name('toyyibpay.callback');

// Payfast
Route::post('payfast-prepare/{slug}', [PayfastController::class, 'payfastPayment'])->name('payfast');
Route::get('payfast-payment/{success}/{slug}', [PayfastController::class, 'payfastsuccess'])->name('payfast.success');

//ORDER PAYMENTWALL
Route::post('{slug}/paymentwall/store-slug/', [StoreController::class, 'paymentwallstoresession'])->name('paymentwall.session.store');
Route::any('/{slug}/paymentwall/order', [PaymentController::class, 'paymentwallPayment'])->name('paymentwall.index');
Route::any('/{slug}/paymentwall/callback', [PaymentController::class, 'paymentwallCallback'])->name('paymentwall.callback');
Route::any('/{slug}/order/error/{flag}', [PaymentController::class, 'orderpaymenterror'])->name('order.callback.error');

/*CHECKBOX*/
Route::post('student-watched/{id}/{course_id}/{slug?}', [StoreController::class, 'checkbox'])->name('student.checkbox');
Route::post('student-remove-watched/{id}/{course_id}/{slug?}', [StoreController::class, 'removeCheckbox'])->name('student.remove.checkbox');

Route::get('{slug?}/edit-products/{theme?}', [StoreController::class, 'Editproducts'])->middleware(['auth','XSS'])->name('store.editproducts');
Route::post('{slug?}/store-edit-products/{theme?}', [StoreController::class, 'StoreEditProduct'])->middleware(['auth'])->name('store.storeeditproducts');

/**/
Route::get('user-address/{slug?}/useraddress', [StoreController::class, 'userAddress'])->name('user-address.useraddress');
Route::get('store-payment/{slug?}/userpayment', [StoreController::class, 'userPayment'])->name('store-payment.payment');
Route::get('store/{slug?}/product/{id}', [StoreController::class, 'productView'])->name('store.product.product_view');
Route::post('user-product_qty/{slug?}/product/{id}/{variant_id?}', [StoreController::class, 'productqty'])->name('user-product_qty.product_qty');
Route::post('customer/{slug?}', [StoreController::class, 'customer'])->name('store.customer');
Route::post('user-location/{slug}/location/{id}', [StoreController::class, 'UserLocation'])->name('user.location');
Route::post('user-shipping/{slug}/shipping/{id}', [StoreController::class, 'UserShipping'])->name('user.shipping');
Route::post('save-rating/{slug?}', [StoreController::class, 'saverating'])->name('store.saverating');
Route::delete('delete_cart_item/{slug?}/product/{id}/{variant_id?}', [StoreController::class, 'delete_cart_item'])->name('delete.cart_item');


Route::get('store-complete/{slug?}/{id}', [StoreController::class, 'complete'])->name('store-complete.complete');


Route::post('add-to-cart/{slug?}/{id}/{variant_id?}', [StoreController::class, 'addToCart'])->name('user.addToCart');

Route::middleware(['XSS'])->group(function () {
    Route::get('order', [StripePaymentController::class,'index'])->name('order.index');
    Route::get('/stripe/{code}', [StripePaymentController::class,'stripe'])->name('stripe');
    Route::post('/stripe/{slug?}', [StripePaymentController::class,'stripePost'])->name('stripe.post');
    Route::post('stripe-payment', [StripePaymentController::class,'addpayment'])->name('stripe.payment');
});


Route::post('pay-with-paypal/{slug?}', [PaypalController::class, 'PayWithPaypal'])->middleware(['XSS'])->name('pay.with.paypal');
// Route::get('{id}/get-payment-status{slug?}', [PaypalController::class, 'GetPaymentStatus'])->middleware(['XSS'])->name('get.payment.status');

Route::get('{id}/get-payment-status{slug?}', [PaypalController::class,'GetPaymentStatus'])->name('get.payment.status')->middleware(['XSS']);


Route::get('{slug?}/order/{id}', [StoreController::class, 'userorder'])->name('user.order');

Route::post('{slug?}/whatsapp', [StoreController::class, 'whatsapp'])->name('user.whatsapp');
Route::post('{slug?}/cod', [StoreController::class, 'cod'])->name('user.cod');
Route::post('{slug?}/bank_transfer', [StoreController::class, 'bank_transfer'])->name('user.bank_transfer');

Route::get('/apply-coupon', [CouponController::class, 'applyCoupon'])->middleware(['auth','XSS'])->name('apply.coupon');

Route::get('/apply-productcoupon', [ProductCouponController::class, 'applyProductCoupon'])->name('apply.productcoupon');

//Student SIDE
Route::get('{slug}/student-home', [StoreController::class, 'studentHome'])->middleware(['studentAuth'])->name('student.home');
Route::get('{slug}/student-wishlist', [StoreController::class, 'wishlistpage'])->middleware(['studentAuth'])->name('student.wishlist');


/*WISHLIST*/
Route::post('{slug}/student-addtowishlist/{id}', [StoreController::class, 'wishlist'])->name('student.addToWishlist');
Route::post('{slug}/student-removefromwishlist/{id}', [StoreController::class, 'removeWishlist'])->middleware(['studentAuth'])->name('student.removeFromWishlist');

// Subscription
Route::middleware(['XSS'])->group(function () {
    Route::resource('subscriptions', SubscriptionController::class);
    Route::POST('subscriptions/{id}', [SubscriptionController::class,'store_email'])->name('subscriptions.store_email');
});


// Ratting
Route::middleware(['XSS'])->group(function () {
    Route::resource('rating', RattingController::class);
    Route::post('rating_view', [RattingController::class,'rating_view'])->name('rating.rating_view');
    Route::get('rating/{slug?}/product/{id}', [RattingController::class,'rating'])->name('rating');
    Route::post('store_rating/{slug?}/product/{course_id}/{tutor_id}', [RattingController::class,'store_rating'])->name('store_rating');
    Route::post('edit_rating/product/{id}', [RattingController::class,'edit_rating'])->name('edit_rating');
});

Route::get('change-language-store/{slug?}/{lang}', [LanguageController::class, 'changeLanquageStore'])->middleware(['XSS'])->name('change.languagestore');
