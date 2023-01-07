<?php

session_start();

// if (!empty($_SESSION['useremail'])){
//     header("Location: ./index.php");
// }

    include_once 'header.php';


    if(!empty($_SESSION['user_name'])){
        header("Location: home.php");
    }

if(isset($_POST['submit'])){
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, substr(hash('sha256',$_POST['password']),5,32));
    $password_repeat = mysqli_real_escape_string($conn, substr(hash('sha256',$_POST['password-repeat']),5,32));
    $empty_password_check = substr(hash('sha256',""),5,32);

        // if ($password == $password_repeat){

        // }
        if($email == null){
            $error = "Įveskite el. pašto adresą";
        }
        else if($password == $empty_password_check){
            $error = "Įveskite slaptažodį";
        }
        else if($password_repeat == $empty_password_check){
            $error = "Pakartokite slaptažodį";
        }
        else if($password != $password_repeat && $password != $empty_password_check){
            $error = "Slaptažodžiai nesutampa";
        }
        else {
            $check_if_exists = "SELECT email, name FROM user WHERE email ='$email'";
            $result = mysqli_query($conn, $check_if_exists);
            $user = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            if($user == null){
                $query = "INSERT INTO user (email, password) VALUES ('$email', '$password')";

                if(mysqli_query($conn, $query)){
                    $_SESSION['user_email'] = $email;
                    echo "Registracija sekminga";
                    echo $_SESSION['useremail'];
                    header("Location: register2.php");
                }
                else {
                    echo "error: " . mysqli_error($conn);
                }
            }
            else{
                $error = "Naudotojas su šiuo el. paštu jau egzistuoja";
            }

        }
    }
    
?>

<section class="register-box">
    <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>" id="register-form" class="register-form">
    <!-- <form id="register-form" class="register-form"> -->
        <p class="register-txt">Sukurkite naują paskyrą</p>
        <input type="email" class="form-control login-input" 
        placeholder="El. pašto adresas" name="email" id="email">
        <input type="password" class="form-control login-input"
        placeholder="Slaptažodis" name="password" id="password">
        <input type="password" class="form-control login-input"
        placeholder="Pakartokite slaptažodį" name="password-repeat" id="password-repeat">
        <input name="submit" type="submit" class="button-black" value="Registruotis">
        <?php
        if (!empty($error)){
            echo '<p class="register-error-txt">' . $error . '</p>';
        }
        ?>
        
        <!-- <p class="register-error-txt">Sukurkite naują paskyrą</p> -->
    </form>
    <p id="back-to-main" class="back-register">Grįžti</p>
</section>

<script>
    // document.getElementById('register-form').addEventListener('submit', register);

    // function register(e){
    //     e.preventDefault();

    //     var email = document.getElementById("email").value;
    //     var password = document.getElementById("password").value;
    //     var password_repeat = document.getElementById("password-repeat").value;

    //     var params = "email=" + email + ", password=" + password + ", password-repeat=" + password_repeat; 

    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', 'controllers/register2_c.php', true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    //     xhr.onload = function () {
    //         console.log(this.responseText);
    //     }

    //     xhr.send(params);
    // }

//     $.ajax({
//     url:'controllers/register2_c.php',
//     data: 'name='+name + ", password=" + password, //sending the data to page.php
//     success: function(data) {  
//         $('#content').html(data);
//     }, error : function(e) { 
//         alert('an error occured');
//     }, complete : function() { 
//         /*alert*/
//     }
// });

//     $("#register-form").submit(function(e) {

// e.preventDefault(); // avoid to execute the actual submit of the form.

// var form = $(this);
// var actionUrl = form.attr('/controllers/register2_c.php');

// $.ajax({
//     type: "POST",
//     url: actionUrl,
//     data: form.serialize(), // serializes the form's elements.
//     success: function(data)
//     {
//       alert(data); // show response from the php script.
//     }
// });

// });

</script>

<?php
    include_once 'footer.php';
?>