<style>
    body {
        background-color: #f8f9fa;
    }

    .containers {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .register-title {
        text-align: center;
        margin-bottom: 30px;
        font-weight: 600;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .form-text {
        color: #6c757d;
        font-size: 0.875rem;
    }

    .btn-register {
        
        width: 100%;
        padding: 10px;
        font-weight: 500;
    }

    .login-link {
        text-align: center;
        margin-top: 20px;
    }
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

</style>
