<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\Post;
class PostController extends Controller
{
    public function showPostRequest()
    {
        $posts = Post::with(['admin', 'category'])->get();
        Session::flash("page", 'post');
        return view('superAdmin.post.view_post' , compact('posts'));
    }

    public function showPostDetail($id=null)
    {
        $postDetails = Post::with(['admin', 'category'])->where('id', $id)->first();
        Session::flash("page", 'post');
        return view('superAdmin.post.post_detail', compact('postDetails'));
    }

    public function updateStatus($id=null)
    {
        $data = request()->all();
        Post::where('id', $id)->update(['confirm_status' =>$data['confirm_status']]);
        return redirect()->back()->with('success_message', 'Post status has updated successfully!');

    }
}
