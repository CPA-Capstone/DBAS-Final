@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Edit Donor Type Target</h1>

      <form method="POST" action="/donortypetargets/{{ $target->donor_type_target_id }}/edit">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
          <label for="target_amount">Target Amount:</label>
          <input type="text" class="form-control" id="target_amount" name="target_amount" value="{{ $target->donor_type_target_amount }}" />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Edit Target</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection