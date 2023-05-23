<?php
include_once "Session.php";
include "Database.php";
class User{
    private $db;
    function __construct()
    {
        $this->db = new Database();
    }

    


    public function userRegistration($data){
        $name = $data['name'];
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $chk_email = $this->emailcheck($email);
        

        if($name == "" || $username == "" || $email == "" || $password == ""){
            $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Fild must not be Empty</div>";
            return $msg;
        }
        if(strlen($username) < 3) {
            $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Username too Short</div>";
            return $msg;
        }elseif(preg_match('/[^a-z0-9_-]+/i', $username)){
            $msg = "<div class='alert alert-danger'> <strong> Error! </strong> username only cantain alhanumerical, dashes and undercores!</div>";
            return $msg;
        }
        if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
            $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Email Address is not Valid</div>";
            return $msg;
        }
        if($chk_email == true){
            $msg = "<div class='alert alert-danger'> <strong> Error! </strong> This Email access already exist</div>";
            return $msg;
        }

        $sql = "INSERT INTO user(name, username, email, password) VALUES(:name, :username, :email, :password)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name', $name);
        $query->bindValue(':username', $username);
        $query->bindValue(':email', $email);
        $query->bindValue(':password', $password);
        $result = $query->execute();
        if($result){
            $msg = "<div class='alert alert-success'> <strong> Successfully! </strong> Thank you. You have been Registered</div>";
            return $msg;
        }else{
            $msg = "<div class='alert alert-danger'> <strong> Sorry! </strong> Please Contact Admin</div>";
            return $msg;
        }   
    }



public function emailcheck($email){
    $sql = 'SELECT email FROM user WHERE email = :email';
    $query = $this->db->pdo->prepare($sql);
    $query->bindValue(':email', $email);
    $query->execute();
    if($query->rowCount() > 0){
        return true;
    }else{
        return false;
    }

}






public function getLoginUser($email, $password){
    $sql = "SELECT * FROM  user WHERE email = :email AND password = :password LIMIT 1";
    $query = $this->db->pdo->prepare($sql);
    $query->bindValue(":email", $email);
    $query->bindValue(":password", $password);
    $query->execute();  
    $result = $query->fetch(PDO::FETCH_OBJ);
    return $result;
}

// user login 
public function userLogin($data){
    $email = $data['email'];
    $password = $data['password'];
    $chk_email = $this->emailcheck($email);

    if($email == "" || $password == ""){
        $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Fild must not be Empty</div>";
        return $msg;
    }
    if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
        $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Email Address is not Valid</div>";
        return $msg;
    }
    

    $result = $this->getLoginUser($email, $password);
    if($result){
        Session::init();
        Session::set("login", true);
        Session::set("id", $result->id);
        Session::set("name", $result->name);
        Session::set("username", $result->username);
        Session::set("loginmsg", $msg ="<div class='alert alert-success'> <strong> Success! </strong> Login Successfully</div>");
        header('Location: index.php');
    }else{
       $msg = "<div class='alert alert-danger'> <strong> Error! </strong> This Email access already exist</div>";
        return $msg;

    }

}


public function getUserData(){
    $sql = "SELECT * FROM user ORDER BY id DESC";
    $query = $this->db->pdo->prepare($sql);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}

public function getUserById($id){
    
    $sql = "SELECT * FROM `user` WHERE id = $id";
    $query = $this->db->pdo->prepare($sql);
    // $query->bindValue(":id", $id);
    $query->execute();  
    $result = $query->fetch(PDO::FETCH_OBJ);
    return $result;
}

public function userUpdate($id, $data){

    $name = $data['name'];
    $username = $data['username'];
    $email = $data['email'];

    if($name == "" || $username == "" || $email == ""){
        $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Fild must not be Empty</div>";
        return $msg;
    }
    if(strlen($username) < 3) {
        $msg = "<div class='alert alert-danger'> <strong> Error! </strong> Username too Short</div>";
        return $msg;
    }
    
    $sql = "UPDATE user SET
    name = :name,
    username = :username,
    email = :email
    WHERE id = :id";
$query = $this->db->pdo->prepare($sql);
$query->bindValue(':name', $name);
$query->bindValue(':username', $username);
$query->bindValue(':email', $email);
$query->bindValue(':id', $id);
$result = $query->execute();
    if($result){
        $msg = "<div class='alert alert-success'> <strong>Update Successfully! </strong> Thank you.</div>";
        return $msg;
    }else{
        $msg = "<div class='alert alert-danger'> <strong> Sorry! </strong> Please Contact Admin</div>";
        return $msg;
    }   
}
}

?>