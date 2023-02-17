<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function authorize($ability, $arguments = [])
    {
        if (! Gate::check($ability, $arguments)) {
            abort(403);
        }
    }


}
