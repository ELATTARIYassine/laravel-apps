<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager as Image;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        return view('posts.create');
    }

    public function store(){

        $data = request()->validate([
            'caption' => 'required',
            'image' => 'required|image'
        ]);
        $imagePath = request()->image->store('uploads', 'public');
        $data['image'] = $imagePath;
        auth()->user()->posts()->create($data);
        
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post){
        return view('posts.show', ['post' => $post]);
    }
}
