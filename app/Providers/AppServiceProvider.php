<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ProductCategory;
use App\Models\User;
use App\Models\Product;
use App\Models\Broucher;
use App\Helpers\CountryHelper;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $menuCategories = ProductCategory::where('status', 'Active')
                                ->where('is_menu', 1)
                                ->get();

            $footerMenuCategories = ProductCategory::where('status', 'Active')->get();

            $adminProfile = User::first(); 

            $products = Product::where('status', 'Active')->get();
            $countries = CountryHelper::getAllCountries();
            $broucher =Broucher::latest()->first();
            $finderCategories = ProductCategory::with(['products' => function($q) {
            $q->where('status', 'Active');
           }])->get();

            $view->with([
                'menuCategories' => $menuCategories,
                'footerMenuCategories' => $footerMenuCategories,
                'user' => $adminProfile,
                'activeProducts' => $products,
                'countries'=> $countries,
                'broucher' => $broucher,
                'finderCategories' => $finderCategories,
            ]);
        });
    }
}
