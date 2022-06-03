<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\TourType;
class TourTypeController extends Controller
{
    public function tourType()
    {
        $tourType =TourType::orderBy('id', 'desc')->get();
        Session::flash('page', 'tour_type');
        return view('superAdmin.tourType.view_tour_type',compact('tourType'));
    }

    public function addEditTourType(Request $request, $id=null)
    {
        if($id=="")
        {
            $choose = new TourType();
            $message = "Tour Type has been added successfully !";
        }else{
            $choose = TourType::find($id);
            $message = "Tour Type has been updated successfully !";
        }
        if($request->isMethod('post'))
        {
            $data = $request->all();
            if(empty($data['icon']))
            {
                $data['icon'] = "";
            }
            if(empty($data['type']))
            {
                $data['type'] = "";
            }
            $choose->icon =$data['icon'];
            $choose->type =$data['type'];
            $choose->save();
            Session::flash('success_message', $message);
            return redirect()->back();
        }
        
    }

    public function deleteTourType($id=null)
    {
        $id =TourType::find($id);
        $id->delete();
        return redirect()->back()->with('success_message', 'Tour Type has been delete successfully!');
  
    }
}
