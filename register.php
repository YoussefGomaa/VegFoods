
<?php
require_once "connect.php";
if(isset($_SESSION['userID'])){
    header('location:http://localhost/vegefoods/index.php');
}
else{
if($_POST){

    $name=trim($_POST['name']);
    $email=trim($_POST['email']);
    $address=trim($_POST['address']);
    $phone=trim($_POST['phone']);
    $pass=trim($_POST['pass']);
    $cpass=trim($_POST['cPass']);

    if($pass==$cpass){
    $selectStmt="select * from users where name='$name' or email='$email' or phone='$phone'";
    $res=$connect->query($selectStmt);
    if($res->num_rows==0){

        $insertStmt="insert into users (name,phone,email,address,password) values
        ('$name','$phone','$email','$address','$pass')";

        $res=$connect->query($insertStmt);
        header('location:http://localhost/vegefoods/login.php');
    }

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
                <form action="" class="bg-white p-5 w-50 contact-form" method="post">
                    <h1 class="text-center text-primary">VegeFoods</h1>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Name" name="name">
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="phone" name="phone">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Address" name="address">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="password" name="pass">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm password" name="cPass">
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" value="Sign up" class="btn btn-primary py-3 px-5">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<?php } ?>