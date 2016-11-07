<?php
if(isset($_POST['r'])){
    to_register();
}

function to_register(){
    if($_POST['r'] == 't'){
        header('Location:teacher-regis.php');
    }
    if($_POST['r'] == 's'){
        header('Location:stu-regis.php');
    }
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/main.css">
<script>

</script>
<style>
    body{
        background: linear-gradient(to bottom, #e4f5fc 0%,#9fd8ef 10%,#2ab0ed 100%);
    }
    div{
        font-size: 3em;
        font-family: 'Times New Roman';
        text-align: center;
        height: 50%;
        background-color: bisque;
        margin: 8% 0% 8% 10%;
        padding: 40px;
        width: 70%;

        background: linear-gradient(to right, rgba(243,223,200,0.97) 0%, rgba(193,149,103,0.98) 19%, rgba(183,132,78,0.98) 42%, rgba(125,68,30,1) 100%);
        box-shadow: 10px 10px 35px 17px rgba(0,0,0,0.76);
        /*background: linear-gradient(to right, rgba(255,175,75,1) 0%, rgba(255,167,58,1) 11%, rgba(255,146,10,1) 41%, rgba(255,146,10,1) 100%);*/
        border-radius: 15px;
    }
    input{
        padding: 15px;
        margin: 40px;
    }
</style>
</head>

<body>
<div>
<form action="" method="post">
Register as a Student<input type="radio" name="r" value="s"><br>
Register as a Teacher<input type="radio" name="r"
value="t">   <br>
<input type="submit" value="Submit">
<input type="reset">
</form>
</div>
</body>
</html>
