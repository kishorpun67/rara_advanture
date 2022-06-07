<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Order;
use Session;
use App\User;
use DB;
use App\Admin\Admin;
use App\Admin\Post;
use Carbon\Carbon;
use Auth;
use App\OrderDetail;
use App\Notifications\OrderNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function cart()
    {
        $carts = Cart::where(['user_id'=>auth()->user()->id])->get();
        return view('front.cart', compact('carts'));
    }
    public function addCart()
    {
        $data = request()->all();
        $admin = Post::where('id', $data['post_id'])->first();
        $cart = new Cart();
        $cart->admin_id = $admin->admin_id;
        $cart->user_id = auth()->user()->id;
        $cart->post_id = $data['post_id'];
        $cart->title = $data['title'];
        $cart->price = $data['price'];
        $cart->image = $data['image'];
        $cart->number_of_customer = $data['number_of_customer'];
        $cart->checkin = $data['checkin'];
        $cart->save();
        return redirect()->back();
    }
    public function checkout()
    {
        if(request()->isMethod('post')){
            $data = request()->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'number' =>'required|numeric',
                'address'=> 'required',
                // 'image' =>'image:jpeg, png, bmp, gif,jpg',
            ];

            $customMessages = [
                'name.required' => 'Name is required',
                'name.alpha' => 'alpha charcter is required',
                'number.required' => 'Number is required',
                'number.numeric' => 'Enter Valid number',
                'address.required' => 'Address is required',
                'image.image' =>'file must be image',
            ];
            $this->validate(request(), $rules, $customMessages);
            User::where('email',auth()->user()->email)->update([
                'name'=>$data['name'],
                'number' =>$data['number'],
                'address' =>$data['address'],
                'country' =>$data['country'],
                'email' =>$data['email'],
                'city' =>$data['city'],
            ]);
            $carts = Cart::where(['user_id'=>auth()->user()->id])->get();
            return view('front.order', compact('carts'));
        }
        $countries  = DB::table('country')->get();
        return view('front.checkout', compact('countries'));
    }

    public function placeOder()
    {
        $data = request()->all();
        $carts = Cart::where(['user_id'=>auth()->user()->id])->get();
        // foreach($carts as $cart)
        // {
        //     return $cart->item_id;
        //     return$getAttributeCount = Item::checkItem($cart->item_id);
        //     if($getAttributeCount==0) {
        //         Item::deleteCartCount($cart->id, $session);
        //         return redirect()->back()->with('error_message','One of the Item is not avaliable. Please try agin.');
        //     }
        //     $stock = Item::checkStock($cart->item_id);
        //     if($cart->quantity > $stock) {
        //         return redirect()->back()->with('error_message','One of the Item require stock is not avaliable. Please try agin.');
        //     }
        //     Item::deleteCartCount($cart->id, $cart->user_id);
        // }
        $admin = Cart::select('admin_id')->groupBy('admin_id')->where('user_id', auth()->user()->id)->get();
        foreach( $admin as $add)
        {
            // return $add->admin_id;
            $new  = new Order();
            $new->user_id = auth()->user()->id;
            $new->admin_id = $add->admin_id;
            $new->name = auth()->user()->name;
            $new->email = auth()->user()->email;
            $new->number = auth()->user()->number;
            $new->total = $data['total'];
            $new->payment_method = $data['paymentMethod'];
            $new->status = "New";
            $new->save();
            $order_id= DB::getPdo()->lastInsertId();
            foreach($carts as $cart)
            {
                $newOrder = new OrderDetail();
                $newOrder->order_id = $order_id;
                $newOrder->admin_id = $add->admin_id;
                $newOrder->post_id = $cart->post_id;
                $newOrder->title = $cart->title;
                $newOrder->price = $cart->price;
                $newOrder->image = $cart->image;
                $newOrder->checkin = $cart->checkin;
                $newOrder->number_of_customer = $cart->number_of_customer;
                $newOrder->save();
                // Item::deleteSotck($cart->item_id, $cart->quantity);
                Cart::where('id', $cart->id)->delete();
            }
            $admin = Admin::where('id',$add->admin_id )->first();
            $letter = collect(['title' => 'New Order by', 'name'=>auth()->user()->name]);
            $letter = json_decode(json_encode($letter), true);
            Notification::send($admin, new OrderNotification($letter));
        }
        return redirect()->route('home');

    }
    public function payment()
    {
        
        return view('front.payment');
    }
    public function orderDetails()
    {
        $orderDetails = OrderDetail::with('order')->where(['user_id'=>auth()->user()->id, 'admin_id'=>session()->get('admin_id')])->get();
        // return $orderDetails;
        return view('front.order_detail' ,compact('orderDetails'));
    }
    public function cancelOrder($id)
    {
        $session = Session::get('code');
        $user = User::where('session', $session)->latest()->first();
        if($user->status == "Paid"){
            return redirect()->back()->with('error_message', 'Order has been already paid. You cannot cancel your order!');
        }
        if($user->status == "Delivery"){
            return redirect()->back()->with('success_message', 'Order has been already delivered.You cannot cancel your order!');
        }
        if ($user->status == "New") {
            $order = Order::where(['id'=> $id, 'session'=>$session])->first();
            $result = Order::where(['id'=> $id, 'session'=>$session])->where('status',0)->where('created_at','>=',Carbon::now()->subMinutes(60)->toDateTimeString())->delete();
            if($result)
            {
                Item::addStock($order->item_id, $order->quantity);
                $count = Order::where('session', $order->session)->count();
                if($count==0)
                {
                    User::where('id', $order->session)->delete();
                }
                return redirect()->back()->with('success_message', 'Order has been cancel successfully!');
            }else{
                return redirect()->back()->with('error_message', 'Your are canot cancel this order. Please! contact Admin');
            }

        }else{
            return redirect()->back()->with('error_message', 'Order Status has been  updated. You cannot cancel your order!');
        }

    }
}
