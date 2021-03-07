<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Library\Helper;
use Illuminate\Support\Facades\DB;

class PublicPagesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::Publish()->orderBy('created_at', 'desc')->offset(1)->limit(30)->get();
        $top_news = Article::Publish()->orderBy('created_at', 'desc')->first();
        return view('public/index', compact('articles', 'top_news'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('public/dummy', ['articles' => Article::findOrFail($id)]);
    }

    public function shou()
    {
        // $articles = Article::where('create_at', '=', enumTAskState::OPEN)->orWhere('state', '=', enumTAskState::CLOSE)->get();
        $articles = Article::orderBy('created_at', 'desc')->limit(3)->get();
        return view('public/dummy', compact('articles'));
    }

    public function dummy()
    {
        return view('public/dummy');
    }
}
