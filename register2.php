<?php
    session_start();
    include_once 'header.php';

    // if (empty($_SESSION['useremail'])){
    //     header("Location: ./index.php");
    // }

    // echo $_SESSION['useremail'];
?>

<section class="register-box">
    <form method="POST" action="./controllers/register2_c.php" class="register-form" enctype="multipart/form-data">
        <p class="register-txt">Susipažinkime! <br> Užpildykite savo profilio duomenis</p>
        <label class="register2-label" for="name">Jūsų vardas</label>
        <input id="name" type="name" name="name" class="form-control login-input">
        <label class="register2-label" for="birthdate">Jūsų gimimo data</label>
        <input id="birthdate" type="date" class="form-control login-input" name="birthdate">
        <label class="register2-label" class="img-upload-txt">Įkelkite savo nuotrauką</label>
        <input class="form-control" type="file" id="picture" name="picture">
        <input type="submit" class="button-black topmargin35 botmargin20" value="Toliau">
    </form>
    <!-- <p id="back-to-main" class="back-register">Grįžti</p> -->
</section>

<?php
    include_once 'footer.php';
?>