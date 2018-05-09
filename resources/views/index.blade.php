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

    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
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
                <a class="nav-link" href="{{ route('publicnotice') }}">Notice</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('student.dashboard',Auth::user()->id) }}">View Profile</a>
                  <a class="dropdown-item" href="{{ route('student.duestatus',Auth::user()->id) }}">Due Status</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Option
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('student.changepassshow') }}">Change Password</a>
                  <a class="dropdown-item" href="{{ route('all.logout') }}">Log Out</a>
                </div>
              </li>
            @elseif (Auth::guard('asstprovost')->check())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Notice
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('admin.insertnotice') }}">Compose Notice</a>
                  <a class="dropdown-item" href="{{ route('admin.shownotice') }}">All Notice</a>
                  <a class="dropdown-item" href="{{ route('publicnotice') }}">Notice view</a>
                </div>
              </li>
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
                  <a class="dropdown-item" href="{{ route('admin.freeroom') }}">Free Room</a>
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
                  <a class="dropdown-item" href="{{ route('asstprovost.changepassshow') }}">Change Password</a>
                  <a class="dropdown-item" href="{{ route('all.logout') }}">Log Out</a>
                </div>
              </li>
            @elseif (Auth::guard('provost')->check())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Notice
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('admin.insertnotice') }}">Compose Notice</a>
                  <a class="dropdown-item" href="{{ route('admin.shownotice') }}">All Notice</a>
                  <a class="dropdown-item" href="{{ route('publicnotice') }}">Notice view</a>
                </div>
              </li>
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
                  <a class="dropdown-item" href="{{ route('admin.freeroom') }}">Free Room</a>
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
                  <a class="dropdown-item" href="{{ route('provost.changepassshow') }}">Change Password</a>
                  <a class="dropdown-item" href="{{ route('all.logout') }}">Log Out</a>
                </div>
              </li>
            @elseif(Auth::guard('admin')->check())
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Notice
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('admin.insertnotice') }}">Compose Notice</a>
                  <a class="dropdown-item" href="{{ route('admin.shownotice') }}">All Notice</a>
                  <a class="dropdown-item" href="{{ route('publicnotice') }}">Notice view</a>
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Room
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">

                  <a class="dropdown-item" href="{{ route('admin.showinsertroom') }}">Insert Room</a>
                  <a class="dropdown-item" href="{{ route('admin.roomdata') }}">Room Data</a>
                  <a class="dropdown-item" href="{{ route('admin.freeroom') }}">Free Room</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.hallmess') }}">Dining Payment</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.studentdata') }}">Student Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Option
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                  <a class="dropdown-item" href="{{ route('admin.changepassshow') }}">Change Password</a>
                  <a class="dropdown-item" href="{{ route('all.logout') }}">Log Out</a>
                </div>
              </li>

            @else
              <li class="nav-item">
                <a class="nav-link" href="{{ route('publicnotice') }}">Notice</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('all.login') }}">Login</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('/image/registerbuilding.jpg')">
            <div class="carousel-caption d-none d-md-block">

            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('/image/Hall1.jpg')">
            <div class="carousel-caption d-none d-md-block">

            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('/image/CSEbuet.jpg')">
            <div class="carousel-caption d-none d-md-block">
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Welcome to Shere-Bangla-Hall</h1>

      <!-- Marketing Icons Section -->
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header bg-dark text-white">About Hall</h4>
            <div class="card-body">
              <p class="card-text">Shere Bangla Hall is one of the best halls in buet which is best accomadtion for students..</p>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header bg-dark text-white">About BUET</h4>
            <div class="card-body">
              <p class="card-text">BUET is one of the best universities of Bangladesh. It is located in the west palashi, Dhaka. </p>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header bg-dark text-white">Life in BUET</h4>
            <div class="card-body">
              <p class="card-text">Here, Life is amusing. In spite of the academic hardship , Students enjoy themselves a lot . Various cultural program is held annually. </p>
            </div>
            <div class="card-footer">

            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Portfolio Section -->

      <!-- /.row -->

      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6">
          <h2>Hall Management System</h2>
          <p>The Hall Management System includes:</p>
          <ul>
            <li>
              <strong>Powerfull,Correct and Faster Calculation Of Students Due.</strong>
            </li>
            <li>Notice Board is Digital Here</li>
            <li>Student Data and Room Data Will be authenticated by Provost Sir and Asst Provost Sir</li>

            <li>Admin can send request to asst prvost and provost sir</li>
          </ul>

        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="{{url('/image/hall3.jpg')}}" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">

        </div>
        <div class="col-md-4">

        </div>
      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
