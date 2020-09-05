<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function change_locale($locale)
    {
        if(array_key_exists($locale, config('locale.languages'))){
            session()->put('locale', $locale);
            app()->setlocale($locale);

        }

        return redirect()->back();
    }


}
