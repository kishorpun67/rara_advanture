<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin\Post;
use App\Admin\Category;
use App\TourType;
use App\Comment;

class PostController extends Controller
{
    public function postList($url=null)
    {
        if(request()->ajax()){
            $data = request()->all();
            $sort = $data['sort'];
            $url = $data['url'];
            if($data['category_id'] != 0){
                $categoy = Category::where('url' ,$url)->first();
                $posts = Post::where('category_id' , $categoy->id)->where('confirm_status', 'Confirmed');

            }else{
                if(!empty($data['location'])){
                    $posts = Post::where('title','like', '%'.$data['location'].'%')->where('confirm_status', 'Confirmed');
                    // $posts = $posts->where('posts.title','like', '%'.$data['location'].'%');
                }else{
                    $posts = Post::where('title','like', '%'.$data['url'].'%')->where('confirm_status', 'Confirmed');
                }

            }
            
            if(!empty($data['price_type'])){
                $posts = $posts->whereIn('posts.price_type', $data['price_type']);
            }
            if(!empty($data['type'])){
                $posts = $posts->whereIn('posts.type_id', $data['type']);
            }
            if($data['category_id'] != 0){
                if(!empty($data['location'])){
                    $posts = $posts->where('posts.title','like', '%'.$data['location'].'%');
                }
            }
            if(!empty($data['minPrice']) && !empty($data['maxPrice'])){
                $posts = $posts->whereBetween('posts.price',[$data['minPrice'], $data['maxPrice']]);
            }
            if(!empty($data['sort'])){
                if($data['sort'] =="low_to_high"){
                     // return 'tst';
                }
                if($data['sort'] =="high_to_low"){
                    $posts->orderBy('price', 'Desc');
                }
                if($data['sort'] =="ascending"){
                    $posts->orderBy('title', 'Asc');
                }
                if($data['sort'] =="descending"){
                    $posts->orderBy('title', 'Desc');
                }
                
            }
            
            $posts = $posts->paginate(9);
            return view('front.ajaxListing' , compact('posts'));
        }else{
            $count = Category::where('url' ,$url)->count();
            if($count == 0)
            {
                return view('error.error');
            }
            $categoy = Category::where('url' ,$url)->first();
            $posts = Post::where('category_id' , $categoy->id)->where('confirm_status', 'Confirmed')->get();
            $types = TourType::get();
            $meta_title = $categoy->meta_title;
            $meta_keywords = $categoy->meta_keywords;
            $meta_description = $categoy->meta_description;
            return view('front.list', compact('posts', 'meta_title','meta_description','meta_keywords','categoy', 'types'));
        }
    }

    public function searhPostArea()
    {
        $data = request()->all();
        $types = TourType::get();
        $posts = Post::where('title','like', '%'.$data['search'].'%')->where('confirm_status', 'Confirmed')->get();
        $categoy  = $data['search'];
        return view('front.search', compact('posts', 'categoy','types'));

    }

    public function postDetails($url)
    {  
        $posts = Post::with('images')->where('url', $url)->where('confirm_status', 'Confirmed')->first();
        // dd($posts);
        $comments = Comment::where('post_id', $posts->id)->get();
        $rating_sum = Comment::where(['post_id'=>$posts->id])->sum('star');
        $rating_count = Comment::where(['post_id'=>$posts->id])->count();
        if ($rating_count >0) {
            $avag_rating = round($rating_sum/$rating_count, 2);
            $avag_star_rating = round($rating_sum/$rating_count);        
        } else{
            $avag_rating = 0;
            $avag_star_rating = 0; 
        }
        // return$posts->images->chunk(3);
        return view('front.detail',compact('posts','comments', 'avag_rating', 'avag_star_rating')); 
    }

    public function addComment(Request $request)
    {
      
        $data = $request->all();
        
        if(empty($data['message']))
        {
            return redirect()->back()->with('error_message', 'Message is required !');
        }
        $comments = new Comment;
        $comments->user_id = auth()->user()->id;
        $comments->post_id = $data['post_id'];
        $comments->name = auth()->user()->name;
        $comments->message = $data['message'];
        $comments->star = $data['star'];
        $comments->save();
        return redirect()->back(); // return auth()->user();
            
    }
}
