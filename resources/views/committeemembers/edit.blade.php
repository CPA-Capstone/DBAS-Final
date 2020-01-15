@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Edit Committee Member</h1>

      <form method="POST" action="/committeemembers/{{ $member->committee_member_id }}/edit">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
          <label for="committee_member_first_name">First Name:</label>
          <input type="text" class="form-control" id="committee_member_first_name" name="committee_member_first_name" value="{{ $member->committee_member_first_name }}" />
        </div>

        <div class="form-group">
          <label for="committee_member_last_name">Last Name:</label>
          <input type="text" class="form-control" id="committee_member_last_name" name="committee_member_last_name" value="{{ $member->committee_member_last_name }}" />
        </div>

        <div class="form-group">
          <label for="user_id">User ID:</label>
          <input type="text" class="form-control" id="user_id" name="user_id" value="{{ $member->user_id }}" />
        </div>

        <div class="form-group">
          <label for="user_password">Password:</label>
          <input type="password" class="form-control" id="user_password" name="user_password" />
        </div>

        <div class="form-group">
          <h5>Assigned Programs:</h5> <br>
          @foreach ($programs as $program)
            <label for="{{ $program->program_id }}">{{ $program->program_name }}:</label>
            <input type="checkbox" id="{{ $program->program_id }}" name="{{ $program->program_id }}" value="{{ $program->program_name }}" @if ($member->programs->contains($program->program_id) && count(\DB::table('committee_member_program')->select('*')->where('committee_member_id', $member->committee_member_id)->where('program_id', $program->program_id)->where('end_date', null)->get()) > 0) checked @endif /> <br>
          @endforeach
        </div>

        <div class="form-group">
          <h5>Assigned Donor Types:</h5> <br>
          @foreach ($types as $type)
            <label for="{{ $type->donor_type_id }}">{{ $type->donor_type_name }}:</label>
            <input type="checkbox" id="{{ $type->donor_type_id }}" name="{{ $type->donor_type_id }}" value="{{ $type->donor_type_name }}" @if ($member->donorTypes->contains($type->donor_type_id) && count(\DB::table('committee_member_donor_type')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_type_id', $type->donor_type_id)->where('end_date', null)->get()) > 0) checked @endif /> <br>
          @endforeach
        </div>

        <div class="form-group">
          <label for="committee_member_status">Deactivate Account:</label>
          <input type="checkbox" id="committee_member_status" name="committee_member_status" value="checked" @if ($member->committee_member_status == 'u') checked @endif />
        </div>        

        <div class="form-group">
          <button type="submit" class="btn btn-dark">Edit Committee Member</button>
        </div>

        @include ('layouts.errors')
      </form>

      <button class="btn btn-dark" onclick="window.location.href = '/committeemembers/{{ $member->committee_member_id }}/donors';">Assign Donors</button>

    </div>
  </div><!-- /.blog-main -->

@endsection