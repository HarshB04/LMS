<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('includes/config.php');

if (isset($_SESSION['login']) && $_SESSION['login'] != '') {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if (isset($_POST['login'])) {
    $email = trim($_POST['emailid']);
    $sql = "SELECT FullName, EmailId, Password, StudentId, Status FROM tblstudents WHERE EmailId=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_OBJ);

    if ($result && password_verify($_POST['password'], $result->Password)) {
        if ($result->Status == 1) {
            $_SESSION['stdid']    = $result->StudentId;
            $_SESSION['username'] = $result->FullName;
            $_SESSION['login']    = $result->EmailId;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Your account has been blocked. Please contact admin.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Online Library Management System - User Login" />
    <title>Online Library Management System | Login</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts (HTTPS) -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet" />
    <!-- Custom Style -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
    <?php include('includes/header.php'); ?>

    <div class="content-wrapper">
        <div class="container mt-4">
            <div class="row mb-3">
                <div class="col-12">
                    <h4 class="header-line">USER LOGIN FORM</h4>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-8 col-12">
                    <div class="card border-info">
                        <div class="card-header bg-info text-white fw-bold">LOGIN FORM</div>
                        <div class="card-body">
                            <?php if ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form method="post">
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" type="email" name="emailid" required autocomplete="off" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required autocomplete="off" />
                                    <div class="form-text"><a href="user-forgot-password.php">Forgot Password?</a></div>
                                </div>
                                <button type="submit" name="login" class="btn btn-info text-white">LOGIN</button>
                                &nbsp;<a href="signup.php" class="btn btn-outline-secondary btn-sm">Not Registered Yet?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3.7 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="assets/js/custom.js"></script>
</body>

</html>