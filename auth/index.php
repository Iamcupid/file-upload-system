<?php
session_start();
$pageName = "Login";
require '../includes/header.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
  header("Location: ../index.php");
  exit();
}

if (isset($_POST['login'])) {
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $pass = $_POST['password'];
  $users = file("users.sk");
  foreach ($users as $user) {
    list($id, $fn, $ln, $un, $em, $pw, $rl) = explode("|", $user);
    if (($email == $em || $uname == $un) && password_verify($pass, $pw)) {
      $_SESSION['loggedIn'] = true;
      $_SESSION['fname'] = $fn;
      $_SESSION['lname'] = $ln;
      $_SESSION['uname'] = $un;
      $_SESSION['email'] = $em;
      $_SESSION['role'] = $rl;
      break;
    }
  }
  if ($_SESSION['loggedIn'] = true) {
    header("Location: ../index.php");
  } else {
    $msg = "Email or Password do not match";
    header("Location: index.php?message=" . urlencode($msg));
  }
}
?>
<main>
<section class="flex items-center justify-center h-screen">
  <div class="block bg-blue-100 rounded-md shadow-md shadow-gray-300 px-6 py-8 w-96">
    <div class="block mb-4">
      <h4 class="text-xl text-white text-center font-bold bg-blue-300 rounded-md px-6 py-2">Login Here</h4>
      <p class="text-sm text-red-500 text-center font-medium mt-4"><?= isset($_GET['message']) ? $_GET['message'] : '' ?></p>
    </div>
    <form action="" method="post">
      <div class="my-4">
        <label for="auth">
          <span class="text-base text-gray-900 font-bold">Username or Email</span>
        </label>
        <div class="flex items-center relative my-1.5">
          <input type="text" name="email" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="auth" placeholder="Username or Email" required />
        </div>
      </div>
      <div class="my-4">
        <label for="password">
          <span class="text-base text-gray-900 font-bold">Password</span>
        </label>
        <div class="flex items-center relative my-1.5">
          <input type="password" name="password" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="Password" placeholder="password" minlength="8" required />
        </div>
      </div>
      <div class="mt-6">
        <button type="submit" name="login" class="block text-base font-bold text-white bg-blue-400 hover:bg-blue-500 rounded-md px-4 py-1.5 w-full" >Login</button>
      </div>
    </form>
    <div class="flex items-center justify-center gap-2 mt-4 mb-0">
      <p>Need an account.</p>
      <a href="register.php">Register Here</a>
    </div>
  </div>
</section>
</main>

<?php require '../includes/footer2.php'; ?>