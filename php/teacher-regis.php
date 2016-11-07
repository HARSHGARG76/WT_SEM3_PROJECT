<?php
function register(){
	extract($_POST);
  $flag = 1;
	$con = new mysqli("localhost", "aviral", "", "wt_project");
	$stmt = $con->prepare("SELECT uname,email FROM teachers");
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

if($flag == 1){

  $q = "INSERT INTO teachers (name, phno, email, address, uname, pword, graduate_institute, place_working, sub1, sub2, sub3, degree, experience) ";
  $q = $q .           "VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $con = new mysqli("localhost", "aviral", "", "wt_project");
  $stmt = $con->prepare($q);
  $stmt->bind_param("sssssssssssss", $name, $phno, $email, $address, $uname, $pword, $graduate_institute, $place_working, $sub1, $sub2, $sub3, $degree , $experience);
  echo "SUCCESS";
	$c =$stmt->execute();
	if(!$c){
		die('Something went wrong: ' . mysqli_error($con));
	}
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
		<input type="text" name="name" class="second" placeholder="Full Name" tabindex="1" /><br/>
		<input type="text" name="uname" class="second" placeholder="Username" tabindex="3" /><br/>
		<input type="email" name="email" class="second" placeholder="Email" tabindex="4" /><br/>
		<input type="text" name="phno" class="second" placeholder="Phone No" tabindex="5"/><br/>
		<input type="text" name="graduate_institute" class="second" placeholder="Graduate institute" tabindex="6"/><br/>
		<input type="text" name="place_working" class="second" placeholder="Place of work" tabindex="7"/><br/>
		<input type="text" name="experience" class="second" placeholder="Experience" tabindex="9" /><br/>
		<input type="text" name="sub1"  class="first" placeholder="Domain1" tabindex="8"/>
		<input type="text" name="sub2" class="first" placeholder="Domain2" tabindex="9" /><br/>
   		<input type="text" name="sub3" class="first" placeholder="Domain3" tabindex="9" />
		<input type="text" name="degree" class="first" placeholder="Degree" tabindex="9" /><br/>
		<input type="text" name="address"  class="second" placeholder="Address" tabindex="10" /><br/>
		<input type="password" name="pword" class="first" placeholder="Password" tabindex="11"/>
		<input type="password" name="pword_conf" class="first" placeholder="Repeat Password" tabindex="12"/><br/>
	</div>
	<div id="myBtn">
		<input type="submit" name="submit" value="Register" tabindex="13"></div>
	</div>
</form>
</div>
</body>
</html>
