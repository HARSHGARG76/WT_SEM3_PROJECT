<?php
session_start();
if(!isset($_SESSION["user"])){
  echo "<script>alert('Login First')</script>";
  header("Location:login.php");
}
 ?>
<html>
<head>
<style>
    table {
      text-align: CENTER;
       margin-top: 1em;
       align-items: LEFT;
    }
    tr:nth-child(even) {
       background-color: #f2f2f2;
    }
    th {
     padding: 16px;
        background-color: #4CAF50;
       color: white;
    }
    td {
       padding: 5px;
    }
</style>
<script>

</script>
</head>
<body>
  <form action="" method="post">
      Enter id<input type="text" name="no" required autocomplete="off">
      <input type="submit" name="add_id" value="ADD">
      <input type="submit" name="delete_id" value="DELETE" >
      <br>
          </form>

  <form action="" method="post">
    <input type="submit" name="back" value="Go Back">
      </form>
</body>
</html>


<?php
if($_POST["back"] === "Go Back"){
  go_back();
}
else if($_POST["add_id"] === "ADD"){
  add_id();
}
elseif ($_POST["delete_id"] === "DELETE") {
  delete_id();
}
display();

function display(){
    $table = $_GET["add"];
    $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
    $q = "SELECT * FROM ". $table;
    $r = mysqli_query($conn, $q);
    $i=1;
    echo "<table width='100%'' cellpadding='1' cellspacing='1'>
          <tr>
            <th>id</th>
            <th>Name</th>
            <th>User Name</th>
            <th>Rating</th>
            <th>E-Mail</th>
            <th>Price</th>
          </tr>
      ";
    while($row = mysqli_fetch_assoc($r) ){
      echo "
            <tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['uname']}</td>
            <td>{$row['rating']}</td>
            <td>{$row['email']}</td>
            <td>{$row['price']}</td>
            </tr>
            <br>
            ";
      $i++;
    }
    echo "</table>";
    mysqli_close($conn);
}

function add_id(){
  $table = $_GET["add"];
  $id = $_POST["no"];
  $ids = $_SESSION['id'];
  $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
  $x = "";
  $q = "";
  if($table === "books"){
    if ($_SESSION["user"] === "student")
      $x = "id_student";
    elseif ($_SESSION["user"] === "teacher") {
      $x = "id_teacher";
    }

    $q = "INSERT INTO following_books ($x, id_book) VALUES('$ids', '$id');" ;
  }
  elseif($table === "teachers")
    $q = "INSERT INTO following_teachers (id_student, id_teacher) VALUES('$ids', '$id');";
  echo "$q";
  $r = mysqli_query($conn, $q);
  mysqli_error($conn);
  mysqli_close($conn);
}

function delete_id(){
  $table = $_GET["add"];
  $id = $_POST["no"];
  $ids = $_SESSION['id'];
  $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
  echo " $ids $id ";
  $x = "";
  $q = "";
  if($table === "books"){
    if ($_SESSION["user"] === "student")
      $x = "id_student";
    elseif ($_SESSION["user"] === "teacher") {
      $x = "id_teacher";
    }
    $q = "DELETE FROM following_books WHERE $x = '$ids' AND id_book='$id' " ;
  }
  elseif($table === "teachers")
    $q = "DELETE FROM following_teachers WHERE id_teacher='$id' AND id_student='$ids' ;";
  echo "$q";
  $r = mysqli_query($conn, $q);
  mysqli_error($conn);
  mysqli_close($conn);
}

function go_back(){
  if($_SESSION['user'] === "student")
    echo "<script>window.location='stu.php'</script>";
  if($_SESSION['user'] === "teacher")
    echo "<script>window.location='teacher.php'</script>";
}
 ?>
