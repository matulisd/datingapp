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

if(isset($_GET['usrmsg'])){
    $_SESSION['usrmsg'] = $_GET['usrmsg'];
    header("Location: message.php");
}

$uid = $_SESSION['user_id'];
$muid = $_SESSION['usrmsg'];
$premium = 0;

$ispremium = "SELECT role_id, end_time FROM user_role WHERE user_id = '$uid'";
if(mysqli_query($conn, $ispremium)){
    $result = mysqli_query($conn, $ispremium);
    $row = mysqli_fetch_array($result);
    mysqli_free_result($result);
    if($row != null && $row['role_id'] == 3){
        if(date("Y-m-d H:i:s") < $row['end_time']){
            $premium = 1;
            $get_usr = "SELECT user.id, user.name, user.description, user.birth_date, photo.url FROM user INNER JOIN photo ON photo.user_id = user.id WHERE user.id = '$muid'";
            if(mysqli_query($conn, $get_usr)){
                $result = mysqli_query($conn, $get_usr);
                $rrow = mysqli_fetch_array($result);
                mysqli_free_result($result);
                if($row != null){
                    $msg_user = $rrow['name'];
                    $msg_description = $rrow['description'];
                    $msg_age = (int)date("Y-m-d") - (int)$rrow['birth_date'];
                    $msg_img = $rrow['url'];
                }
            }
        }
    }
}
else {
    echo "error: " . mysqli_error($conn);
}

$user_likes = "SELECT user.id, user.name, user.description, user.birth_date, photo.url, matches.response FROM user INNER JOIN photo ON photo.user_id = user.id INNER JOIN matches ON matches.user_id = user.id AND matches.matched_user_id = '$uid' WHERE matches.response = 'true' AND user.id = '$muid'";
if(mysqli_query($conn, $user_likes)){
    $result = mysqli_query($conn, $user_likes);
    $row = mysqli_fetch_array($result);
    if($row != null){
        $msg_user = $row['name'];
        $msg_description = $row['description'];
        $msg_age = (int)date("Y-m-d") - (int)$row['birth_date'];
        $msg_img = $row['url'];
        $liked_by_user = "SELECT response FROM matches WHERE user_id = '$uid' AND matched_user_id = '$muid'";
        if(mysqli_query($conn, $liked_by_user)){
            $result2 = mysqli_query($conn, $liked_by_user);
            $match_check = mysqli_fetch_array($result2);
            mysqli_free_result($result2);
            if($match_check == null || $match_check['response'] != 'true'){
                if($premium == 0){
                    header("Location: index.php");
                }
            }
        }
        else {
            echo "error: " . mysqli_error($conn);
          }
    }
    else{
        if($premium == 0){
            header("Location: index.php");
        }
    }

    mysqli_free_result($result);
    }
else {
    echo "error: " . mysqli_error($conn);
    }

    if(isset($_POST['msgsubmit'])){
        if(!empty($_POST['msgtxt'])){
            $msgtxt = mysqli_real_escape_string($conn, $_POST['msgtxt']);
            $timestamp = date("Y-m-d H:i:s");
            $sendmsg = "INSERT INTO message (participant_id, receiver_id, text, timestamp) VALUES ('$uid', '$muid', '$msgtxt', '$timestamp')";
            if(mysqli_query($conn, $sendmsg)){
                // header("Refresh:0");
            }
            else{
                echo "error: " . mysqli_error($conn);
            }
        }
        $error = 'tuscia';
    }

    if(isset($_POST['report'])){
        echo '<script>alert("Pranesta");</script>';
    }

    if(isset($_POST['unmatch'])){
        $unmatch = "UPDATE matches SET response='false' WHERE user_id = '$uid' AND matched_user_id = '$muid'";
        $unmatch2 = "UPDATE matches SET response='false' WHERE user_id = '$muid' AND matched_user_id = '$uid'";
        $deletemsg = "UPDATE message SET participant_id = participant_id * -1, receiver_id = receiver_id * -1 WHERE (participant_id = '$uid' AND receiver_id = '$muid') OR (participant_id = '$muid' AND receiver_id = '$uid')";
        if(mysqli_query($conn, $unmatch)){
            if(mysqli_query($conn, $unmatch2)){
               if(mysqli_query($conn, $deletemsg)){
                    header("Location: messages.php");
                }
                else {
                    echo "error: " . mysqli_error($conn);
                } 
            }
            else {
                echo "error: " . mysqli_error($conn);
            }
          }
          else {
            echo "error: " . mysqli_error($conn);
          }
    }


include_once 'header.php';
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
        <input type="submit" name="logoff" class="navbutton logoff input-submit-disable" value="Atsijungti"></input>
        </form>
    </nav>
</aside>

<section class="workspace">
<section class="messages-grid">

<section class="messages-box">
    <section class="chat-block">
    
    <?php

$getmessages = "SELECT participant_id, text, timestamp FROM message WHERE (participant_id = '$uid' AND receiver_id = '$muid') OR (participant_id = '$muid' AND receiver_id = '$uid') ORDER BY timestamp ASC";
if(mysqli_query($conn, $getmessages)){
    $result = mysqli_query($conn, $getmessages);
    if(mysqli_num_rows($result) > 0){
      while($msg = mysqli_fetch_array($result)){
        if($msg['participant_id'] == $uid){
            echo '<div class="message sent">' .
            '<p class="timestamp">' . $msg['timestamp'] . '</p>' .
            '<p>' . $msg['text'] . '</p>' .
            '</div>';
        }
        else{
            echo '<div class="message">' .
            '<p class="timestamp">' . $msg['timestamp'] . '</p>' .
            '<p>' . $msg['text'] . '</p>' .
            '</div>';
        }
      }
    }
    mysqli_free_result($result);
  }

?>

    </section>
    <form autocomplete="off" class="chatbox" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <input name="msgtxt" class="msginput form-control login-input" type="text" placeholder="Rašyti žinutę..">
        <input name="msgsubmit" class="msgsend form-control login-input" type="submit" value="Siųsti">
    </form>
</section>

<section class="messages-box">
<section class="preview-inchat">
        <button class="photo-switch switch-left"><img src=".\img\arrow_left.svg" alt="Arrow left"></button>
        <button class="photo-switch switch-right"><img src=".\img\arrow_right.svg" alt="Arrow right"></button>
        <img class="match-picture" src="<?php echo $msg_img ?>">
</section>
<section class="profile-info-inchat">
<p class="match-info-inchat"><?php echo $msg_user . ", " . $msg_age ?></p>
        <div class="line"></div>
        <p class="description-txt"><?php echo $msg_description ?></p>
        <div class="line"></div>

        <section class="interest-box">
        <?php
        $get_interests = "SELECT interests.interest_description FROM interests INNER JOIN user_interests ON interests.id = user_interests.interest_id AND user_interests.user_id = '$muid'";
        if(mysqli_query($conn, $get_interests)){
          $result = mysqli_query($conn, $get_interests);
          if(mysqli_num_rows($result) > 0){
            while($row2 = mysqli_fetch_array($result)){
                echo '<div class="interest">' . $row2['interest_description'] . '</div>';
            }
          }
          mysqli_free_result($result);
        }
        ?>
        </section>
        
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <input type="submit" name="report" class="inchat-btn" value="Pranešti"></input>
        <input type="submit" name="unmatch" class="inchat-btn nomargin" value="Atšaukti atitikimą"></input>
    </form>
</section>
</section>

</section>
</section>

<?php
include_once 'footer.php';
?>