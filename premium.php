<?php
session_start();
include_once 'header.php';

if(isset($_POST['logoff'])){
    session_destroy();
    header("Location: index.php");
}

if(!isset($_SESSION['user_name'])){
    header("Location: register2.php");
}
else if(!isset($_SESSION['user_gender'])){
    header("Location: register3.php");
}

$uid = $_SESSION['user_id'];
$ugender = $_SESSION['user_gender'];
$user_likes = "SELECT user.id, user.name, photo.url FROM user INNER JOIN photo ON photo.user_id = user.id WHERE user.gender != '$ugender'";

$premium = 0;
$ispremium = "SELECT role_id, end_time FROM user_role WHERE user_id = '$uid'";
if(mysqli_query($conn, $ispremium)){
    $result = mysqli_query($conn, $ispremium);
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
    if($row != null && $row['role_id'] == 3){
        if(date("Y-m-d H:i:s") < $row['end_time']){
            $premium = 1;
        }
    }
}
else {
    echo "error: " . mysqli_error($conn);
}

?>

<section class="mainpage">
<aside class="sidebar">
    <section class="user-name-block">
    <img class="profile-picture" src="<?php echo $_SESSION['user_pic'] ?>" alt="User's profile picture">
    <h2 class="user-name"><?php echo $_SESSION['user_name'] ?></h2>
    </section>
    <nav>
        <a class="navbutton" href="home.php">Pagrindinis</a>
        <a class="navbutton" href="matches.php">Atitikimai</a>
        <a class="navbutton" href="messages.php">Pranešimai</a>
        <a class="navbutton active" href="premium.php">Premium</a>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" name="logoff" class="navbutton logoff input-submit-disable" value="Atsijungti">
        </form>
    </nav>
</aside>

<section class="workspace">
    

<?php

if(mysqli_query($conn, $user_likes)){
    $result = mysqli_query($conn, $user_likes);
    if($premium == 1){
        echo '<section class="matches-preview">';
        while($row = mysqli_fetch_array($result)){

            echo '<a href="message.php?usrmsg=' . $row['id'] . '">' .
    '<section class="matchbox-small">' .
    '<img class="match-picture-small" src="' . $row['url'] . '" alt="">' .
    '<div class="txtcover">' . $row['name'] . '</div>' .
    '</section>' .
    '</a>';
    
}

    }
    else {
        echo '<section class="matches-preview blur">';
        while($row = mysqli_fetch_array($result)){

            echo '<section class="matchbox-small">' .
    '<img class="match-picture-small" src="' . $row['url'] . '" alt="">' .
    '<div class="txtcover">' . $row['name'] . '</div>' .
    '</section>';
    
}

    }
    
    mysqli_free_result($result);
    }
    else {
        echo "error: " . mysqli_error($conn);
      }

?>

</section>
</section>
</section>

<?php
include_once 'footer.php';
?>