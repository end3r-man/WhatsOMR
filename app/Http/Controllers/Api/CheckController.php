<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{

    public function validateFormData(Request $request)
    {
        $fields = $request->all();
        dd($fields);
        
    }


}
