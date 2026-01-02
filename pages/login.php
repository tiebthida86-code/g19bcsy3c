<?php
    include '../include/header.inc.php';
    include '../include/style.inc.php';
    include '../include/navbar.inc.php';
?>
    <div class="containers">
        <form class="mx-auto" style="max-width: 500px;">
            <h3 class="my-3">Login</h3>
            <div class="mb-3">
                <label for="userNameInput" class="form-label">Username</label>
                <input type="text" class="form-control" id="userNameInput">
            </div>

            <div class="mb-3">
                <label for="passwdInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwdInput">
            </div>
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <div class="mb-3 form-check">
                <label>Do not have account? <a href="">Register</a></label>
            </div>
        </form>
    </div>
<?php
include '../include/fooler.inc.php';
?>
