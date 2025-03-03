<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('website.news');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.list');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'news_title' => 'required',
            'news_desc' => 'required',
            'news_image' => 'required',
            'news_slug' => 'required|unique:news'
        ]);
        $news = new News;
        $news->news_title = $request->news_title;
        $news->news_slug = Str::slug($request->news_slug);
        $news->news_date = $request->news_date;
        $news->news_desc = $request->news_desc;
        if ($request->hasFile('news_image')) {
            $image_path = date('Y-m-d-H_i_s').'_' .$request->file('news_image')->getClientOriginalName();
            $request->file('news_image')->storeAs('news_images', $image_path,['disk' => 'public']);
            $news->news_image = $image_path;
        }
        $news->save();
        return redirect()->back()->withSuccess('News added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        $news =  News::get();
        return ['data'=> $news];
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $news =  News::where('news_slug', $slug)->first();
        return view('website.news_details', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $news =  News::find($request->id);
        $news->delete();
        return ['warning'=>'News Deleted successfully'];
    }
}