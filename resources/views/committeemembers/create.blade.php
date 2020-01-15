@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Add Committee Member</h1>

      <form method="POST" action="/committeemembers">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="committee_member_first_name">First Name:</label>
          <input type="text" class="form-control" id="committee_member_first_name" name="committee_member_first_name" />
        </div>

        <div class="form-group">
          <label for="committee_member_last_name">Last Name:</label>
          <input type="text" class="form-control" id="committee_member_last_name" name="committee_member_last_name" />
        </div>

        <div class="form-group">
          <label for="user_id">User ID:</label>
          <input type="text" class="form-control" id="user_id" name="user_id" />
        </div>

        <div class="form-group">
          <label for="user_password">Password:</label>
          <input type="password" class="form-control" id="user_password" name="user_password" />
        </div>

        <div class="form-group">
          <h5>Assigned Programs:</h5> <br>
          @foreach ($programs as $program)
            <label for="{{ $program->program_id }}">{{ $program->program_name }}:</label>
            <input type="checkbox" id="{{ $program->program_id }}" name="{{ $program->program_id }}" value="{{ $program->program_name }}" /> <br>
          @endforeach
        </div>

        <div class="form-group">
          <h5>Assigned Donor Types:</h5> <br>
          @foreach ($types as $type)
            <label for="{{ $type->donor_type_id }}">{{ $type->donor_type_name }}:</label>
            <input type="checkbox" id="{{ $type->donor_type_id }}" name="{{ $type->donor_type_id }}" value="{{ $type->donor_type_name }}" /> <br>
          @endforeach
        </div>     

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Add Committee Member</button>
        </div>

        @include ('layouts.errors')
      </form>

    </div>
  </div><!-- /.blog-main -->

@endsection