<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramController extends Controller
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

      $campuses = \App\Campus::all();

      return view('programs.create', compact('campuses'));
    }

    public function store(Request $request)
    {
      $this->validate($request, [
        'program_name' => 'required|min:3',
      ]);

      $program = new \App\Program;
      $program->program_name = $request->get('program_name');
      $program->timestamps = false;
      $program->save();

      $campuses = \App\Campus::all();

      foreach ($campuses as $campus)
      {
        if ($request->__isset($campus->campus_id))
        {
          $program->campuses()->attach($campus->campus_id);
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
      
      $program = \App\Program::where('program_id', $id)->first();
      $campuses = \App\Campus::all();

      return view('programs.edit', compact(['program', 'campuses']));
    }

    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'program_name' => 'required|min:3',
      ]);
      
    	$program = \App\Program::where('program_id', $id)->first();
      $program->program_name = $request->get('program_name');
      $program->timestamps = false;
      $program->save();

      $campuses = \App\Campus::all();

      foreach ($campuses as $campus)
      {
        if ($program->campuses->contains($campus->campus_id))
        {
          if (!$request->__isset($campus->campus_id))
          {
            $program->campuses()->detach($campus->campus_id);
          }
        }
        else
        {
          if ($request->__isset($campus->campus_id))
          {
            $program->campuses()->attach($campus->campus_id);
          }
        }
      }

      return redirect('/headhome');
    }
}
