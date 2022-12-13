<?php
include_once 'header.php';

$arr = array("Screenshot_1", "Screenshot_2", "Screenshot_3", "Screenshot_4", "Screenshot_5", "Screenshot_6", "Screenshot_7", "Screenshot_8", "Screenshot_9", "Screenshot_10");

?>

<section class="mainpage">
<aside class="sidebar">
    <section class="user-name-block">
    <img class="profile-picture" src=".\img\usr_img\1670341460.jpg" alt="User's profile picture">
    <h2 class="user-name">Vardenis</h2>
    </section>
    <nav>
        <p class="navbutton">Pagrindinis</p>
        <p class="navbutton active">Atitikimai</p>
        <p class="navbutton">Pranešimai</p>
        <p class="navbutton">Premium</p>
        <p class="navbutton logoff">Atsijungti</p>
    </nav>
</aside>

<section class="workspace matches-preview">
    
    <!-- <img class="match-picture-small" src=".\img\usr_img\dd\Screenshot_1.jpg" alt=""> -->

    <?php
    foreach ($arr as &$value){
        echo "<img class='match-picture-small' " . 
        "src='./img/usr_img/dd/" . $value . ".jpg' >";
    }
    ?>

</section>

<?php
include_once 'footer.php';
?>