<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index(){
        return response()->json(['message' => 'Welcome to API V1']);
    }
}
