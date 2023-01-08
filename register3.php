<?php
    session_start();
    include_once 'header.php';

    if(empty($_SESSION['user_email'])){
      header("Location: index.php");
    }
    else if(!empty($_SESSION['user_gender'])){
      header("Location: home.php");
    }
    
    if(isset($_POST['submit'])){

      if(empty($_POST['men']) && empty($_POST['women'])){
        $error = "Pažymėkite kokia yra Jūsų lytis";
      }
      else if(!empty($_POST['men']) && !empty($_POST['women'])){
        $error = "Pasirinkite vieną lytį";
      }
      else{
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $uid = $_SESSION['user_id'];
        if(empty($_POST['men'])){
          $gender = "M";
        }
        else{
          $gender = "V";
        }
        $query = "UPDATE user SET description='$description', gender='$gender' WHERE id='$uid'";

        if(mysqli_query($conn, $query)){
          $_SESSION['user_gender'] = $gender;
          header("Location: home.php");
        }
        else {
          echo "error: " . mysqli_error($conn);
        }

      }

    }
?>

<section class="register-box">
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="register-form">
        <h6 class="register-txt">Liko visai nedaug! <br> Užpildykite likusius reikalingus duomenis</h6>
        <label class="register2-label" for="description">Jūsų profilio aprašymas (nebūtinas)</label>
        <input id="description" type="text" name="description" class="form-control login-input">
        <label class="register2-label">Kas Jūs?</label><br>
        <input id="men" type="checkbox" name="men" value="Vaikinas">
        <label for="men"> Vaikinas</label>
        <input id="women" type="checkbox" name="women" value="Mergina">
        <label for="women"> Mergina</label><br>
        <p id="errortxt" class="register-error-txt">
                <?php
                    if(isset($error)){
                        echo $error;
                    }
                ?>
            </p>
        <input name="submit" type="submit" class="button-black topmargin35 botmargin20" value="Užbaigti registraciją">
    </form>
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
    document.cookie = "x = " + position.coords.latitude;
    document.cookie = "y = " + position.coords.longitude;
}

</script>

<?php
    include_once 'footer.php';
?>