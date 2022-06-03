<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Contact;
class ContactController extends Controller
{
    public function editContact($id=null)
    {
        if(request()->isMethod('post')){
            $data = request()->all();
            if(empty($data['hot_line']))
            {
                $data['hot_line'] = "";
            }
            if(empty($data['instagram']))
            {
                $data['instagram'] = "";
            }
            if(empty($data['twiter']))
            {
                $data['twiter'] = "";
            }
            if(empty($data['facebook']))
            {
                $data['facebook'] = "";
            }
            $contact = Contact::first();
            $contact->address = $data['address'];
            $contact->mobile = $data['mobile'];
            $contact->hot_line = $data['hot_line'];
            $contact->instagram = $data['instagram'];
            $contact->twiter = $data['twiter'];
            $contact->facebook = $data['facebook'];
            $contact->gmail = $data['gmail'];
            $contact->save();
            Session::flash('success_message', 'Contact Update sucessfully!');
            // return redirect('su/categories');
            return redirect()->back();

        }
        $contact = Contact::first();
        Session::flash('page', 'contact');
        return view('superAdmin.contact.edit_contact',compact('contact'));
    }
}
