<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/main.css">
     <link rel="stylesheet" type="text/css" href="../css/register_login.css">
	</head>

<?php




function check(){
$uname = $_POST["user"];
$password = $_POST["pword"];


$con = mysqli_connect("localhost", "aviral", "", "wt_project");
$q1 = "SELECT pword,id FROM students WHERE uname = '$uname';";
$q2 = "SELECT pword,id FROM teachers WHERE uname = '$uname';";
$result1 = mysqli_fetch_assoc(mysqli_query($con, $q1));
$result2 = mysqli_fetch_assoc(mysqli_query($con, $q2));

if($result1["pword"] === $password){

    session_start();
    $_SESSION['id']=$result1['id'];
    $_SESSION['user'] = "student";
    echo "<script>window.location='stu.php'</script>";
}
else if( $result2["pword"] === $password){

    session_start();
    $_SESSION['id']=$result2['id'];
    $_SESSION['user'] = "teacher";
    echo "<script>window.location='teacher.php'</script>";
}
    else{
        echo"<script>alert('Invalid Username Or Password !');
        </script>";
    }

}

function forgot(){
    echo "<script>var x = prompt('Enter your E-mail id ');
        window.location='login.php?email='+x;
        </script>";

}

    function send_mail(){

        require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'etutor.elearn@gmail.com';          // SMTP username
$mail->Password = 'newpasswor';// SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;
$to = $_GET['email'];
        $mail->setFrom('etutor.elearn@gmail.com', 'etutor');
$mail->addReplyTo('etutor.elearn@gmail.com', 'etutor');
$mail->addAddress($to);   // Add a recipient
$mail->isHTML(true);
$mail->Subject = 'Your Password for etutor';
$con = mysqli_connect("localhost", "aviral", "", "wt_project");
$result = mysqli_query($con, "SELECT pword,name from students where email=  '$to'");
$result = mysqli_fetch_assoc($result);
$mail->Body = $result['name']." your password is ". $result['pword'];

if(!$mail->send()) {
    echo '<script>Your Message could not be sent !</script>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '<script>Your Message has been sent !</script>';
}
    }

    if(isset($_POST["submit"])){
        check();
    }

        if(isset($_GET["forgot"])){
            forgot();
        }

        if(isset($_GET["email"])){
            send_mail();
        }

?>


<body>

<form action="" method="post">
  <div class="imgcontainer">
	  <h1 style="font-family: 'Times New Roman'; font-size= 40px; "><br>e-Tutor Login<br><br></h1>
          <img id ="profile" src="../pics/book_glass.jpg" alt="XYZ" class="avatar">

  </div>


  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="user" style=" background-image: url('../pics/user.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding-left: 50px; "required>
<br>
    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pword" style=" background-image: url('../pics/password.png');
    background-position: 10px 10px;
    background-repeat: no-repeat;
    padding-left: 50px; " required>
<br>
<br>

  </div>

  <div class="container" style="background-color:#f1f1f1">
      <button type="submit" name="submit">Login</button>
    <button type="button" class="cancelbtn" onclick="window.location='main.php';">Cancel</button>
    <span class="psw" style="float: right" onclick="">Forgot <a href="login.php?forgot=True">password?</a></span><br><br><br>
  </div>
</form>
</body>
</html>
