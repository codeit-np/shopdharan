<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Arr;

class Authenticate extends Middleware
{
    protected $guards;
    
    public function handle($request, Closure $next,...$guards){
        $this->guards = $guards;
        return parent::handle($request,$next,...$guards);
    }
    
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            $current_guard = Arr::first($this->guards);
            if($current_guard==='webvendor'){
                return route('supplier.login');
            }else if($current_guard==='webcustomer'){
                return route('customerlogin');
            }
            return route('admin.login');
        }
    }
}
