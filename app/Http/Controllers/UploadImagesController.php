<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UploadImage;
use App\Library\Helper;
use App\Library\RequestValidator as RequestValidator;

class UploadImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        // resolveCurrentPageで現在ページは解決する
        $images = UploadImage::where('delete_request', '=', '0')->orderBy('id', 'desc')->Paginate(config('const.common.PAGINATION.PER_PAGE.IMAGES'), ['*'], 'page');

        $validator = RequestValidator::pagination($request, $images->lastpage());

        if ($validator->fails()) {
            return redirect()
                ->route('image.upload_form')
                ->withErrors($validator);
        }

        return view('image/upload_form')
            ->with('images', $images);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('image/upload_image_show', [
            'uploaded_image' => UploadImage::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function upload(Request $request)
    {

        $validator = RequestValidator::uploadImage($request->all());

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        } else {
            $newImage = new UploadImage;
            // save to storage/app/public/images
            $filepath = $request->file('image')->store('public/images');
            $newImage->path = $filepath;
            $newImage->name = str_replace('public/images/', '', $filepath);
            $newImage->user_id = Helper::getUser()[0];
            // $newImage->user_id = auth()->id();
            $newImage->save();
            return view('test')
                ->with([
                    'msg' => 'upload complete',
                    'filename' => $newImage->name
                ]);
        };
    }

    public function deleteRequest(Request $request)
    {
        $uploadImage = UploadImage::find($request->id);
        $uploadImage->delete_request = boolval(1);
        $uploadImage->save();
        return redirect()->route('image.upload_form');
    }

    public function selectArticleImage(Request $request)
    {

        $images = UploadImage::where('delete_request', '=', '0')->orderBy('id', 'desc')->Paginate(config('const.common.PAGINATION.PER_PAGE.IMAGES'), ['*'], 'page');

        $validator = RequestValidator::pagination($request, $images->lastpage());

        if ($validator->fails()) {
            return redirect()
                ->route('image.select')
                ->withErrors($validator);
        }

        return view('image.select_article_image')
            ->with('images', $images);
    }
}
