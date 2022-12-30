<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $users = User::all();

            return Inertia::render('Blog/Admin/ListUser', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'users' => $users,
            ]);
        }
    }
}
