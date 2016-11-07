<?php
function register(){
	extract($_POST);
  $flag = 1;
	$con = new mysqli("localhost", "aviral", "", "wt_project");
	$stmt = $con->prepare("SELECT uname,email FROM students");
	$stmt->execute();
	$user = [];
	$em = [];
	foreach ($stmt->get_result() as $row)
	{
	    $user[] = $row['uname'];
			$em[] = $row['email'];
	}

  if(strlen($name) > 20){
    $flag = 0;
    echo "<script>alert('The Name is too Big (should be < 20 letters)')</script>" ;
    #die();
  }
  if(preg_match('/[\'^£$%&*()}{@#~?><>,.|=_+¬-]/', $uname) || strlen($uname) >= 16){
    $flag = 0;
    echo "<script>alert('The UserName should contain only letters or alphabets')</script>";
    #die();
  }
  if($pword !== $pword_conf){
    $flag = 0;
    echo "<script>alert('The Passwords do not match')</script>";
    #die();
  }
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $flag = 0;
    echo "<script>alert('The email dose not seem to be valid')</script>";
    #die();
  }

	if(strlen($phno) > 11 ){
    $flag = 0;
    echo "<script>alert('The Phone Number is invalid')</script>";
    #die();
  }
 if(in_array($uname, $user)){
	 $flag = 0;
	 echo "<script>alert('The Username is Not Available')</script>";
 }
 if(in_array($email, $em)){
	 $flag = 0;
	 echo "<script>alert('The Email is Already Registered')</script>";
 }
 if((floatval)($marks_10th) < 0 || (floatval)($marks_10th) > 100 ){
   $flag = 0;
   echo "<script>alert('The 10th Marks Do not seem legit')</script>";
   #die();
 }
if((floatval)($marks_12th) < 0 || (floatval)($marks_12th) > 100 ){
  $flag = 0;
  echo "<script>alert('The 12th Marks Do not seem legit')</script>";
  #die();
}

if($flag == 1){

  $q = "INSERT INTO students (name, phno, email, address, uname, pword, marks_10th, marks_12th, class_year, school_name) ";
  $q = $q .           "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $con = new mysqli("localhost", "aviral", "", "wt_project");
  $stmt = $con->prepare($q);
  #$stmt = mysqli_stmt_bind_param($stmt, "ssssssssss", $name, $phno, $email, $address, $uname, $pword, $marks_10th, $marks_12th, $class_year, $school_name);
  $stmt->bind_param("ssssssssss", $name, $phno, $email, $address, $uname, $pword, $marks_10th, $marks_12th, $class_year, $school_name);
  echo "SUCCESS";
	$stmt->execute();
	header("Location:main.php");
}
}

if(isset($_POST['submit'])){
  register();
}
?>

<html>
<head>
<title>
Sign Up
</title>
<link type="text/css" rel="stylesheet" href="../css/signupstyle.css"/>
</head>
<body>
<div id="outmost" style="text-align: center;">
<div style="text-align: center;">
<h1>Sign Up</h1>
</div>
<p style="font-size: 15px;">Never Do Tomorrow, What You Can Do Today</p>
<form action="" method="post">
	<div>
		<input type="text" name="name" class="second" placeholder="Full name" tabindex="1" required/><br/>
		<input type="text" name="uname" class="second" placeholder="Username" tabindex="3" required/><br/>
		<input type="email" name="email" class="second" placeholder="Email" tabindex="4" required/><br/>
		<input type="text" name="phno" class="first" placeholder="Phone No" tabindex="5" required/>
		<input type="text" name="class_year" class="first" placeholder="Class of Study" tabindex="6" required/><br/>
		<input type="text" name="marks_10th" class="first" placeholder="Matriculation Grade" tabindex="7" required/>
		<input type="text" name="marks_12th"  class="first" placeholder="PU Grade" tabindex="8" required/><br/>
		<input type="text" name="school_name" class="second" placeholder="Institute" tabindex="9" required/><br/>
		<input type="text" name="address"  class="second" placeholder="Address" tabindex="10" required /><br/>
		<input type="password" name="pword" class="first" placeholder="Password" tabindex="11" required/>
		<input type="password" name="pword_conf" class="first" placeholder="Repeat Password" tabindex="12" required/><br/>
	</div>
	<div id="myBtn">
		<input type="submit" name="submit" value="Register" tabindex="13"></div>
	</div>
</form>
</div>
</body>
</html>
