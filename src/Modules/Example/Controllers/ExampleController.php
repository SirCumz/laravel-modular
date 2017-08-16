<?php

namespace App\Modules\Example\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the example index view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Example::index');
    }

}
