<?php
    session_start();
    include_once 'header.php';

    if(!empty($_SESSION['user_name'])){
        header("Location: register3.php");
    }

    if(empty($_SESSION['user_email'])){
        header("Location: index.php");
    }
    else {
        $target_dir = "img/usr_img/";
        if(isset($_POST['submit'])){
            $name =  mysqli_real_escape_string($conn, $_POST['name']);   
            $birthdate = $_POST['birthdate'];
            $picture = $_FILES['picture'];
            $target_file = $target_dir . basename($_FILES["picture"]["name"]);
            $temp = explode(".", $_FILES["picture"]["name"]);
            $new_file_name = $target_dir . round(microtime(true)) . '.' . end($temp);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $interval = (int)date("Y-m-d") - (int)$birthdate;
        
            if(empty($_POST['name'])){
                $error = "Įveskite savo vardą";
            }
            else if(empty($_POST['birthdate'])){
                $error = "Įveskite savo gimimo datą";
            }

            else if($interval < 18){
                    $email_delete = $_SESSION['user_email'];
                    $query = "DELETE FROM user WHERE email='$email_delete'";
                    if(mysqli_query($conn, $query) == false){
                        echo "error: " . mysqli_error($conn);
                    }
                    else {
                        echo "<script>alert('nuo 18');</script>";

                        //TODO -- IMPLEMENT ERROR MESSAGE
                        // or make register box invisible 
                        // and display error with link back
                        // in this case delete header to index
                        // and change it to onclick (a)

                    }
                    session_destroy();
                    header("Location: nuo18.php");
            }        
            else if ($picture['size'] < 1){
                $error = "Įkelkite savo profilio nuotrauką";
            }
            else{

                if ($picture["size"] > 10000000) {
                $error = "Failas yra per didelis";
                $uploadOk = 0;
                }

                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ){
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload fil
            }
            else{
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $new_file_name)) {
                    echo "The file ". htmlspecialchars( basename( $_FILES["picture"]["name"])). " has been uploaded.";
                    //$sql = "UPDATE user SET (name, birth_date) VALUES ('$name', '$birthdate') WHERE email = ('{$_SESSION['useremail']}')";
                    $sql = "UPDATE user SET name = '$name', birth_date = '$birthdate' WHERE email = '{$_SESSION['user_email']}'";
                    if ($conn->query($sql) != true){
                        echo "Klaida: " . $sql . "<br>" . $conn->error;
                    }
                    $_SESSION['user_name'] = $name;
                    $userid = $conn->query("SELECT id FROM user WHERE email = '{$_SESSION['user_email']}'");
                    $result = mysqli_fetch_array($userid);
                    $uid = $result['id'];
                    $_SESSION['user_id'] = $uid;
                    $timestamp = date("Y-m-d H:i:s");
                    $sql = "INSERT INTO photo (user_id, url, time_created) VALUES ('$uid', '$new_file_name', '$timestamp')";
                    if ($conn->query($sql) != true){
                        echo "Klaida: " . $sql . "<br>" . $conn->error;
                    }
                    else {
                      header("Location: register3.php");  
                    } 
                }
                else {
                    $error = "Sorry, there was an error uploading your file.";
                }
            }
                
            }

        }
    }


    echo $_SESSION['user_email'];

?>

<section class="register-box">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="register-form" enctype="multipart/form-data">
        <p class="register-txt">Susipažinkime! <br> Užpildykite savo profilio duomenis</p>
        <label class="register2-label" for="name">Jūsų vardas</label>
        <input id="name" type="name" name="name" class="form-control login-input">
        <label class="register2-label" for="birthdate">Jūsų gimimo data</label>
        <input id="birthdate" type="date" class="form-control login-input" name="birthdate">
        <label class="register2-label" class="img-upload-txt">Įkelkite savo nuotrauką</label>
        <input class="form-control" type="file" id="picture" name="picture">
        <?php
        if (!empty($error)){
            echo '<p class="register-error-txt">' . $error . '</p>';
        }
        ?>
        <input name="submit" type="submit" class="button-black topmargin35 botmargin20" value="Toliau">
    </form>
    <!-- <p id="back-to-main" class="back-register">Grįžti</p> -->
</section>

<?php
    include_once 'footer.php';
?>