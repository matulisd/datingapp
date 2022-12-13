<?php

header("Content-Type: application/json; charset=UTF-8");


session_start();
$server = "localhost";
$user = "root";
$password = "";
$database= "datingapp";

$conn=new mysqli($server,$user,$password,$database);

if ($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
}

echo $_SESSION['useremail'] . " ";

if (empty($_SESSION['useremail'])){
    header("Location: ../index.php");
}

// if (empty($_POST['name']) || empty($_POST['birthdate']) || empty($_POST['picture'])){
//     echo "tuscia";
//     die();
// }

else {

$target_dir = "../img/usr_img/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$temp = explode(".", $_FILES["picture"]["name"]);
$new_file_name = $target_dir . round(microtime(true)) . '.' . end($temp);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
}

$name =  htmlspecialchars($_POST['name']);   
    $birthdate = $_POST['birthdate'];

    // if (empty($name)){
    //     echo $name;
    //     echo "Iveskite varda ";
    //     $uploadOk = 0;
    //     die();
    // }

    // echo "dabar - 18:" . (int)date("y-m-d") - 18 . " ";
    // // echo ((int)date("Y-m-d") - (int)$birthdate);
    // echo strtotime(date("y-m-d")) - strtotime($birthdate);

    // if ((int)date("Y-m-d") - (int)$birthdate < 18){
    //     // echo ((int)date("Y-m-d") - (int)$birthdate);
    //     echo "Per jaunas ";
    //     $uploadOk = 0;
    //     die();
    // }

if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if ($_FILES["picture"]["size"] > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
} 
else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $new_file_name)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
        //$sql = "UPDATE user SET (name, birth_date) VALUES ('$name', '$birthdate') WHERE email = ('{$_SESSION['useremail']}')";
        $sql = "UPDATE user SET name = '$name', birth_date = '$birthdate' WHERE email = '{$_SESSION['useremail']}'";
        if ($conn->query($sql) != true){
            echo "Klaida: " . $sql . "<br>" . $conn->error;
        }
        $userid = $conn->query("SELECT id FROM user WHERE email = '{$_SESSION['useremail']}'");
        $result = mysqli_fetch_array($userid);
        $uid = $result['id'];
        $timestamp = date("Y-m-d H:i:s");
        $sql = "INSERT INTO photo (user_id, url, time_created) VALUES ('$uid', '$new_file_name', '$timestamp')";
        if ($conn->query($sql) != true){
            echo "Klaida: " . $sql . "<br>" . $conn->error;
        }
        header("Location: ../mainpage.php");
    }
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}



// if (!empty($_POST['name']) && !empty($_POST['birthdate']) && !empty(!$_POST['picture'])){
//     $name =  htmlspecialchars($_POST['name']);   
//     $birthdate = $_POST['birthdate'];
//     $picture = $_POST['picture'];
//     $sql = "UPDATE user (name, birth_date) VALUES ('$name', '$birthdate') WHERE email = {$_SESSION['useremail']} ";
//     if ($conn->query($sql) != true){
//         echo "Klaida: " . $sql . "<br>" . $conn->error;
//     }
//     $userid = $conn->query("SELECT id FROM user WHERE email = '{$_SESSION['useremail']}'");
//     $timestamp = date("Y-m-d H:i:s");
//     $sql = "INSERT INTO photo (user_id, url, time_created) VALUES ('$userid', '$picture', '$date')";
//     if ($conn->query($sql) != true){
//         echo "Klaida: " . $sql . "<br>" . $conn->error;
//     }
// }
// else {
//     echo "tuscia";
// }

?>