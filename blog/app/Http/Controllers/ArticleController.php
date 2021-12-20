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
                'publication_date' => $article->publication_date,
                'mood' => $this->getTextMood($article->text)
            ]);
        }
        return response()->json($articles);
    }

    /**
     * Create a new article from $request
     */
    public function createArticle(Request $request) 
    {
        $this->validate($request, [
            'name' => 'required|string',
            'author' => 'required|string',
            'text' => 'required|string',
        ]);
        $article = Article::create($request->all());
        return response()->json($article, 201);
    }

    /**
     * Update text of article with given id 
     */
    public function editArticle(Request $request) 
    {
        $this->validate($request, [
            'id' => 'required|integer',
            'text' => 'required|string',
        ]);

        $article = Article::findOrFail($request->id)
                    ->update(['text' => $request->text]);
        return response()->json($article, 200);
    }


    /**
     * Delete an article with given id
     */
    public function deleteArticle(Request $request) 
    {
        $this->validate($request, [
            'id' => 'required|integer'
        ]);

        $article = Article::findOrFail($request->id);
        $article->delete();
        return response("Successful");
    }

    public function getTextMood(string $text) {
        $curl = curl_init("https://sentim-api.herokuapp.com/api/v1/");

        $headers = [
            "Accept: application/json",
            "Content-Type: application/json",
        ];
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = <<<DATA
        {
            "text": $text
        }
        DATA;
        
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        
        //for debug only!
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $resp = curl_exec($curl);
        curl_close($curl);    

        $json_resp = json_decode($resp);
        return $json_resp->result->type;
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
