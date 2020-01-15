@extends ('layouts.layout')

@section ('content')

<table class="table">


        <tr>
            <td><h5>Donation ID</h5></td>
            <td><h5>Donor Name</h5></td>
            <td><h5>Date</h5></td>
            <td><h5>Program</h5></td>
            <td><h5>Amount</h5></td>
            <td></td>
        </tr>


        @foreach ($donations as $donation)
            <tr>
              <td>{{ $donation->donation_id }}</td>
              <td>{{ $donation->donor->donor_name }}</td>
              <td>{{ substr($donation->donation_date, 0, 10) }}</td>
              <td>{{ $donation->program->program_name}}</td>
              <td>{{ $donation->donation_amount }}</td>
              
              <td>
                <button class="btn btn-dark" onclick="window.location.href = '/member/{{$donation->donation_id}}/editdonation';">Edit</button>
              </td>
            </tr>
        @endforeach
        <tr>
    </table> 
@endsection