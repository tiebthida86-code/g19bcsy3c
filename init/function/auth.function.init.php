<?php
function usernameExists($username)
{
    global $db;
    $query = $db->prepare('SELECT * FROM tbl_users WHERE username = ?');
    $query->bind_param('s', $username);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return true;
    }
    return false;
}

function registerUser($name, $username, $passwd)
{
    global $db;
    if (usernameExists($username)) {
        return false;
    }
    $query = $db->prepare('INSERT INTO tbl_users  (name, username, passwd) VALUES(?, ?, ?)');
    $query->bind_param('sss', $name, $username, $passwd);
    $query->execute();
    if ($query->affected_rows) {
        return true;
    }
    return false;
}

function logUserIn($username, $passwd)
{
    global $db;
    $query = $db->prepare('SELECT * FROM tbl_users WHERE username = ? AND passwd = ?');
    $query->bind_param('ss', $username, $passwd);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_object();
    }
    return false;

}

function loggedInUser()
{
    global $db;
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    $user_id = $_SESSION['user_id'];
    $query = $db->prepare('SELECT * FROM tbl_users WHERE id = ?');
    $query->bind_param('d', $user_id);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result->fetch_object();
    }
    return null;
}
function isUserHasPassword($passwd)
{
    global $db;
    $user = loggedInUser();
    $query = $db->prepare(
        "SELECT * FROM tbl_users WHERE id = ? AND passwd = ?"
    );
    $query->bind_param('ss', $user->id, $passwd);
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return true;
    }
    return false;
}

function setUserNewPassowrd($passwd)
{
    global $db;
    $user = loggedInUser();
    $query = $db->prepare(
        "UPDATE tbl_users SET passwd = ? WHERE id = ?"
    );
    $query->bind_param('ss', $passwd, $user->id);
    $query->execute();
    if ($db->affected_rows) {
        return true;
    }
    return false;
}

function uploadUserProfile($imgPath)
{
    global $db;
    $user = loggedInUser();
    if (!$user) {
        return false;
    }
    $query = $db->prepare("UPDATE tbl_users SET photo = ? WHERE id = ?");
    $query->bind_param('si', $imgPath, $user->id);
    if ($query->execute()) {
        return true;
    } else {
        return false;
    }
}

function deletePhotoFile($photo)
{
    if (!empty($photo) && $photo !== 'emptyuser.png' && file_exists('./assets/images/' . $photo)) {
        unlink('./assets/images/' . $photo);
    }
}

function updatePhoto($user)
{
    global $db;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0) {

        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        $fileType = mime_content_type($_FILES['photo']['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            echo '<div class="alert alert-warning" role="alert">Only JPG and PNG files are allowed.</div>';
        } else {
            $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $newName = 'user_' . $user->id . '.' . $ext;
            $dest = './assets/images/' . $newName;

            // delete old photo file from folder
            deletePhotoFile($user->photo);

            // move uploaded file to ./assets/images/ folder
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) {
                $query = $db->prepare('UPDATE tbl_users SET photo = ? WHERE id = ?');
                $query->bind_param('si', $newName, $user->id);
                $query->execute();
                echo '<div class="alert alert-success" role="alert">Photo updated successfully!</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Failed to save photo to folder.</div>';
            }
        }

    } else {
        echo '<div class="alert alert-warning" role="alert">Please select a photo.</div>';
    }
}

function deletePhoto($user)
{
    global $db;
    // delete file from ./assets/images/ folder
    deletePhotoFile($user->photo);
    // set photo column back to NULL in database
    $query = $db->prepare('UPDATE tbl_users SET photo = NULL WHERE id = ?');
    $query->bind_param('i', $user->id);
    $query->execute();
    echo '<div class="alert alert-success" role="alert">Photo deleted successfully!</div>';
}



?>