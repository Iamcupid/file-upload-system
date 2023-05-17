<?php
$pageName = "Homepage";
require './includes/header.php';
if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $users = file("users.sk");
    $loggedIn = false;
    foreach ($users as $user) {
      list($fn, $ln, $e, $p) = explode("|",$user);
      if ($email == $e && password_verify($pass, $p) ) {
        $loggedIn = true;
        break;
      }
    }
    if ($loggedIn) {
      echo "Welcome $email";
    } else {
      header("location:auth/login.php");
    }
} else {
  header("location:auth/login.php");
}
?>

<!-- Add your index.php content here -->
<a href="./auth//login.php">Login</a>

<?php require './includes/footer.php'; ?>