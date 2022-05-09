<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FoodMenu;
use App\IngredientUnit;
use App\FoodCategory;
use Image;
use Session;


class FoodMenuController extends Controller
{
    public function foodMenus()
    {
        $foodMenus = FoodMenu::with('foodCategory','ingredientUnit')->get();
        Session::flash('page', 'FoodMenu');
        return view('admin.foodMenus.view_food_menus', compact('foodMenus'));
    }

    public function addEditFoodMenu(Request $request, $id=null)
    {
        if($id=="") {
            $title = "Add Food Menu";
            $button ="Submit";
            $foodMenu = new FoodMenu;
            $foodMenusData = array();
            $message = "food menus has been added sucessfully";
        }else{
            $title = "Edit Food Menu";
            $button ="Update";
            $foodMenusData = FoodMenu::where('admin_id',auth('admin')->user()->id)->where('id',$id)->first();
            $foodMenusData= json_decode(json_encode($foodMenusData),true);
            $foodMenu = FoodMenu::find($id);
            $message = "Food Menus has been updated sucessfully";
        }
        if($request->isMethod('post')) {
            $data = $request->all();
            //dd($data);
            if(empty($data['name'])){
                return redirect()->back()->with('error_message', 'food menu name is required !');
            }
                   
            if(empty($data['sale_price']))
            {
                $data['sale_price'] = "";
            }
               
            if(empty($data['category_id']))
            {
                $data['category_id'] = "";
            }
               
            if(empty($data['description']))
            {
                $data['description'] = "";
            }
            if(empty($data['ingredient_id']))
            {
                $data['ingredient_id'] = "";
            }
            if(empty($data['code']))
            {
                $data['code'] = "";
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
                    $imagePath = 'image/menu'.$imageName;
                    $result = Image::make($image_tmp)->save($imagePath);
                    // dd($result);
                    $foodMenu->image =$imagePath;
    
                }
            }
            // if(empty($data['user_id']))
            // {
            //     $data['user_id'] = "";
            // }
            // if(empty($data['parent_id']))
            // {
            //     $data['parent_id'] = "";
            // }
            $foodMenu->admin_id = auth('admin')->user()->id;
            $foodMenu->name = $data['name'];
            $foodMenu->sale_price = $data['sale_price'];
            $foodMenu->category_id = $data['category_id'];
            $foodMenu->description = $data['description'];
            $foodMenu->ingredient_id = $data['ingredient_id'];
            $foodMenu->code = $data['code'];
            $foodMenu->save();
            Session::flash('success_message', $message);
            return redirect('admin/food-menus');
        }
        $foodCategory = FoodCategory::get();
        $ingredientUnit = IngredientUnit::get();
        Session::flash('page', 'foodMenu');
        return view('admin.foodMenus.add_edit_food_menus', compact('title','button','foodMenusData','foodCategory','ingredientUnit'));
    }
    public function deleteFoodMenu($id)
    {
      $id =FoodMenu::find($id);
      $id->delete();
      return redirect()->back()->with('success_message', 'Food menus has been deleted successfully!');

    }
}