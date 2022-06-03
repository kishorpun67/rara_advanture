<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Category;
use Session;
use App\Admin\Post;
use Image;
use App\Admin\Type;
use App\TourType;
use App\PostImage;

class PostController extends Controller
{
    public function post()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $post = Post::orderBy('id','desc')->with(['category'])->where('admin_id', auth('admin')->user()->id)->get();
        Session::flash("page", 'post');
        return view('admin.post.view_post', compact('post'));
    }
    
    public function updatePostStatus()
    {
        if(request()->ajax()) {
            $data = request()->all();
            if($data['status']=="Active") {
                $status = 0;
            }else {
                $status = 1;
            }
            Post::where('id', $data['item_id'])->update(['status' => $status]);
            return response()->json(['status' =>$status,'item_id' =>$data['item_id']]);
        }
    }
    public function addEditPost(Request $request, $id=null)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        if($id=="") {
            $title = "Add Post";
            $button ="Submit";
            $post = new Post;
            $postData = array();
            $message = "Post has been added sucessfully";
        }else{
            $title = "Edit Post";
            $button ="Update";
            $postData = Post::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $postData= json_decode(json_encode($postData),true);
            $post = Post::find($id);
            $message = "Post has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $data = $request->all();
            $rules = [
                'category_id' => 'required',
                'title' =>'required',
                'price' =>'required',
                'url' =>'required',
                'type_id'=>'required',
                'url'=>'required',
                'price_type'=>'required',
                'expire_days'=>'required',
                
    
            ];
    
            $customMessages = [
                'category_id.required' => 'Please select category',
                'title.required' => 'Title field is required',
                'price.required' => 'Price field is required',
                'url.required' => 'Url field is required',
                'type_id.required' => 'Tour Type field is required',
                'url.required' => 'Url field is required',
                'price_type.required' => 'Price Type field is required',
                'expire_days.required' => 'Please select days',



    
            ];
            $this->validate($request, $rules, $customMessages);
           
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            if(empty($data['meta_title']))
            {
                $data['meta_title'] = "";
            }
            if(empty($data['meta_description']))
            {
                $data['meta_description'] = "";
            }
            if(empty($data['meta_keywords']))
            {
                $data['meta_keywords'] = "";
            }
            if(!empty($data['image'])){
                $image_tmp = $data['image'];
                // dd($image_tmp);
                if($image_tmp->isValid())
                {
                    // get extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/post'.$imageName;
                    $result = Image::make($image_tmp)->save($imagePath);
                    $post->image = $imagePath;
                }
            }
            $post->admin_id = $admin_id;
            $post->type_id =  $data['type_id'];
            $post->category_id =  $data['category_id'];
            $post->expire_days =  $data['expire_days'];
            $post->price_type =  $data['price_type'];
            $post->title = $data['title'];
            $post->details = $data['description'];
            $post->price = $data['price'];
            $post->url = $data['url'];
            $post->meta_title = $data['meta_title'];
            $post->meta_description = $data['meta_description'];
            $post->meta_keywords = $data['meta_keywords'];
            $post->save();
            Session::flash('success_message', $message);
            // return redirect('su/categories');
            return redirect()->route('admin.post');
        }
        $categories = Category::get();
        $types  =TourType::get();
        Session::flash("page", 'post');
        return view('admin.post.add_edit_post', compact('title','button','postData','categories','types'));
    }

    
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Item has been deleted successfully!');
    }

    public function addImages(Request $request, $id)
    {
        if($request->isMethod('post')) {
            $data = $request->all();
            if($request->hasFile('image')) {
                $file =  $request->file('image');
                    // get extension
                    $extension = $file->getClientOriginalExtension();
                    // generate new image name

                    $image = New PostImage;
                    $imageName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'image/post/'.$imageName; 

                    Image::make($file)->save($large_image_path);

                    $image->post_id = $data['post_id'];
                    $image->image = $large_image_path;
                    $image->save();
            }
            return redirect()->back()->with('success_message', 'Image has been added successfully!');
        }
        $posttDetails = Post::with('images')->find($id);
        Session::flash('page', 'post');
        return view('admin.post.add_post_image', compact('posttDetails'));
    }

    public function deleteImages($id=null)
    {
        $postImage= Post::select('image')->where('id',$id)->first();

        // Get image path
        $postImagePath = 'image/post';
     
        if(!empty($postImage->image) && file_exists($postImagePath)){

           
            if(file_exists($postImage->image)) {
                unlink($postImage->image);
            }
        }
        $id = PostImage::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Post Image has been delete successfully!');
    }
}
