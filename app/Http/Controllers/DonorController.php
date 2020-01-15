<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DonorType;
use App\Donor;
use App\CommitteeMember;

class DonorController extends Controller
{
    public function create()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }

        $donor_types = DonorType::all();
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();

        return view('donor.adddonor',compact('donor_types', 'member'));
    } 
    public function store(Request $request)
    {
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();

        /* $this->validate(request(), [
            
            'donor_name' => 'required',
            'donor_type_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'account_number' => 'required'

        ]); */
        $donor = new Donor;
        $donor->donor_name= $request->get('donor_name');
        $donor->donor_type_id= $request->get('donor_type_id');
        $donor->donor_email= $request->get('email');
        $donor->donor_phone= $request->get('phone');
        $donor->donor_address= $request->get('address');
        $donor->donor_bank_account_number= $request->get('account_number');
        $donor->timestamps = false;
            $donor->save();

        $member->donors()->attach($donor->donor_id,['start_date'=> date('Y-m-d H:i:s')]);   
        
        return redirect('/memberhome');
    }

    public function edit($id)
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }

        $donor_types = DonorType::all();
        $donor = Donor::find($id);
        return view('donor.editdonor',compact('donor_types', 'donor'));
    } 

    public function update(Request $request, $id)
    {
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();

        /* $this->validate(request(), [
            
            'donor_name' => 'required',
            'donor_type_id' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'account_number' => 'required'

        ]); */
        $donor = Donor::find($id);
        $donor->donor_name= $request->get('donor_name');
        $donor->donor_email= $request->get('email');
        $donor->donor_phone= $request->get('phone');
        $donor->donor_address= $request->get('address');
        $donor->donor_bank_account_number= $request->get('account_number');
        $donor->timestamps = false;
            $donor->save();

        $member->donors()->attach($donor->donor_id,['start_date'=> date('Y-m-d H:i:s')]);   
        
        return redirect('/memberhome');
    }
}
