@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      @foreach ($years as $year)

        <h4>{{ $year }} Individual Campus Targets</h4>
        <h4>(Thousands of Dollars)</h4>

        <table class="table">
          <tr>
            <td></td>
            <td><h5>Qtr 1</h5></td>
            <td><h5>Qtr 2</h5></td>
            <td><h5>Qtr 3</h5></td>
            <td><h5>Qtr 4</h5></td>
          </tr>
          @foreach ($campuses as $campus)
            <tr>
              <td><h5>{{ $campus->campus_name }}</h5></td>
              @for ($i = 1; $i <= 4; $i++)
                <td>
                  @if (isset($targets[$year.'|'.$i.'|'.$campus->campus_id]))
                    <a href="campustargets/{{ $targets[$year.'|'.$i.'|'.$campus->campus_id]->campus_target_id }}/edit" >{{ $targets[$year.'|'.$i.'|'.$campus->campus_id]->campus_target_amount/1000 }}</a>
                  @else

                  @endif
                </td>
              @endfor
            </tr>
          @endforeach
        </table>

      @endforeach

      <button class="btn btn-dark" onclick="window.location.href = '/campustargets/create';">Add Campus Target</button>

    </div>

  </div><!-- /.blog-main -->

@endsection