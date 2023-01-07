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

$latitude = $_COOKIE['x'];
$longitude = $_COOKIE['y'];
$uid = $_SESSION['user_id'];
//https://rapidlasso.com/2019/05/06/how-many-decimal-digits-for-storing-longitude-latitude/#:~:text=Longitude%20and%20latitude%20coordinates%20are,right%20of%20the%20decimal%20points.

if(!empty($_COOKIE['x'])) {
$geolocation_check = "SELECT latitude, longitude FROM user_geolocation WHERE user_id ='$uid'";
$result = mysqli_query($conn, $geolocation_check);
$geolocation = mysqli_fetch_array($result);
mysqli_free_result($result);
if($geolocation == null){
    $insert_geolocation = "INSERT INTO user_geolocation (user_id, latitude, longitude) VALUES ('$uid', '$latitude', '$longitude')";
    if(!mysqli_query($conn, $insert_geolocation)){
        echo "error: " . mysqli_error($conn);
    }
}
else {
if($geolocation['latitude'] != $_COOKIE['x'] || $geolocation['longitude'] != $_COOKIE['y']){
    $query = "UPDATE user_geolocation SET latitude = '$latitude', longitude = '$longitude' WHERE user_id = '$uid'";
     if(!mysqli_query($conn, $query)){
         $_SESSION['user_email'] = $email;
                     echo "error: " . mysqli_error($conn);
                 }
            }
        }
    }

    // $getuser = "SELECT user.id, user.name, user.description, user.gender, match.response FROM user LEFT JOIN match ON user.user_id = match.matched_user_id WHERE match.user_id = '$uid'";

    if($_SESSION['user_gender'] == "V"){
        $prefered_gender = "M";
    }
    else{
        $prefered_gender = "V";
    }

    $getuser = "SELECT user.id as userid, user.name as username, user.description as description, user.gender, user.birth_date, matches.user_id, 
    matches.matched_user_id, matches.response, user_geolocation.latitude, user_geolocation.longitude, photo.url FROM user 
    LEFT JOIN matches ON user.id = matches.matched_user_id AND matches.user_id = '$uid' 
    LEFT JOIN user_geolocation on user.id = user_geolocation.user_id 
    LEFT JOIN photo on user.id = photo.user_id
    WHERE user.name is not null AND user.id != '$uid' and user.gender = '$prefered_gender' and matches.response is null";

    // echo "as: " . $_SESSION['user_name'] . " uid: " . $_SESSION['user_id'] . " -> ";

    if(mysqli_query($conn, $getuser)){
        $result = mysqli_query($conn, $getuser);
        // $usser = mysqli_fetch_all($result, MYSQLI_ASSOC);
        // var_dump($usser);
        // mysqli_free_result($result);
        // echo "count: " . mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);
        if($row != null){
            $matched_id = $row['userid'];
        $matched_name = $row['username'];
        $matched_description = $row['description'];
        $matched_photo = $row['url'];
        $matched_age = (int)date("Y-m-d") - (int)$row['birth_date'];
        }
        
        // foreach($usser as $usr){
        //     // var_dump($usser);
        //     echo $usser[0];
        //     // echo $usser['username'];
        //     echo " +++ ";
        //     $count++;
        // }
        // echo "count: " . $count;
        mysqli_free_result($result);

    }
    else {
        echo "error: " . mysqli_error($conn);
      }
if($row != null){
if(isset($_POST['yes'])){
    $matchinfo = "INSERT INTO matches (user_id, matched_user_id, response) VALUES ('$uid', '$matched_id ', 'true')";
        if(!mysqli_query($conn, $matchinfo)){
          echo "error: " . mysqli_error($conn);
        }
}

if(isset($_POST['no'])){
    $matchinfo = "INSERT INTO matches (user_id, matched_user_id, response) VALUES ('$uid', '$matched_id ', 'false')";
        if(!mysqli_query($conn, $matchinfo)){
          echo "error: " . mysqli_error($conn);
        }        
}
}



