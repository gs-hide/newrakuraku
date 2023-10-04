<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// 🔽 1行追加 🔽
use Illuminate\Routing\UrlGenerator;

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
   // 🔽 編集 🔽
      public function boot(UrlGenerator $url)
      {
        $url->forceScheme('https');
      }
}
