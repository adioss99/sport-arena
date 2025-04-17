<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Carbon\Carbon;

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
        Blade::directive('currency', function ($expression) {
            return "Rp <?php echo number_format($expression,0,',','.'); ?>";
        });

        Blade::directive('dateFormat', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('d M Y H:i'); ?>";
        });

        Blade::directive('time', function ($expression) {
            return "<?php
                        try {
                            echo \\Carbon\\Carbon::createFromFormat('H:i:s',$expression ?? '00:00:00')->format('H:i');
                        } catch (\\Exception \$e) {
                            echo $expression; // fallback to original value if it fails
                        }
                    ?>";
        });
    }
}
