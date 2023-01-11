<?php
function hash_password($password) {
	return sha1($password);
}
function redirect_to($page_name) {
	header("Location: $page_name.php");
}
function Sanitization($value) {
	return trim(htmlspecialchars(htmlentities($value)));
}
function con_pass($password, $con_password, &$errors) {
	if ($con_password === $password) {
		return true;
	}
	$errors['password'] = "Password and confirmation password must be identical";
	return false;
}
function val_name($val, &$errors) {
	$length = strlen($val);
	if ($length < 3 || $length > 20) {
		$errors['name'] = "must be between 3 and 20 characters";
		return false;
	}
	if (preg_match("![0-9/.,;'\\\[\]]!", $val)) {
		$errors['name'] = "can include any number";
		return false;
	}
	if (!preg_match("![A-Z/.,;'\\\[\]]!", $val)) {
		$errors['name'] = "must have at least one capital character";
		return false;
	}
	return true;
}
function val_email($val, &$errors) {
	$val = filter_var($val, FILTER_SANITIZE_EMAIL);
	if (filter_var($val, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = "is a not valid";
		return false;
	}
	return true;
}
function val_password($val,&$errors) {
	$length = strlen($val);
	if ($length < 8 || $length > 16) {
		$errors['password'] = "must be between 8 and 16 characters";
		return false;
	}
	$uppercase = preg_match('@[A-Z]@', $val);
	$lowercase = preg_match('@[a-z]@', $val);
	$number    = preg_match('@[0-9]@', $val);
//    $specialchars = preg_match('@[^\w]@', $password);
	if( !$uppercase ||!$lowercase || !$number) {
		$errors['password'] = "not valid <br> Password must be at least capital letter and at least on small letter";
		return false;
	}
	return true;
}

function validation($name, $email, $password, $conpassword, &$errors) {
	if (empty($name) || empty($email) || empty($password) || empty($conpassword)) {
		$errors['all'] = "must fill all data";
		return false;
	}
	if (!val_name($name, $errors)) {
		return false;
	}
	if (!val_email($name, $errors)) {
		return false;
	}
	if (!con_pass($password, $conpassword, $errors)) {
		return false;
	}
	if (!val_password($password, $errors)) {
		return false;
	}
	return true;
}