?>

<section class="mainpage">
<aside class="sidebar">
    <section class="user-name-block">
    <img class="profile-picture" src=".\img\usr_img\dd\Screenshot_5.jpg" alt="User's profile picture">
    <h2 class="user-name"><?php echo $_SESSION['user_name'] ?></h2>
    </section>
    <nav>
        <a class="navbutton active" href="home.php">Pagrindinis</a>
        <a class="navbutton" href="matches.php">Atitikimai</a>
        <a class="navbutton" href="messages.php">Pranešimai</a>
        <a class="navbutton" href="premium.php">Premium</a>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" name="logoff" class="navbutton logoff input-submit-disable" value="Atsijungti"></input>
        </form>
    </nav>
</aside>

<section class="matchbox">
<?php

if($row != null){

    echo '<section id="profile">' .
    '<section class="match-preview">' .
        '<button class="photo-switch switch-left"><img src=".\img\arrow_left.svg" alt="Arrow left"></button>' .
        '<button class="photo-switch switch-right"><img src=".\img\arrow_right.svg" alt="Arrow right"></button>' .
       ' <img class="match-picture" src="' . $matched_photo . '">' .
    '</section>' .
    '<section class="match-info">' .
        '<p class="match-info-txt">' . $matched_name . ', ' . $matched_age . '</p>' .
        '<button class="removebuttonatt" onclick="test"><img id="toggleinfo" class="match-info-button" src=".\img\info.svg" alt="More info button"></button>' .
    '</section>' .
    '</section>' .
    //profile preview
    '<section id="profile-preview" class="matchbox-inside profile-edit-box">' .
    '<section class="match-preview">' .
        '<button class="photo-switch switch-left"><img src=".\img\arrow_left.svg" alt="Arrow left"></button>' .
        '<button class="photo-switch switch-right"><img src=".\img\arrow_right.svg" alt="Arrow right"></button>' .
        '<img class="match-picture" src="' . $matched_photo . '">' .
    '</section>' .
    '<section class="match-info profile-info profile-edit-box">' .
    '<p class="match-info-txt">' . $matched_name . ', ' . $matched_age . '</p>' .
        '<button class="removebuttonatt" onclick="test"><img id="toggleinfo2" class="match-info-button" src=".\img\info.svg" alt="More info button"></button>' .
        '<div class="line"></div>' .
        '<span class="profile-info-tag ">' . $matched_description . '</span>' .
        '<div class="line"></div>' .
        '<section class="interest-box">';
            
            $get_interests = "SELECT interests.interest_description FROM interests INNER JOIN user_interests ON interests.id = user_interests.interest_id AND user_interests.user_id = '$matched_id'";
            if(mysqli_query($conn, $get_interests)){
              $result = mysqli_query($conn, $get_interests);
              if(mysqli_num_rows($result) > 0){
                while($row2 = mysqli_fetch_array($result)){
                    echo '<div class="interest">' . $row2['interest_description'] . '</div>';
                }
              }
              mysqli_free_result($result);
            }
            
      echo  '</section>' .
    '</section>' .
    '</section>' .
        
    
    '<form method="POST" action="' . $_SERVER['PHP_SELF'] . '" class="match-navigation">' .
       ' <input type="submit" name="no" class="match-button match-button-no" value="" alt="Dislike button">' .
        '<input type="submit" name="yes" class="match-button match-button-yes" value="" alt="Like button">' .
'</form>';
}
else {
    echo "<p class='login-txt-left2'>Naujų narių pagal Jūsų interesus nėra. Grįžkite vėliau! :)";
}
?>
</section>


<script>

window.addEventListener('load', getLocation);

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position){
    console.log(position.coords.latitude);
    console.log(position.coords.longitude);
    document.cookie = "x = " + position.coords.latitude;
    document.cookie = "y = " + position.coords.longitude;
}


</script>

<?php
include_once 'footer.php';
?>