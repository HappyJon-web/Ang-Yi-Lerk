<?php
if(isset($_POST["action"]))
{
 $connect = mysqli_connect("localhost", "root", "", "comics");
 if($_POST["action"] == "fetch")
 {
  $query = "SELECT * FROM comic ORDER BY id ASC";
  $result = mysqli_query($connect, $query);
  $output = '
   <table class="table table-bordered table-striped">  
    <tr>
     <th width="5%">ID</th>
     <th width="10%">Image</th>
     <th width="15%">Image Name</th>
     <th width="20%">Image Description</th>
     <th width="10%">Category</th>
     <th width="10%">Posted On</th>
     <th width="10%">Change</th>
     <th width="10%">Remove</th>
    </tr>
  ';
  $num = 1;
  while($row = mysqli_fetch_array($result))
  {
   $output .= '

    <tr>
     <td>'.$num.'</td>
     <td>
      <img src="data:image/jpg;base64,'.base64_encode($row['photo'] ).'" height="75" width="75" class="img-thumbnail" />
     </td>
     <td>
      '.$row['imgName'].'
     </td>
     <td>
      '.$row['imgDesc'].'
     </td>
     <td>
      '.$row['imgCat'].'
     </td>
     <td>
      '.$row['posted'].'
     </td>
     <td><button type="button" name="update" class="btn btn-warning bt-xs update" id="'.$row["id"].'">Change</button></td>
     <td><button type="button" name="delete" class="btn btn-danger bt-xs delete" id="'.$row["id"].'">Remove</button></td>
    </tr>
   ';
   $num = $num + 1;
  }
  $output .= '</table>';
  echo $output;
 }

 if($_POST["action"] == "insert")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $name = trim($_POST["name"]);
  $desc = trim($_POST["desc"]);
  $cat = trim($_POST["cat"]);
  date_default_timezone_set("Asia/Kuala_Lumpur");
  $post = date('Y-m-d H:i:s');
  $query = "INSERT INTO comic(photo, imgName, imgDesc, imgCat, posted) 
  VALUES ('$file', '$name', '$desc', '$cat', '$post')";
  if(mysqli_query($connect, $query))
  {
   echo 'Image Inserted into Database';
  }
 }
 if($_POST["action"] == "update")
 {
  $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
  $newName = trim($_POST["name"]);
  $newDesc = trim($_POST["desc"]);
  $newCat = trim($_POST["cat"]);
  date_default_timezone_set("Asia/Kuala_Lumpur");
  $newPost = date('Y-m-d H:i:s');
  $query = "UPDATE comic SET photo = '$file', imgName = '$newName', imgDesc = '$newDesc',
  imgCat = '$newCat', posted = '$newPost' WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($connect, $query))
  {
   echo 'Image Updated into Database';
  }
 }
 if($_POST["action"] == "delete")
 {
  $query = "DELETE FROM comic WHERE id = '".$_POST["image_id"]."'";
  if(mysqli_query($connect, $query))
  {
   echo 'Image Deleted from Database';
  }
 }
}
?>