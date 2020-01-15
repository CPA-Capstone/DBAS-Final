<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Donor;
use App\Program;
Use App\Donation;
Use App\CommitteeMember;
use Carbon\Carbon;

class DonationController extends Controller
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

        $donors = Donor::all();
        $programs = Program::all();
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();
        return view('member.makedonation',compact('donors', 'programs', 'member'));
    
    } 

    public function store(Request $request)
    {
        
        $this->validate(request(), [
            
            'donor_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'programs' => 'required'

        ]);
        $donation =new Donation;
        $donation->donor_id= $request->get('donor_id');
        $donation->committee_member_id= CommitteeMember::where('user_id', \Session::get('user')->user_id)->first()->committee_member_id;
        $donation->donation_amount= $request->get('amount');
        $donation->donation_date= $request->get('date');
        $donation->program_id= $request->get('programs');
        $donation->timestamps = false;
            $donation->save();
        
        return redirect('/member/pastdonations');
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

        $donation = Donation::find($id);

        $donors = Donor::all();
        $programs = Program::all();
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();
        return view('member.editdonation',compact('donation', 'donors', 'programs', 'member'));
    }

    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            
            'donor_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'programs' => 'required'

        ]);
        $donation = Donation::find($id);
        $donation->donor_id= $request->get('donor_id');
        $donation->committee_member_id= CommitteeMember::where('user_id', \Session::get('user')->user_id)->first()->committee_member_id;
        $donation->donation_amount= $request->get('amount');
        $donation->donation_date= $request->get('date');
        $donation->program_id= $request->get('programs');
        $donation->timestamps = false;
            $donation->save();
        
        return redirect('/member/pastdonations');
    }

    public function show()
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
        $member = CommitteeMember::where('user_id', \Session::get('user')->user_id)->first();
        $donations = Donation::where('committee_member_id', $member->committee_member_id)->orderBy('donation_date')->get();
        
        return view('member.pastdonation',compact('donors', 'programs', 'member','donations'));
    }  

    public function list()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }

        $donations = \DB::table('campus_donation')->select('*')->orderBy('campus_donation_date', 'desc')->get()->toArray();
        $campuses = \App\Campus::all();
        $donors = Donation::all();

        return view('donation.list', compact('donations', 'campuses', 'donors'));
    }

    public function add()
    {
        if (null === \Session::get('user'))
        {
            return redirect('/');
        }
        else if (\Session::get('user')->user_type == 'h')
        {
            return redirect('/headhome');
        }

        $donations = Donation::doesnthave('campuses')->get();
        $campuses = \App\Campus::all();

        return view('donation.create', compact('donations', 'campuses'));
    }

    public function insert(Request $request)
    {
        $donation = Donation::find($request->get('donation_id'));
        $campus = \App\Campus::find($request->get('campus_id'));

        \DB::table('campus_donation')->insert(['donation_id' => $donation->donation_id, 'campus_id' => $campus->campus_id, 'campus_donation_amount' => $donation->donation_amount, 'campus_donation_date' => date('Y-m-d H:i:s')]);

        return redirect('/donations/show');
    }
}
