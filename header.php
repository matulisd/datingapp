<?php
 $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") + 1);

//  header("Content-Type: application/json; charset=UTF-8");
//  header("Access-Control-Allow-Origin: *");
//  session_start();

//  $server = "localhost";
//  $user = "root";
//  $password = "";
//  $database= "datingapp";

//  $conn=new mysqli($server,$user,$password,$database);

//  if ($conn->connect_error){
//      die("connection failed:" . $conn->connect_error);
//      // $output=array("TIPAS"=>"Klaida","ATS"=> "Negaliu prisijungti prie MySQL".$conn->connect_error);
// 	   // output($output);
//  }

require("controllers/config/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating app</title>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Mitr">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styles.css">

</head>
<!-- <body class="<?php if ($curPageName == "index.php" || $curPageName == "register.php" || $curPageName == "register2.php") echo "gradientbg"; ?>"> -->
<body class="gradientbg">

<header>

<?php if ($curPageName == "index.php" || $curPageName == "register.php" || $curPageName == "register2.php" || $curPageName == "register3.php"){
  echo '<nav class="navbar">' .
  '<h1 onclick="location.href = ("index.php");">Pavadinimas</h1>' .
  '</nav>';
}
?>
 <!-- <nav class="navbar">
 <h1 onclick="location.href = ('index.php');">BooBoo</h1>
 </nav> -->

<?php  
   
    // if ($curPageName == "index.php"){
        
    // }
    // else {
        
    // }
  ?> 

</header>


