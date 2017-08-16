<?php
if (!function_exists('modules_path')) {
    function modules_path($path = '') {
        return app_path('Modules').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }    
}
