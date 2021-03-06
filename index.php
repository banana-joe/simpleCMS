<?php
session_start();
require_once "include/config.inc.php";
require_once "include/mysql.inc.php";
require_once "include/functions.inc.php";
// + rainTPL template engine
require_once "include/rain.tpl.class.php";
raintpl::$tpl_dir = "templates/";
raintpl::$cache_dir = "tmp/";

$tpl = new raintpl();
$tpl->draw("header");

if (isset($_GET['p']))
{
    switch ($_GET['p'])
    {
        case 'articles':
        require_once "include/articles.inc.php";
        break;

        case 'contact':
        require_once "include/contact.inc.php";
        break;

        case 'login':
        require_once "include/login.inc.php";
        break;

        case 'logout':
        require_once "include/logout.inc.php";
        break;
    }
}
else
{
    header ("Location: ?p=articles&function=list");
}

$tpl->draw("footer");
?>
