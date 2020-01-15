@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Donor Contribution Report</h4>
      <h4>{{ DateTime::createFromFormat('!m', $month)->format('F') }}, {{ $year }}</h4>
      <h4>{{ floor((($month)/12)*100) }}% of the current year elapsed</h4>

      <table class="table">
        <tr>
          <td><h5>Donor Type</h5></td>
          <td><h5>Donor</h5></td>
          <td><h5>Year-to-Date Contributions <br> (Hundreds of $)</h5></td>
          <td><h5>% of Annual Projection</h5></td>
        </tr>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->donor_type_name }}</td><td></td><td></td><td></td>
          </tr>
          @foreach ($donors as $donor)
            @if ($donor->donor_type_id == $type->donor_type_id)
              <tr>
                <td></td>
                <td>{{ $donor->donor_name }}</td>
                <td>
                  {{ floor($sums[$type->donor_type_id.'|'.$donor->donor_id]/100) }}
                </td>
                <td>
                  @for ($i = 0; $i < count($projections); $i++)
                    @if ($projections[$i]->donor_id == $donor->donor_id)
                      <?php $projection = $projections[$i]; ?>
                    @endif
                  @endfor
                  @if (!isset($projection))

                  @else
                    {{ floor(($sums[$type->donor_type_id.'|'.$donor->donor_id]/$projection->donor_projection_amount)*100) }}
                  @endif
                </td>
              </tr>
            @endif
          @endforeach
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection