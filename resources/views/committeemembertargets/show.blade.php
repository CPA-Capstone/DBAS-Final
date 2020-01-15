@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      @foreach ($years as $year)

        <h4>{{ $year }} Individual Committee Member Targets</h4>
        <h4>(Thousands of Dollars)</h4>

        <table class="table">
          <tr>
            <td></td>
            <td><h5>Qtr 1</h5></td>
            <td><h5>Qtr 2</h5></td>
            <td><h5>Qtr 3</h5></td>
            <td><h5>Qtr 4</h5></td>
          </tr>
          @foreach ($members as $member)
            @if (count(\DB::table('committee_member_targets')->select('*')->where('committee_member_target_year', $year)->where('committee_member_id', $member->committee_member_id)->get()) !== 0)
              <tr>
                <td><h5>{{ $member->committee_member_first_name }} {{ $member->committee_member_last_name }}</h5></td>
                @for ($i = 1; $i <= 4; $i++)
                  <td>
                    @if (isset($targets[$year.'|'.$i.'|'.$member->committee_member_id]))
                      <a href="committeemembertargets/{{ $targets[$year.'|'.$i.'|'.$member->committee_member_id]->committee_member_target_id }}/edit" >{{ $targets[$year.'|'.$i.'|'.$member->committee_member_id]->committee_member_target_amount/1000 }}</a>
                    @else

                    @endif
                  </td>
                @endfor
              </tr>
            @endif
          @endforeach
        </table>

      @endforeach

      <button class="btn btn-dark" onclick="window.location.href = '/committeemembertargets/create';">Add Committee Member Target</button>

    </div>

  </div><!-- /.blog-main -->

@endsection