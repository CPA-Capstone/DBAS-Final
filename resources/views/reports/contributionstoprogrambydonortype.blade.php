@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Contributions to Program by Donor Type</h4>
      <h4>{{ $qtext }} Quarter, {{ $year }}</h4>
      <h4>(Hundreds of Dollars)</h4>

      <table class="table">
        <tr>
          <td><h5>Donor Type</h5></td>
          <td><h5>Program</h5></td>
          <td><h5>Contributions this Quarter</h5></td>
        </tr>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->donor_type_name }}</td><td></td><td></td><td></td>
          </tr>
          @foreach ($programs as $program)
            <tr>
              <td></td>
              <td>{{ $program->program_name }}</td>
              <td>
                {{ floor($sums[$type->donor_type_id.'|'.$program->program_id]/100) }}
              </td>
            </tr>
          @endforeach
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection