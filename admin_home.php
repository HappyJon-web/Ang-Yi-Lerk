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
  <title>JAYL Comics Admin Homepage</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
.form-div { margin-top: 100px; border: 1px solid #e0e0e0; }
#profileDisplay { display: block; height: 210px; width: 50%; margin: 0px auto; }
.img-placeholder {
  width: 50%;
  color: white;
  height: 210px;
  background: black;
  opacity: .7;
  height: 210px;
  z-index: 100;
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: none;
}
.img-placeholder h4 {
  color: #aaa;
  font-size: 20px;
  font-weight: bold;
}
.img-div:hover .img-placeholder {
  display: block;
  cursor: pointer;
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
      <li class="active"><a>Home</a></li>
      <li><a href="admin_contact.php">View Messages</a></li>
    </ul>

<ul class="nav navbar-nav navbar-right">
<li style="background-color: red;"><a href="admin_logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>   
      </ul>
      </div>
    </div>

  </div>
</nav>

 
  <div class="container" style="width:80%;">  
   <h3 align="center">Short Comics Add Edit Delete Admin Panel</h3>  
   <br />
   <div align="right">
    <button type="button" name="add" id="add" class="btn btn-success">Add</button>
   </div>
   <br />
   <div id="image_data">
    </div>
  </div> 


<div id="insertModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Add Image</h4>
   </div>
   <div class="modal-body">
    <form id="image_form" method="post" enctype="multipart/form-data">


      <div class="form-group text-center" style="position: relative;" >
            <span class="img-div">
              <div class="text-center img-placeholder"  onClick="triggerClick()">
                <h4>Click Here to Insert Image</h4>
              </div>
              <img src="pad.png" onClick="triggerClick()" id="profileDisplay">
            </span>
            <input type="file" name="image" onChange="displayImage(this)" id="image" class="form-control" 
            style="display: none;">
            <label>Place Comic Image Here</label>
          </div>

     <div class="form-group">
            <label>Image Name</label>
            <input name="name" type="text" class="form-control" required>
      </div>
     <div class="form-group">
            <label>Image Description</label>
            <textarea name="desc" class="form-control" required></textarea>
      </div>

<div class="form-group">
  <label for="cat">Comic Category</label>
  <select class="form-control" id="cat" name="cat">
    <option value="inspirational">Inspirational</option>
    <option value="memes">Memes</option>
    <option value="bible">Bible Messages</option>
    <option value="reallife">Real-Life Events</option>
  </select>
</div>

     <input type="hidden" name="action" id="action" value="insert" />
     <input type="hidden" name="image_id" id="image_id" />
     <input type="submit" name="insert" id="insert" value="Insert" class="btn btn-info" />
      
    </form>
   </div>
  </div>
 </div>
</div>

<script>
  function triggerClick(e) {
  document.querySelector('#image').click();
}
function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e){
      document.querySelector('#profileDisplay').setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.files[0]);
  }
}

</script>

<script>  
$(document).ready(function(){
 
 fetch_data();

 function fetch_data()
 {
  var action = "fetch";
  $.ajax({
   url:"admin_comicInsert.php",
   method:"POST",
   data:{action:action},
   success:function(data)
   {
    $('#image_data').html(data);
   }
  })
 }
 $('#add').click(function(){
  $('#insertModal').modal('show');
  $('#image_form')[0].reset();
  $('.modal-title').text("Add Image");
  $('#image_id').val('');
  $('#action').val('insert');
  $('#insert').val("Insert");
 });
 $('#image_form').submit(function(event){
  event.preventDefault();
  var image_name = $('#image').val();
  if(image_name == '')
  {
   alert("Please Select Image");
   return false;
  }
  else
  {
   var extension = $('#image').val().split('.').pop().toLowerCase();
   if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)
   {
    alert("Invalid Image File");
    $('#image').val('');
    return false;
   }
   else
   {
    $.ajax({
     url:"admin_comicInsert.php",
     method:"POST",
     data:new FormData(this),
     contentType:false,
     processData:false,
     success:function(data)
     {
      alert(data);
      fetch_data();
      $('#image_form')[0].reset();
      $('#insertModal').modal('hide');
     }
    });
   }
  }
 });
 $(document).on('click', '.update', function(){
  $('#image_id').val($(this).attr("id"));
  $('#action').val("update");
  $('.modal-title').text("Update Image");
  $('#insert').val("Update");
  $('#insertModal').modal("show");
 });
 $(document).on('click', '.delete', function(){
  var image_id = $(this).attr("id");
  var action = "delete";
  if(confirm("Are you sure you want to remove this image from database?"))
  {
   $.ajax({
    url:"admin_comicInsert.php",
    method:"POST",
    data:{image_id:image_id, action:action},
    success:function(data)
    {
     alert(data);
     fetch_data();
    }
   })
  }
  else
  {
   return false;
  }
 });
});  
</script>

<br><br><br>

<div class="jumbotron text-center" style="margin-bottom:0">
  <p>Copyright &copy; 2020 by Jonathan Ang.</p>
</div>

</body>
</html>
