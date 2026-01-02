<?php
    include '../include/header.inc.php'
?>
<div class="containers">
        <form class="mx-auto" style="max-width: 500px;">
            <h3 class="my-3">Register</h3>
            <div class="mb-3">
                <label for="userNameInput" class="form-label">Username</label>
                <input type="text" class="form-control" id="userNameInput">
            </div>
            <div class="mb-3">
                <label for="emailInput" class="form-label">Email address</label>
                <input type="email" class="form-control" id="emailInput" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="passwdInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwdInput">
            </div>
            <div class="mb-3">
                <label for="confirmPasswdInput" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPasswdInput">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="termsCB">
                <label class="form-check-label" for="termsCB">I agree</label>
            </div>
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-danger">Reset</button>
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
<?php
include '../include/footer.inc.php';
?>