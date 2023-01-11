<?php
include "db/db.php";

$todo_obj = new db();
//==========================================================
function addTodo($title, $body, $img, $user_id) {
    global $todo_obj;
    $todo = [
        "title" => $title,
        "body" => $body,
        "img" => $img,
        "user_id" => $user_id
    ];
    $todo_obj->insert("todos", $todo)->execute();
    return mysqli_affected_rows($todo_obj->connection);
}
//==========================================================
function get_todos($id) {
    // selet add to dodos of the current user_id and return the result
    global $todo_obj;
    $res =$todo_obj->select('todos',"*")->where('user_id',"=","$id")->get_select_query();
    return $res;
}
//==========================================================
function upload_img($file) {
    $filetmp = $_FILES['img']['tmp_name'];
    $img = $_FILES['img']['name'];
    move_uploaded_file($filetmp, "upload/" . $img);
    return $img;
}
//==========================================================
function delete ($table_name,$id) {
    global $todo_obj;
    return $todo_obj->delete($table_name)->where("id","=",$id)->execute();
}
// ==========================================================
function get_ids($table_name): array {
    global $todo_obj;
    return $todo_obj->select($table_name, "id")->get_select_query();
}
//==========================================================
function update_todo($table_name, $id , $title , $body , $img) {
    global $todo_obj;
    if (empty($img)) {
        $update_todo = [
            "title" => $title,
            "body" => $body,

        ];
    } else {
        $update_todo = [
            "title" => $title,
            "body" => $body,
            "img" => $img,
        ];
    }
    return $todo_obj->update($table_name,$update_todo)->where("id","=","$id")->execute();
}
function selcet_todo($id){
    global $todo_obj;
    $row = $todo_obj->select("todos","*") ->where("id","=","$id")->get_row();
    return $row ;
}