@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-8 blog-main">

    <div class="col-md-8">
      
      <h1>Add Committee Member Target</h1>

      <form method="POST" action="/committeemembertargets">
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
          <select name="committee_member_id" class="form-control">
            @foreach ($members as $member)
              <option value="{{ $member->committee_member_id }}">{{ $member->committee_member_first_name }} {{ $member->committee_member_last_name }}</option>
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