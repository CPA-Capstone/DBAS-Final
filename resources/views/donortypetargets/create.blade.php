@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Add Donor Type Target</h1>

      <form method="POST" action="/donortypetargets">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="target_year">Target Year:</label>
          <input type="text" class="form-control" id="target_year" name="target_year" />
        </div>

        <div class="form-group">
          <label for="target_quarter">Target Quarter:</label>
          <input type="text" class="form-control" id="target_quarter" name="target_quarter" />
        </div>

        <div class="form-group">
          <label for="target_amount">Target Amount:</label>
          <input type="text" class="form-control" id="target_amount" name="target_amount" />
        </div>

        <div class="form-group">
          <select name="donor_type_id" class="form-control">
            @foreach ($types as $type)
              <option value="{{ $type->donor_type_id }}">{{ $type->donor_type_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Add Target</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection