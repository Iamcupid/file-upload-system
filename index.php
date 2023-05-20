<?php
session_start();
$pageName = "Homepage";
require './includes/header.php';
if(!$_SESSION['loggedIn']){
  header("Location: auth/index.php");
}
?>
<main class="flex bg-white" >
<?php include './includes/sidebar.php' ?>
<div class="w-5/6">
  <section class="mx-4 my-12">
  </section>
</div>
</main>
<?php require './includes/footer.php'; ?>