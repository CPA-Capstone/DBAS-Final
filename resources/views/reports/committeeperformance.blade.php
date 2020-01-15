@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Contributions by Donor Type</h4>
      <h4>{{ $qtext }} Quarter {{ $year }}</h4>
      <h4>(Thousands of Dollars)</h4>

      <table class="table">
        <tr>
          <td><h5>Member</h5></td>
          <td><h5>Target</h5></td>
          <td><h5>Contributions this Quarter</h5></td>
          <td><h5>% of Target Acheived</h5></td>
        </tr>
        @foreach ($members as $member)
          <tr>
            <td>{{ $member->committee_member_first_name }}</td>
            <td>
              @for ($i = 0; $i < count($targets); $i++)
                @if ($targets[$i]->committee_member_id == $member->committee_member_id)
                  <?php $target = $targets[$i]; ?>
                @endif
              @endfor
              @if (!isset($target))

              @else
                {{ floor($target->committee_member_target_amount/1000) }}
              @endif
            </td>
            <td>
              {{ floor($sums[$member->committee_member_id]/1000) }}
            </td>
            <td>
              @for ($i = 0; $i < count($targets); $i++)
                @if ($targets[$i]->committee_member_id == $member->committee_member_id)
                  <?php $target = $targets[$i]; ?>
                @endif
              @endfor
              @if (!isset($target))

              @else
                {{ floor(($sums[$member->committee_member_id]/$target->committee_member_target_amount)*100) }}
              @endif
            </td>
          </tr>
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection