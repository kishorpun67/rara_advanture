<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\User;
use Session;
use App\Admin\Admin;

class OrderController extends Controller
{
    public function Order()
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $order = Order::orderBy('id','desc')->with('orderDetails')->where('admin_id', $admin_id)->get();
        Session::flash('page', 'order');
        return view('admin.order.view_order', compact('order'));
    }

    public function orderDetail($id=null)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
       if(request()->isMethod('post')){
            Order::where('id', $id)->update(['status' => request('order_status')]);
            return redirect()->back()->with('success_message', 'Order status has been deleted successfully!');
       }
       Session::flash('page', 'order');
       $orderDetails = Order::with('orderDetails')->where(['admin_id'=> $admin_id, 'id'=>$id])->first();
       $userDetails  = User::where('id', $orderDetails->user_id)->first();
       return view('admin.order.order_detail', compact('orderDetails', 'userDetails'));
    }

    public function orderInnovice($id=null)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $admin = Admin::where('id', $admin_id)->first();
        Session::flash('page', 'order');
        $orderDetails = Order::with('orderDetails')->where(['admin_id'=> $admin_id, 'id'=>$id])->first();
        $userDetails  = User::where('id', $orderDetails->user_id)->first();
        return view('admin.order.order_invoice', compact('orderDetails', 'userDetails', 'admin'));
    }

    public function orderBill($id=null)
    {
        if(auth('admin')->user()->parent_id > 0){
            $admin_id = auth('admin')->user()->parent_id;
        }else{
            $admin_id = auth('admin')->user()->id;
        }
        $admin = Admin::where('id', $admin_id)->first();
        Session::flash('page', 'order');
        $orderDetails = Order::with('orderDetails')->where(['admin_id'=> $admin_id, 'id'=>$id])->first();
        $userDetails  = User::where('id', $orderDetails->user_id)->first();
        return view('admin.order.order_bill_print', compact('orderDetails', 'userDetails', 'admin'));
    }

    public function deleteOrder($id)
    {
      $id = Order::where('id', $id)->delete();
      return redirect()->back()->with('success_message', 'Order has been deleted successfully!');
    }
}