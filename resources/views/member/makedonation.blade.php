@extends ('layouts.layout')

@section ('content')


<div>
<H2>Record A Donation</H2>
<form method="post">
{{ csrf_field() }}
    
<div class="form-group">
    <select class="form-control" name="donor_id" id="donor_id">
        @foreach ($donors as $donor)
            @if ($member->donors->contains($donor->donor_id) && count(\DB::table('donor_committee_member')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)->get()) > 0)
                <option value="{{ $donor->donor_id }}">{{ $donor->donor_name }}</option>
            @endif    
        @endforeach
    </select>
    </div>
    
    <div class="form-group">
         <input class="form-control" type="text" id="amount" name="amount">
    </div>
    <div class="form-group">
        <input class="form-control" type="date" name="date" id="date">
    </div>
    <div class="form-group">
    <select class="form-control" name="programs" id="programs">
         @foreach ($programs as $program)
                <option value="{{ $program->program_id }}">{{ $program->program_name }}</option>
         @endforeach
  </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" value="Add Donation">
    </div>
</form>
</div>


@endsection