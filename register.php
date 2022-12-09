<?php
    include_once 'header.php';
?>

<section class="register-box">
    <form method="post" action="./controllers/register_c.php" class="register-form">
        <p class="register-txt">Sukurkite naują paskyrą</p>
        <input type="email" class="form-control login-input" 
        placeholder="El. pašto adresas" name="email">
        <input type="password" class="form-control login-input"
        placeholder="Slaptažodis" name="password">
        <input type="password" class="form-control login-input"
        placeholder="Pakartokite slaptažodį" name="password-repeat">
        <input type="submit" class="button-black" value="Registruotis">
    </form>
    <p id="back-to-main" class="back-register">Grįžti</p>
</section>

<?php
    include_once 'footer.php';
?>