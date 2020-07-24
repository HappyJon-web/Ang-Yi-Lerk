<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $email = $pass = $com = "";
$username_err = $email_err = $pass_err = $com_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate name
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(strlen(trim($_POST["username"])) < 6){
        $username_err = "Username must have at least 6 letters.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE username = ?";
        $link = mysqli_stmt_init($connection);
        
        if(mysqli_stmt_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($link, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($link)){
                /* store result */
                mysqli_stmt_store_result($link);
                
                if(mysqli_stmt_num_rows($link) == 1){
                    $username_err = "This username already exists.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($link);
    }


    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email address.";
    } elseif(strlen(trim($_POST["email"])) < 12 ){
        $email_err = "Email address must have at least 12 characters.";
    } elseif(!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL) ){
        $email_err = "Please follow the correct email format (abc123@gmail.com) .";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM admin WHERE email = ?";
        $link = mysqli_stmt_init($connection);
        
        if($stmt = mysqli_stmt_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($link, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($link)){
                /* store result */
                mysqli_stmt_store_result($link);
                
                if(mysqli_stmt_num_rows($link) == 1){
                    $email_err = "This email address already exists.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($link);
    }


    // Validate password
    if(empty(trim($_POST["pass"]))){
        $pass_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["pass"])) < 6){
        $pass_err = "Password must have atleast 6 characters.";
    } else{
        $pass = trim($_POST["pass"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["com"]))){
        $com_err = "Please confirm password.";     
    } else{
        $com = trim($_POST["com"]);
        if(empty($pass_err) && ($pass != $com)){
            $com_err = "Password did not match.";
        }
    }

    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($email_err) && empty($pass_err) && empty($com_err) ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO admin (username, email, password) 
        VALUES (?, ?, ?)";
        $link = mysqli_stmt_init($connection);
         
        if($stmt = mysqli_stmt_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($link, 'sss', $param_username, $param_email, $param_pass);
            
            // Set parameters
            $param_username = $username;
            $param_email = $email;
            $param_pass = password_hash($pass, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($link)){

                // Redirect to homepage
                header("location: admin_login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($link);
    }
    
    // Close connection
    mysqli_close($connection);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JAYL Comics Admin Sign Up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">
        body{ font: 14px sans-serif; background-image: url('admin.jpg'); }
        .wrapper{ width: 60%; padding: 10px; }

form {border: 3px solid #000;
border-radius: 10px;
padding: 20px;
background-color: #fff;
box-shadow: 2px 2px 2px #fff;}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

</style>


</head>
<body>
    <center><div class="wrapper">
        <h2 style="color:#fff;">Admin User Sign Up</h2>
        <p style="color:#fff;">Please fill this form to create an account.</p>
        <form action="admin_register.php" method="post">


            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" value="<?php echo $pass; ?>">
                <span class="help-block"><?php echo $pass_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($com_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="com" class="form-control" value="<?php echo $com; ?>">
                <span class="help-block"><?php echo $com_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="admin_login.php">Login here</a>.</p>
        </form>
    </div></center>   
</body>
</html>