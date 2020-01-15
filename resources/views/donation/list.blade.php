@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">

      <button class="btn btn-dark" onclick="window.location.href = '/donation/create';">Assign Donation</button><br><br>

      <table class="table">
        <tr>
          <td><h5>Campus</h5></td>
          <td><h5>Donor</h5></td>
          <td><h5>Amount</h5></td>
          <td><h5>Date</h5></td>
        </tr>
        @foreach ($donations as $donation)
          <tr>
          <td>
            @foreach ($campuses as $campus)
              @if ($campus->campus_id == $donation->campus_id)
                {{ $campus->campus_name }}
              @endif
            @endforeach
          </td>
          <td>
            @foreach ($donors as $donor)
              @if ($donor->donation_id == $donation->donation_id)
                {{ $donor->donor->donor_name }}
              @endif
            @endforeach
          </td>
          <td>{{ $donation->campus_donation_amount }}</td>
          <td>{{ substr($donation->campus_donation_date, 0, 10) }}</td>
        </tr>
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection