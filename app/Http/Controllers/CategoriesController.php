<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Inertia\Inertia;


class CategoriesController extends Controller
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
            sleep(1);
            $categories = Category::all();

            return Inertia::render('Blog/Admin/ListCategory', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'categories' => $categories,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $newCategory = new Category;
            $newCategory->original_name = '';
            $newCategory->save();

            $categories = Category::all();

            return Inertia::render('Blog/Admin/ListCategory', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'categories' => $categories,
            ]);

            return redirect()->route('adminCategories.index')->with('message', "Category created successfully");

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            return Inertia::render('Blog/Admin/ListCategory', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category_name = $request->validated()['original_name'];
        $category2 = Category::find($category->id);
        $category2->update([
            'original_name' => $category_name,
        ]);

        return redirect()->route('adminCategories.index')
            ->with('message', "Category $category_name updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $category_name = $category->original_name;
            $category->delete();
            return redirect()->route('adminCategories.index')->with('message', "Category $category_name deleted successfully");
        }
    }
}
