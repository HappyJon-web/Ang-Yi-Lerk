<!DOCTYPE html>
<html lang="en">
<head>
  <title>JAYL Comics Contact</title>
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
    background-color: #474444;
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
        <a class="nav-link disabled" href="#">Contact</a>
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
  $('nav').toggleClass('scrolled', $(this).scrollTop() > 100);
});
</script>

<br><br><br>

<div style="text-align: center; color: #fff;">
<h2><b>Online Inquiry Form</b></h2>
  <p>Leave a message with this form and I'll reply you in your email.</p>
</div>

<?php
// Include config file
 $connect = mysqli_connect("localhost", "root", "", "comics");
 
// Define variables and initialize with empty values
$name = $phone = $email = $msg = "";
$name_err = $phone_err = $email_err = $msg_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["name"]))){
        $name_err = "No name? OK, I'll assume your name is Mr.UnderPants.";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$name) ){
        $name_err = "Only letters and white spaces allowed.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Validate phone
    if(empty(trim($_POST["phone"]))){
        $phone_err = "I'm not a stalker, so don't worry. Fake phone number also can.";
    } elseif(strlen(trim($_POST["phone"])) < 10 ){
        $phone_err = "Phone number must have at least 10 digits.";
    } elseif(!is_numeric(trim($_POST["phone"])) ){
        $phone_err = "Phone must be in number format.";
    } else{
        $phone = trim($_POST["phone"]);
    }

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "I have to know your email so I can reply to your message.";
    } elseif(strlen(trim($_POST["email"])) < 12 ){
        $email_err = "Email address must have at least 12 characters.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL) ){
        $email_err = "Please follow the correct email format (abc123@gmail.com) .";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate message
    if(empty(trim($_POST["msg"]))){
        $msg_err = "Uh, really? Sending me an empty message? At least enter something.";
    } else{
        $msg = nl2br(trim($_POST["msg"]));
    }

    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($phone_err) && empty($email_err) && empty($msg_err) ){

  date_default_timezone_set("Asia/Kuala_Lumpur");
  $post = date('Y-m-d H:i:s');
  $query = "INSERT INTO contact(name, phone, email, message, posted_on) 
  VALUES ('$name', '$phone', '$email', '$msg', '$post')";
  if(mysqli_query($connect, $query))
  { ?>

      <div class="alert alert-success alert-dismissible">
    <a class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Thank you for your submission.</strong> We have received your information, and will get back to you as soon as possible.
  </div>
<?php
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
}
?>



<div class="row">
<div class="container" style="color: #fff;">    

  <p>Inputs with a red asterisk (<span style="color: red;">*</span>) is a required input.</p>

  <form action="contact.php" method="post" class="needs-validation" style="width: 60%;" novalidate>


    <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name<span style="color: red;">*</span>  :</label>
                <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                <span class="help-block" style="color: red;"><?php echo $name_err; ?></span>
            </div>

    <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                <label>Contact Number<span style="color: red;">*</span>  :</label>
                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                <span class="help-block" style="color: red;"><?php echo $phone_err; ?></span>
            </div>

    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email Address<span style="color: red;">*</span>  :</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block" style="color: red;"><?php echo $email_err; ?></span>
            </div>

    <div class="form-group <?php echo (!empty($msg_err)) ? 'has-error' : ''; ?>">
                <label><b>Your Message<span style="color: red;">*</span>  :</b></label>
                <textarea class="form-control" rows="5" name="msg" value="<?php echo $msg; ?>"></textarea>
                <span class="help-block" style="color: red;"><?php echo $msg_err; ?></span>
            </div>

    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-danger">Reset</button>
  </form>

    </div>
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

</body>
</html>
