<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\View\Components\AdminAppLayout;
use App\View\Components\TeacherAppLayout;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('admin-app-layout', AdminAppLayout::class);
        Blade::component('teacher-app-layout', TeacherAppLayout::class);
    }
}
