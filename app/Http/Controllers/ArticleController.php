<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::all();
        return view('article.index', compact('articles'));
    }
    public function create(){
        return view('article.create');
    }
    public function store(Request $request){
        //primo metodo
        // Article::create($request->all());

        //secondo metodo
        Article::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return 'ok';
    }
}
