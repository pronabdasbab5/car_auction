<?php

namespace App\Http\Middleware\Member;

use App\Models\Apikey\Apikey;
use Closure;
use Response;

class RedirectIfAuthenticated
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
        $api_key = new Apikey;

        $api_key_count = $api_key->where('userId', $request->userId)->where('api_token', $request->api_token)->count();

        if ($api_key_count > 0) {

            return $next($request);
        } else {

            $data = [];

            $message = "Bad Authentication";

            $response = [
                'code'    => 200,
                'status'  => false,
                'data'    => $data,
                'message' => $message,
            ];

            return response()->json($response, 200);
        }
    }
}
