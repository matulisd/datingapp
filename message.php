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
        <p class="navbutton active">Pranešimai</p>
        <p class="navbutton">Premium</p>
        <p class="navbutton logoff">Atsijungti</p>
    </nav>
</aside>

<section class="workspace">
<section class="messages-grid">

<section class="messages-box">
    <section class="chat-block">
    <p class="nametag">Tadas</p>
    <div class="message">
        <p class="timestamp">Pirmadienis, 20:15</p>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
    </div>

    <p class="nametag nametag-right">Rimantė</p>
    <div class="message sent">
        <p class="timestamp">Pirmadienis, 20:18</p>
        <p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
    </div>

    <div class="message sent">
        <p class="timestamp">Pirmadienis, 20:36</p>
        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>

    <p class="nametag">Tadas</p>
    <div class="message">
        <p class="timestamp">Pirmadienis, 21:05</p>
        <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
    </div>

    </section>
    <form class="chatbox" action="">
        <input class="msginput form-control login-input" type="text" placeholder="Rašyti žinutę..">
        <input class="msgsend form-control login-input" type="submit" value="Siųsti">
    </form>
</section>

<section class="messages-box">
<section class="preview-inchat">
        <button class="photo-switch switch-left"><img src=".\img\arrow_left.svg" alt="Arrow left"></button>
        <button class="photo-switch switch-right"><img src=".\img\arrow_right.svg" alt="Arrow right"></button>
        <img class="match-picture" src=".\img\usr_img\1670341776.jpg">
</section>
<section class="profile-info-inchat">
<p class="match-info-inchat">Tadas, 24</p>
        <div class="line"></div>
        <p class="description-txt">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
        <div class="line"></div>
        <section class="interest-box">
            <div class="interest">Knygos</div>
            <div class="interest">Kava</div>
            <div class="interest">Maistas</div>
            <div class="interest">Sportas</div>
            <div class="interest">Muzika</div>
            <div class="interest">Kava</div>
            <div class="interest">Maistas</div>
            <div class="interest">Sportas</div>
            <div class="interest">Muzika</div>
            <div class="interest">Filmai</div>
            <div class="interest">Filmai</div>
        </section>
        <button class="inchat-btn">Pranešti</button>
        <button class="inchat-btn nomargin">Atšaukti atitikimą</button>
</section>
</section>

</section>
</section>

<?php
include_once 'footer.php';
?>