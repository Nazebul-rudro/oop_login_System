<?php 
include_once 'inc/header.php';
include_once 'lib/User.php';
Session::checkLogin()
?>

<?php 
$user = new User();

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
   $userLog = $user->userLogin($_POST);
   
}
?>
<?php 
    if(isset($userLog)){
        echo $userLog;
    }
    ?>
<div class="container">
    
<div class="card pb-4">
    <div class="card-header">
        <h3>User Login</h3>
    </div>
    <form action="" method="post">
    <div class="mt-2 mx-4">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mt-2 mx-4">
        <label for="password">Password : </label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="mt-2 mx-4 mb-2">
    <button class="btn btn-primary float-end" name="login">Login</button>
    </div>
    </form>
</div>
</div>


<?php 
include_once 'inc/footer.php';
?>