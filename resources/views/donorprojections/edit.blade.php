@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Edit Donor Projection</h1>

      <form method="POST" action="/donorprojections/{{ $projection->donor_projection_id }}/edit">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
          <label for="projection_amount">Projection Amount:</label>
          <input type="text" class="form-control" id="projection_amount" name="projection_amount" value="{{ $projection->donor_projection_amount }}" />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Edit Projection</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection