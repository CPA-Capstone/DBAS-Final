@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      @foreach ($years as $year)

        <h4>{{ $year }} Individual Donor Projections</h4>
        <h4>(Thousands of Dollars)</h4>

        <table class="table">
          <tr>
            <td><h5>Donor</h5></td>
            <td><h5>Donor Type</h5></td>
            <td><h5>Projection</h5></td>
          </tr>
          @foreach ($donors as $donor)
            @if (count(\DB::table('donor_projections')->select('*')->where('donor_projection_year', $year)->where('donor_id', $donor->donor_id)->get()) !== 0)
              <tr>
                <td><h6>{{ $donor->donor_name }}</h6></td>
                <td><h6>{{ $donor->donor_type_id }}</h6></td>
                <td>
                  @if (isset($projections[$year.'|'.$donor->donor_id]))
                    <a href="donorprojections/{{ $projections[$year.'|'.$donor->donor_id]->donor_projection_id }}/edit" >{{ $projections[$year.'|'.$donor->donor_id]->donor_projection_amount/1000 }}</a>
                  @else

                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        </table>

      @endforeach

      <button class="btn btn-dark" onclick="window.location.href = '/donorprojections/create';">Add Donor Projection</button>

    </div>

  </div><!-- /.blog-main -->

@endsection