<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\ArticleStatus;
use App\Models\UploadImage;
use App\Library\Helper;

use Illuminate\Support\Facades\DB;


class PosterPagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        list($user_id, $user_name) = Helper::getUser();

        // $abc = Article::find(1)->statusName->name;
        // var_dump($abc);

        DB::enableQueryLog();
        $articles = DB::table('articles')
            ->leftJoin('article_statuses', 'status', '=', 'article_statuses.status_id')
            ->where('author', '=', $user_id)
            ->orderBy('articles.updated_at', 'desc')
            ->limit(999)
            ->select('articles.*', 'article_statuses.status_name')
            ->get();
        // dd(DB::getQueryLog());

        $article_statuses = ArticleStatus::all();
        $count = $articles->count();

        return view('poster/my_posts', compact('articles', 'article_statuses', 'user_id', 'user_name'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        list($user_id, $user_name) = Helper::getUser();

        $new_article = new Article;
        $new_article->title = $request->title;
        $new_article->content = $request->content;
        $new_article->author = $user_id;
        $new_article->status = $request->status_id;
        $new_article->featured_image_id = $request->image_id;
        $new_article->save();

        return redirect('/post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        var_dump($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('poster/article_edit', [
            'article' => Article::findOrFail($id),
            'statuses' => ArticleStatus::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $article = Article::find($id);
        $article->title = $request->title;
        $article->content = $request->content;
        $article->status = $request->status_id;
        $article->save();
        return redirect('post/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect('post/');
    }


    public function newPost(Request $request)
    {
        $request->session()->forget('editing_title');
        $request->session()->forget('editing_content');

        empty(request('image')) === true ? $req_image = '' : $req_image = request('image');

        $image = UploadImage::where('name', '=', $req_image)->first();

        list($user_id, $user_name) = Helper::getUser();
        $statuses = ArticleStatus::all();
        return view('poster/article_new_post', compact('statuses', 'user_id', 'user_name', 'image'));
    }

    public function continuePost(Request $request)
    {
        empty(request('image')) === true ? $image_name = '' : $image_name = request('image');

        $image = UploadImage::where('name', '=', $image_name)->first();

        list($user_id, $user_name) = Helper::getUser();
        $statuses = ArticleStatus::all();
        return view('poster/article_new_post', compact('statuses', 'user_id', 'user_name', 'image'));
    }

    public function saveEditingToSession(Request $request)
    {
        $request->session()->put('editing_title', $request->title);
        request()->session()->put('editing_content', request('content'));

        return redirect()->route('image.select');
    }
}
