@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Contributions by Donor Type</h4>
      <h4>{{ $month }}, {{ $year }}</h4>
      <h4>(Thousands of Dollars)</h4>

      <table class="table">
        <tr>
          <td><h5>Donor Type</h5></td>
          <td><h5>Target</h5></td>
          <td><h5>Contributions this Quarter</h5></td>
          <td><h5>% of Target Acheived</h5></td>
        </tr>
        @foreach ($types as $type)
          <tr>
            <td>{{ $type->donor_type_name }}</td>
            <td>
              @for ($i = 0; $i < count($targets); $i++)
                @if ($targets[$i]->donor_type_id == $type->donor_type_id)
                  <?php $target = $targets[$i]; ?>
                @endif
              @endfor
              @if (!isset($target))

              @else
                {{ floor($target->donor_type_target_amount/1000) }}
              @endif
            </td>
            <td>
              {{ floor($sums[$type->donor_type_id]/1000) }}
            </td>
            <td>
              @for ($i = 0; $i < count($targets); $i++)
                @if ($targets[$i]->donor_type_id == $type->donor_type_id)
                  <?php $target = $targets[$i]; ?>
                @endif
              @endfor
              @if (!isset($target))

              @else
                {{ floor(($sums[$type->donor_type_id]/$target->donor_type_target_amount)*100) }}
              @endif
            </td>
          </tr>
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection