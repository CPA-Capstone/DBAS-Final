<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donor;
use App\Program;
Use App\Donation;
Use App\User;
Use App\CommitteeMember;
use Carbon\Carbon;

class CommitteeMemberController extends Controller
{
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

      $programs = \App\Program::all();
      $types = \App\DonorType::all();

      return view('committeemembers.create', compact(['member', 'programs', 'types']));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'committee_member_first_name' => 'required',
        'committee_member_last_name' => 'required',
        'user_id' => 'required',
        'user_password' => 'required|min:6',
      ]);

      $member = new \App\CommitteeMember;
      $user = new \App\User;;

      $member->committee_member_status = 'e';
      $member->committee_member_type = 'm';
      $user->user_type = $member->committee_member_type;

      $member->committee_member_first_name = $request->get('committee_member_first_name');
      $member->committee_member_last_name = $request->get('committee_member_last_name');
      $member->user_id = $request->get('user_id');
      $member->timestamps = false;
      $member->save();

      $user->user_id = $request->get('user_id');
      $user->user_password = bcrypt($request->get('user_password'));
      $user->timestamps = false;
      $user->save();

      $programs = \App\Program::all();

      foreach ($programs as $program)
      {
        if ($request->__isset($program->program_id))
   	    {
          $member->programs()->attach($program->program_id, ['start_date' => date('Y-m-d H:i:s')]);
        }
      }

      $types = \App\DonorType::all();

      foreach ($types as $type)
      {
        if ($request->__isset($type->donor_type_id))
        {
          $member->donorTypes()->attach($type->donor_type_id, ['start_date' => date('Y-m-d H:i:s')]);
        }
      }

      return redirect('/headhome');
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

      $member = \App\CommitteeMember::find($id);
      $programs = \App\Program::all();
      $types = \App\DonorType::all();

      return view('committeemembers.edit', compact(['member', 'programs', 'types']));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'committee_member_first_name' => 'required',
        'committee_member_last_name' => 'required',
        'user_id' => 'required',
      ]);

      $member = \App\CommitteeMember::find($id);
      $user = $member->user;

      if ($request->__isset('committee_member_status'))
      {
      	$member->committee_member_status = 'u';
      	$user->user_type = 'd';
      }
      else
      {
      	$member->committee_member_status = 'e';
      	$user->user_type = $member->committee_member_type;
      }

      $member->committee_member_first_name = $request->get('committee_member_first_name');
      $member->committee_member_last_name = $request->get('committee_member_last_name');
      $member->user_id = $request->get('user_id');
      $member->timestamps = false;
      $member->save();

      $user->user_id = $request->get('user_id');
      if ($request->get('user_password') != '')
      {
      	$user->user_password = bcrypt($request->get('user_password'));
      }
      $user->timestamps = false;
      $user->save();

      $programs = \App\Program::all();

      foreach ($programs as $program)
      {
		if ($member->programs->contains($program->program_id) && count(\DB::table('committee_member_program')->select('*')->where('committee_member_id', $member->committee_member_id)->where('program_id', $program->program_id)->where('end_date', null)->get()) > 0)
        {
          if (!$request->__isset($program->program_id))
          {
            \DB::table('committee_member_program')
            	->where('committee_member_id', $member->committee_member_id)->where('program_id', $program->program_id)->where('end_date', null)
            	->update(['end_date' => date('Y-m-d H:i:s')]);
          }
        }
        else
        {
          if ($request->__isset($program->program_id))
          {
            $member->programs()->attach($program->program_id, ['start_date' => date('Y-m-d H:i:s')]);
          }
        }
      }

      $types = \App\DonorType::all();

      foreach ($types as $type)
      {
		if ($member->donorTypes->contains($type->donor_type_id) && count(\DB::table('committee_member_donor_type')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_type_id', $type->donor_type_id)->where('end_date', null)->get()) > 0)
        {
          if (!$request->__isset($type->donor_type_id))
          {
            \DB::table('committee_member_donor_type')
            	->where('committee_member_id', $member->committee_member_id)->where('donor_type_id', $type->donor_type_id)->where('end_date', null)
            	->update(['end_date' => date('Y-m-d H:i:s')]);
          }
        }
        else
        {
          if ($request->__isset($type->donor_type_id))
          {
            $member->donorTypes()->attach($type->donor_type_id, ['start_date' => date('Y-m-d H:i:s')]);
          }
        }
      }

      return redirect('/headhome');
    }

    public function show($id)
    {
      if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'm')
        {
            return redirect('/memberhome');
        }

      $member = \App\CommitteeMember::find($id);
      $donors = \App\Donor::orderBy('donor_name')->get();
      $types = [];
      foreach (\DB::table('committee_member_donor_type')->select('donor_type_id')->where('committee_member_id', $member->committee_member_id)->where('end_date', null)->get() as $type)
      {
      	array_push($types, $type->donor_type_id);
  	  }

      return view('committeemembers.assign', compact(['member', 'donors', 'types']));
    }

    public function assign(Request $request, $id)
    {
    	$member = \App\CommitteeMember::find($id);
    	$donor = \App\Donor::find($request->get('donor_id'));

    	$member->donors()->attach($donor->donor_id, ['start_date' => date('Y-m-d H:i:s')]);

    	return redirect('/committeemembers/'.$member->committee_member_id.'/donors');
    }

    public function unassign(Request $request, $id)
    {
    	$member = \App\CommitteeMember::find($id);
    	$donor = \App\Donor::find($request->get('donor_id'));

    	\DB::table('donor_committee_member')
            ->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)
            ->update(['end_date' => date('Y-m-d H:i:s')]);

    	return redirect('/committeemembers/'.$member->committee_member_id.'/donors');
    }

    public function home()
    {
      if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }
        $donors = Donor::all();
        $programs = Program::all();
        $month = Carbon::now()->month;
        $quarters = [1, 4, 7, 10];
        $quarter = 0;
        $q = 0;
        foreach ($quarters as $quart)
        {
            $q += 1;
            if (($month >= $quart && $month < $quart + 3) || ($quart + 2 > 12 && $month < $quart - 10))
            {
                $quarter = $q;
            }
        }

        $year = Carbon::now()->year;
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();
        $types = [];

        foreach (\DB::table('committee_member_donor_type')->select('donor_type_id')->where('committee_member_id', $member->committee_member_id)->where('end_date', null)->get() as $type)
        {
          array_push($types, $type->donor_type_id);
        }
        $target = \DB::table('committee_member_targets')->where('committee_member_id', $member->committee_member_id)->where('committee_member_target_quarter', $quarter)->where('committee_member_target_year', $year)->first();
      
        return view('member.memberhome',compact('donors', 'programs','types','member', 'quarter','year','target' ));
    }
}