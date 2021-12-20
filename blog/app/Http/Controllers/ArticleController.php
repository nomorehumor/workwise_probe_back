<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showAllArticles(Request $request) 
    {
        return response()->json(Article::all());
    }

    public function createArticle(Request $request) 
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    //
}
