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
        <a class="navbutton active" href="messages.php">Pranešimai</a>
        <a class="navbutton" href="premium.php">Premium</a>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" name="logoff" class="navbutton logoff input-submit-disable" value="Atsijungti">
        </form>
    </nav>
</aside>

<section class="workspace">
<section class="msg-grid">


<?php

        $get_conversations = "SELECT user.name, user.id, photo.url FROM user INNER JOIN message ON message.participant_id = user.id OR message.receiver_id = user.id INNER JOIN photo ON photo.user_id = user.id WHERE (message.participant_id = '$uid' OR message.receiver_id = '$uid') AND user.id != '$uid' GROUP BY user.id ORDER BY message.timestamp DESC";
        if(mysqli_query($conn, $get_conversations)){
          $result = mysqli_query($conn, $get_conversations);
          if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                echo '<a class="msg-pre-a" href="message.php?usrmsg=' . $row['id'] . '">' .
                '<section class="msg-preview">' .
                '<img class="msg-pre-img" src="' . $row['url'] . '" alt="User profile picture">' .
                '<div>' .
                '<p class="msg-pre-name">' . $row['name'] . '</p>' .
                '</div>' .
                '</section>' .
                '</a>';
            }
          }
          else {
            echo "Kol kas neturite pradėtų pokalbių..";
          }
          mysqli_free_result($result);
        }

?>

</section>
</section>
</section>

<?php
include_once 'footer.php';
?>