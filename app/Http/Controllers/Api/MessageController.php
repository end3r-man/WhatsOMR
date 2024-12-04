<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Http;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function HandleMessage(Request $request)
    {

        $request->validate([
            'number' => 'required|numeric|digits:12',
            'name' => 'required|max:150',
            'date' => 'required',
            'time' => 'required',
            'email' => 'nullable|email',
            'gender' => 'required',
        ]);

        $urlm = 'http://localhost:3000/msg';

        $sendc = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($urlm, [
            'number' => $request->number,
            'name' => $request->name,
            'date' => $request->date,
            'time' => $request->time,
            'email' => $request->email ?? 'Null',
            'gender' => $request->gender,
        ]);

        return true;
    }
}
