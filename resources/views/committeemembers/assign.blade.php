@extends ('layouts.layout')

@section ('content')

  <div class="col-sm-12 blog-main">
      
      <h1>Assigned Donors</h1>

      <table class="table">
        @foreach ($donors as $donor)
          @if ($member->donors->contains($donor->donor_id) && count(\DB::table('donor_committee_member')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)->get()) > 0)
            <tr>
              <td>{{ $donor->donor_name }}</td>
              <td>{{ $donor->donor_email }}</td>
              <td>({{ substr($donor->donor_phone, 0, 3) }}){{ substr($donor->donor_phone, 3, 3) }}-{{ substr($donor->donor_phone, 6, 4) }}</td>
              <td>{{ $donor->donor_address }}</td>
              <td>
                <form method="POST" action="/committeemembers/{{ $member->committee_member_id }}/unassign">
                  {{ csrf_field() }}
                  <input type="hidden" id="donor_id" name="donor_id" value="{{ $donor->donor_id }}" />
                  <div class="form-group">
                    <button type="submit" class="btn btn-dark">Unassign</button>
                  </div>
                </form>
              </td>
            </tr>
          @endif
        @endforeach
        <tr>
          <form method="POST" action="/committeemembers/{{ $member->committee_member_id }}/assign">
            {{ csrf_field() }}
            <td>Assign Donor:</td>
            <td colspan="3">
              <select name="donor_id">
                @foreach ($donors as $donor)
                  @if (array_search($donor->donor_type_id, $types) !== false && count(\DB::table('donor_committee_member')->select('*')->where('committee_member_id', $member->committee_member_id)->where('donor_id', $donor->donor_id)->where('end_date', null)->get()) == 0)
                    <option value="{{ $donor->donor_id }}">{{ $donor->donor_name }}</option>
                  @endif
                @endforeach
              </select>
            </td>
            <td>
              <div class="form-group">
                <button type="submit" class="btn btn-dark">Assign</button>
              </div>
            </td>
          </form>
        </tr>
      </table>
  </div><!-- /.blog-main -->

@endsection