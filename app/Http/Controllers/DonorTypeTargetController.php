<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonorTypeTargetController extends Controller
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

    	$donortypetargets = \App\DonorTypeTarget::orderBy('donor_type_target_year', 'desc')->get();
    	$types = \App\DonorType::all();

    	$targets = [];
    	$years = [];

    	foreach ($donortypetargets as $donortypetarget)
    	{
    		$targets[$donortypetarget->donor_type_target_year.'|'.$donortypetarget->donor_type_target_quarter.'|'.$donortypetarget->donor_type_id] = $donortypetarget;

    		if (array_search($donortypetarget->donor_type_target_year, $years) === false)
    		{
    			array_push($years, $donortypetarget->donor_type_target_year);
    		}
    	}
    	return view('donortypetargets.show', compact(['types', 'targets', 'years']));
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

        $types = \App\DonorType::all();

        return view('donortypetargets.create', compact(['types']));
    }

    public function store(Request $request)
    {
        if (count(\DB::table('donor_type_targets')->select('*')->where('donor_type_target_year', $request->get('target_year'))->where('donor_type_target_quarter', $request->get('target_quarter'))->where('donor_type_id', $request->get('donor_type_id'))->get()) !== 0)
        {
            return redirect()->back();
        }

        $target = new \App\DonorTypeTarget;
        $target->donor_type_target_year = $request->get('target_year');
        $target->donor_type_target_quarter = $request->get('target_quarter');
        $target->donor_type_target_amount = $request->get('target_amount');
        $target->donor_type_id = $request->get('donor_type_id');
        $target->timestamps = false;
        $target->save();

        return redirect('/donortypetargets');
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
        
    	$target = \App\DonorTypeTarget::find($id);

    	return view('donortypetargets.edit', compact(['target']));
    }

    public function update(Request $request, $id)
    {
      $target = \App\DonorTypeTarget::find($id);

      $target->donor_type_target_amount = $request->get('target_amount');
      $target->timestamps = false;
      $target->save();

      return redirect('/donortypetargets');
    }
}
