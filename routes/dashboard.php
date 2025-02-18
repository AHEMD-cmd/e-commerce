<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\FaqController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\WorldController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\Auth\ForgotPasswordController;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        ################################## Auth ####################################
        Route::get('login',   [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('login',  [AuthController::class, 'login'])->name('login.post');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        ################################# Reset Password #############################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {

            Route::controller(ForgotPasswordController::class)->group(function () {
                Route::get('email',          'showEmailForm')->name('email');
                Route::post('email',         'sendEmail')->name('email.post');
            });
            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email}/{token}', 'showResetForm')->name('reset');
                Route::post('reset', 'resetPassword')->name('reset.post');
            });
        });
        ################################## End Pssword #################################


        #------------------------------- Protected Routes -------------------------------#
        Route::group(['middleware' => 'auth:admin'], function () {

            ################################ Welcome Routes ###############################
            Route::get('welcome', [WelcomeController::class, 'index'])->name('welcome');

            ################################ Roles Routes ################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RoleController::class);
            });

            ################################ Admins Routes ############################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins',        AdminController::class);
                Route::get('admins/{id}/status', [AdminController::class, 'changeStatus'])
                    ->name('admins.status');
            });

            ############################ Shipping & Countries ##########################
            Route::group(['middleware' => 'can:global_shipping'], function () {
                Route::controller(WorldController::class)->group(function () {

                    Route::prefix('countries')->name('countries.')->group(function () {
                        Route::get('/',                              'getAllCountries')->name('index');
                        Route::get('/{country_id}/governorates',     'getGovsByCountry')->name('governorates.index');
                        Route::get('/change-status/{country_id}',    'changeStatus')->name('status');
                    });

                    Route::prefix('governorates')->name('governorates.')->group(function () {
                        Route::get('/change-status/{gov_id}',       'changeGovStatus')->name('status');
                        Route::put('/shipping-price',               'changeShippingPrice')->name('shipping-price');
                    });
                });
            });

            ############################### Category Routes ###############################
            Route::group(['middleware' => 'can:categories'], function () {
                Route::resource('categories', CategoryController::class)->except('show');
                Route::get('categories-all', [CategoryController::class, 'getAll'])
                    ->name('categories.all');
            });

            ############################### Brands Routes ###############################
            Route::group(['middleware' => 'can:brands'], function () {
                Route::resource('brands', BrandController::class)->except('show');
                Route::get('brands-all', [BrandController::class, 'getAll'])
                    ->name('brands.all');
            });

              ############################### Coupons Routes ###############################
              Route::group(['middleware' => 'can:coupons'], function () {
                Route::resource('coupons', CouponController::class)->except('show');
                Route::get('coupons-all', [CouponController::class, 'getAll'])
                    ->name('coupons.all');
            });

            ############################### Faqs Routes ################################
            Route::group(['middleware' => 'can:faqs'], function () {
                Route::resource('faqs', FaqController::class);
                Route::get('faqs-all', [FaqController::class, 'getAll'])
                    ->name('faqs.all');
            });

            ############################### Settings Routes ###############################
            Route::group(['middleware' => 'can:settings', 'as' => 'settings.'], function () {
                Route::get('settings',      [SettingController::class, 'index'])->name('index');
                Route::put('settings/{id}', [SettingController::class, 'update'])->name('update');
            });
        });
    }
);
