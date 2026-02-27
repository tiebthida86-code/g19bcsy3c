<?php
$oldPasswd = $newPasswd = $confirmNewPasswd = '';
$oldPasswdErr = $newPasswdErr = '';

if (isset($_POST['changePasswd'], $_POST['oldPasswd'], $_POST['newPasswd'], $_POST['confirmNewPasswd'])) {
    $oldPasswd = trim($_POST['oldPasswd']);
    $newPasswd = trim($_POST['newPasswd']);
    $confirmNewPasswd = trim($_POST['confirmNewPasswd']);
    if (empty($oldPasswd)) {
        $oldPasswdErr = 'please input your old password';
    }
    if (empty($newPasswd)) {
        $newPasswdErr = 'please input your new password';
    }
    if ($newPasswd !== $confirmNewPasswd) {
        $newPasswdErr = 'password does not match';
    }
    if (!isUserHasPassword($oldPasswd)) {
        $oldPasswdErr = 'password is incorrect';
    }
    if (empty($oldPasswdErr) && empty($newPasswdErr)) {
        if (setUserNewPassowrd($newPasswd)) {
            header('Location: ./?page=logout');
        } else {
            echo '<div class="alert alert-danger" role="alert">
                try aggain.
                </div>';
        }
    }
}


if (isset($_POST['uploadPhoto']) && isset($_FILES['photo'])) {
    $photo = $_FILES['photo'];
    if (empty($photo['name'])) {
        echo '<div class="alert alert-danger" role="alert">
    Please select a photo to upload.
</div>';
    } else {
        try {
            if (changeProfileImage($photo)) {
                echo '<div class="alert alert-success" role="alert">
    profile image changed successfully.
</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
    failed to change profile image.
</div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">
    ' . $e->getMessage() . '
</div>';
        }
    }
}

if (isset($_POST['deletePhoto'])) {
    deleteProfileImage();
}
?>

<div class="row">
    <style>
        /* Container for the avatar */
        .avatar-wrapper {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .avatar-wrapper:hover {
            transform: scale(1.03);
        }

        /* The actual image */
        #previewImg {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            border-radius: 50% !important;
            /* Forces a circle */
        }

        /* "Change Photo" overlay that appears on hover */
        .avatar-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 12px;
            font-weight: 500;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .avatar-wrapper:hover .avatar-overlay {
            opacity: 1;
        }

        /* Button adjustments */
        .profile-actions .btn {
            border-radius: 20px;
            padding: 5px 20px;
            font-weight: 600;
            min-width: 100px;
        }
    </style>

    <div class="col-6 mx-auto">
        <div class="col-6">
            <form method="post" action="./?page=profile" enctype="multipart/form-data">
                <div class="d-flex justify-content-center">
                    <input name="photo" type="file" id="profileUpload" hidden>
                    <label role="button" for="profileUpload">
                        <img src="<?php echo loggedInUser()->photo ?? './assets/images/emptyuser.png' ?>"
                            class="rounded img-thumbnail" style="max-width:200px">
                    </label>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="deletePhoto" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete your photo?')">Delete</button>
                    <button type="submit" name="uploadPhoto" class="btn btn-success">Upload</button>
                </div>
            </form>

            <script>
                document.getElementById('profileUpload').onchange = function () {
                    var file = this.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            document.getElementById('previewImg').src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                    }
                }
            </script>
        </div>
    </div>

    <div class="col-6">
        <form method="post" action="./?page=profile" class="col-md-8 col-lg-6 mx-auto">
            <h3>Change Password</h3>
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input value="<?php echo $oldPasswd ?>" name="oldPasswd" type="password" class="form-control 
                <?php echo empty($oldPasswdErr) ? '' : 'is-invalid' ?>">
                <div class="invalid-feedback">
                    <?php echo $oldPasswdErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input name="newPasswd" type="password" class="form-control 
                <?php echo empty($newPasswdErr) ? '' : 'is-invalid' ?>">
                <div class="invalid-feedback">
                    <?php echo $newPasswdErr ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input name="confirmNewPasswd" type="password" class="form-control">
            </div>
            <button type="submit" name="changePasswd" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>