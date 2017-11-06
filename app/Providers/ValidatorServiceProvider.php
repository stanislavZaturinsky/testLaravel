<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    public function boot()
    {
        $this->app['validator']->extend('is_uppercase_first_chr', function ($attribute, $value, $parameters)
        {
            $chr = mb_substr ($value, 0, 1, "UTF-8");
            return mb_strtolower($chr, "UTF-8") != $chr;
        });

        $this->app['validator']->extend('is_uppercase', function ($attribute, $value, $parameters)
        {
            return ctype_upper($value);
        });
    }

    public function register()
    {
        //
    }
}