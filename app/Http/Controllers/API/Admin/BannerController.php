<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Banner;
class BannerController extends Controller
{
    public function banner()
    {
        $banner = Banner::get();
        return response()->json($banner, 200);
    }
}
