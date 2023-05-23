<?php 
include 'lib/User.php';
include_once 'inc/header.php';

Session::checkSession();

if(isset($_GET['id'])){
    $userid = (int)$_GET['id'];

}
$user = new User();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        $userUpdate = $user->userUpdate($userid, $_POST);
    }
?>

<div class="container">
    <?php
    if(isset($userUpdate)){
        echo $userUpdate;
        null;
    }
    
    ?>
<div class="card pb-4">
    <div class="card-header">
        <h3>User Update</h3>
    </div>
    <?php 
    $user = new User();
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
        $userUpdate = $user->userUpdate($userid, $_POST);
    }

    $uservalue = $user->getUserById($userid);
    if($uservalue){
    ?>
    <form action="" method="post">
    <div class="mt-2 mx-4">
        <label for="name">Your Name :</label>
        <input type="text" name="name" id="name" class="form-control" value="<?php echo $uservalue->name; ?>">

    </div>
    <div class="mt-2 mx-4">
        <label for="username">User Name :</label>
        <input type="text" name="username" id="username" class="form-control" value="<?php echo $uservalue->username?>">
    </div>
    <div class="mt-2 mx-4">
        <label for="email">Email :</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $uservalue->email?>">
    </div>
    <?php 
    $sessionId = Session::get('id');
    if($sessionId == $userid){
        
    ?>
    <div class="mt-2 mx-4 mb-2">
    <!-- <input type="submit" value="update" class="btn btn-primary float-end"> -->
    <button name="update" class="btn btn-primary float-end">Update</button>
    </div>
    <?php    
}
    ?>
    </form>
    <?php } ?>
</div>
</div>


<?php 
include_once 'inc/footer.php';
?>