<?php

    session_start();
    include_once 'header.php';

    if(isset($_SESSION['user_email'])){
        header("Location: home.php");
    }

    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, substr(hash('sha256',$_POST['password']),5,32));
        $empty_password_check = substr(hash('sha256',""),5,32);

        if($email == null){
            $error = "Įveskite el. pašto adresą";
        }
        else if($password == $empty_password_check){
            $error = "Įveskite slaptazodi";
        }
        else{
            $query = "SELECT user.id, user.name, user.email, user.password, user.description, user.gender, photo.url FROM user LEFT JOIN photo ON photo.user_id = user.id WHERE user.email='$email'";
    
            if(mysqli_query($conn, $query)){
                $result = mysqli_query($conn, $query);
                $user = mysqli_fetch_array($result);
                mysqli_free_result($result);
            
                if($user != null){
    
                    if($user['password'] == $password){
                        $_SESSION['user_email'] = $user['email'];
                        $_SESSION['user_name'] = $user['name'];
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user_gender'] = $user['gender'];
                        $_SESSION['user_pic'] = $user['url'];
                        header("Location: home.php");
                    }
                    else {
                        $error = "Slaptazodis neteisingas";
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

?>

<div class="container width90">
    <div class="row login">
        <section class="col-md-6 col-sm-12 login-left">
            <img class="login-img" src="./img/korteles.png" alt="Naudotojų profilių nuotraukos">
             <h2 class="login-txt-left"></h2>
            <h3 class="login-txt-left2">Pažintys mygtuko paspaudimu - 
                surask savo antrą pusę šiandien!
            </h3>
        </section>
        <section class="col-md-6 col-sm-12 login-right">
            <h4 class="login-txt">Turi paskyrą? Prisijunk!
            </h4>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="login-form" class="login-form">
            <input name="email" type="email" class="form-control login-input" 
            placeholder="El. pašto adresas">
            <input name="password" type="password" class="form-control login-input"
            placeholder="Slaptažodis">
            <p id="errortxt" class="register-error-txt">
                <?php
                    if(isset($error)){
                        echo $error;
                    }
                ?>
            </p>
            <input name="submit" type="submit" class="button-black" value="Prisijungti">
            </form>
            <p class="login-txt-small">arba</p>
            <button id="register" class="button-black">Registruotis</button>
        </section>
    </div>
</div>

<script>
    document.getElementById('register').addEventListener('click', () => location.href = "register.php");
</script>

<?php
    include_once 'footer.php';
?>