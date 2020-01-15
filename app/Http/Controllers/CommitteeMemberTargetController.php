<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommitteeMemberTargetController extends Controller
{
    public function show()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }

    	$membertargets = \App\CommitteeMemberTarget::orderBy('committee_member_target_year', 'desc')->get();
    	$members = \App\CommitteeMember::all();

    	$targets = [];
    	$years = [];

    	foreach ($membertargets as $membertarget)
    	{
    		$targets[$membertarget->committee_member_target_year.'|'.$membertarget->committee_member_target_quarter.'|'.$membertarget->committee_member_id] = $membertarget;

    		if (array_search($membertarget->committee_member_target_year, $years) === false)
    		{
    			array_push($years, $membertarget->committee_member_target_year);
    		}
    	}
    	return view('committeemembertargets.show', compact(['members', 'targets', 'years']));
    }

    public function create()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }

        $members = \App\CommitteeMember::where('committee_member_type', 'm')->where('committee_member_status', 'e')->get();

        return view('committeemembertargets.create', compact(['members']));
    }

    public function store(Request $request)
    {
        if (count(\DB::table('committee_member_targets')->select('*')->where('committee_member_target_year', $request->get('target_year'))->where('committee_member_target_quarter', $request->get('target_quarter'))->where('committee_member_id', $request->get('committee_member_id'))->get()) !== 0)
        {
            return redirect()->back();
        }

        $target = new \App\CommitteeMemberTarget;
        $target->committee_member_target_year = $request->get('target_year');
        $target->committee_member_target_quarter = $request->get('target_quarter');
        $target->committee_member_target_amount = $request->get('target_amount');
        $target->committee_member_id = $request->get('committee_member_id');
        $target->timestamps = false;
        $target->save();

        return redirect('/committeemembertargets');
    }

    public function edit($id)
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }
        
    	$target = \App\CommitteeMemberTarget::find($id);

    	return view('committeemembertargets.edit', compact(['target']));
    }

    public function update(Request $request, $id)
    {
      $target = \App\CommitteeMemberTarget::find($id);

      $target->committee_member_target_amount = $request->get('target_amount');
      $target->timestamps = false;
      $target->save();

      return redirect('/committeemembertargets');
    }
}
