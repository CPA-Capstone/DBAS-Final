@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      @foreach ($years as $year)

        <h4>{{ $year }} Individual Donor Type Targets</h4>
        <h4>(Thousands of Dollars)</h4>

        <table class="table">
          <tr>
            <td></td>
            <td><h5>Qtr 1</h5></td>
            <td><h5>Qtr 2</h5></td>
            <td><h5>Qtr 3</h5></td>
            <td><h5>Qtr 4</h5></td>
          </tr>
          @foreach ($types as $type)
            <tr>
              <td><h5>{{ $type->donor_type_name }}</h5></td>
              @for ($i = 1; $i <= 4; $i++)
                <td>
                  @if (isset($targets[$year.'|'.$i.'|'.$type->donor_type_id]))
                    <a href="donortypetargets/{{ $targets[$year.'|'.$i.'|'.$type->donor_type_id]->donor_type_target_id }}/edit" >{{ $targets[$year.'|'.$i.'|'.$type->donor_type_id]->donor_type_target_amount/1000 }}</a>
                  @else

                  @endif
                </td>
              @endfor
            </tr>
          @endforeach
        </table>

      @endforeach

      <button class="btn btn-dark" onclick="window.location.href = '/donortypetargets/create';">Add Donor Type Target</button>

    </div>

  </div><!-- /.blog-main -->

@endsection