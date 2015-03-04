<?php namespace App\Providers;

use Illuminate\Html\HtmlServiceProvider;
class MacroServiceProvider extends HtmlServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require base_path() . '/resources/macros/alert_macro.php';
        // require base_path() . '/resources/macros/macro2.php';
        // etc...
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // $this->app->bind(
        //      require base_path() . '/resources/macros/alert_macro.php';
        // );
        parent::register();
       require base_path() . '/resources/macros/alert_macro.php';
    }

}