<?php
include "database.php";
include "session.php";
class user{
    public $db;
    public function __construct(){
        $this->db = new database();
    }
    public function regcreat($data){
        $name = $data['name'];
        $email = $data['email'];
        $echeck = $this->emailcheck($email);
        $password = $data['pswd'];
        $confirm = $data['cpswd'];

        if($name=="" || $email=="" || $password=="" || $confirm==""){
            $msg = "<div>please full fill your form..</div>";
            return $msg;
        }

        if(strlen($password)<4 && strlen($confirm)<4){
            $msg = "<div>Your password is too short..</div>";
            return $msg;
        }

        if($password!=$confirm){
            $msg = "<div>Your password are not same..</div>";
            return $msg;
        }

        if($echeck==true){
            $msg = "<div>Your email already exists..</div>";
            return $msg;
        }

        $sql = "INSERT INTO student2( name, email, password, confirm) VALUES (:name,:email,:password,:confirm)";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $query->bindValue(':confirm',$confirm);
        $res = $query->execute();
        if($res){
            $msg = "<div>insert successfull..</div>";
            return $msg;
        }
        else{
            $msg = "<div>insert error..</div>";
            return $msg;
        }

    }

    public function emailcheck($email){
        $sql = "SELECT * FROM student2 WHERE email = :email";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if($query->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function dbdecode($email,$password){
        $sql = "SELECT * FROM student2 WHERE email = :email  && password = :password LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;

    }

    public function logincreat($data){
        $email = $data['email'];
        $password = $data['pswd'];

        if($email=="" || $password==""){
            $msg = "<div>please full fill your form..</div>";
            return $msg;
        }

        if(strlen($password)<4 && strlen($confirm)<4){
            $msg = "<div>Your password is too short..</div>";
            return $msg;
        }

        if(filter_var($email,FILTER_VALIDATE_EMAIL)==false){
            $msg = "<div>Your email does not valid..</div>";
            return $msg;
        }

        $res = $this->dbdecode($email,$password);
        if($res){
            session::init();
            session::set("login",true);
            session::set("id",$res->id);
            session::set("name",$res->name);
            session::set("email",$res->email);
            session::set("logmsg","<div>you are log in..</div>");
            header("Location: index.php");
        }
        else{
            $msg = "<div>Your data not found..</div>";
            return $msg;
        }
    }
    public function duser(){
        $sql = "SELECT * FROM student2";
        $query = $this->db->pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

    public function userdata($id){
        $sql = "SELECT * FROM student2 WHERE id = :id LIMIT 1";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':id',$id);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function updata($id,$data){
        $name = $data['name'];
        $email = $data['email'];
        

        if($name=="" || $email==""){
            $msg = "<div>please full fill your form..</div>";
            return $msg;
        }


        $sql = "UPDATE student2 SET
         name=:name,
         email=:email 
         WHERE id = :id";
        $query = $this->db->pdo->prepare($sql);
        $query->bindValue(':name',$name);
        $query->bindValue(':email',$email);
        $query->bindValue(':id',$id);
        $res = $query->execute();
        if($res){
            $msg = "<div>update successfull..</div>";
            return $msg;
        }
        else{
            $msg = "<div>update error..</div>";
            return $msg;
        }

    }
    
}

?>