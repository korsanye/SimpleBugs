<?php

namespace App\Providers;

use cebe\markdown\GithubMarkdown;
use Illuminate\Support\ServiceProvider;
use Michelf\MarkdownExtra;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(MarkdownExtra::class, function() {
            $parser = new MarkdownExtra();
            return $parser;

        });
    }
}
