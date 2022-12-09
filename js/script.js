if (document.getElementById('register')) {
    document.getElementById('register').addEventListener('click', () => location.href = "register.php");
}

if (document.getElementById('back-to-main')) {
    document.getElementById('back-to-main').addEventListener('click', () => location.href = "index.php");
}

function click() {
    console.log('click');
};