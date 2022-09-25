<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->is_admin) {
            return redirect('/dashboard');
        }
        elseif(auth()->check()){
            return redirect('/dashboard');
        }
        else{
            return redirect('/dashboard');
        }
    }
}
