<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckController extends Controller
{

    private $hashToken = "$2y$12$7sqhPngJx97sQkNKv7YyMe6RqOJuIX12TcsAncG2iCICe3Xx.NkNO";

    public function verifyToken(Request $request){

        $fields = $request->all();

        $errors = Validator::make($fields, [
            'token' => 'required|string'
        ]);

        if($errors->fails())
        {
            return response($errors->errors()->all());
        }

        if($request->token && $request->token == $this->token){
            return response(true, 200);
        }

        return response(false, 400);

        
    }

    public static function token()
    {
        return self::$hashToken;
    }

    public function  getToken()
    {
        return response([
            'token' => $this->hashToken,
        ], 200);
    }

    public function validateFormData(Request $request)
    {
        $fields = $request->all();
        dd($fields);
    }


}
