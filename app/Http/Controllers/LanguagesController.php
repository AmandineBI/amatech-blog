<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Inertia\Inertia;


class LanguagesController extends Controller
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
            $languages = Language::all();

            return Inertia::render('Blog/Admin/ListLanguage', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'languages' => $languages,
            ]);
        }
    }
}
