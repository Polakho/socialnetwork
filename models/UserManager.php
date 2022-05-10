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

function GetUserIdFromUserAndPassword($user, $pwd)
{
    global $PDO;

    $data = ["user" => $user,
        "pwd" => $pwd
    ];

    $sql = "select * from user WHERE user.nickname = :user and user.password = MD5(:pwd)";

    $stmt = $PDO->prepare($sql);
    $response = $stmt->execute($data);
    if ($response === false) {
        return -1;
    } else {
        $user = $stmt->fetch();
        return $user["id"];
    }
}
    function IsNicknameFree($nickname)
    {
        global $PDO;
        $response = $PDO->prepare("SELECT * FROM user WHERE nickname = :nickname ");
        $response->execute(
            array(
                "nickname" => $nickname
            )
        );
        return $response->rowCount();
    }

    function CreateNewUser($nickname, $password)
    {
        global $PDO;
        $response = $PDO->prepare("INSERT INTO user (nickname, password) values (:nickname , MD5(:password))");
        $response->execute(
            array(
                "nickname" => $nickname,
                "password" => $password
            )
        );
        return $PDO->lastInsertId();

    }
