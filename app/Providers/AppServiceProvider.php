<?php

namespace App\Providers;

use App\Settings\GeneralSettings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
    public function boot(GeneralSettings $settings): void
    {
        View::share('settings', $settings);

        Blade::directive('spaLink', function () {
            return '<?php echo spa_link(); ?>';
        });

        Blade::directive('smartTarget', function ($expression) {
            return "<?php echo {$expression} ? 'target=\"_blank\"' : spa_link(); ?>";
        });
    }
}
