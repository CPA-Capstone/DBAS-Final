@extends ('layouts.layout')

@section ('content')
<?php $q = 0; ?>

  <div class="col-sm-8 blog-main">

    @include ('layouts.errors')

    <div class="col-md-12">

      <form method="POST">
        {{ csrf_field() }}
        <table class="table">
          <tr>
            <td>Year:</td>
            <td>Month:</td>
          </tr>
          <tr>
            <td>
              <div class="form-group">
                <input type="text" class="form-control" id="year" name="year" value="{{ date('Y') }}" />
              </div>
            </td>
            <td>
              <div class="form-group">
                <input type="text" class="form-control" id="month" name="month" value="{{ $month }}" />
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Contributions By Campus Report: <br><br>
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/campus" class="btn btn-dark">View</button>
              </div>
            </td>
            <td>
              Contributions By Donor Types Report:
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/type" class="btn btn-dark">View</button>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Contributions To Programs By Donor Types Report:
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/program" class="btn btn-dark">View</button>
              </div>
            </td>
            <td>
              Contributions List Report:<br><br>
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/list" class="btn btn-dark">View</button>
              </div>
            </td>
          </tr>
          <tr>
            <td>
              Donor Contributions Report:
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/donor" class="btn btn-dark">View</button>
              </div>
            </td>
            <td>
              Committee Performance Report:
              <div align="right" class="form-group">
                <button type="submit" formaction="/reports/performance" class="btn btn-dark">View</button>
              </div>
            </td>
          </tr>
        </table>
      </form>

    </div>

  </div><!-- /.blog-main -->

  <div class="col-sm-3 offset-sm-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
      <h4>Committee Members</h4>
      <ol class="list-unstyled">
        @foreach ($committeeMembers as $member)
          <li>
            <a href="/committeemembers/{{ $member['committee_member_id'] }}/edit">
              {{ $member['committee_member_first_name'] }} {{ $member['committee_member_last_name'] }}
            </a>
          </li>
        @endforeach
          <li>
            <a href="/committeemembers/create">
              Add...
            </a>
          </li>
      </ol>
    </div>

    <div class="sidebar-module">
      <h4>Programs</h4>
      <ol class="list-unstyled">
        @foreach ($programs as $program)
          <li>
            <a href="/programs/{{ $program['program_id'] }}/edit">
              {{ $program['program_name'] }}
            </a>
          </li>
        @endforeach
          <li>
            <a href="/programs/create">
              Add...
            </a>
          </li>
      </ol>
    </div>
  </div>

@endsection