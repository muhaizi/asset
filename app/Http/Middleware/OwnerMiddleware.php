<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnerMiddleware
{

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $currentUser = $this->auth->user()->id;
        
        //The route model binding on middleware you can access it by using the request method:
        $asset = $request->route('asset');
        //dd($asset->created_by, $currentUser);

        if ($asset->created_by !== $currentUser) {
            abort(401, 'Unauthorized action.');
        }

        return $next($request);
    }
}
