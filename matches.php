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
$user_likes = "SELECT user.id, user.name, photo.url, matches.user_id FROM user INNER JOIN photo ON photo.user_id = user.id INNER JOIN matches ON matches.user_id = user.id AND matches.matched_user_id = '$uid' WHERE matches.response = 'true'";

?>

<section class="mainpage">
<aside class="sidebar">
    <section class="user-name-block">
    <img class="profile-picture" src="<?php echo $_SESSION['user_pic'] ?>" alt="User's profile picture">
    <h2 class="user-name"><?php echo $_SESSION['user_name'] ?></h2>
    </section>
    <nav>
        <a class="navbutton" href="home.php">Pagrindinis</a>
        <a class="navbutton active" href="matches.php">Atitikimai</a>
        <a class="navbutton" href="messages.php">Pranešimai</a>
        <a class="navbutton" href="premium.php">Premium</a>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" name="logoff" class="navbutton logoff input-submit-disable" value="Atsijungti">
        </form>
    </nav>
</aside>

<section class="workspace">
<section class="matches-preview">
    

<?php

if(mysqli_query($conn, $user_likes)){
    $result = mysqli_query($conn, $user_likes);
    
    while($row = mysqli_fetch_array($result)){
        $this_uid = $row['user_id'];
        $liked_by_user = "SELECT response FROM matches WHERE user_id = '$uid' AND matched_user_id = '$this_uid'";
        if(mysqli_query($conn, $liked_by_user)){
            $result2 = mysqli_query($conn, $liked_by_user);
            $match_check = mysqli_fetch_array($result2);
            mysqli_free_result($result2);
            if($match_check != null && $match_check['response'] == 'true'){
                echo '<a href="message.php?usrmsg=' . $row['user_id'] . '">' . 
        '<section class="matchbox-small">' .
        '<img class="match-picture-small" src="' . $row['url'] . '" alt="">' .
        '<div class="txtcover">' . $row['name'] . '</div>' .
        '</section>' .
        '</a>';
            }
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