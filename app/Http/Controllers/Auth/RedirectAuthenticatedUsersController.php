<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RedirectAuthenticatedUsersController extends Controller
{
    public function home()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('adminPanel');
        }
        elseif(auth()->check()){
            return redirect()->route('dashboard');
        }
        else{
            return redirect()->route('dashboard');
        }
    }
}
