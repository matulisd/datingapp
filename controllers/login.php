<?php
// Connect to a database
require("config/db.php");

session_start();
ob_start();


// $query = "SELECT * FROM user";

// $result = mysqli_query($conn, $query);

// $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
// // $user = mysqli_fetch_assoc($result);

// // var_dump($users);

// mysqli_free_result($result);

// mysqli_close($conn);

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if($email == null){
        $error = "Įveskite el. pašto adresą";
    }
    else if($password == null){
        $error = "Įveskite slaptazodi";
    }
    else{
        $query = "SELECT email, password FROM user WHERE email='$email'";

        if(mysqli_query($conn, $query)){
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);
            // var_dump($user);
            mysqli_free_result($result);

            // foreach($user as $usr){
            //     echo $usr['password'];
            // }
        
            if($user != null){

                if($user['password'] == substr(hash('sha256',$_POST['password']),5,32)){
                    $_SESSION['user_email'] = $user['email'];
                    header("Location: ../home.php");
                }
                else {
                    $error = "Slaptazodis neteisingas";
                    header("Location: ../index.php");
                }

            }
            else {
                $error = "Tokio naudotojo nera";
            }

        }
        else {
            echo "error: " . mysqli_error($conn);
        }
    }

}

echo $error;


?>