<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Admin;
use Hash;
class AdminController extends Controller
{
    public function login(Request $request)
    {
        $user=  Admin::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }

                $token = $user->createToken('my-app-token')->plainTextToken;
                // $response = \Session::put('token', $token);
            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->json($response, 200);
    }
}
