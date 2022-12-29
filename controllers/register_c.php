<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

function output($arg) {
    echo json_encode($arg);
    exit;
}

$server = "localhost";
$user = "root";
$password = "";
$database= "datingapp";
$error = null;

$conn=new mysqli($server,$user,$password,$database);

if ($conn->connect_error){
    die("connection failed:" . $conn->connect_error);
    // $output=array("TIPAS"=>"Klaida","ATS"=> "Negaliu prisijungti prie MySQL".$conn->connect_error);
	// output($output);
}

if (!empty($_POST['email']) && !empty($_POST['password'])){

    $email = htmlspecialchars($_POST['email']);
    $password = substr(hash('sha256',$_POST['password']),5,32);
    $password_repeat = substr(hash('sha256',$_POST['password-repeat']),5,32);

    if ($password == $password_repeat){

        $check_if_exists = "SELECT * FROM user WHERE email = '{$email}'";
        $result = $conn->query($check_if_exists);

        if (mysqli_num_rows($result) == 0){
            $sql = "INSERT INTO user (email, password) VALUES ('$email', '$password')";
            if ($conn->query($sql) == true){
                $_SESSION['useremail'] = $email;
                echo "Registracija sekminga";
                echo $_SESSION['useremail'];
                header("Location: ../register2.php");
                die();
            }
            else {
                echo "Klaida: " . $sql . "<br>" . $conn->error;
                $error = $conn->error;
            }
        }
        else {
            echo "Tokia paskyra jau yra";
            $error = "Tokia paskyra jau yra";
        }
    }
    else {
        echo "Slaptazodziai nesutampa";
        $error = "Slaptazodziai nesutampa";
    }
}
else {
    echo "tuscia";
    $error = "tuscia";
}

if (isset($_POST['submit'])) {
    $error = '';
    if (!empty($_POST['email'])) {
        $error = "email empty";
    }
    if (!empty($_POST['password'])){
        $error = "pass empty";
    }
}

// $conn->close();

?>