@extends ('layouts.layout')

@section ('content')


<div>

<H2>Add Donor</H2>
<form method="POST" action="/donor/adddonor">
{{ csrf_field() }}
    <div class="form-group"> 
        Name:<br>
        <input type="text" class="form-control" name="donor_name" id="donor_name">
    </div>

    <div class="form-group">
    Donor Type: <br>
    <select class="form-control" name="donor_type_id" id="donor_type_id">
         @foreach ($donor_types as $donor_type)
            @if ($member->donorTypes->contains($donor_type->donor_type_id) && count(\DB::table('committee_member_donor_type')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_type_id', $donor_type->donor_type_id)->where('end_date', null)->get()) > 0)
                <option value="{{ $donor_type->donor_type_id }}">{{ $donor_type->donor_type_name }}</option>
            @endif
         @endforeach
  </select>
    </div>
    
    <div class="form-group">
    Email: <br>
         <input class="form-control" type="email" name="email" id="email">
    </div>
    <div class="form-group">
        Phone Number: <br>
        <input class="form-control" type="tel" name="phone" id="phone">
    </div>
    <div class="form-group">
        Address: <br>
        <input class="form-control" type="text" name="address" id="address">
    </div>
    <div class="form-group">
        Bank Account Number: <br>
        <input class="form-control" type="text" name="account_number" id="account_number">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" value="Add Donor">
    </div>
</form>

</div>


@endsection