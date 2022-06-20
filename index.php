
 <?php
include 'functions.php';

// Your PHP code here.

// Home Page template below.
?>
<?php 
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>HOME</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     
     <a href="logout.php">Logout</a>
</body>
</html>

<?php 
}else{
     header("Location: index.php");
     exit();
}
 ?>
<?=template_header('Home')?>

<div class="content">
	<h2>Home</h2>
	<p>Selamat datang, ada yang bisa kami bantu?</p>
</div>

<?=template_footer()?>
