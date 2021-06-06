<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Blog;
use App\Comment;

class HomeController extends Controller
{
    public function index()
    {
    	$posts = Blog::with('user')->where('status','published')->orderby('created_at','desc')->get();

    	return view('welcome',[
            'posts' => $posts
        ]);
    }

    public function details($slug)
    {
    	$item = Blog::with(['user','comments' => function($comments) {
            $comments->where('status', 'published');
        }])->where('slug',$slug)->first();

        return view('details',[
            'item' => $item
        ]);
    }

    public function commentSave(Request $request)
    {
    	if (!auth()->check()){
    		return redirect()->back()->with('warning','Sorry, Please Login!');
        }

    	$request->validate([
            'description' => ['required'],
        ]);

        $data = $request->all();
        $data ['user_id'] = Auth::user()->id;

        Comment::create($data);

        return redirect()->back()->with('success','Thanks, Message has been sended!');
    }

    public function search(Request $request)
    {
    	$posts = Blog::with('user')->where([
    		['status','published'],
    		['title','like','%'.$request->search.'%'],
    	])->orderby('created_at','desc')->get();

    	return view('search',[
            'posts' => $posts,
            'keyword' => $request->search,
        ]);
    }

    public function searchSorting(Request $request)
    {
        $filter = $request->filter;
        $keyword = $request->keyword;

        if($request->ajax()) {
            if (empty($keyword)) {
                $posts = Blog::with('user')->where([
                    ['status','published'],
                    ['title','like','%'.$keyword.'%'],
                ])->get();
            }

            if ($filter == 'terbaru') {
                $posts = Blog::with('user')->where([
                    ['status','published'],
                    ['title','like','%'.$keyword.'%'],
                ])->orderBy('created_at', 'desc')->get();
            }

            if ($filter == 'terlama') {
                $posts = Blog::with('user')->where([
                    ['status','published'],
                    ['title','like','%'.$keyword.'%'],
                ])->orderBy('created_at', 'asc')->get();
            }            
            
            return view('search-sorting', compact('posts'))->render();
        }
    }
}
