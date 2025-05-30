<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// tambahan untuk notif jumlah yang belum disetujui
use App\Models\Umat;
use Illuminate\Support\Facades\View;

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
        // tambahan untuk notif jumlah yang belum disetujui
        View::composer('*', function ($view) {
            $jumlahPending = Umat::where('status_pendaftaran', 'Pending')->count();
            $view->with('jumlahPending', $jumlahPending);
        });
    }
}
