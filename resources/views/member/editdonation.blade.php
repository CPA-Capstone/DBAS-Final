@extends ('layouts.layout')

@section ('content')

@php $assigned = false; @endphp
<div>

<H2>Edit Donation</H2>
<form method="post">
{{ csrf_field() }}
{{ method_field('PATCH') }}
<div class="form-group">
    <select class="form-control" name="donor_id" id="donor_id">
        @foreach ($donors as $donor)
            @if ($member->donors->contains($donor->donor_id) && count(\DB::table('donor_committee_member')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)->get()) > 0)
                <option value="{{ $donor->donor_id }}" @if ($donor->donor_id == $donation->donor_id) selected @php $assigned = true; @endphp @endif>{{ $donor->donor_name }}</option>
            @endif
            @if (!$assigned)
                <option value="{{ $donation->donor_id }}" selected>{{ $donation->donor->donor_name }}</option>
            @endif    
        @endforeach
    </select>
    </div>
    
    <div class="form-group">
         <input class="form-control" type="text" id="amount" name="amount" value="{{ $donation->donation_amount }}">
    </div>
    <div class="form-group">
        <input class="form-control" type="date" name="date" id="date" value="{{ substr($donation->donation_date, 0, 10) }}">
    </div>
    <div class="form-group">
    <select class="form-control" name="programs" id="programs">
         @foreach ($programs as $program)
            <option value="{{ $program->program_id }}" @if ($program->program_id == $donation->program_id) selected @endif >{{ $program->program_name }}</option>
         @endforeach
  </select>
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" value="Edit Donation">
    </div>
</form>

</div>


@endsection