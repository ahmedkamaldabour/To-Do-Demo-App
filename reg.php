<?php
include_once "inc/users.php";
include_once "inc/val.php";

$errors = [
    "all" => '',
    "name" => '',
    "email" => '',
    "password" => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // first get the values from post
    foreach ($_POST as $key => $value) {
        $$key = Sanitization($value) ;
    }
    // second cheek the data is valid and password == confirmation password
    $is_valid = validation($name, $email, $password, $conpassword, $errors);
    if ($is_valid) {
        // also hash the password
        $hash_password = hash_password($password);
        //third if the data is valid >>>>  insert the user in the database
        $effected_row = insert_user($name, $email, $hash_password);
        if($effected_row === 1){
            redirect_to('login');
        }

    }
}
include_once "inc/header.php";
?>
    <b><h3> Registration : Fill All Inputs <?php if ($errors['all'])echo " -----> " . $errors['all'] ?></h3></b>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" novalidate>
        <label for="name">Name <?php if ($errors['name'])echo " -----> " . $errors['name'] ?></label>
        <input type="text" name="name" id="name" value="<?php echo $_POST['name']??'' ?>">

        <label for="email">Email <?php if($errors['email']) echo " -----> " . $errors['email'] ?></label>
        <input type="email" name="email" id="name" value="<?php echo $_POST['email']??'' ?>">

        <label for="password">Password <?php if($errors['password']) echo " -----> " . $errors['password'] ?></label>
        <input type="password" name="password" id="password">

        <label for="conpassword">Confirm Password</label>
        <input type="password" name="conpassword" id="conpassword">

        <button type="submit" name="signup" id="signup">Login</button>
        <p>H have an account already</p>
        <a href="login.php">login  </a>
    </form>

<?php
include_once "inc/footer.php";
?>