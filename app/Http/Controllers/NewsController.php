<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\News;
use Exception;

class NewsController extends Controller
{
    public function add()
    {
        $title = "Add - New | Admin";
        $data = compact('title');
        return view('news.add')->with($data);
    }
    public function view()
    {
        $title = "View - News | Admin";
        $news = News::orderBy('id', 'desc')->get(); //select 
        $data = compact('title', 'news');
        return view('news.view')->with($data);
    }

    public function create(Request $request)
    {

        $validation = Validator::make(
            $request->all(),
            [
                'news_title' => ['required', 'max:100'],
                'news_desc' => ['required']
            ],
            [
                'news_desc.required' => 'The news desciption field is required.'
            ]
        );
        if ($validation->fails()) {
            // p($validation->messages());
            return redirect()->back()->withErrors($validation->messages())->withInput();
        }

        try {
            $news = new News();
            $news->title = $request['news_title'];
            $news->description = $request['news_desc'];
            $news->image = "";
            $news->save(); //create
        } catch (\Exception $err) {
            $news = null;
        }
        if (is_null($news)) {
            return redirect()->back()->withErrors("Internal server error")->withInput();
        }
        return redirect('/news');
    }

    public function destroy($id)
    {
        try {
            $newsData = News::where('id', $id)->first();
            $newsData->delete();
        } catch (\Exception $err) {
            $newsData = null;
        }
        if (is_null($newsData)) {
            return redirect()->back()->withErrors("Internal server error");
        }
        return redirect()->back();
    }

    public function toggle($id)
    {
        try {
            $newsData = News::where('id', $id)->first();
            if ($newsData->status == 1) {
                $newsData->status = 0;
            } else {
                $newsData->status = 1;
            }
            $newsData->save(); //update
        } catch (\Exception $err) {
            $newsData = null;
        }
        if (is_null($newsData)) {
            return redirect()->back()->withErrors("Internal server error");
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $news = News::where('id', $id)->first();
        if (is_null($news)) {
            return redirect()->back()->withErrors("Invalid id");
        } else {
            $data = [
                'title' => "Update News",
                'news' => $news
            ];
            return view('news.update')->with($data);
        }
    }

    public function update($id, Request $request)
    {
        $news = News::where('id', $id)->first();
        if (is_null($news)) {
            return redirect()->back()->withErrors("Invalid id");
        } else {
            $validation = Validator::make(
                $request->all(),
                [
                    'news_title' => ['required', 'max:100'],
                    'news_desc' => ['required']
                ],
                [
                    'news_desc.required' => 'The news desciption field is required.'
                ]
            );
            if ($validation->fails()) {
                return redirect()->back()->withErrors($validation->messages())->withInput();
            }
            try {
                $news->title = $request['news_title'];
                $news->description = $request['news_desc'];
                $news->save();
            } catch (Exception $err) {
                $news = null;
            }
            if (is_null($news)) {
                return redirect()->back()->withErrors("Internal server error")->withInput();
            }
            return redirect('/news');
        }
    }
}
