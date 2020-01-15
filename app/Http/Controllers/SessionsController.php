<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function head()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }

        return view('head');
    }

    public function create()
    {
        if (null !== \Session::get('user') && \Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }
        else if (null !== \Session::get('user') && \Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }

    	return view('welcome');
    }

    public function store()
    {
    	if(!auth()->attempt(request(['user_id', 'user_password'])))
    	{
    		return back()->withErrors([
    			'message' => 'Incorrect ID or Password; please try again.'
    		]);
    	}

    	if (\Auth::user()->user_type == 'h')
    	{
            \Session::put('user', \Auth::user());
    		return redirect('/headhome');
    	}
    	else if (\Auth::user()->user_type == 'm')
    	{
            \Session::put('user', \Auth::user());

    		return redirect('/memberhome');
    	}
    	else if (\Auth::user()->user_type == 'd')
    	{
            auth()->logout();

    		return back()->withErrors([
    			'message' => 'That account is no longer active.'
    		]);
    	}
    }

    public function password()
    {
        if (null !== \Session::get('user'))
        {
            return view('changepassword');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function changepassword(Request $request){
        if (!(\Hash::check($request->get('current-password'), \Session::get('user')->user_password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not match with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = \Session::get('user');
        $user->user_password = bcrypt($request->get('new-password'));
        $user->timestamps = false;
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");

    }

    public function destroy()
    {
    	\Session::flush();

    	return redirect()->home();
    }
}
