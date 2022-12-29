<?php
include_once 'header.php';
?>
<section class="mainpage">
<aside class="sidebar">
    <section class="user-name-block">
    <img class="profile-picture" src=".\img\usr_img\dd\Screenshot_5.jpg" alt="User's profile picture">
    <h2 class="user-name">Rimantė</h2>
    </section>
    <nav>
        <p class="navbutton">Pagrindinis</p>
        <p class="navbutton">Atitikimai</p>
        <p class="navbutton">Pranešimai</p>
        <p class="navbutton">Premium</p>
        <p class="navbutton logoff">Atsijungti</p>
    </nav>
</aside>

<section class="matchbox profile-edit-box">
    <section class="match-preview">
        <button class="photo-switch switch-left"><img src=".\img\arrow_left.svg" alt="Arrow left"></button>
        <button class="photo-switch switch-right"><img src=".\img\arrow_right.svg" alt="Arrow right"></button>
        <img class="match-picture" src=".\img\usr_img\dd\Screenshot_5.jpg">
    </section>
    <section class="match-info profile-info">
        <p class="match-info-txt profile-info-txt">Rimantė, 20</p>
        <!-- <img class="match-info-button" src=".\img\info.svg" alt="More info button"> -->
        <div class="line"></div>
        <span class="profile-info-tag ">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</span>
        <div class="line"></div>
        <section class="interest-box">
            <div class="interest">Knygos</div>
            <div class="interest">Kava</div>
            <div class="interest">Maistas</div>
            <div class="interest">Sportas</div>
            <div class="interest">Muzika</div>
            <div class="interest">Filmai</div>
        </section>
    </section>
    <!-- <section class="match-navigation">
        <button class="match-button"><img src=".\img\x.svg" alt="Dislike button"></button>
        <button class="match-button"><img src=".\img\heart.svg" alt="Like button"></button>
    </section> -->
</section>
</section>

<?php
include_once 'footer.php';
?>