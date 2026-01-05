<?php
include './include/header.inc.php';
include './include/navbar.inc.php';

$availale_pages = ['login', 'register'];

if (isset($_GET['page'])) {
    $page = $_GET['page']; //login

    if (in_array($page, $availale_pages)) {
        include './pages/' . $page . '.php';
    } else {
        echo '<h1>404 page not found</h1>';
    }
    
} else {
    echo '<h1>404 page not found</h1>';
}
include './include/footer.inc.php';

?>