
<?php

require_once "connect.php";
session_start();
if(isset($_SESSION['userID'])){
    header('location:http://localhost/vegefoods/index.php');
}
else{
if($_POST){

$email=$_POST['email'];
$pass=$_POST['pass'];

$selectStmt="select * from users where email='$email' and password='$pass'";
$res=$connect->query($selectStmt);

if($res->num_rows>0){
     $row=$res->fetch_assoc();
    $_SESSION['userID']=$row['id'];
    header('location:http://localhost/vegefoods/index.php');
}

}


?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12  d-flex justify-content-center">
                <form action="#" class="bg-white p-5 w-50 contact-form" method="post">
                <h1 class="text-center text-primary">VegeFoods</h1>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="password" name="pass">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Login" class="btn btn-primary py-3 px-5">
                    </div>
                    <div><a href="register.php" style="color:blue;"> Register</a></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php  } ?>