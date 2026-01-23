<?php
require_once './init/init.php';
include './include/header.inc.php';
include './include/navbar.inc.php';

$availale_pages = ['login', 'register'];

if (isset($_GET['page'])) {
    $page = $_GET['page']; //login

    if (in_array($page, $availale_pages)) {
        include './pages/' . $page . '.php';
    } else {
        include './pages/error404.php';
    }
    
} else {
    include  './pages/dashboard.php';
}
include './include/footer.inc.php';

?>