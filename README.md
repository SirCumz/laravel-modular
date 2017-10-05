laravel-modular!
===================
[![Latest Stable Version](https://poser.pugx.org/sircumz/laravel-modular/v/stable)](https://packagist.org/packages/sircumz/laravel-modular) [![Total Downloads](https://poser.pugx.org/sircumz/laravel-modular/downloads)](https://packagist.org/packages/sircumz/laravel-modular) [![Latest Unstable Version](https://poser.pugx.org/sircumz/laravel-modular/v/unstable)](https://packagist.org/packages/sircumz/laravel-modular) [![License](https://poser.pugx.org/sircumz/laravel-modular/license)](https://packagist.org/packages/sircumz/laravel-modular)

A Laravel 5.4+ package for a modular design.

----------

Install
-------
The preferred way of installing is through composer

    composer require SirCumz/laravel-modular

Add the service provider to config/app.php:

    SirCumz\LaravelModular\LaravelModularServiceProvider::class

Publish the package

    php artisan vendor:publish --tag=modules

Navigate to "app/Modules" to view the code of the **Example module**.

To view the output of the **Example module** goto:

    http://localhost/Example


Theme support with laravel-themes
-------
Laravel Modular depends on laravel-themes! make sure you install and configure this package.

see: https://github.com/SirCumz/laravel-themes

Compiling Module Assets with laravel-mixable
-------
Laravel Modular depends on laravel-mixable! make sure you install and configure this package.

see: https://github.com/SirCumz/laravel-mixable
