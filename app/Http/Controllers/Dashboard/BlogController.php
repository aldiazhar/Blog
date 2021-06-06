<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Blog;
use App\Comment;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $posts = Blog::with('comments')->get();
        return view('dashboard.blog.index',[
            'posts' => $posts
        ]);
    }

    public function create()
    {
        if (auth()->check() && !auth()->user()->can('menulis-artikel')){
            Abort(404);
        }

        return view('dashboard.blog.create');
    }

    public function store(Request $request)
    {
        if (auth()->check() && !auth()->user()->can('menulis-artikel')){
            Abort(404);
        }

        $data = $request->all();

        $request->validate([
            'title' => ['required', 'string', 'max:255','min:3','regex:/(^[A-Za-z0-9 ]+$)+/'],
            'description' => ['required', 'min:3'],
            'thumbnail' => ['required','image'],
        ]);

        $data ['user_id'] = Auth::user()->id;
        $data ['slug'] = Str::slug($request->title);
        $data ['status'] = 'drafted';
        $data ['thumbnail'] = $request->file('thumbnail')->store('assets/blog','public');

        Blog::create($data);

        return redirect()->route('blog.index')->with('success','Thanks, Post has been saved!');
    }

    public function show($id)
    {
        $item = Blog::with('user')->findOrFail($id);

        return view('dashboard.blog.show',[
            'item' => $item
        ]);
    }

    public function edit($id)
    {
        if (auth()->check() && !auth()->user()->can('mengedit-artikel')){
            Abort(404);
        }

        $item = Blog::findOrFail($id);

        return view('dashboard.blog.edit',[
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        if (auth()->check() && !auth()->user()->can('mengedit-artikel')){
            Abort(404);
        }
        
        $data = $request->all();

        $request->validate([
            'title' => ['required', 'string', 'max:255','min:3','regex:/(^[A-Za-z0-9 ]+$)+/'],
            'description' => ['required', 'min:3'],
            'thumbnail' => ['image'],
        ]);

        $data ['user_id'] = Auth::user()->id;
        $data ['slug'] = Str::slug($request->title);

        $item = Blog::findOrFail($id);

        if ($request->hasFile('thumbnail')) {
            unlink(storage_path('app/public/'.$item->thumbnail));
            $data ['thumbnail'] = $request->file('thumbnail')->store('assets/blog','public');
        }

        $item->update($data);

        return redirect()->route('blog.index')->with('success','Thanks, Data has been updated!');
    }

    public function updateStatus(Request $request, $id)
    {
        if (auth()->check() && !auth()->user()->can('mereview-artikel') || !auth()->user()->can('menerbitkan-artikel')){
            Abort(404);
        }
        
        $data = $request->all();

        $item = Blog::findOrFail($id);

        $item->update($data);

        return redirect()->route('blog.index')->with('success','Thanks, Data has been updated!');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasRole('super-admin')){
            Abort(404);
        }

        return redirect()->route('blog.index')->with('success','Thanks, Data has been deleted!');
    }

    public function comments($id)
    {
        if (auth()->check() && !auth()->user()->can('menerbitkan-komen')){
            Abort(404);
        }

        $item = Blog::with('comments.user')->find($id);

        return view('dashboard.blog.comments',[
            'item' => $item
        ]);
    }

    public function commentsAccept(Request $request, $id)
    {
        if (auth()->check() && !auth()->user()->can('menerbitkan-komen')){
            Abort(404);
        }
        
        $data = $request->all();

        $item = Comment::findOrFail($id);

        $item->update($data);

        return redirect()->back()->with('success','Thanks, Data has been updated!');
    }

    public function commentsDelete(Request $request, $id)
    {
        if (auth()->check() && !auth()->user()->can('menerbitkan-komen')){
            Abort(404);
        }

        return redirect()->back()->with('success','Thanks, Data has been deleted!');
    }
}
