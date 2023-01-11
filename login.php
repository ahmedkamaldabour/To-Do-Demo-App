<?php
session_start();
include_once "inc/users.php";
include_once "inc/val.php";
$errors = [
    "email" => '',
    "password" => ''
];
$notLogged = false;
$emailORpassword = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        // sanitize and assign the value to the variable
        $$key = Sanitization($value);
    }
    $hash_password = hash_password($password);
    // cheek is email and password are in the database
    $row = cheekEmailAndPassword($email, $hash_password);
    if (!empty($row['id'])) {
        $_SESSION['login'] = $row ;
        redirect_to('index');
    }else{
        $notLogged = true;
        $emailORpassword = "Email or Password is wrong";
    }
}
include_once "inc/header.php";
?>

    <p><h1>LOGIN <?php if($notLogged) echo "-----> $emailORpassword"?></h1></p>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
        <label for="email">Email <?php if ($errors['email']) echo " -----> " . $errors['email'] ?></label>
        <input type="email" name="email" id="email" value="<?php echo $_POST['email'] ?? '' ?>">

        <label for="password">Password <?php if ($errors['password']) echo " -----> " . $errors['password'] ?></label>
        <input type="password" name="password" id="password">

        <button type="submit" name="login" id="login">Login</button>
        <a href="reg.php"> Sign in</a>
    </form>



<?php
include_once "inc/footer.php";
?>