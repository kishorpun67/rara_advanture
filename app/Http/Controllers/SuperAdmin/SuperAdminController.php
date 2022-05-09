<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\Admin;
use App\SuperAdmin\SuperAdmin;
use Session;
use Auth;
use Hash;
use DB;
use Image;
use App\Admin\AdminRole;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        Session::flash('page', 'dashboard');
        return view('superAdmin.superAdmin_dashboard');
    }

    public function settings()
    {
        Session::flash('page', 'setting');
        return view('superAdmin.superAdmin_settings');
    }

    public function login(Request $request)
    {

        if($request->isMethod('post')) {
           $data = $request->all();
            // return $data;
            // return$paasword= Hash::make($data['password']);
            // return ($data['email']);

            $rules = [
                'email' => 'required|eamil|max:255',
                'password' => 'required',
            ];
            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valild Email is required',
                'password.required' => 'Password is required',
            ];
            // $this->validate($request, $rules, $customMessages);
            //  $datas= Admin::where('email', $data['email'])->first();
            //  $datas->password =$paasword;
            //  $datas->save();
            // $remember_me = $request->has('remember') ? true : false;
            // return $remember_me;

            // return;
            // return SuperAdmin::where('email', $data['email'])->first();
            if(Auth::guard('superAdmin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                return redirect('superAdmin/dashboard');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }
        return  view('superAdmin.superAdmin_login');
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();
        if(Hash::check($data['current_password'],Auth::guard('superAdmin')->user()->password))
        {
            echo "true";
        }else{
            echo"false";
        }
    }

    public function updateCurrentPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // return $data->id;
            // check current password
            if(Hash::check($data['current_password'],Auth::guard('superAdmin')->user()->password)) {
                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    SuperAdmin::where('id',Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    Session::flash('success_message', 'Password has been changed sucessfully');
                }else{
                    Session::flash('error_message', 'New Password and Confirm Password is not Match');
                }

            }else{
                Session::flash('error_message', 'Your Current Password is Incorrect');
            }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
        if($request->isMethod('post'))
            {
                $data = $request->all();
                // dd($data);
                $rules = [
                    'name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'number' =>'required|between:10,20',
                    'image' =>'image:jpeg, png, bmp, gif',
                ];

                $customMessages = [
                    'name.required' => 'Name is required',
                    'name.alpha' => 'alpha charcter is required',
                    'number.required' => 'number is required',
                    'number.between' => 'enter between 10 to 20 ',
                    'image.image' =>'file must be image',
                ];
                $this->validate($request, $rules, $customMessages);

                // upload images

                if(empty($data['image'])){
                    $data['image']='';
                    $imagePath = Auth::guard('superAdmin')->user()->image;
                }
                if($data['image']){
                    $image_tmp = $data['image'];
                    // dd($image_tmp);
                    if($image_tmp->isValid())
                    {
                        // get extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                        $result = Image::make($image_tmp)->resize(1000,1000)->save($imagePath);
                        // dd($result);

                    }else if(!empty($data['current_admin_image'])) {
                        $imagePath = $data['current_admin_image'];
                    }else{
                        $imagePath = "";
                    }
                }


                SuperAdmin::where('email',Auth::guard('superAdmin')->user()->email)->update([
                    'name'=>$data['name'],
                    'number' =>$data['number'],
                    'image' => $imagePath,
                ]);
                Session::flash('success_message', 'Admin details update sucessfully');
                return redirect()->back();
            }

            Session::flash('page', 'updateAdminDetail');
            return view('superAdmin.superAdmin_update');
    }

    public function logout()
    {
        Auth::logout();
        // Auth::logout();
        Auth::guard('superAdmin')->logout();
        return redirect('/superAdmin')->with('success_message', 'Logout Successfully!');
    }

    public function admin()
    {
        $admins = Admin::with('role')->where('parent_id',0)->get();
        $roles = AdminRole::where('id', "<",3)->get();
        Session::flash('page', 'admin_roles');
        return view('superAdmin.superAdmin_view_admin', compact('admins', 'roles'));
    }

    public function addEditAdmin($id=null)
    {
            $data = request()->all();
            if($id ===null){
                $rules = [
                    'name'=>'required',
                    'email' => 'required|email',
                    'number'=>'required',
                    'type'=>'required',
                    'password' => 'required',
                ];
                $customMessages = [
                    'name.required'=>'Name is required',
                    'type.required'=>'Please! Select type',
                    'email.required' => 'Email is required',
                    'number.required'=>'Number is required',
                    'email.email' => 'Valild Email is required',
                    'password.required' => 'Password is required',
                ];
                $this->validate(request(), $rules, $customMessages);
                if(empty($data['image'])){
                    $data['image']='';
                    $imagePath = "";
                }
        
                if($data['image']){
                    $image_tmp = $data['image'];
                    // dd($image_tmp);
                    if($image_tmp->isValid())
                    {
                        // get extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        // generate new image name
                        $imageName = rand(111,99999).'.'.$extension;
                        $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                        $result = Image::make($image_tmp)->save($imagePath);
                        // dd($result);
        
                    }
                }
                $newAdmin = new Admin();
                $newAdmin->name = $data['name'];
                $newAdmin->email = $data['email'];
                $newAdmin->number = $data['number'];
                $newAdmin->type = $data['type'];
                $newAdmin->access = 0;
                $newAdmin->image = $imagePath;
                $newAdmin->save();
                return redirect()->back()->with('sucess_message','Admin has beeb added successfully!');
            }else{
                // return request()->all();
                $rules = [
                    'name'=>'required',
                    'email' => 'required|email',
                    'number'=>'required',
                ];
                $customMessages = [
                    'name.required'=>'Name is required',
                    'type.required'=>'Please! Select type',
                    'email.required' => 'Email is required',
                    'number.required'=>'Number is required',
                    'email.email' => 'Valild Email is required',
                ];
                $this->validate(request(), $rules, $customMessages);
                if(empty($data['image']) && !empty($data['old_image'])){
                    $imagePath = $data['old_image'];
                }
                if(empty($data['old_image']))
                {
                    $imagePath = "";
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
                        $imagePath = 'image/admin_image/admin_photos/'.$imageName;
                        $result = Image::make($image_tmp)->resize(183,196)->save($imagePath);
                        // dd($result);
                    }
                }
                $newAdmin =  Admin::find($id);
                $newAdmin->name = $data['name'];
                $newAdmin->email = $data['email'];
                $newAdmin->number = $data['number'];
                $newAdmin->role_id = $data['role_id'];
                $newAdmin->image = $imagePath;
                $newAdmin->save();
                return redirect()->back()->with('success_message','Admin has beeb updated successfully!');            }
      
     
    }
    public function access($id=null)
    {   
        $rules = [
            'access'=>'required',
        ];
        $customMessages = [
            'access.required'=>'Please! Select  access type',
        ];
        $this->validate(request(), $rules, $customMessages);
        $data = request()->all();
        $admin = Admin::find($id);
        $admin->access = $data['access'];
        $admin->save();
        return redirect()->back()->with('success_message','Access control updated successfully!');   
    }
}
