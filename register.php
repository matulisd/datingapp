<?php

session_start();

// if (!empty($_SESSION['useremail'])){
//     header("Location: ./index.php");
// }

    include_once 'header.php';
?>

<section class="register-box">
    <form method="post" action="./controllers/register_c.php" id="register-form" class="register-form">
    <!-- <form id="register-form" class="register-form"> -->
        <p class="register-txt">Sukurkite naują paskyrą</p>
        <input type="email" class="form-control login-input" 
        placeholder="El. pašto adresas" name="email" id="email">
        <input type="password" class="form-control login-input"
        placeholder="Slaptažodis" name="password" id="password">
        <input type="password" class="form-control login-input"
        placeholder="Pakartokite slaptažodį" name="password-repeat" id="password-repeat">
        <input type="submit" class="button-black" value="Registruotis">
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