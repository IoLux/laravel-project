<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            "articles" => Article::latest()->filter(request(['search', 'category',]))->paginate(4)->withQueryString(),
            "active" => "home",
            "title" => 'All Article',
        ]);
    }

    /**
     * Show user blog only
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userIndex(User $user)
    {
        return view('home', [
            "articles" => $user->article()->filter(['search'])->paginate(3)->withQueryString(),
            "active" => "home",
            "title" => 'All Article From ' . $user->name,
        ]);
    }

    public function show(Article $article)
    {
        return view('view', [
            "article" => $article
        ]);
    }

    public function create(Request $request)
    {
        /*
        apparently this category return the value from option
        and it can be use for adding the category id

        dd(request('category'));
        */
        
        $article = $request->validate([
            "title" => "required|string|unique:articles",
            "body" => "required|string|unique:articles",
            "category" => "required",
        ]);

        Article::create([
            "title" => $article['title'],
            "slug" => Str::of($article['title'])->slug('-'),
            "body" => $article['body'],
            "user_id" => Auth::id(),
            "category_id" => $article['category'],
        ]);

        return redirect('/home');
    }

    public function edit(Request $request,$id)
    {
        $article = $request->validate([
            "title" => "required",
            "body" => "required",
            "category" => "required",
        ]);

        Article::find($id)->update([
            "title" => $article['title'],
            "slug" => Str::of($article['title'])->slug('-'),
            "body" => $article['body'],
            "category" => $article['category'],
        ]);

        return redirect('/home');
    }

    public function destroy($id)
    {
        Article::destroy($id);
        

        return redirect('/home');
    }
}
