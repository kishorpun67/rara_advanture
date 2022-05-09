<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Admin\Category;
use App\OrderDetail;
use Carbon\Carbon;
use App\Order;
class ChartsController extends Controller
{
    public function dailyReport()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
    	$current_day_sales = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('quantity');
    	$last_day_sales1 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(1))->sum('total');
    	$last_day_sales2 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(2))->sum('total');
    	$last_day_sales3 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(3))->sum('total');
    	$last_day_sales4 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(4))->sum('total');
    	$last_day_sales5 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(5))->sum('total');
    	$last_day_sales6 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->subDay(6))->sum('total');
    	Session::flash('page', 'daily');
        $category = Category::where(['admin_id'=> $admin_id])->where('parent_id', '=!', 0)->get();
        $countUser = Order::select('user_id')->groupBy('user_id')->where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->count();
        $current_day_sales_price = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('total');
    	$daily_sale=OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();
		return view('admin.carts.carts' , compact('current_day_sales', 'last_day_sales1', 'last_day_sales2', 'last_day_sales3','last_day_sales4', 'last_day_sales5','last_day_sales6', 'daily_sale', 'category', 'current_day_sales_price', 'countUser'));
    }

    public function ajaxDaily(Request $request)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        if($request->ajax()) {
            $data = $request->all();
            if($data['cat_id']=='all')
            {
                $current_day_sales = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('quantity');
                $current_day_sales_price = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('total');
                $daily_sale=OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();

            }else{
                $current_day_sales = OrderDetail::where(['admin_id' => $admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('quantity');
                $current_day_sales_price = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->sum('total');
                $daily_sale=OrderDetail::where(['admin_id' => $admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->get();

            }
            $countUser = Order::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->whereDay('created_at', Carbon::now()->day)->select('user_id')->groupBy('user_id')->count();

            return view('admin.carts.daily', compact('current_day_sales','current_day_sales_price', 'countUser','daily_sale'));
        }
    }
   

    public function monthlyReport()
    {
        
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $current_month_sale_price = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');
        $last_month_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(1))->sum('total');
        $last_to_last_month_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(2))->sum('total');
        $last_to_last_month_sale4 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(3))->sum('total');
        $last_to_last_month_sale5 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(4))->sum('total');
        $last_to_last_month_sale6 = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subMonth(5))->sum('total');
        $current_sale = OrderDetail::where('admin_id',$admin_id)->sum('total');
        $current_month_sale = OrderDetail::where('admin_id',$admin_id)->sum('quantity');

        $monthly_sale=OrderDetail::with('order')->where('admin_id',$admin_id)->get();
        Session::flash('page','monthly');
        $category = Category::where(['admin_id'=> $admin_id])->where('parent_id', '=!', 0)->get();
        return view('admin.carts.monthly', compact('category','current_month_sale','last_month_sale','last_to_last_month_sale','last_to_last_month_sale4','last_to_last_month_sale5','last_to_last_month_sale6','monthly_sale', 'category', 'current_sale','current_month_sale_price'));
    }

    public function ajaxMonthly(Request $request)
    {
        if($request->ajax()) {
            if(auth('admin')->user()->parent_id > 0){
                $admin_id = auth('admin')->user()->parent_id;
            }else{
                $admin_id = auth('admin')->user()->id;
            }
            $data = $request->all();
                    // return response()->json($data);

            if (!empty($data['cat_id']) && !empty($data['monthly'])) {
                if($data['monthly']=="0" )
                {
                    $current_sale = OrderDetail::with(['order'])->where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->sum('total');
                    $current_month_sale = OrderDetail::with(['order'])->where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->sum('quantity');
                    $monthly_sale = OrderDetail::with(['order'])->where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->get();

                    // return response()->json($current_sale);

                }
                if($data['monthly'] =="1")
                {
                    $current_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');
                    $current_month_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('quantity');
                    $monthly_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();
                    
                    // return response()->json($current_sale);
                }
                if($data['monthly'] =="2")
                {
                    $current_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->sum('total');
                    $current_month_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->sum('quantity');
                    $monthly_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->get();

                    // return response()->json($current_sale);
                }
                if($data['monthly'] =="all")
                {
                    $current_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->sum('total');
                    $current_month_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->sum('quantity');
                    $monthly_sale = OrderDetail::where(['admin_id'=>$admin_id,'category_id'=>$data['cat_id'] ])->whereYear('created_at', Carbon::now()->year)->get();

                    // return response()->json($current_sale);
                }
            } else {
                if($data['monthly']=="0")
                {
                    $current_sale = OrderDetail::with(['order'])->where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->sum('total');
                    $current_month_sale = OrderDetail::with(['order'])->where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->sum('quantity');
                    $monthly_sale = OrderDetail::with(['order'])->where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->subDays(7))->get();

                    // return response()->json($current_sale);

                }
                if($data['monthly'] =="1")
                {
                    $current_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('total');
                    $current_month_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->sum('quantity');
                    $monthly_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->get();

                    
                    // return response()->json($current_sale);
                }
                if($data['monthly'] =="2")
                {
                    $current_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->sum('total');
                    $current_month_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->sum('quantity');
                    $monthly_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->get();

                    // return response()->json($current_month_sale);
                }
                if($data['monthly'] =="all")
                {
                    $current_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->sum('total');
                    $current_month_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->sum('quantity');
                    $monthly_sale = OrderDetail::where('admin_id',$admin_id)->whereYear('created_at', Carbon::now()->year)->get();
                    // return response()->json($current_month_sale);
                }
            }
            return view('admin.carts.monthly_sale', compact('current_month_sale', 'current_sale', 'monthly_sale'));
        }
    }

}
