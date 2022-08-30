<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;

class IndexController extends Controller
{
    public function view()
    {
        $title = "View - News";
        $news = News::orderBy('id', 'desc')->get(); //select 
        $data = compact('title', 'news');
        return view('frontend.news.index')->with($data);
    }
    public function read($id)
    {
        $title = "Read - News";
        $news = News::where('id', $id)->first(); //select 
        $data = compact('title', 'news');
        return view('frontend.news.read')->with($data);
    }
}
