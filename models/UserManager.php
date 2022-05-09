<?php
include_once "PDO.php";

function GetOneUserFromId($id)
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user WHERE id = $id");
  return $response->fetch();
}

function GetAllUsers()
{
  global $PDO;
  $response = $PDO->query("SELECT * FROM user ORDER BY nickname ASC");
  return $response->fetchAll();
}

function GetUserIdFromUserAndPassword($user, $pwd){
    global $PDO;

    $data = ["user" => $user,
             "pwd" => $pwd
        ]   ;

    $sql = "select * from user WHERE user.nickname = :user and user.password = :pwd";

    $stmt = $PDO->prepare($sql);
    $response = $stmt->execute($data);
    if ($response === false){
        return -1;
    }else{
        $user = $stmt->fetch();
        var_dump($user);
        return $user["id"];
    }
}
