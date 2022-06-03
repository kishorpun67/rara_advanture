<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Session;
use Hash;
use Auth;
use App\Member;
use Image;
// use App\User;

class UserController extends Controller
{
    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            //return Hash::make(12345);
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $session = Str::random(50);
                Session::put('session', $session);
                return redirect('/');
            }else{
                Session::flash('error_message', 'Invalid Email or Password');
                return redirect()->back();
            }
        }else{
            return view('front.login');
        }
       //return redirect('/');
    }
    public function register(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = request()->all();
            //return $data;
            $count = User::where('email', $data['email'])->count();
            if($count >=1){
                Session::flash('error_message', 'Email already exists');
            }
            $newUser = new User();
            $newUser->name = $data['name'];
            $newUser->email = $data['email'];
            $newUser->password = Hash::make($data['password']);
            $newUser->save();
            Session::flash('success_message', 'Your account has created sucessfully');
            return redirect()->back();
        }
        // return view('admin.user_member_form');
    }

    public function forgotPassword()
    {
        if(request()->method('post')){

        }
        return view('front.password_forgot');
    }
    public function logout () {
        auth()->logout();
        return redirect('/');
    }

    public function account()
    {
        return view('front.account');
    }
    public function updateCurrentPassword(Request $request)
    {
        if($request->isMethod('post')){
            $data = $request->all();
            // return $data->id;
            // check current password
            if(Hash::check($data['current_password'],auth()->user()->password)) {

                // check new password ana confirm password
                if($data['new_password']==$data['confirm_password']){
                    User::where('id',auth()->user()->id)->update(['password' => Hash::make($data['new_password'])]);
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

    public function updateUserDetail()
    {
        if(request()->isMethod('post'))
        {
            $data = request()->all();
            // dd($data);
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
            if(empty($data['image'])){
                // $data['image']='';
                $imagePath = auth()->user()->image;
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
                    $result = Image::make($image_tmp)->resize(163,61)->save($imagePath);
                    // dd($result);

                }
            }
            User::where('email',auth()->user()->email)->update([
                'name'=>$data['name'],
                'number' =>$data['number'],
                'address' =>$data['address'],
                'image' => $imagePath,
            ]);
            Session::flash('success_message', 'User details updated sucessfully');
            return redirect()->back();
        }
    }
}
