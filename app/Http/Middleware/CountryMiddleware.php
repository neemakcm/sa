<?php

namespace App\Http\Middleware;

use Closure;

class CountryMiddleware
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
        //dd(1);
        // $countryShortcode = $request->route('country');
        $countryShortcode ='in';
       $routeName = $request->route()->getName();
       $routeParameters = $request->route()->parameters();
       if ($request->session()->has('redirect_to_country')) {
           $redirectTo = $request->session()->get('redirect_to_country');
           if ($country === $redirectTo) {
               $request->session()->forget('redirect_to_country');
           } else {
               $routeParameters['country'] = $redirectTo;
               return redirect()->route($routeName, $routeParameters);
           }
       }
       $country = Country::where('country_shortcode', '=', $countryShortcode)->where('is_active', '=', 1)->first();
       if ($country === null) {
           return redirect('/');
       }
       $request->session()->put('country', $country);
       $request->session()->save();
       return $next($request);
    }
}
