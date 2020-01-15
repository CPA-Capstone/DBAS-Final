@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">

    <div class="col-md-12" align="center">
      
      <h4>Contributions by Campus</h4>
      <h4>{{ $qtext }} Quarter {{ $year }}</h4>
      <h4>(Thousands of Dollars)</h4>

      <table class="table">
        <tr>
          <td><h5>Campus</h5></td>
          <td><h5>Contributions this Quarter</h5></td>
          <td><h5>% of Target Acheived</h5></td>
        </tr>
        @foreach ($campuses as $campus)
          <tr>
            <td>{{ $campus->campus_name }}</td>
            <td>
              @if (isset($sums[$campus->campus_id]))
                {{ floor($sums[$campus->campus_id]/1000) }}
              @else
                0
              @endif
            </td>
            <td>
              @for ($i = 0; $i < count($targets); $i++)
                @if ($targets[$i]->campus_id == $campus->campus_id)
                  <?php $target = $targets[$i]; ?>
                @endif
              @endfor
              @if (!isset($target))

              @elseif (isset($sums[$campus->campus_id]))
                {{ floor(($sums[$campus->campus_id]/$target->campus_target_amount)*100) }}
              @else
                0
              @endif
            </td>
          </tr>
        @endforeach
      </table>

    </div>

  </div><!-- /.blog-main -->

@endsection