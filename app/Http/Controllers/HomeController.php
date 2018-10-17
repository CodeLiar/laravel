<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = \App\Article::all();
        forEach ($articles as $article)
        {
            echo $article->title;
            // var_dump($article->$title);
        }
        return view('home')->with('articles', \App\Article::all());
    }

    public function mytest() {
        $models = \App\MyModel::all();
        print $models;
    }
}
