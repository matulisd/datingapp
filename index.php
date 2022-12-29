<?php

    // require __DIR__ . '/database.php';
    // $db = DB();
    // require("controllers/login.php");
    
    include_once 'header.php';


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
             <!-- pakeisti i besikeicianti teksta + vaikinas iesko merginos -->
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
    // var errortxt = document.getElementById('errortxt');
    // errortxt.innerHTML = "";

    document.getElementById('register').addEventListener('click', () => location.href = "register.php");
    // document.getElementById('login-form').addEventListener('submit', login);

    // function login(e){
    //     e.preventDefault();

    //     var email = document.getElementById('email').value;
    //     var params = "email=" + email;

    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', './controllers/login.php', true);
    //     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    //     xhr.onload = function () {
    //         console.log(this.responseText);
    //     }

    //     xhr.send(params);
    // }

    // function login(){
    //     if (document.getelementbyid('email').inngerHTML == ""){
    //         errortxt.innerHTML = "Iveskite el. pasta"
    //     }
    //     if (document.getelementbyid('password').innerHTML == ""){
    //         errortxt.innerHTML = "Iveskite slaptazodi"
    //     }
    //     else {
    //         var xmlhttp = new XMLHttpRequest();
    //         xmlhttp.onreadystatechange = function () {
    //             if (this.readyState == 4 && this.status == 200) {
    //                 errortxt.innerHTML = this.responseText;
    //             }
    //         };
    //         // xmlhttp.open("POST")
    //     }

    //}

</script>

<?php
    include_once 'footer.php';
?>