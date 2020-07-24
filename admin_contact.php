<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["admin_loggedin"]) || $_SESSION["admin_loggedin"] !== true){
    header("location: admin_login.php");
    exit;}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>JAYL Comics Admin Enquiry View Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>

  .fakeimg {
    height: 200px;
    background: #aaa;
  }

.container {
  border: 2px solid #ccc;
  background-color: #eee;
  border-radius: 5px;
  padding: 16px;
  margin: 16px 0
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  margin-right: 20px;
  border-radius: 50%;
}

.container span {
  font-size: 20px;
  margin-right: 15px;
}

@media (max-width: 500px) {
  .container {
      text-align: center;
  }
  .container img {
      margin: auto;
      float: none;
      display: block;
  }
}

  </style>

</head>
<body>

<div class="jumbotron text-center" style="margin-bottom:0; background-image: url('abstract.jpg');
  background-size: cover;">
  <h1>Welcome to JAYL COMICS Admin Page!</h1>
  <p>Customize your comics for people to see in your website!</p> 
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand"><span class="glyphicon glyphicon-user"></span>
      <?php echo htmlspecialchars($_SESSION["admin_username"]); ?> </a>
    </div>
    

<div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
      <li><a href="admin_home.php">Home</a></li>
      <li class="active"><a>View Messages</a></li>
    </ul>

<ul class="nav navbar-nav navbar-right">
<li style="background-color: red;"><a href="admin_logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>   
      </ul>
      </div>
    </div>

  </div>
</nav>


<h2>Responsive Testimonials</h2>
<p>Resize the browser window to see the effect.</p>

<?php
          include("config.php");
          $dbc = mysqli_connect('localhost','root','');
          mysqli_select_db($dbc, 'comics');
          $query = 'SELECT * FROM contact ORDER BY id';
          if ($r = mysqli_query($dbc, $query)){
          while($test = mysqli_fetch_array($r, MYSQLI_ASSOC)) { 
              print '
<div class="container">
  <img src="avatar.png" alt="Avatar" style="width:120px">
  <p><span>'.$test['name'].'</span> '.$test['email'].' &nbsp; '.$test['phone'].'</p>
  <p>Posted on '.$test['posted_on'].'.</p>
  <p>'.$test['message'].'</p>
</div>
              ';
            }
          }
        ?>


<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Copyright &copy; 2020 by Jonathan Ang.</p>
</div>

</body>
</html>
