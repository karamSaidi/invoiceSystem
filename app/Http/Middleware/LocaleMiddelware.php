<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;

class LocaleMiddelware
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
        if(config('locale.status')){
            if( session()->has('locale') && array_key_exists(session()->get('locale'), config('locale.languages')) ){
                app()->setLocale(session()->get('locale'));
            }
            else{
                $userLanguages = preg_split('/[,;]/', $request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach($userLanguages as $language){
                    if(array_key_exists($language, config('locale.languages'))){
                        app()->setLocale($language);
                        setlocale(LC_TIME, config('locale.languages')[$language][2]);
                        Carbon::setLocale(config('locale.languages')[$language][0]);
                        if(config('locale.languages')[$language][2]){
                            session(['lang-rtl' => true]);
                        }
                        else{
                            session()->forget('lang-rtl');
                        }
                    break;
                    }
                }
            }
        }
        else{

        }
        return $next($request);
    }
}
