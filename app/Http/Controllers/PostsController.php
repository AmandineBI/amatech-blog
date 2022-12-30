<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\Post;
use App\Models\Language;
use App\Models\Category;
//use App\Models\Tag;
use Inertia\Inertia;
use Spatie\Tags\Tag; 
use Illuminate\Support\Facades\Response;

class PostsController extends Controller
{
    /*public function __construct() {
        $this->middleware('can:list', ['only' => ['index', 'show']]);
        $this->middleware('can:edit', ['only' => ['create', 'store', 'edit', 'update']]);
    }*/
    //index()   fetch all the resources                         viewAny policy
    //show()    fetch a single resource                         view
    //create()  shows the form to use to create a resource      create
    //store()   to commit the recsource to the database         create
    //edit()    to show the form to update a resource           update
    //update()  to commit the edited resource to the databse    update
    //destroy() to delete a resource from the database          delete

    public function index() { // Limit data
        /*$posts1 = DB::table('posts')
                    ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                    ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                    ->where('contents.language_code', '=', 'EN')
                    ->where('seo_contents.language_code', '=', 'EN')
                    ->select('posts.*', DB::raw('coalesce(contents.content, posts.original_content) AS content'))
                    ->orderBy('published_at', 'desc')
                    ->get();*/

        $posts = Post::query()
                        ->with(['tags' => function ($query) {
                            $query->select('original_name');
                        }])
                        ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                        ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                        /*->where(function ($query) {
                            $query->where('contents.language_code', '=', 'EN')
                                ->orWhere();
                        })*/
                        ->whereRaw('coalesce(contents.language_code, "EN") = "EN" and coalesce(seo_contents.language_code, "EN") = "EN"')
                        ->select('posts.*', DB::raw('coalesce(contents.content, posts.original_content) AS content'))
                        ->orderBy('published_at', 'desc')
                        ->get();
                
        //return view('index', ['blog_posts' => $posts]);
        return Inertia::render('Blog/ListPost', [
            'permissions' => false,
            'filters' => request()->all('search'),
            'can' => [
                'list' => true,
                'edit' => false,
            ],
            'blog_posts' => $posts,
        ]);
        
    }


    public function indexAdmin() {
        $categories = Category::all();

        $posts = Post::query()
                        ->with(['tags' => function ($query) {
                            $query->select('original_name');
                        }])
                        ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                        ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                        ->join('categories', 'categories', '=', 'categories.id', 'left outer')
                        /*->where(function ($query) {
                            $query->where('contents.language_code', '=', 'EN')
                                ->orWhere();
                        })*/
                        ->whereRaw('coalesce(contents.language_code, "EN") = "EN" and coalesce(seo_contents.language_code, "EN") = "EN"')
                        ->select('posts.*', 'categories.original_name as category_name', DB::raw('coalesce(contents.content, posts.original_content) AS content'))
                        ->orderBy('published', 'asc')
                        ->orderBy('published_at', 'desc')
                        ->orderBy('updated_at', 'desc')
                        ->get();
                
        return Inertia::render('Blog/Admin/ListPost', [
            'permissions' => auth()->user()?->is_admin,
            'filters' => request()->all('search'),
            'can' => [
                'list' => true,
                'edit' => auth()->user()?->is_admin,
            ],
            'blog_posts' => $posts,
            'categories' => $categories
        ]);
        
    }

    public function indexAdminCategory($category_id) {
        $categories = Category::all();

        $posts = Post::query()
                        ->with(['tags' => function ($query) {
                            $query->select('original_name');
                        }])
                        ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                        ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                        /*->where(function ($query) {
                            $query->where('contents.language_code', '=', 'EN')
                                ->orWhere();
                        })*/
                        ->whereRaw('coalesce(contents.language_code, "EN") = "EN" and coalesce(seo_contents.language_code, "EN") = "EN" and categories = '.$category_id)
                        ->select('posts.*', DB::raw('coalesce(contents.content, posts.original_content) AS content'))
                        ->orderBy('published', 'asc')
                        ->orderBy('published_at', 'desc')
                        ->orderBy('updated_at', 'desc')
                        ->get();
                
        return Inertia::render('Blog/Admin/ListPost', [
            'permissions' => auth()->user()?->is_admin,
            'filters' => request()->all('search'),
            'can' => [
                'list' => true,
                'edit' => auth()->user()?->is_admin,
            ],
            'blog_posts' => $posts,
            'categories' => $categories,
            'selectedCategoryId' => $category_id
        ]);
        
    }


