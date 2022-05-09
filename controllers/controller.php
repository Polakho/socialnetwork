<?php

$action = $_GET["action"] ?? "display";

switch ($action) {

  case 'register':
    // code...
    break;

  case 'logout':
    // code...
    break;

  case 'login':
    // code...
    break;

  case 'newMsg':
    // code...
    break;

  case 'newComment':
    // code...
    break;

  case 'display':
  default:
    include "../models/PostManager.php";
    if (isset($_GET['search'])) {
        $posts = SearchInPosts($_GET['search']);
    } else {
        $posts = GetAllPosts();
    }


    include "../models/CommentManager.php";
    $comments = array();

    foreach ($posts as $post){
        $id = $post["id"];
        $comments[$id] = GetAllCommentsFromPostId($id);
    }
    include "../views/DisplayPosts.php";
    break;
}
