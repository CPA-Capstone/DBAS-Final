@extends ('layouts.layout')

@section ('content')


<div>
    <H1>Your Target for this quarter:
       
    @php
    if (isset($target->committee_member_target_amount))
    {
      echo $target->committee_member_target_amount;
    }
    else
    {
      echo 'Unavailable...';
    }
    @endphp 
    </H1>
 

    <table class="table">
        @foreach ($donors as $donor)
          @if ($member->donors->contains($donor->donor_id) && count(\DB::table('donor_committee_member')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)->get()) > 0)
            <tr>
              <td>{{ $donor->donor_name }}</td>
              <td>{{ $donor->donor_email }}</td>
              <td>({{ substr($donor->donor_phone, 0, 3) }}){{ substr($donor->donor_phone, 3, 3) }}-{{ substr($donor->donor_phone, 6, 4) }}</td>
              <td>{{ $donor->donor_address }}</td>
              <td>
                <button class="btn btn-dark" onclick="window.location.href = '/donor/{{$donor->donor_id}}/editdonor';">Edit</button>
              </td>
            </tr>
          @endif
        @endforeach
        <tr>
    </table> 

    
       
</div>

@endsection
