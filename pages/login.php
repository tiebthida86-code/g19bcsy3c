<?php
$username =  '';
$usernameErr = $passwdErr = '';
if (isset($_POST['username'], ($_POST['passwd']))) {
    $username = trim($_POST['username']);
    $passwd = trim($_POST['passwd']);
    if (empty($username)) {
        $usernameErr = 'Please input your username!';
    }
    if (empty($passwd)) {
        $passwdErr = 'Please input your password!';
    }
    if (empty($usernameErr) && empty($passwdErr)) {
        $user = logUserIn($username, $passwd);
        if ($user !== false) {
            $_SESSION['user_id'] = $user->id;
            header('Location: ./?page=dashboard');
        } else {
            echo '<div class = "Alert alert-danger" role = "alert">
            Login failed!
            </div>';
        }
    }
}
?>
<form method="post" action="./?page=login" class="mx-auto" style="max-width: 500px;">
    <h3>Login</h3>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Username</label>
        <input name="username" value="<?php echo $username ?>" type="text" class="form-control 
            <?php echo empty($usernameErr) ? '' : 'is-invalid' ?>">
        <div class="invalid-feedback"><?php echo $usernameErr ?></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input name="passwd" type="password" class="form-control 
            <?php echo empty($passwdErr) ? '' : 'is-invalid' ?>">
        <div class="invalid-feedback"><?php echo $passwdErr ?></div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>