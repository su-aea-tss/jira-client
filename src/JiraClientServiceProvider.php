<?php


namespace SUTSS\JiraClient;


use Illuminate\Support\ServiceProvider;
use SUTSS\JiraClient\JiraClient;


class JiraClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('jiraclient', function ($app) {
        return new JiraClient();
    });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }
}
