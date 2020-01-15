@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Add Donor Projection</h1>

      <form method="POST" action="/donorprojections">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="projection_year">Projection Year:</label>
          <input type="text" class="form-control" id="projection_year" name="projection_year" />
        </div>

        <div class="form-group">
          <label for="projection_amount">Projection Amount:</label>
          <input type="text" class="form-control" id="projection_amount" name="projection_amount" />
        </div>

        <div class="form-group">
          <select name="donor_id" class="form-control">
            @foreach ($donors as $donor)
              <option value="{{ $donor->donor_id }}">{{ $donor->donor_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Add Projection</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection