<?php
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $users = file("users.sk");
    $loggedIn = false;
    foreach ($users as $user) {
      list($e, $p) = explode("|", $user);
      if ($email == $e && $pass == $p) {
        $loggedIn = true;
        break;
      }
    }
    if ($loggedIn) {
      header("Location: index.php");
      exit();
    } else {
      $error = "Email or Password do not match";
      header("Location: auth/login.php?message=" . urlencode($error)); // Redirect with error message
      exit();
    }
}
?>