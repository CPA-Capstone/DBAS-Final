<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Datetime;

class ReportController extends Controller
{
    public function performance(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

        $year = $request->get('year');
        $month = $request->get('month');

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
        if ($quarter == 1)
        {
            $qtext = 'First';
        }
        else if ($quarter == 2)
        {
            $qtext = 'Second';
        }
        else if ($quarter == 3)
        {
            $qtext = 'Third';
        }
        else
        {
            $qtext = 'Fourth';
        }

        $quarters = [0, 1, 4, 7, 10];

        $targets = \App\CommitteeMemberTarget::where('committee_member_target_year', $year)->where('committee_member_target_quarter', $quarter)->get();
        $members = \App\CommitteeMember::where('committee_member_type', 'm')->get();

        $donations = \App\Donation::where('donation_date', '>', date('Y-m-d', strtotime("$year-$quarters[$quarter]-01")))
            ->where('donation_date', '<', date('Y-m-d', strtotime("+3 months", strtotime("$year-$quarters[$quarter]-01"))))->get();

        $sums = [];
        foreach ($members as $member)
        {
            $sums[$member->committee_member_id] = 0;
        }

        foreach ($donations as $donation)
        {
            $sums[$donation->committee_member_id] += $donation->donation_amount;
        }

        return view('reports.committeeperformance', compact(['year', 'qtext', 'targets', 'members', 'sums']));
    }

    public function donor(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

        $year = $request->get('year');
        $month = $request->get('month');
        $types = \App\DonorType::all();
        $donors = \App\Donor::all();

        $projections = \App\DonorProjection::where('donor_projection_year', $year)->get();

        $donations = \App\Donation::where('donation_date', '>', date('Y-m-d', strtotime("$year-01-01")))
            ->where('donation_date', '<', date('Y-m-d', strtotime("+1 months", strtotime("$year-$month-01"))))->get();

        $sums = [];
        foreach ($types as $type)
        {
            foreach ($donors as $donor) 
            {
                if($donor->donor_type_id == $type->donor_type_id)
                {
                    $sums[$type->donor_type_id.'|'.$donor->donor_id] = 0;
                }
            }
        }

        foreach ($donations as $donation)
        {
            $sums[$donation->donor->donor_type_id.'|'.$donation->donor_id] += $donation->donation_amount;
        }

        return view('reports.donorcontribution', compact(['year', 'month', 'donors', 'types', 'projections', 'sums']));
    }

    public function list(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

        $year = $request->get('year');

        $donations = \App\Donation::where('donation_date', '>=', date('Y-m-d', strtotime("$year-01-01")))
            ->where('donation_date', '<=', date('Y-m-d', strtotime(($year+1)."-01-01")))->get();

        return view('reports.contributionlistreport', compact(['year', 'donations']));
    }

    public function program(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

    	$year = $request->get('year');
    	$month = $request->get('month');

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
        if ($quarter == 1)
        {
            $qtext = 'First';
        }
        else if ($quarter == 2)
        {
            $qtext = 'Second';
        }
        else if ($quarter == 3)
        {
            $qtext = 'Third';
        }
        else
        {
            $qtext = 'Fourth';
        }

    	$quarters = [0, 1, 4, 7, 10];

    	$types = \App\DonorType::all();
        $programs = \App\Program::all();

    	$donations = \App\Donation::where('donation_date', '>', date('Y-m-d', strtotime("$year-$quarters[$quarter]-01")))
    		->where('donation_date', '<', date('Y-m-d', strtotime("+3 months", strtotime("$year-$quarters[$quarter]-01"))))->get();

    	$sums = [];
    	foreach ($types as $type)
    	{
            foreach ($programs as $program) 
            {
    		    $sums[$type->donor_type_id.'|'.$program->program_id] = 0;
            }
    	}

    	foreach ($donations as $donation)
    	{
    		$sums[$donation->donor->donor_type_id.'|'.$donation->program_id] += $donation->donation_amount;
    	}

    	return view('reports.contributionstoprogrambydonortype', compact(['year', 'qtext', 'programs', 'types', 'sums']));
    }

    public function type(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

        $year = $request->get('year');
        $month = $request->get('month');

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

        $quarters = [0, 1, 4, 7, 10];

        $targets = \App\DonorTypeTarget::where('donor_type_target_year', $year)->where('donor_type_target_quarter', $quarter)->get();
        $types = \App\DonorType::all();

        $donations = \App\Donation::where('donation_date', '>', date('Y-m-d', strtotime("$year-$quarters[$quarter]-01")))
            ->where('donation_date', '<', date('Y-m-d', strtotime("+3 months", strtotime("$year-$quarters[$quarter]-01"))))->get();

        $sums = [];
        foreach ($types as $type)
        {
            $sums[$type->donor_type_id] = 0;
        }

        foreach ($donations as $donation)
        {
            foreach ($types as $type)
            {
                if ($donation->donor->donor_type_id == $type->donor_type_id)
                {
                    $sums[$type->donor_type_id] += $donation->donation_amount;
                }
            }
        }

        $month = DateTime::createFromFormat('!m', $month)->format('F');

        return view('reports.contributionsbydonortype', compact(['year', 'month', 'targets', 'types', 'sums']));
    }

    public function campus(Request $request)
    {
        $this->validate($request, [
            'year' => 'required|numeric',
            'month' => 'required|numeric',
        ]);

    	$quarters = [1, 4, 7, 10];
        $quarter = 0;
        $q = 0;
        foreach ($quarters as $quart)
        {
            $q += 1;
            if (($request->get('month') >= $quart && $request->get('month') < $quart + 3) || ($quart + 2 > 12 && $request->get('month')< $quart - 10))
            {
                $quarter = $q;
            }
        }
    	$year = $request->get('year');
    	if ($quarter == 1)
    	{
    		$qtext = 'First';
    	}
    	else if ($quarter == 2)
    	{
    		$qtext = 'Second';
    	}
    	else if ($quarter == 3)
    	{
    		$qtext = 'Third';
    	}
    	else
    	{
    		$qtext = 'Fourth';
    	}
    	$quarters = [0, 1, 4, 7, 10];

    	$targets = \App\CampusTarget::where('campus_target_year', $year)->where('campus_target_quarter', $quarter)->get();
    	$campuses = \App\Campus::all();

    	$sums = \DB::table('campus_donation')
    		->where('campus_donation_date', '>', date('Y-m-d', strtotime("$year-$quarters[$quarter]-01")))
    		->where('campus_donation_date', '<', date('Y-m-d', strtotime("+3 months", strtotime("$year-$quarters[$quarter]-01"))))
    		->groupBy('campus_id')
    		->selectRaw('sum(campus_donation_amount) as sum, campus_id')
   			->pluck('sum','campus_id');

    	return view('reports.contributionsbycampus', compact(['year', 'qtext', 'targets', 'campuses', 'sums']));
    }
}
