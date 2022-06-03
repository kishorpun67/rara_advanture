<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Choose;
use Session;

class ChooseController extends Controller
{
    public function choose()
    {
        $choose =Choose::orderBy('id', 'desc')->get();
        Session::flash('page', 'choose');
        return view('superAdmin.choose.view_choose',compact('choose'));
    }

    public function addEditChoose(Request $request, $id=null)
    {
        if($id=="")
        {
            $choose = new Choose();
            $message = "Choose has been added successfully !";
        }else{
            $choose = Choose::find($id);
            $message = "Choose has been updated successfully !";
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['icon']))
            {
                $data['icon'] = "";
            }
            if(empty($data['title']))
            {
                $data['title'] = "";
            }
            if(empty($data['description']))
            {
                $data['description'] = "";
            }

            $choose->icon =$data['icon'];
            $choose->title =$data['title'];
            $choose->description =$data['description'];
            $choose->save();
            Session::flash('success_message', $message);
            return redirect()->back();
        }
        
    }

    public function deleteChoose($id=null)
    {
        $id =Choose::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Choose Us has been delete successfully!');
  
    }
}
