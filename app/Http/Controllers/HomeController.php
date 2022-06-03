<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin\Post;
use App\Admin\Category;
use App\User;
use App\Admin\Banner;
use Carbon\Carbon;
use App\Admin\TestMonial;
use App\Choose;
use App\TourType;
class HomeController extends Controller
{
    public function home($url=null)
    {
        $mostPopularTours = Post::where('confirm_status', 'Confirmed')->limit(5)->get();
        $banners = Banner::where('status',1)->get();
        $testimonial = TestMonial::get();
        $choose =Choose::orderBy('id', 'desc')->get();
        $tourType =TourType::orderBy('id', 'desc')->get();
        return view('front.home', compact('banners','testimonial', 'mostPopularTours', 'choose', 'tourType'));

        
    }

    public function  searchPost()
    {
        $data = request()->all();
        // echo 'name';
        $name = Post::where('title','like', '%'.$data['title'].'%')->where('confirm_status', 'Confirmed')->get();
        $output = "<ul>";
            foreach($name as $names)
            {
                $output .= "<li>{$names['title']}</li>";

            }
            // $output .= "</ul>Name not found</ul>";

        $output .= "</ul>";

        echo $output;

    }

   

}
