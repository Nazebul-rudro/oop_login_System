<?php

class Database{
    private $hostdb = "localhost";
    private $username = "root";
    private $password = "";
    private $namebd = "dblogin";
    public $pdo;
    function __construct()
    {
        if(!isset($this->pdo)){
            try{
                $link = new PDO('mysql:host='.$this->hostdb. ";dbname=".$this->namebd,$this->username, $this->password);
                $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link->exec('SET CHARACTER SET utf8');
                $this->pdo = $link;
            }catch(PDOException $e){
                die('Failed to connect with Database'. $e->getMessage());
            }
        }
    }
}
?>