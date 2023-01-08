<?php
    session_start();
    include_once 'header.php';

    if(isset($_SESSION['user_email'])){
        header("Location: home.php");
    }

?>

<h1 class="limit18">Atsiprašome, tačiau sistema naudotis gali tik asmenys sulaukę 18 metų. <br> Jūsų paskyra buvo pašalinta. <br> <a class="limit18link" href="index.php">Į pradžią</a></h1>

<?php
    include_once 'footer.php';
?>