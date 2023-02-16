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

    public function successResponse($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $status);
    }

    public function errorResponse($message, $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $status);
    }
}
