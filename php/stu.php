  <?php
  session_start();

  if(!isset($_SESSION["user"])){
    echo "<script>alert('Login First')</script>";
    header("Location:login.php");
  }

  function show_profile(){
    $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
    $query = "SELECT * FROM students WHERE id = '{$_SESSION['id']}' ;";
    $result = mysqli_fetch_assoc(mysqli_query($conn, $query));

    echo "<br>
    <section id='profile'>
    <p id=''>Name : {$result['name']}</p> <p id=''>User Name: {$result['uname']}</p>
    <img src='../pics/student/{$result['id']}.png' width='30px' height='50px'>
    <p id=''>Phone Number: {$result['phno']}</p>
    <p id=''>E-mail: {$result['email']}</p>
    <p id=''>Institute Currently Studying In: {$result['school_name']}</p>
    <p id=''>Class/Year Of Study: {$result['class_year']}</p>
    <p id=''>Marks 10th: {$result['marks_10th']}</p>
    <p id=''>Marks 12th: {$result['marks_12th']}</p>
    <p id=''>Address: {$result['address']}</p>
    </section>
    ";
    mysqli_close($conn);

  }

  function show_teachers(){
    $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
    $q1 = "SELECT id_teacher FROM following_teachers WHERE id_student = {$_SESSION['id']};";
    $q1r = mysqli_query($conn, $q1);
    $id_arr = array();
    while($r1 = mysqli_fetch_assoc($q1r))
      $id_arr[] = $r1["id_teacher"];

    $len = sizeof($id_arr);

    for($i=0; $i<$len; $i++){
        $query = "SELECT * FROM teachers WHERE id = '$id_arr[$i]' ;";
      $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
      echo "<section id='teachers'>
      <p id=''>Name : {$result['name']}</p> <p id=''>User Name: {$result['uname']}</p>
      <img src='../pics/teacher/{$result['id']}.png' width='30px' height='50px'>
      <p id=''>Phone Number: {$result['phno']}</p>
      <p id=''>E-mail: {$result['email']}</p>
      <p id=''>Graduate From : {$result['gradguate_institute']}</p>
      <p id=''>Place Working: {$result['place_working']}</p>
      <p id=''>Degree: {$result['degree']}</p>
      <p id=''>Experience: {$result['experience']}</p>
      <p>Knowledge On:<br>1.{$result['sub1']}   2.{$result['sub2']}   3.{$result['sub1']} </p>
      <p id=''>Address: {$result['address']}</p>
      </section>
      ";
    }
      mysqli_close($conn);
  }

  function show_books(){
    $conn = mysqli_connect("localhost", "aviral", "", "wt_project");
    $q1 = "SELECT id_book FROM following_books WHERE id_student = {$_SESSION['id']};";
    $q1r = mysqli_query($conn, $q1);
    $id_arr = array();
    while($r1 = mysqli_fetch_assoc($q1r))
      $id_arr[] = $r1["id_book"];

    $len = sizeof($id_arr);

    for($i=0; $i<$len; $i++){
        $query = "SELECT * FROM books WHERE id = '$id_arr[$i]' ;";
      $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
      echo "<section id='books'>
      <p id=''>Name : {$result['name']}</p> <p id=''>User Name: {$result['uname']}</p>
      <img src='../pics/book/{$result['id']}.png' width='30px' height='50px'>
      <p id=''>Name: {$result['name']}</p>
      <p id=''>Author: {$result['author']}</p>
      <p id=''>Price {$result['price']}</p>
      <p id=''>Rating: {$result['Rating']}</p>
      </section>
      ";
    }
      mysqli_close($conn);
  }

  function logout(){
    session_destroy();
      unset($_SESSION);
      header("Location:login.php");
  }

  if(isset($_GET["logout"])){
    logout();
  }
    ?>

  <html>
  <head>
      <link rel="stylesheet" type="text/css" href="../css/stu.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
  <style>
      #query{
      text-align: center;
      margin-top: 50px;
      }

      #display_info{
      padding-left: 100px;
      padding-top: 70px;
      }

      input:focus{
      border: 1px red solid;

      }

      input[type=text]{
      width: 30%;
      border: 1px solid #ccc;
      box-sizing: border-box;
      border-radius: 4px;
      padding: 12px 20px;
      }
      article{
        margin: 5em 5em 5em 5em;
      }
      body{
        font-family: "Times New Roman";
      }
      h1{
        color: #001fab;
      }
      p id=''{
        color: #5a3000;
      }
      section#profile{
        background: linear-gradient(to bottom, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%);
        padding: 30px;
        margin: 10px;
      }
      section#teachers{
        background: linear-gradient(to bottom, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%);
        padding: 30px;
        margin: 10px;

        box-sizing: border-box;
        display: inline-block;
      vertical-align: middle;
      }
      div#teachers{
      overflow-x: scroll;
      overflow-y: hidden;
      white-space: nowrap;
      }
      section#books{
        background: linear-gradient(to bottom, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%);
        padding: 30px;
        margin: 10px;
        width: 25%;
        box-sizing: border-box;
        display: inline-block;
      vertical-align: middle;
      }
      div#books{
      overflow-x: scroll;
      overflow-y: hidden;
      white-space: nowrap;
      }
      body {
          background-image: url("../pics/grad.jpg");
          background-repeat: repeat-x;
      }
      .floating-box {
          display: inline-block;
          width: 350px;
          height:300px;
          margin: 10px;
          background: linear-gradient(to bottom, rgba(0,0,0,0.65) 0%,rgba(0,0,0,0) 100%);
          padding: 30px;
          margin: 10px;
          width: 25%;
          box-sizing: border-box;
          display: inline-block;
        vertical-align: middle;
          box-sizing: border-box;
          display: inline-block;
        vertical-align: middle;

      }
      .mySlides{
      	height:30em;
      	width:24em;
      }
      .book_details{
      	float: right;
      }
      p{
      	padding-top: 5px;
      	padding-left: 15px;
      	font-size: 20px;
      }

      .modal {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }

      /* Modal Content */
      .modal-content {
          position: relative;
          background-color: #fefefe;
          margin: auto;
          padding: 0;
          border: 1px solid #888;
          width: 80%;
          box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
          -webkit-animation-name: animatetop;
          -webkit-animation-duration: 0.4s;
          animation-name: animatetop;
          animation-duration: 0.4s
      }

      /* Add Animation */
      @-webkit-keyframes animatetop {
          from {top:-300px; opacity:0}
          to {top:0; opacity:1}
      }

      @keyframes animatetop {
          from {top:-300px; opacity:0}
          to {top:0; opacity:1}
      }

      /* The Close Button */
      .close {
          color: white;
          float: right;
          font-size: 28px;
          font-weight: bold;
      }

      .close:hover,
      .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
      }

      .modal-header {
          padding: 2px 16px;
          background-color: #5cb85c;
          color: white;
      }

      .modal-body {padding: 2px 16px;}


      .mySlides {display:none;}


      div#recommendation{
        overflow-x: scroll;
        overflow-y: hidden;
        white-space: nowrap;

      }
  </style>

   <script>
  <!--

      /* Set the width of the side navigation to 250px and the left margin of the page content to 250px and add a black background color to body */
  function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.getElementById("main").style.marginLeft = "250px";
      document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  }

  /* Set the width of the side navigation to 0 and the left margin of the page content to 0, and the background color of body to white */
  function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.getElementById("main").style.marginLeft = "0";
      document.body.style.backgroundColor = "aliceblue";
  }
  function show_div(sh, h1, h2, h3,h4) {
      document.getElementById(sh).style.display='block';
      document.getElementById(h1).style.display='none';
      document.getElementById(h2).style.display='none';
      document.getElementById(h3).style.display='none';
      document.getElementById(h4).style.display='none';
      closeNav();
      return false;
  }
  function add_teacher(){
    window.location = "add.php?add=teachers";
  }
  function add_books(){
    window.location = "add.php?add=books";
  }
  function logout(){
    if(window.location == "stu.php")
    window.location += "?logout=logout"
    else
      window.location += "&logout=logout"
  }

  -->
  </script>
  </head>
  <nav id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="javascript:void(0)" onclick="show_div('books','teachers','recommendation','search','profile')">Books</a>
    <a href="javascript:void(0)" onclick="show_div('teachers','books','recommendation','search','profile')">Teachers</a>
    <a href="javascript:void(0)" onclick="show_div('books','teachers','recommendation','search','profile')">Books</a>
    <a href="javascript:void(0)" onclick="show_div('recommendation','books','teachers','search','profile')">Recommendations</a>
    <a href="javascript:void(0)" onclick="show_div('profile', 'books','teachers','search','recommendation')">Profile</a>
    <a href="javascript:void(0)" onclick="show_div('search','profile', 'books','teachers','recommendation')">Search</a>
  </nav>

  <!-- Use any element to open the sidenav -->
  <!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the sidenav to sit on top of the page -->
  <div id="main">
      <span class="menu" onclick="openNav()"><img src="../pics/Menu%20button.png" height="70px" width="130px"></span>

  </div>
  <span class="home"><img onclick="logout()" src="../pics/home.png" height="56px" width="90px" ></span>
  </html>

  <body>
      <article id="books" style="display:none">
        <h1 align="center">Books</h1>
        <button onclick="add_books()">Add/Delete BOOKs(s)</button>
        <br>
        <div id="books">
          <?php show_books(); ?>
        </div>
      </article>
      <article id="search" style="display:none">
        <h1 align="center">Search</h1>
        <br>
        <div id="search">
          <div id="query">
            <div id="search_name">
            <form action="?search=yes" method="post">
            <input type="text" name="name" placeholder="Enter the bookname" /><br/>
            <input type="submit" value="Search by bookname"/>
            </form>
          </div>
          <div id="search_auth">
            <form action="" method="post">
            <input type="text" name="author" placeholder="Enter the author"/><br/>
            <input type="submit" value="Search by author"/>
            </form>
          </div>

          <button type="button" id="btn4">Search by subject</button>
          <div id="subje"  style="display: none;">
          <form action="" method="post">
          <p>PU :</p>
            <input type="radio" name="subject" value="MAT"/> Mathematics
            <input type="radio" name="subject" value="PHY"/> Physics
            <input type="radio" name="subject" value="CHE"/> Chemistry
          <input type="radio" name="subject" value="BUS"/> Business Studies<br/>
          <p>Engineering Courses:</p>
          <input type="radio" name="subject" value="CSE"/> Comp Science
          <input type="radio" name="subject" value="MEC"/> Mech Eng.
          <input type="radio" name="subject" value="ECE"/> Electronics and Comm
          <input type="radio" name="subject" value="EEE"/> Electrical and Elec.<br/>
          <input type="submit" value="Submit"/>
          </form>
          </div>
          </div>
          <div id="display_info">
            <?php
            $count=1;
            $count1 =1;
            $count2 =1;

              $conn = mysqli_connect("localhost","aviral", "", "wt_project");
            if (!empty($_REQUEST['name'])) {
              $conn = mysqli_connect("localhost","aviral", "", "wt_project");
              $term = mysqli_real_escape_string($conn, $_POST['name']);

              $sql = "SELECT * FROM books WHERE name='$term'";
              $result = mysqli_query($conn,$sql);
              while ($row = mysqli_fetch_assoc($result)){
              echo '<div class="floating-box">';

              echo "<p>Name: ".$row["name"]."</p>";
              echo "<p>Author: ".$row["author"]."</p>";
              echo "<p>Price: ".$row["price"]."</p>";
              echo "<p>Rating: ".$row["rating"]."</p>";
              echo"<button id="."myBtn$count"." onclick= displaymodal($count) >More Info</button>";
              echo"</div>";
              echo"<div id="."myModal"."$count"." class='modal'>";

                echo"<!-- Modal content -->";
              echo"<div class='modal-content'>";
                echo"<div class='modal-header'>";
                  echo"<span class='close'>×</span>";
                echo"<h2>Short Description</h2>";
                echo"</div>";
                echo"<div class='modal-body'>";

                  echo"<p>".$row['description']."</p>";
                echo"</div>";
                  echo"</div>";
              echo"</div>";
              echo"</div>";

              $count++;
              }
              }
            if (!empty($_REQUEST['subject'])) {

              $term = mysqli_real_escape_string($conn, $_POST['subject']);

              $sql = "SELECT * FROM books WHERE subject='$term'";
              $result = mysqli_query($conn,$sql);
              while ($row = mysqli_fetch_assoc($result)){
              echo '<div class="floating-box">';

              echo "<p>Name: ".$row["name"]."</p>";
              echo "<p>Author: ".$row["author"]."</p>";
              echo "<p>Price: ".$row["price"]."</p>";
              echo "<p>Rating: ".$row["rating"]."</p>";
              echo"<button id="."myBtn$count"." onclick= displaymodal($count) >More Info</button>";
              echo"</div>";
              echo"<div id="."myModal"."$count"." class='modal'>";

                echo"<!-- Modal content -->";
              echo"<div class='modal-content'>";
                echo"<div class='modal-header'>";
                  echo"<span class='close'>×</span>";
                echo"<h2>Short Description</h2>";
                echo"</div>";
                echo"<div class='modal-body'>";

                  echo"<p>".$row['description']."</p>";
                echo"</div>";
                  echo"</div>";
              echo"</div>";
              echo"</div>";
              $count++;
              }
              }
            if (!empty($_REQUEST['author'])) {

              $term = mysqli_real_escape_string($conn, $_POST['author']);

              $sql = "SELECT * FROM books WHERE author='$term'";
              $result = mysqli_query($conn,$sql);
              while ($row = mysqli_fetch_assoc($result)){
              echo '<div class="floating-box">';

              echo "<p>Name: ".$row["name"]."</p>";
              echo "<p>Author: ".$row["author"]."</p>";
              echo "<p>Price: ".$row["price"]."</p>";
              echo "<p>Rating: ".$row["rating"]."</p>";
              echo"<button id="."myBtn$count"." onclick= displaymodal($count) >More Info</button>";
              echo"</div>";
              echo"<div id="."myModal"."$count"." class='modal'>";

                echo"<!-- Modal content -->";
              echo"<div class='modal-content'>";
                echo"<div class='modal-header'>";
                  echo"<span class='close'>×</span>";
                echo"<h2>Short Description</h2>";
                echo"</div>";
                echo"<div class='modal-body'>";

                  echo"<p>".$row['description']."</p>";
                echo"</div>";
                  echo"</div>";
              echo"</div>";
              echo"</div>";
              $count2++;
              }
              }
              ?>
          </div>
          <script>
          var btncheck= document.getElementById("btn4");
          var blockshow= document.getElementById("subje");
          btncheck.onclick=function() {
          blockshow.style.display= "block";
          }
          function displaymodal(cnt){
          var modal1 = document.getElementById('myModal'+cnt);
          var btn1 = document.getElementById("myBtn"+cnt);
          var span = document.getElementsByClassName("close")[cnt-1];
          modal1.style.display = "block";
          span.onclick = function() {
              modal1.style.display = "none";
          }
          window.onclick = function(event) {
              if (event.target == modal1) {
                modal1.style.display = "none";
              }
            }
             }
              </script>
            </div>
      </article>

      <article id="teachers" style="display:none">
        <h1 align="center"> Teachers</h1>
        <button onclick="add_teacher()">Add/Delete Teacher(s)</button>
        <br>
        <div id="teachers">
        <?php show_teachers(); ?>
      </div>
      </article>

      <article id="recommendation" style="display:none">
          <h2 style="text-align: center;">Recommended Books</h2>

                 <div class="w3-content w3-section" style="max-width:100%;max-height:100%; align: center;">
                  <img class="mySlides" src="../pics/four.png" style="align: center;" >
                  <img class="mySlides" src="../pics/two.jpg" style="align: center;">
                  <img class="mySlides" src="../pics/five.jpg" style="align: center;">
                </div>

                <script>
                var myIndex = 0;
                carousel();

                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                       x[i].style.display = "none";
                    }
                    myIndex++;
                    if (myIndex > x.length) {myIndex = 1}
                    x[myIndex-1].style.display = "block";
                    setTimeout(carousel, 2000); // Change image every 2 seconds
                }
                </script>
                <div style="padding-left: 20%">
                <?php
                $conn = mysqli_connect("localhost", "aviral", "", "wt_project");

                $sql = "SELECT * FROM books";
                $result = mysqli_query($conn, $sql);
                $count=1;
                $i=0;
                echo "<div id='recommendation'>";
                for($i=0; $i<3; $i++)
                {
                echo "<div class='rec_container'>";
                $row = mysqli_fetch_assoc($result);

                echo '<div class="floating_box" style="border: 3px solid #73AD21;">';
                #	echo'<!--<div class="book_details" style="display:inline-block; border: 1px solid black; width: 200px; position: absolute">-->';
                    echo "<p>Name: ".$row["name"]."</p>";
                    echo "<p>Author: ".$row["author"]."</p>";
                    echo "<p>Price: ".$row["price"]."</p>";
                    echo "<p>Rating: ".$row["rating"]."</p>";
                    echo "<div style='padding-left: 5%'>";
                    echo"<button id=".'myBtn'."$count".">More Info</button>";
                    echo"</div>";


                 // echo "id="."myModel"."$count"
                  echo"<div id="."myModal"."$count"." class='modal'>";

                  echo"<!-- Modal content -->";
                  echo"<div class='modal-content'>";
                    echo"<div class='modal-header'>";
                      echo"<span class='close'>×</span>";
                      echo"<h2>Short Description</h2>";
                    echo"</div>";
                    echo"<div class='modal-body'>";

                      echo"<p>".$row['description']."</p>";
                    echo"</div>";
                    echo"</div>";
                    echo"</div>";
                echo"</div>";
                echo"</div>";
                $count++;
                }
                echo "</div>";
                mysqli_close($conn);
                ?>
                </div>

                <script>
                // Get the modal
                var modal1 = document.getElementById('myModal1');
                var modal2 = document.getElementById('myModal2');
                var modal3 = document.getElementById('myModal3');

                // Get the button that opens the modal
                var btn1 = document.getElementById("myBtn1");
                var btn2 = document.getElementById("myBtn2");
                var btn3 = document.getElementById("myBtn3");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
                var span1 = document.getElementsByClassName("close")[1];
                var span2 = document.getElementsByClassName("close")[2];

                // When the user clicks the button, open the modal
                btn1.onclick = function() {
                    modal1.style.display = "block";
                }
                btn2.onclick = function() {
                    modal2.style.display = "block";
                }
                btn3.onclick = function() {
                    modal3.style.display = "block";
                }

                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal1.style.display = "none";
                }
                span1.onclick = function() {
                    modal2.style.display = "none";
                }
                span2.onclick = function() {
                    modal3.style.display = "none";
                }
                // When the user clicks anywhere outside of the modal, close it
                window.onclick = function(event) {
                    if (event.target == modal1) {
                        modal1.style.display = "none";
                    }
                  if (event.target == modal2) {
                        modal2.style.display = "none";
                    }
                  if (event.target == modal3) {
                        modal3.style.display = "none";
                    }
                }

                </script>




      </article>

      <article id="profile" style="display:block">
        <h1 align="center"> Profile</h1>
        <?php show_profile(); ?>

     </article>

     <?php
     if($_GET['search'] === "yes"){
       echo "
       <script>
         document.getElementById('search').style.display='block';
         document.getElementById('profile').style.display='none';
         document.getElementById('teacher').style.display='none';
         document.getElementById('books').style.display='none';
         document.getElementById('recommendation').style.display='none';
         closeNav();
       </script>
       ";
     }

     ?>
  </body>
  </html>
