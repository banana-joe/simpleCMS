<?php
function isLogged() {
    if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        return true;
    } else {
        return false;
    }
}

function isAdmin() {
    if (isset($_SESSION['login_admin']) && $_SESSION['login_admin'] == true) {
        return true;
    } else {
        return false;
    }
}
?>
