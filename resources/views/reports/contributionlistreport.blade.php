@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Contributions List for {{ $year }}</h4>

      <table class="table">
        <tr>
          <td><h5>Date</h5></td>
          <td><h5>Donor</h5></td>
          <td><h5>Amount <br> (Hundreds of $)</h5></td>
          <td><h5>Program Name</h5></td>
          <td><h5>Committee Member</h5></td>
        </tr>
        @foreach ($donations as $donation)
          <tr>
          <td>{{ substr($donation->donation_date, 0, 10) }}</td>
          <td>{{ $donation->donor->donor_name }}</td>
          <td>{{ floor($donation->donation_amount/100) }}</td>
          <td>{{ $donation->program->program_name }}</td>
          <td>{{ $donation->committeeMember->committee_member_first_name }}</td>
        </tr>
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection