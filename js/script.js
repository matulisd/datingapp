if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

// if (document.getElementById('register')) {
//     document.getElementById('register').addEventListener('click', () => location.href = "register.php");
// };

if (document.getElementById('back-to-main')) {
    document.getElementById('back-to-main').addEventListener('click', () => location.href = "index.php");
};

// if (document.getElementById('profile')) {
//     document.getElementById('toggleinfo').addEventListener('click', toggleinfo, false);
// };

var preview = 0;

function toggleinfo() {
    if (preview == 0) {
        document.getElementById('profile-preview').style = 'display:block';
        document.getElementById('profile').style = 'display:none';
        preview = 1;
    }
    else {
        document.getElementById('profile-preview').style = 'display:none';
        document.getElementById('profile').style = 'display:block';
        preview = 0;
    }
};
