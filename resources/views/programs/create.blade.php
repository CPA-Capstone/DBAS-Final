@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Add Program</h1>

      <form method="POST" action="/programs">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="program_name">Program Name:</label>
          <input type="text" class="form-control" id="program_name" name="program_name" />
        </div>

        <div class="form-group">
          <h5>Offered On:</h5> <br>
          @foreach ($campuses as $campus)
            <label for="{{ $campus->campus_id }}">{{ $campus->campus_name }}:</label>
            <input type="checkbox" id="{{ $campus->campus_id }}" name="{{ $campus->campus_id }}" value="{{ $campus->campus_name }}" /> <br>
          @endforeach
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Add Program</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection