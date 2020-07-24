<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["admin_loggedin"]) && $_SESSION["admin_loggedin"] === true){
  header("location: admin_home.php");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $pass = "";
$username_err = $pass_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["pass"]))){
        $pass_err = "Please enter your password.";
    } else{
        $pass = trim($_POST["pass"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($pass_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";
        $link = mysqli_stmt_init($connection);
        
        if(mysqli_stmt_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($link, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($link)){
                // Store result
                mysqli_stmt_store_result($link);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($link) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($link, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($link)){
                        if(password_verify($pass, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            

                            // Store data in session variables
                            $_SESSION["admin_loggedin"] = true;
                            $_SESSION["admin_id"] = $id;
                            $_SESSION["admin_username"] = $username;                          
                            
                            // Redirect user to welcome page
                            header("location: admin_home.php");
                        } else{
                            // Display an error message if password is not valid
                            $pass_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
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
    <title>JAYL Comics Admin User Login</title>
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
        <h2 style="color:#fff;">Admin User Login</h2>
        <p style="color:#fff;">Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">


            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" value="<?php echo $pass; ?>">
                <span class="help-block"><?php echo $pass_err; ?></span>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="admin_register.php">Sign up now</a>.</p>
        </form>
    </div></center>   
</body>
</html>