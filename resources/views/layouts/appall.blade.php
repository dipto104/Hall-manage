<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Modern Business - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


      <!--formodal-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
      <!-- Custom styles for this template -->

      <link href="css/modern-business.css" rel="stylesheet">

      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">



      <!-- Website Font style -->
       </head>

  <body>

    <!-- Navigation -->
    <div id="app">

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="/">Home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">

              @if (Auth::guard('web')->check())
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Option
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('student.logout') }}">Log Out</a>
                      </div>
                  </li>
              @elseif (Auth::guard('asstprovost')->check())
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Request
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                          <a class="dropdown-item" href="{{ route('asstprovost.roomreqinsertshow') }}">Room Insert</a>
                          <a class="dropdown-item" href="{{ route('asstprovost.roomreqdeleteshow') }}">Room Delete</a>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Room
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('admin.showinsertroom') }}">Insert Room</a>
                          <a class="dropdown-item" href="{{ route('admin.roomdata') }}">Room Data</a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.hallmess') }}">Dining Payment</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.studentdata') }}">Student Data</a>
                  </li>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('asstprovost.dashboard') }}">Asst. Provost</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Option
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('asstprovost.logout') }}">Log Out</a>
                      </div>
                  </li>
                  @elseif (Auth::guard('provost')->check())
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Request
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                          <a class="dropdown-item" href="{{ route('provost.studentreqinsertshow') }}">Student Insert</a>
                          <a class="dropdown-item" href="{{ route('provost.studentreqdeleteshow') }}">Student Delete</a>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Room
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('admin.showinsertroom') }}">Insert Room</a>
                          <a class="dropdown-item" href="{{ route('admin.roomdata') }}">Room Data</a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.hallmess') }}">Dining Payment</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.studentdata') }}">Student Data</a>
                  </li>

                      <li class="nav-item">
                          <a class="nav-link" href="{{ route('provost.dashboard') }}">Provost</a>
                      </li>
                      <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Option
                          </a>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                              <a class="dropdown-item" href="{{ route('provost.logout') }}">Log Out</a>
                          </div>
                      </li>
              @elseif(Auth::guard('admin')->check())
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Room
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('admin.showinsertroom') }}">Insert Room</a>
                          <a class="dropdown-item" href="{{ route('admin.roomdata') }}">Room Data</a>
                      </div>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.hallmess') }}">Dining Payment</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.studentdata') }}">Student Data</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('student.login') }}">Student Login</a>
                  </li>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Option
                      </a>
                      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                          <a class="dropdown-item" href="{{ route('admin.logout') }}">Log Out</a>
                      </div>
                  </li>

              @else
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('student.login') }}">Student Login</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('admin.login') }}">Admin Login</a>
                  </li>
              @endif

          </ul>
        </div>
      </div>
    </nav>
        <hr>
        <hr>
        <hr>
        <hr>

        @include('includes.flashmesseges')
        @yield('content')
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
        <hr>
    </div>

        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->

        <!-- App scripts -->

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script>
        @stack('scripts')




    <!-- Page Content -->

    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Dipto Roy 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    <!--formodal-->


  </body>

</html>
