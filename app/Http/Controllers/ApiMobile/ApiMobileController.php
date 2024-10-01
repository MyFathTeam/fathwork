<?php

namespace App\Http\Controllers\ApiMobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiMobileController extends Controller
{

    /**
     * Get test mobile
     * Demo Cecep Abu Azhar API
     */
    
    public function testMobile(Request $request)
    {
        return response()->ok(true);
    }

}
