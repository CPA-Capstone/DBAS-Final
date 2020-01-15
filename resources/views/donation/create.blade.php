@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Assign Donation</h1>

      <form method="POST" action="/donation">
        {{ csrf_field() }}

        <h5>Donation ID</h5>
        <div class="form-group">
          <select name="donation_id" class="form-control">
            @foreach ($donations as $donation)
              <option value="{{ $donation->donation_id }}">{{ $donation->donation_id }}</option>
            @endforeach
          </select>
        </div>

        <h5>Campus</h5>
        <div class="form-group">
          <select name="campus_id" class="form-control">
            @foreach ($campuses as $campus)
              <option value="{{ $campus->campus_id }}">{{ $campus->campus_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Assign</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection