<?php
session_start();
$pageName = "Register";
require '../includes/header.php';

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
  header("Location: ../index.php");
  exit(); // Stop executing the rest of the code
}

if (isset($_POST['register'])) {
  $id = time();
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $uname = $_POST['uname'];
  $email = $_POST['email'];
  $pass1 = $_POST['password'];
  $pass2 = $_POST['c_password'];
  $role = 0;

  // Validate email format
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $msg = "Invalid email format";
    header("Location: register.php?message=" . urlencode($msg));
    exit(); // Stop executing the rest of the code
  }

  // Check if email is already registered
  if (isEmailRegistered($email)) {
    $msg = "Email is already registered";
    header("Location: register.php?message=" . urlencode($msg));
    exit(); // Stop executing the rest of the code
  }

  // Check if email is already registered
  if (isUnameTaken($uname)) {
    $msg = "Username already taken";
    header("Location: register.php?message=" . urlencode($msg));
    exit(); // Stop executing the rest of the code
  }

  if ($pass1 == $pass2) {
    if (strlen($pass1) < 8 || !preg_match('/^[a-zA-Z0-9:@$_\-\+.,]+$/', $pass1)) {
      $msg = "Password should have a minimum length of 8 characters and contain only a-zA-Z0-9 and special characters: : @$_-+.,";
      header("Location: register.php?message=" . urlencode($msg));
      exit(); // Stop executing the rest of the code
    }
    $users = fopen("users.sk", "a");
    $info = $id . "|" . $fname . "|" . $lname . "|" . $uname . "|" . $email . "|" . password_hash($pass1, PASSWORD_DEFAULT) . "|" . $role . "|\n";
    fwrite($users, $info);
    fclose($users);
    $msg = "Registration Successfull";
    header("Location: index.php?message=" . urlencode($msg));
  } else {
    $msg = "Password not matched";
    header("Location: register.php?message=" . urlencode($msg));
  }
}

function isEmailRegistered($email) {
  $users = file("users.sk");
  foreach ($users as $user) {
    list($id, $fn, $ln, $un, $em, $pw, $rl) = explode("|", $user);
    if ($email == $em) {
      return true; // Email is already registered
    }
  }
  return false; // Email is not registered
}

function isUnameTaken($uname) {
  $users = file("users.sk");
  foreach ($users as $user) {
    list($id, $fn, $ln, $un, $em, $pw, $rl) = explode("|", $user);
    if ($uname == $un) {
      return true; // Email is already registered
    }
  }
  return false; // Email is not registered
}
?>
<main>
<section class="flex items-center justify-center h-screen">
  <div class="block bg-blue-100 rounded-md shadow-md shadow-gray-300 px-6 py-8 w-96">
    <div class="block mb-4">
      <h4 class="text-xl text-white text-center font-bold bg-blue-300 rounded-md px-6 py-2">Register New</h4>
      <p class="text-sm text-red-500 text-center font-medium mt-4"><?= isset($_GET['message']) ? $_GET['message'] : '' ?></p>
    </div>
    <form action="" method="post">
      <div class="my-2.5">
        <label for="name">
          <span class="text-base text-gray-900 font-bold">Full Name</span>
        </label>
        <div class="flex items-center gap-2.5 relative my-1.5">
          <input type="text" name="fname" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="name" placeholder="John" required />
          <input type="text" name="lname" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="name" placeholder="Doe" required />
        </div>
      </div>
      <div class="my-2.5">
        <label for="uname">
          <span class="text-base text-gray-900 font-bold">Username</span>
        </label>
        <div class="flex items-center relative my-1.5">
          <input type="text" name="uname" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="uname" placeholder="eg. johndoe" required />
        </div>
      </div>
      <div class="my-2.5">
        <label for="email">
          <span class="text-base text-gray-900 font-bold">Email Address</span>
        </label>
        <div class="flex items-center relative my-1.5">
          <input type="email" name="email" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="email" placeholder="someone@example.com" required />
        </div>
      </div>
      <div class="grid grid-cols-2 gap-2 5 my-2 5">
        <div class="block">
          <label for="password">
            <span class="text-base text-gray-900 font-bold">Password</span>
          </label>
          <div class="flex items-center relative my-1.5">
            <input type="password" name="password" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="password" placeholder="Password" minlength="8" required />
          </div>
        </div>
        <div class="block">
          <label for="c_password">
            <span class="text-base text-gray-900 font-bold">Confirm Password</span>
          </label>
          <div class="flex items-center relative my-1.5">
            <input type="password" name="c_password" class="block border-2 border-blue-400 focus:outline-none px-4 py-1.5 w-full" id="c_password" placeholder="Password" minlength="8" required />
          </div>
        </div>
      </div>
      <div class="mt-4">
        <button type="submit" name="register" class="block text-base font-bold text-white bg-blue-400 hover:bg-blue-500 rounded-md px-4 py-1.5 w-full" >Register</button>
      </div>
    </form>
    <div class="flex items-center justify-center gap-2 mt-4 mb-0">
      <p>Have an account.</p>
      <a href="index.php">Login Here</a>
    </div>
  </div>
</section>
</main>

<?php require '../includes/footer2.php'; ?>