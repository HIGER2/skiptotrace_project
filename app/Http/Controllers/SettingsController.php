<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\User;
use Mail;
use App\Mail\ContactMail;

use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('change_password');

  }

    public function change_password_post(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){

            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('message','Password Updated Successfully');

        }else{

            return redirect()->back()->with('message','Current Password does not match with Old Password');
        }
    }


      public function contact()
      {
        return view('contact');

      }

      public function store(Request $request)
      {
        $uid=Auth::user()->id;

        //return view('contact');
        $name=$request->inputName;
        $phone=$request->inputPhone;
        $email=$request->inputEmail;
        $subject=$request->inputSubject;
        $message=$request->inputMessage;

        $query=array('uid' => $uid,'name' => $name,'email' => $email,'phone' => $phone,'subject' => $subject,'message' => $message);
        DB::table('contact')->insert($query);

        $data=[
            'title' => $subject,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'message' => $message,
        ];
        Mail::to('imjattsingh@gmail.com')->send(new ContactMail($data));

         return back()->with('success', 'Thanks for contacting us!');

      }


}
