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
        <p class="register-txt">Liko visai nedaug! <br> Užpildykite likusius reikalingus duomenis</p>
        <label class="register2-label" for="name">Jūsų profilio aprašymas (nebūtinas)</label>
        <input id="name" type="name" name="name" class="form-control login-input">
        <label class="register2-label">Ko ieškote?</label><br>
        <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
        <label for="vehicle1"> Vaikino</label>
        <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
        <label for="vehicle2"> Merginos</label><br>

        <input type="submit" class="button-black topmargin35 botmargin20" value="Užbaigti registraciją">
    </form>
    <!-- <p id="back-to-main" class="back-register">Grįžti</p> -->
</section>

<script>

window.addEventListener('load', getLocation);

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    console.log("Geolocation is not supported by this browser.");
  }
}

function showPosition(position){
    console.log(position.coords.latitude);
    console.log(position.coords.longitude);
}


</script>

<?php
    include_once 'footer.php';
?>