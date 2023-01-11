<?php
include "db/db.php";
$users = new db();
function insert_user($name, $email, $password) {
    global $users;
    $user = [
        "name" => $name,
        "email" => $email,
        "password" => $password
    ];
    $users->insert("users",$user)->execute();
    return mysqli_affected_rows($users->connection);
}
function cheekEmailAndPassword($email, $password) {
    global $users;
    return $users->select("users", "*")->where("email", " = ", "$email",
        " AND `password` = '$password' ")->get_row();
}
