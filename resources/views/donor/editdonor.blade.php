@extends ('layouts.layout')

@section ('content')


<div>

<H2>Edit Donor</H2>
<form method="post">
{{ csrf_field() }}
{{ method_field('PATCH')}}
    <div class="form-group">
        
        Name:<br>
        <input type="text" class="form-control" name="donor_name" id="donor_name" value="{{ $donor->donor_name }}">
    </div>
    
    <div class="form-group">
    Email: <br>
         <input type="email" class="form-control" name="email" id="email" value="{{ $donor->donor_email }}">
    </div>
    <div class="form-group">
        Phone Number: <br>
        <input type="tel" class="form-control" name="phone" id="phone" value="{{ $donor->donor_phone }}">
    </div>
    <div class="form-group">
        Address: <br>
        <input type="text" class="form-control" name="address" id="address" value="{{ $donor->donor_address }}">
    </div>
    <div class="form-group">
        Bank Account Number: <br>
        <input type="text" class="form-control" name="account_number" id="account_number" value="{{ $donor->donor_bank_account_number }}">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-dark" value="Edit Donor">
    </div>
</form>

</div>


@endsection