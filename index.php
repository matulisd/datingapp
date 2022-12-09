<?php
    include_once 'header.php';

    $_SESSION['useremail'] = NULL;

    echo $_SESSION['useremail'];
?>

<div class="container width90">
    <div class="row login">
        <section class="col-md-6 col-sm-12 login-left">
            <img class="login-img" src="./img/korteles.png" alt="Naudotojų profilių nuotraukos">
             <!-- pakeisti i besikeicianti teksta + vaikinas iesko merginos -->
             <h2 class="login-txt-left">Mergina ieško vaikino</h2>
            <h3 class="login-txt-left2">Pažintys mygtuko paspaudimu - 
                surask savo antrą pusę šiandien!
            </h3>
        </section>
        <section class="col-md-6 col-sm-12 login-right">
            <h4 class="login-txt">Turi paskyrą? Prisijunk!
            </h4>
            <form action="user.php" method="POST" class="login-form">
            <input type="email" class="form-control login-input" 
            placeholder="El. pašto adresas">
            <input type="password" class="form-control login-input"
            placeholder="Slaptažodis">
            <input id="login" type="submit" class="button-black" value="Prisijungti">
            </form>
            <p class="login-txt-small">arba</p>
            <button id="register" class="button-black">Registruotis</button>
        </section>
    </div>
<div>

<?php
    include_once 'footer.php';
?>