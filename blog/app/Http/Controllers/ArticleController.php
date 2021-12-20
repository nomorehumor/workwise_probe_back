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


    /**
     * Get information about all articles
     * Returns id, name, author, creation time and publication time of each article
     */
    public function showAllArticles(Request $request) 
    {

        $articles = [];
        foreach (Article::all() as $article) {
            array_push($articles, [
                'id' => $article->id,
                'name' => $article->name,
                'author' => $article->author,
                'creation_time' => $article->creation_time,
                'publication_date' => $article->publication_date
            ]);
        }
        return response()->json($articles);
    }

    /**
     * Create a new article from $request
     */
    public function createArticle(Request $request) 
    {
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    /**
     * Update text of article with given id 
     */
    public function editArticle(Request $request) 
    {
        $article = Article::where('id', $request->id)
                    ->update(['text' => $request->text]);
        return response()->json($article, 201);
    }


    /**
     * Delete an article with given id
     */
    public function deleteArticle(Request $request) 
    {
        $article = Article::findOrFail($request->id);
        $article->delete();
        return response("Successful");  
    }

    /**
     * Debug function to show all fields of all articles in the database
     */
    public function debugShowArticles(Request $request) 
    {
        return response()->json(Article::all());
    }

    //
}
