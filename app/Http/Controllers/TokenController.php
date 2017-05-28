<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Exception;
use App\User;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{

    public function VerifyToken(Request $request) {

        $token = explode(' ',$request->header('Authorization'));
        $secret = config('app.key'); // get from config file

        try {
           $payload = JWT::decode($token[1], $secret, array('HS256'));
           $data = array('token' => $payload,'status'=>$token);
        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }

    public function getToken(Request $request) {
        $time = time() + ( 24 * 10 * 10); // one day
        $secret = config('app.key'); // get from config file
        $status = 'success';

        $payload = array(
            "exp" => $time,
        );

        try {

            //login
            $this->checkLogin($request);

            //jwt section
            $jwt = JWT::encode($payload, $secret);
            $data = array('token' => $jwt,'status'=>$status);
        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
        }

        return response()->json($data);
    }

    public function checkLogin($request) {
        if ($request->username ==  null) {
            throw new Exception("Error : Username is empty");
            
        }
        if ($request->password ==  null) {
            throw new Exception("Error : Password is empty");
            
        }

        $user = User::where('username',$request->username)->orWhere('email',$request->username)
                ->firstOrFail();

        if (!Hash::check($request->password, $user->password)) {
            throw new Exception("Error : Password is Wrong");
        }

        return true;
    }

}
