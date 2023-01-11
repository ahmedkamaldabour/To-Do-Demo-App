<?php
session_start();
include "inc/val.php";
include "inc/todo_db.php";
if (empty($_SESSION['login'])) {
    redirect_to("login");
}
if (isset($_POST['save'])) {
    foreach ($_POST as $key => $val)
        $$key = Sanitization($val);
    $img = upload_img($_FILES);
    $res = update_todo("todos", $id, $title, $body, $img);
    if ($res === 1) {
        redirect_to("index");
    } else {
        redirect_to("update");
    }
} else {
    if (!isset($_GET['id'])) {
        redirect_to("index");
    }
    $all_todo_id = get_ids("todos");
    $ids = [];
    foreach ($all_todo_id as $todos)
        foreach ($todos as $todo)
            $ids[] = $todo;
    $r = in_array($_GET['id'], $ids);
    if ($r != 1) {
    redirect_to("index");
    }
    $row = selcet_todo($_GET['id']);
}
include "inc/header.php";
include "_form.php";
include "inc/footer.php";
