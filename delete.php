<?php
session_start();
include "inc/todo_db.php";
include "inc/val.php";
if (empty($_SESSION['login'])) {
    redirect_to('login');
}
$all_todo_id = get_ids("todos");
$ids = [];
foreach ($all_todo_id as $todos)
    foreach ($todos as $todo)
        $ids[] = $todo;
$r = in_array($_GET['id'], $ids);
$img = $_GET['img'];
if (isset($_GET['id']) && $r == 1) {
    delete("todos", $_GET['id']);
    unlink("upload/$img");
    redirect_to("index");
} else {
    echo "NOT FOUND";
}