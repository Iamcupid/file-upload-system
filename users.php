<?php
session_start();
$pageName = "Users & Members";
require './includes/header.php';
if(!$_SESSION['loggedIn']){
  header("Location: auth/index.php");
}
?>
<main class="flex bg-white" >
<?php include './includes/sidebar.php' ?>
<div class="w-5/6">
  <section class="mx-4 bg-gray-100 rounded-md p-4 my-12">
    <table class="min-w-full text-left">
      <thead class="border-y-2 border-gray-800 bg-gray-800 text-white font-bold">
        <tr>
          <th scope="col" class="px-4 py-2" >SL</th>
          <th scope="col" class="px-4 py-2" >Name of User</th>
          <th scope="col" class="px-4 py-2" >Email Address</th>
          <th scope="col" class="px-4 py-2" >Action</th>
        </tr>
      </thead>
      <tbody>
      <?php
$users = file("./auth/users.sk");
foreach ($users as $k => $user) {
    $info = explode("|", $user);
    list($fn, $ln, $e, $p) = $info;
    // echo $fn . $ln . $e . "<br>";
    echo "<tr class='border-y-2 border-gray-300 hover:bg-gray-200' >
        <td class='px-4 py-2' >{$k} </td>
        <td class='px-4 py-2' >{$fn} {$ln}</td>
        <td class='px-4 py-2' >{$e}</td>
        <td class='px-4 py-2' >
        <ul class='flex items-center gap-1 text-center'>
      <a href='#' class='block text-blue-500 hover:text-white hover:bg-blue-500 border-2 border-blue-500 rounded-md py-0.5 w-8 h-8'>
        <i class='fas fa-edit'></i>
      </a>
      <a href='#' class='block text-green-500 hover:text-white hover:bg-green-500 border-2 border-green-500 rounded-md py-0.5 w-8 h-8'>
        <i class='fas fa-eye'></i>
      </a>
      <a href='#' class='block text-red-500 hover:text-white hover:bg-red-500 border-2 border-red-500 rounded-md py-0.5 w-8 h-8'>
        <i class='fas fa-trash-alt'></i>
      </a>
    </ul>
        </td>
    </tr>";
}
?>
      </tbody>
    </table>
  </section>
</div>
</main>
<?php require './includes/footer.php'; ?>