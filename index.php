
<?php 
include_once 'inc/header.php';
include "lib/User.php";
Session::checkSession();
$db = new Database();

?>



<!-- body start -->
<div class="container">
<?php 
$loginmsg = Session::get('loginmsg');
if(isset($loginmsg)){
    echo $loginmsg;
    Session::set('loginmsg', NULL);
}
?>
<div class="card">
    <div class="card-header">
        <h3>User list <a class="float-end nav-link" href=""><strong>Welcome!</strong> 
    <?php
    $username = Session::get('username'); 
    if(isset($username)){
    echo $username;
    }
    ?>
    </a></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Serial</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $alluser = new User();
                $allusers = $alluser->getUserData();
                if($allusers){
                    $i = 0;
                foreach($allusers as $user){
                    $i++;
                ?>
                <tr>
                    <td><?=$i?></td>
                    <td><?=$user['name'];?></td>
                    <td><?=$user['username']?></td>
                    <td><?=$user['email']?></td>
                    <td>
                        <a class="btn btn-primary" href="profile.php?id=<?=$user['id']?>">view</a>
                    </td>
                </tr>
                <?php } }else{ ?>
<tr>
    <td colspan="5"><h2>User Data Not Found.............</h2></td>
</tr>


                    <?php }?>

            </tbody>
        </table>
    </div>
</div>

</div>
<!-- body end -->

<?php 
include_once 'inc/footer.php';
?>