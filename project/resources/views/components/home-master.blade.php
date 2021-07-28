<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Globe Ltd.</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/app.css')}}">
  <!-- Custom styles for this template -->
  <link href="{{asset('css/blog-home.css')}}" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href=""><b>VISITOR MANAGEMENT</b></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <!-- <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li> -->

          @if(Auth::check())
          <li class="nav-item">
            <a class="navbar-brand" href="{{route('admin.index')}}"><b>DASHBOARD</b></a>
          </li>

          @else
          <li class="nav-item">
            <a class="nav-link" href="/login"><b>LOGIN</b></a>
          </li>


          @endif

          <!-- <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li> -->
        </ul>
      </div>
    </div>
  </nav>
 <div style="background-attachment: fixed;"> <img src="{{asset('img/background.jpg')}}" alt="" width="100%" height="40%"></div>
  <!-- Page Content -->
  <!-- <div class="container"> -->
<!-- 
    <div class="row"> -->

      <!-- Blog Entries Column -->
      <!-- <div class="col-md-8"> -->

        
      <!-- </div> -->

      <!-- Sidebar Widgets Column -->
      <!-- <div class="col-md-4">

        Search Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <form method="post" action="">
          <div class="card-body"> -->
          <!-- @csrf -->
            <!-- <div class="input-group">
              <input type="text" name="search_post" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
          </form>
          </div>
        </div> -->

        <!-- Categories Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Categories</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0"> -->


                <!-- Categories List -->
               

        <!-- Side Widget -->
        <!-- <div class="card my-4">
          <h5 class="card-header">Side Widget</h5>
          <div class="card-body">
            You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
          </div>
        </div>

      </div>

    </div> -->
    <!-- /.row -->

  <!-- </div> -->
  <!-- /.container -->

  <!-- Footer -->
  <!-- <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
  
  </footer> -->

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
