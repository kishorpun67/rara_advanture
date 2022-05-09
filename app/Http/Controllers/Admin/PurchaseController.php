<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Purchase;
use App\Supplier;
use App\IngredientUnit;
use App\IngredientCategory;
use Session;

class PurchaseController extends Controller
{
    public function purchase()
    {
        $purchase = Purchase::with('ingredientCategory','ingredientUnit','supplierName')->get();
        Session::flash('page', 'purchase');
        return view('admin.purchase.view_purchase', compact('purchase'));
    }

    public function addEditPurchase(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Purchase";
            $button ="Submit";
            $purchase = new Purchase;
            $purchasedata = array();
            $message = "Purchase has been added sucessfully";
        }else{
            $title = "Edit Purchase";
            $button ="Update";
            $purchasedata = Purchase::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $purchasedata= json_decode(json_encode($purchasedata),true);
            $purchase = Purchase::find($id);
            $message = "purchase has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
        //dd($data);
            if(empty($data['supplier_id'])){
                return redirect()->back()->with('error_message', 'Supplier id is required !');
            }

            
            if(empty($data['date']))
            {
                $data['date'] = "";
            }

            if(empty($data['ingredient_id']))
            {
                $data['ingredient_id'] = "";
            }
            if(empty($data['unit_id']))
            {
                $data['unit_id'] = "";
            }
            if(empty($data['code']))
            {
                $data['code'] = "";
            }
            if(empty($data['amount']))
            {
                $data['amount'] = "";
            }
            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $purchase->admin_id = auth('admin')->user()->id;
            $purchase->supplier_id = $data['supplier_id'];
            $purchase->date = $data['date'];
            $purchase->ingredient_id = $data['ingredient_id'];
            $purchase->unit_id = $data['unit_id'];
            $purchase->code = $data['code'];
            $purchase->amount = $data['amount'];
            $purchase->save();
            Session::flash('success_message', $message);
            return redirect('admin/purchase');
        }
        $supplier = Supplier::get();
        $ingredientCategory = IngredientCategory::get();
        $ingredientUnit = IngredientUnit::get();
        Session::flash('page', 'purchase');
        return view('admin.purchase.add_edit_purchase', compact('title','button','purchasedata','ingredientCategory','ingredientUnit','supplier'));
    }

    public function deletePurchase($id)
    {
      $id =Purchase::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Purchase has been deleted successfully!');

    }
}