    public function show($post_id) { // Limit data
        $post = Post::query()
                        ->with(['tags' => function ($query) {
                            $query->select('original_name');
                        }])
                        ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                        ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                        /*->where(function ($query) {
                            $query->where('contents.language_code', '=', 'EN')
                                ->orWhere();
                        })*/
                        ->where('posts.id', $post_id)
                        ->whereRaw('coalesce(contents.language_code, "EN") = "EN" and coalesce(seo_contents.language_code, "EN") = "EN" and posts.published')
                        ->select('posts.*', DB::raw('coalesce(contents.content, posts.original_content) AS final_content, coalesce(contents.title, posts.title) AS final_title'))
                        ->orderBy('published_at', 'desc')
                        ->get(); // This returns an array???
        
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            return Inertia::render('Blog/ViewPost', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'blog_post' => $post[0],
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'laravelVersion' => '9',
                'phpVersion' => '8',
            ]);
        }

    }


    public function create() {
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $categories = Category::all();
            $languages = Language::all();
            return Inertia::render('Blog/Admin/CreatePost', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'categories' => $categories,
                'languages' => $languages
                //'blog_post' => $post[0],
            ]);
        }
    }


    public function store(StorePostRequest $request) {
        // store form inputs to database
        Post::create([
            'title' => $request->validated()['title'],
            'original_content' => $request->validated()['content'],
            'original_seo_content' => $request->validated()['content'],
            'categories' => $request->category?$request->category:0,
            'original_language_code' => $request->language?$request->language:'EN',
        ]);
        return redirect()->route('adminPanel')
                    ->with('message', 'Post created successfully');
    }


    public function destroy($post_id) { //route model binding?
        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $post = Post::query()->where('posts.id', $post_id);
            $post->delete();
            return redirect()->route('adminPanel')->with('message', 'Post deleted successfully');
        }
    }


    public function edit($post_id) { // Limit data

        if (!auth()->user()?->is_admin) {
            abort(403);
        } else {
            $post = Post::query()
                    ->with(['tags' => function ($query) {
                        $query->select('original_name');
                    }])
                    ->join('contents', 'posts.id', '=', 'contents.post_id', 'left outer')
                    ->join('seo_contents', 'posts.id', '=', 'seo_contents.post_id', 'left outer')
                    ->where('posts.id', $post_id)
                    ->whereRaw('coalesce(contents.language_code, "EN") = "EN" and coalesce(seo_contents.language_code, "EN") = "EN"')
                    ->select('posts.*', DB::raw('coalesce(contents.content, posts.original_content) AS final_content, coalesce(contents.title, posts.title) AS final_title'))
                    ->orderBy('published_at', 'desc')
                    ->get(); // This returns an array???
            $categories = Category::all();
            $languages = Language::all();
            return Inertia::render('Blog/Admin/EditPost', [
                'permissions' => auth()->user()?->is_admin,
                'filters' => request()->all('search'),
                'can' => [
                    'list' => true,
                    'edit' => auth()->user()?->is_admin,
                ],
                'blog_post' => $post[0],
                'categories' => $categories,
                'languages' => $languages,
            ]);
        }
    }


    public function update($post_id, StorePostRequest $request) {
        $post = Post::find($post_id);
        $post->update([
            'title' => $request->validated()['title'],
            'original_content' => $request->validated()['content'],
            'categories' => $request->category,
            'original_languase_code' => $request-> language,
        ]);

        return redirect()->route('adminPanel')
            ->with('message', 'Post updated successfully');
    }

    public function publish($post_id) {
        $post = Post::find($post_id);
        $post->update([
            'published' => 1,
            'published_at' => now()
        ]);

        return redirect()->route('adminPanel')
            ->with('message', 'Post published successfully');
    }

    public function archive($post_id) {
        $post = Post::find($post_id);
        $post->update([
            'published' => 0
        ]);

        return redirect()->route('adminPanel')
            ->with('message', 'Post archived successfully');
    }

}
