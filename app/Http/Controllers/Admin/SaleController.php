<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Sale;
use App\FoodCategory;
use App\FoodMenu;
use App\Cart;
use App\Waiter;
use App\Customer;
use Image;
use Session;

class SaleController extends Controller
{
    public function Sale()
    {
        $sale = Sale::get();
        Session::flash('page', 'sale');
        return view('admin.sale.view_sale', compact('sale'));
    }

    public function addEditSale(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Sale";
            $button ="Submit";
            $sale = new Sale;
            $saledata = array();
            $message = "Sale has been added sucessfully";
        }else{
            $title = "Edit Sale";
            $button ="Update";
            $saledata = Sale::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $saledata= json_decode(json_encode($saledata),true);
            $sale = Sale::find($id);
            $message = "Sale has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
          
            // if(empty($data['admin_id'])){
            //     return redirect()->back()->with('error_message', 'admin_id is required !');
            // }
            if(!empty($data['image'])){
                $image_tmp = $data['image'];
                // dd($image_tmp);
                if($image_tmp->isValid())
                {
                    // get extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // generate new image name
                    $imageName = rand(111,99999).'.'.$extension;
                    $imagePath = 'image/sale'.$imageName;
                    $result = Image::make($image_tmp)->save($imagePath);
                    // dd($result);
                    $sale->image =$imagePath;
                }
            }   
            if(empty($data['qty']))
            {
                $data['qty'] = "";
            }
               
            if(empty($data['price']))
            {
                $data['price'] = "";
            }
               
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
        
            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $sale->admin_id = auth('admin')->user()->id;
            // $sale->image = $data['image'];
            $sale->qty = $data['qty'];
            $sale->price = $data['price'];
            $sale->description = $data['description'];
            $sale->save();
            Session::flash('success_message', $message);
            return redirect('admin/sale');
        }
        // $ingredientCategory = IngredientCategory::get();
        // $ingredientUnit = IngredientUnit::get();
        $foodCategories = FoodCategory::get();
        $carts = Cart::get();
        $foodMenus = FoodMenu::get();
        $waiter = Waiter::get();
        $customer = Customer::get();
        Session::flash('page', 'sale');
        return view('admin.sale.add_edit_sale', compact('title','button','saledata','foodCategories','foodMenus','carts','waiter','customer'));
    }

    public function ajaxGetItem()
    {
        $category_id = request('category_id');
        $foodMenus = FoodMenu::where('category_id', $category_id)->get();

        return view('admin.sale.ajaxitem',compact('foodMenus'));
        // return $foodMenus;

    }

    public function ajaxFoodTable(Request $request)
    {
        $data = $request->all();
        $newcarts = new Cart;
        // $newcarts->item_id = $data['item_id'];
        $newcarts->admin_id = auth('admin')->user()->id;
        $newcarts->price = $data['price'];
        $newcarts->item = $data['name'];
        $newcarts->quantity =1;
        $newcarts->total = $data['price'] ;
        $newcarts->save();
        $carts = Cart::get();
       return view('admin.sale.ajax_food_table',compact('carts'));
    }

    public function deleteCart($id)
    {
      $id =Cart::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Cart has been delete successfully!');
    }

    public function deleteSale($id)
    {
      $id =Sale::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'sale has been deleted successfully!');
    }
}
