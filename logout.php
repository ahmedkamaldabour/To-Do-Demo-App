<?php
session_start();
include "inc/val.php";

unset($_SESSION['login']);
session_destroy();

redirect_to('login');
