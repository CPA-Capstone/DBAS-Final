<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonorProjectionController extends Controller
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

    	$donorprojections = \App\DonorProjection::orderBy('donor_projection_year', 'desc')->get();
    	$donors = \App\Donor::all();

    	$projections = [];
    	$years = [];

    	foreach ($donorprojections as $donorprojection)
    	{
    		$projections[$donorprojection->donor_projection_year.'|'.$donorprojection->donor_id] = $donorprojection;

    		if (array_search($donorprojection->donor_projection_year, $years) === false)
    		{
    			array_push($years, $donorprojection->donor_projection_year);
    		}
    	}
    	return view('donorprojections.show', compact(['donors', 'projections', 'years']));
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

        $donors = \App\Donor::all();

        return view('donorprojections.create', compact(['donors']));
    }

    public function store(Request $request)
    {
        if (count(\DB::table('donor_projections')->select('*')->where('donor_projection_year', $request->get('projection_year'))->where('donor_id', $request->get('donor_id'))->get()) !== 0)
        {
            return redirect()->back();
        }

        $projection = new \App\DonorProjection;
        $projection->donor_projection_year = $request->get('projection_year');
        $projection->donor_projection_amount = $request->get('projection_amount');
        $projection->donor_id = $request->get('donor_id');
        $projection->timestamps = false;
        $projection->save();

        return redirect('/donorprojections');
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
        
    	$projection = \App\DonorProjection::find($id);

    	return view('donorprojections.edit', compact(['projection']));
    }

    public function update(Request $request, $id)
    {
      $projection = \App\DonorProjection::find($id);

      $projection->donor_projection_amount = $request->get('projection_amount');
      $projection->timestamps = false;
      $projection->save();

      return redirect('/donorprojections');
    }
}
