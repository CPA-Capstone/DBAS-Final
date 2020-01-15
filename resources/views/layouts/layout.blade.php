<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>McLaughlin University</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/MU.css" rel="stylesheet">
  </head>

  <body>

    <div class="blog-masthead">
      <nav class="nav blog-nav">
        <h4 class="nav-header">McLaughlin University</h4>
        @if (null !== \Session::get('user') && \Session::get('user')->user_type == 'm')
            <a class="nav-link ml-auto" href="/memberhome">Home</a>
            <a class="nav-link ml-auto" href="/donor/adddonor">Add Donor</a>
            <a class="nav-link ml-auto" href="/member/makedonation">Record Donation</a>
            <a class="nav-link ml-auto" href="/donations/show">Assign Donations</a>
            <a class="nav-link ml-auto" href="/member/pastdonations">Past Donations</a>
        @endif
        @if (null !== \Session::get('user') && \Session::get('user')->user_type == 'h')
          <a class="nav-link" href="/headhome">Home</a>
          <a class="nav-link" href="/campustargets">Campus Targets</a>
          <a class="nav-link" href="/committeemembertargets">Committee Member Targets</a>
          <a class="nav-link" href="/donortypetargets">Donor Type Targets</a>
          <a class="nav-link" href="/donorprojections">Donor Projections</a>
        @endif
        @if (null !== \Session::get('user'))
          <a class="nav-link" href="/changepassword">Change Password</a>
          <a class="nav-link ml-auto" href="/logout">Logout</a>
        @endif
      </nav>
    </div>

    <div class="container">

      <div class="row">

      	@yield ('content')
        
      </div><!-- /.row -->

    </div><!-- /.container -->

    <footer class="blog-footer">
      <p>&copy;McLaughlin University</p>
    </footer>
  </body>
</html>
