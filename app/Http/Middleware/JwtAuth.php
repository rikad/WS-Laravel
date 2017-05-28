<?php

namespace App\Http\Middleware;

use Illuminate\Http\Response;
use Closure;
use Firebase\JWT\JWT;
use Exception;

class JwtAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            $headerToken = $request->header('Authorization');
            if ($headerToken == null) {
                throw new Exception("Error : Token is empty");
            }
            $token = explode(' ',$headerToken);
            $secret = config('app.key'); // get from config file
            $payload = JWT::decode($token[1], $secret, array('HS256'));
            $request->merge(array('payload'=> $payload));

        } catch (Exception $e) {
            $data = array('status' => 'error','message'=> $e->getMessage());
            return Response(json_encode($data),401);
        }

        return $next($request);
    }
}
