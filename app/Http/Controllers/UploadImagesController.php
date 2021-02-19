<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\UploadImage;
use App\Library\Helper;

class UploadImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('image/upload_form');
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
        $rules = [
            // 'name'                  => 'required',
            'email'                 => 'required|email',
            // 'password'              => 'required|confirmed',
            // 'password_confirmation' => 'required',
            'image' => 'required|mimes:jpeg,gif,png',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
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
}
