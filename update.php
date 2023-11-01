<?php
error_reporting(E_ALL);
session_start();

$users = json_decode(file_get_contents('users.json'), true);

if (!isset($_SESSION['email']) || !isset($users[$_SESSION['email']])) {
    echo "Email not found";
}

if (isset($_POST['update'])) {
    $user_email = $_SESSION['email'];
    $new_role = $_POST['role'];

    if (isset($users[$user_email])) {
        $users[$user_email]['role'] = $new_role;
        file_put_contents('users.json', json_encode($users, JSON_PRETTY_PRINT));
        // header('location:update.php');
    }
}

if (isset($_POST['logout'])) {
    // Unset the session data for the email
    unset($_SESSION['email']);

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header('Location: login.php');
    exit();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title> Update Role </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Update Role</h3>
                    </div>
                    <div class="card-body">
                        <!-- <?php
                        if (!empty($errormsg)) {
                            echo $errormsg;
                        }
                        if (!empty($successmsg)) {
                            echo $successmsg;
                        }
                        ?> -->
                        <form class="form" method="POST">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="role" placeholder="Role" value="">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-4">
                                    <button type="submit" name="update" class="btn btn-primary btn-block" value="Update">Update Role</button>
                                </div>

                                <div class="col-4">
                                    <form method="POST">
                                        <button type="submit" name="logout" class="btn btn-danger btn-block" value="logout">Log Out</button>
                                    </form>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>