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
    <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<header>

<nav class="navbar">
<h1>BooBoo</h1>

<?php  
    $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"],"/") + 1);  

    if ($curPageName == "index.php"){
        echo "</nav>";
    }
    else {
        echo '<button class="button-black">asdf</button>
        <button class="button-black">asdf</button>
        </nav>';
    }
  ?> 

</header>


