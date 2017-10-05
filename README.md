laravel-modular!
===================
[![Latest Stable Version](https://poser.pugx.org/SirCumz/laravel-modular/v/stable)](https://packagist.org/packages/SirCumz/laravel-modular) [![Total Downloads](https://poser.pugx.org/SirCumz/laravel-modular/downloads)](https://packagist.org/packages/SirCumz/laravel-modular) [![Latest Unstable Version](https://poser.pugx.org/SirCumz/laravel-modular/v/unstable)](https://packagist.org/packages/SirCumz/laravel-modular) [![License](https://poser.pugx.org/SirCumz/laravel-modular/license)](https://packagist.org/packages/SirCumz/laravel-modular)

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


Compiling Module Assets with laravel-mixable
-------

see: https://github.com/SirCumz/laravel-mixable
