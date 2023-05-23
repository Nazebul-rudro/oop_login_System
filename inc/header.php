<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once $filepath.'/../lib/Session.php';
    Session::init();
?>

<?php 
if(isset($_GET['action']) == 'logout'){
    Session::destrory();


}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Login System</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <script src="inc/bootstrap.min.js"></script>
    <script src="inc/jquery.min.js"></script>
</head>
<body>


    <nav class="container navbar navbar-default bg-light">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="index.php" class="navbar-brand">Login Register System PDO & PHP</a>
            </div>
            <ul class="nav  pull-right">
                <?php 
                $id = Session::get('id');
                $userlogin = Session::get('login');
                if($userlogin == true){
                ?>
                <li><a class="nav-link" href="Profile.php?id=<?php echo $id ?>">Profile</a></li>
                <li><a class="nav-link" href="?action=logout">Logout</a></li>
                <?php }else{?>
                <li><a class="nav-link" href="login.php">Login</a></li>    
                <li><a class="nav-link" href="registration.php">Register</a></li>
                <?php } ?>
            </ul>
        </div>
    </nav>
<br>