<?php 
include_once 'inc/header.php';
include 'lib/User.php';
Session::checkLogin();
?>

<?php 
$user = new User();


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
   $userReg = $user->userRegistration($_POST);
   
}

?>



<div class="container">

<?php 
if(isset($userReg)){
    echo $userReg;
}
?>
<div class="card pb-4">
    <div class="card-header">
        <h3>User Registration</h3>
    </div>
    <form action="" method="POST">
    <div class="mt-2 mx-4">
        <label for="name">Your Name :</label>
        <input type="text" name="name" id="name" class="form-control">
    </div>
    <div class="mt-2 mx-4">
        <label for="username">User Name :</label>
        <input type="text" name="username" id="username" class="form-control">
    </div>
    <div class="mt-2 mx-4">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" class="form-control">
    </div>
    <div class="mt-2 mx-4">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="mt-2 mx-4 mb-2">
    
    <button name="register"  class="btn btn-primary float-end">Register</button>
    </div>
    </form>
</div>
</div>


<?php 
include_once 'inc/footer.php';
?>