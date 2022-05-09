<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use App\Waiter;
use App\Customer;
use App\Table;
use Session;

class OrderController extends Controller
{
    public function Order()
    {
        $order = Order::with('Waiter','Customer','Table')->get();
        Session::flash('page', 'order');
        return view('admin.order.view_order', compact('order'));
    }

    public function addEditOrder(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Order";
            $button ="Submit";
            $order = new Order;
            $orderData = array();
            $message = "Order has been added sucessfully";
        }else{
            $title = "Edit Order";
            $button ="Update";
            $orderData = Order::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $orderData= json_decode(json_encode($orderData),true);
            $order = Order::find($id);
            $message = "Order has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
            if(empty($data['admin_id'])){
                return redirect()->back()->with('error_message', 'Admin id is required !');
            }
            if(empty($data['waiter_id']))
            {
                $data['waiter_id'] = "";
            }
            if(empty($data['customer_id']))
            {
                $data['customer_id'] = "";
            }
            if(empty($data['order_detail_id']))
            {
                $data['order_detail_id'] = "";
            }
            if(empty($data['table_id']))
            {
                $data['table_id'] = "";
            }
            if(empty($data['number_of_customer']))
            {
                $data['number_of_customer'] = "";
            }
            // if(empty($data['ingredient_id']))
            // {
            //     $data['ingredient_id'] = "";
            // }
            // if(empty($data['code']))
            // {
            //     $data['code'] = "";
            // }
           
            $order->admin_id = auth('admin')->user()->id;
            $order->waiter_id = $data['waiter_id'];
            $order->customer_id = $data['customer_id'];
            $order->order_detail_id = $data['order_detail_id'];
            $order->table_id = $data['table_id'];
            $order->number_of_customer = $data['number_of_customer'];
            $order->save();
            Session::flash('success_message', $message);
            return redirect('admin/order');
        }
        $waiter = Waiter::get();
        $customer = Customer::get();
        $table = Table::get();
        Session::flash('page', 'order');
        return view('admin.order.add_edit_order', compact('title','button','orderData','waiter','customer','table'));
    }

    public function deleteOrder($id)
    {
      $id =Order::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Order has been deleted successfully!');
    }
}