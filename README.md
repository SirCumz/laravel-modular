1. composer require sircumz/laravel-modular

2. Add the service provider "SirCumz\LaravelModular\LaravelModularServiceProvider::class" to config/app.php

3. php artisan vendor:publish --tag=modules

Add the following code to "webpack.mix.js" if you want to enable asset compiling for modules.

    /*
     |--------------------------------------------------------------------------
     | Mix Asset Management For Modules
     |--------------------------------------------------------------------------
     |
     | Mix Module assets
     | If a module has a mix.js file, it will be compiled into the mix
     |
     */
    var fs = require('fs');

    var dirs = fs.readdirSync('./app/Modules');

    for (var i=0; i<dirs.length; i++) 
    {
        var file = './app/Modules/' + dirs[i];

        var stat = fs.statSync(file);

        if(stat.isDirectory())
        {
            if(fs.existsSync(file + '/mix.js'))
            {                 
                require(file + '/mix.js').mix( mix );
            }             
        }    
    }

And inside the "app/Modules/Example" module, you will find an example mix.js file:

    module.exports = {
        mix: function(mix) {
            mix.sass( __dirname + '/assets/css/example.css', 'public/modules/example/css/example.css'); 
        }
    }
