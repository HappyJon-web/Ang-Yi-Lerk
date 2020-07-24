<!DOCTYPE html>
<html lang="en">
<head>
  <title>JAYL Comics Short Comics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css"/>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

body {
  background-color: #f1f1f1;
  font-family: Arial;
}

/* Center website */
.main {
  max-width: 1000px;
  margin: auto;
}

h1 {
  font-size: 50px;
}

.row {
  margin: 10px -16px;
}

/* Add padding BETWEEN each column */
.row,
.row > .column {
  padding: 8px;
}

/* Create three equal columns that floats next to each other */
.column {
  float: left;
  width: 60%;
  margin-left: 20%;
  display: none; /* Hide all elements by default */
}

/* Clear floats after rows */ 
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Content */
.content {
  background-color: white;
  padding: 10px;
}

/* The "show" class is added to the filtered elements */
.show {
  display: block;
}

/* Style the buttons */
.filter {
  border: none;
  outline: none;
  padding: 12px 16px;
  background-color: white;
  cursor: pointer;
}

.filter:hover {
  background-color: #ddd;
}

.filter.sort {
  background-color: #666;
  color: white;
}
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light bg-transparent fixed-top">
  <a class="navbar-brand">JAYL Comics</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.html">Home</a>
      </li>

      <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Comics
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="shorts.php">Short Comics</a>
        <a class="dropdown-item" href="zodiac.html">Zodiac Madness</a>
        <a class="dropdown-item" href="feature.html">Featured Stories</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Features
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="tchoukball.html">Tchoukball!</a>
        <a class="dropdown-item" href="hope.html">Hope</a>
      </div>
    </li>

      <li class="nav-item">
        <a class="nav-link" href="about.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">Contact</a>
      </li>
      <li class="nav-item"><a class="nav-link" href="https://www.facebook.com/jonathan.ang.102/">
        <i class="fa fa-facebook mr-1"></i></a>
      </li>
      <li class="nav-item"><a class="nav-link" href="https://www.instagram.com/jonathan_ang_102/">
        <i class="fa fa-instagram"></i></a>
      </li>
    </ul>
  </div>
</nav>

<script type="text/javascript">
$(window).scroll(function(){
  $('nav').toggleClass('scrolled', $(this).scrollTop() > 590);
});
</script>

<div class="jumbotron jumbotron-fluid" style="background-image: url('shortcoms.jpg'); background-size: cover;">
  <div class="container" style="text-align: center; 
  font-family: Candara, serif; color: #3b1424;">
    <h1 class="display-1">Short <br> Comics</h1>
    <h5 class="display-5">Comics that are not more than 10 pages long.</h5>
  </div>
</div>

<!-- MAIN (Center website) -->
<div class="main">

<h1><center>SHORT VARIETY COMICS</center></h1>
<hr>

<p><center>
All these comics are short and simple comics that either desribes the real life in comedy genre, or give inspirational messages to encourage those who need help. You can narrow your search for any comics simply
by choosing any comic category listed below.
</center></p><br>

<center><div id="myBtnContainer">
  <button class="filter sort" onclick="filterSelection('all')"> Show all</button>
  <button class="filter" onclick="filterSelection('inspirational')"> Inspirational Messages</button>
  <button class="filter" onclick="filterSelection('memes')"> Memes</button>
  <button class="filter" onclick="filterSelection('bible')"> Biblical Messages</button>
  <button class="filter" onclick="filterSelection('reallife')"> Real-Life Events</button>
</div></center>

<!-- Portfolio Gallery Grid -->
<div class="row">

  <?php
 $connect = mysqli_connect("localhost", "root", "", "comics");
  $query = "SELECT * FROM comic ORDER BY id ASC";
  $result = mysqli_query($connect, $query);
  while($row = mysqli_fetch_array($result))
  {
   print'

    <div class="column '.$row['imgCat'].'">
    <div class="content">
      <img src="data:image/jpg;base64,'.base64_encode($row['photo'] ).'" 
      style="width:100%;">
      <h4>'.$row['imgName'].'</h4>
      <p>'.$row['imgDesc'].'</p>
      <p>Posted on '.$row['posted'].'</p>
      <p>Category: '.$row['imgCat'].'</p>
    </div>
  </div>
   ';
  }
    ?>
    
<!-- END GRID -->
</div>

<!-- END MAIN -->
</div>

<br><br>
<!-- Footer -->
<footer class="page-footer font-small" style="background-color: #2b2a2a; color: #fff;">

  <!-- Footer Links -->
  <div class="container text-center text-md-left mt-5">

    <!-- Grid row -->
    <div class="row mt-3">

      <!-- Grid column -->
      <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mb-4">

        <!-- Content -->
        <h6 class="text-uppercase font-weight-bold">About JAYL Comics</h6><br>
        <p>JAYL Comics is dedicated to sharing happiness through simple
        hand-drawn comics that imitate real events and how to make people 
        laugh and be motivated through meaningful comics.</p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Comic Products</h6><br>
        <p>
          <a href="shorts.php">Short Comics</a>
        </p>
        <p>
          <a href="zodiac.html">Zodiac Madness</a>
        </p>

      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Story Comics</h6><br>
        <p>
          <a href="tchoukball.html">Tchoukball!</a>
        </p>
        <p>
          <a href="hope.html">Hope</a>
        </p>
      </div>
      <!-- Grid column -->

      <!-- Grid column -->
      <div class="col-md-4 col-lg-3 col-xl-4 mx-auto mb-4">

        <!-- Links -->
        <h6 class="text-uppercase font-weight-bold">Contact</h6><br>
        <p>
          <i class="fas fa-home mr-3"></i> Penang, Malaysia</p>
        <p>
          <i class="fas fa-envelope mr-3"></i> jonathanang4978@gmail.com</p>
        <p>
          <i class="fas fa-phone mr-3"></i> 019-463-8900</p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Links -->


      <!-- Grid column -->
      <div class="col-md-12 py-5" style="text-align: center">
        <p>You can also follow my comics through these mediums:</p>
        <div class="mb-5 flex-center">

          <!-- Facebook -->
          <a class="fb-ic" href="https://www.facebook.com/jonathan.ang.102">
            <i class="fab fa-facebook-f fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
          <!--Instagram-->
          <a class="ins-ic" href="https://www.instagram.com/jonathan_ang_102/">
            <i class="fab fa-instagram fa-lg white-text mr-md-5 mr-3 fa-2x"> </i>
          </a>
        </div>
      </div>
      <!-- Grid column -->


  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">
    <p> Copyright &copy; 2020 by Jonathan Ang. </p>
  </div>
  <!-- Copyright -->

</footer>
<!-- Footer -->

<script>
filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("column");
  if (c == "all") c = "";
  for (i = 0; i < x.length; i++) {
    HideClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) FilterClass(x[i], "show");
  }
}

function FilterClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
  }
}

function HideClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);     
    }
  }
  element.className = arr1.join(" ");
}


// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnContainer");
var btns = btnContainer.getElementsByClassName("filter");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function(){
    var current = document.getElementsByClassName("sort");
    current[0].className = current[0].className.replace(" sort", "");
    this.className += " sort";
  });
}
</script>

</body>
</html>
