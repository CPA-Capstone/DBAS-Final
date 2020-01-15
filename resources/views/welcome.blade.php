@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Log In</h1>

      <form method="POST" action="/">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="user_id">User ID:</label>
          <input type="text" class="form-control" id="user_id" name="user_id" />
        </div>
              
        <div class="form-group">
          <label for="user_password">Password:</label>
          <input type="password" class="form-control" id="user_password" name="user_password" />
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Log In</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>

  </div><!-- /.blog-main -->

@endsection