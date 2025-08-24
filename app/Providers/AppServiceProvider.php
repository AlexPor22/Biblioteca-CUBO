<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\LibroDigital;
use App\Models\AudioLibro;
use App\Observers\LibroDigitalObserver;
use App\Observers\AudioLibroObserver;

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
    public function boot(): void
    {
        //
        LibroDigital::observe(LibroDigitalObserver::class);
        AudioLibro::observe(AudioLibroObserver::class);
    }
}
