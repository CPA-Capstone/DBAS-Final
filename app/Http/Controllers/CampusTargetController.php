<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CampusTargetController extends Controller
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

    	$campustargets = \App\CampusTarget::orderBy('campus_target_year', 'desc')->get();
    	$campuses = \App\Campus::all();

    	$targets = [];
    	$years = [];

    	foreach ($campustargets as $campustarget)
    	{
    		$targets[$campustarget->campus_target_year.'|'.$campustarget->campus_target_quarter.'|'.$campustarget->campus_id] = $campustarget;

    		if (array_search($campustarget->campus_target_year, $years) === false)
    		{
    			array_push($years, $campustarget->campus_target_year);
    		}
    	}
    	return view('campustargets.show', compact(['campuses', 'targets', 'years']));
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

        $campuses = \App\Campus::all();

        return view('campustargets.create', compact(['campuses']));
    }

    public function store(Request $request)
    {
        if (count(\DB::table('campus_targets')->select('*')->where('campus_target_year', $request->get('target_year'))->where('campus_target_quarter', $request->get('target_quarter'))->where('campus_id', $request->get('campus_id'))->get()) !== 0)
        {
            return redirect()->back();
        }

        $target = new \App\CampusTarget;
        $target->campus_target_year = $request->get('target_year');
        $target->campus_target_quarter = $request->get('target_quarter');
        $target->campus_target_amount = $request->get('target_amount');
        $target->campus_id = $request->get('campus_id');
        $target->timestamps = false;
        $target->save();

        return redirect('/campustargets');
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
        
    	$target = \App\CampusTarget::find($id);

    	return view('campustargets.edit', compact(['target']));
    }

    public function update(Request $request, $id)
    {
      $target = \App\CampusTarget::find($id);

      $target->campus_target_amount = $request->get('target_amount');
      $target->timestamps = false;
      $target->save();

      return redirect('/campustargets');
    }
}