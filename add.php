<?php
session_start();
include "inc/todo_db.php";
include "inc/val.php";
if (empty($_SESSION['login'])) {
    redirect_to("login");
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST as $key => $value) {
        $$key = Sanitization($value) ;
    }
    $img=upload_img($_FILES);
    $user_id = $_SESSION['login']['id'];
    $res = addTodo($title,$body, $img,$user_id);
    if($res === 1){
        redirect_to("index");
    }

}


include "inc/header.php";
include "_form.php";
include "inc/footer.php";
