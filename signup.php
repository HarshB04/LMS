<?php
session_start();
include('includes/config.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$success = '';
$error   = '';

if (isset($_POST['signup'])) {
    $fname    = trim($_POST['fullanme']);
    $mobileno = trim($_POST['mobileno']);
    $email    = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $status   = 1;

    // Check email not already registered
    $chk = $dbh->prepare("SELECT id FROM tblstudents WHERE EmailId=:email");
    $chk->bindParam(':email', $email, PDO::PARAM_STR);
    $chk->execute();
    if ($chk->rowCount() > 0) {
        $error = "This email is already registered.";
    } else {
        // Insert without StudentId first, then use auto-increment id to build SID
        $sql = "INSERT INTO tblstudents(FullName, MobileNumber, EmailId, Password, Status)
                VALUES(:fname, :mobileno, :email, :password, :status)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname',    $fname,    PDO::PARAM_STR);
        $query->bindParam(':mobileno', $mobileno, PDO::PARAM_STR);
        $query->bindParam(':email',    $email,    PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->bindParam(':status',   $status,   PDO::PARAM_INT);
        $query->execute();
        $newId     = $dbh->lastInsertId();
        $StudentId = 'SID' . str_pad($newId, 3, '0', STR_PAD_LEFT);

        // Update with generated StudentId
        $upd = $dbh->prepare("UPDATE tblstudents SET StudentId=:sid WHERE id=:id");
        $upd->bindParam(':sid', $StudentId, PDO::PARAM_STR);
        $upd->bindParam(':id',  $newId,     PDO::PARAM_INT);
        $upd->execute();

        $success = "Registration successful! Your Student ID is <strong>" . htmlspecialchars($StudentId) . "</strong>. <a href='index.php'>Login now</a>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Library Management System - Student Signup" />
    <title>Online Library Management System | Student Signup</title>
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
                    <h4 class="header-line">User Signup</h4>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-8 col-12">
                    <div class="card border-danger">
                        <div class="card-header bg-danger text-white fw-bold">SIGNUP FORM</div>
                        <div class="card-body">
                            <?php if ($success): ?>
                                <div class="alert alert-success"><?= $success ?></div>
                            <?php elseif ($error): ?>
                                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                            <?php endif; ?>

                            <form id="signupForm" method="post" novalidate>
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input class="form-control" type="text" name="fullanme" autocomplete="off" required />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mobile Number</label>
                                    <input class="form-control" type="text" name="mobileno" maxlength="10" autocomplete="off" required pattern="\d{10}" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <input class="form-control" type="email" name="email" id="emailid" autocomplete="off" required />
                                    <span id="user-availability-status" class="form-text"></span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" id="password" autocomplete="off" required minlength="6" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input class="form-control" type="password" name="confirmpassword" id="confirmpassword" autocomplete="off" required />
                                </div>
                                <button type="submit" name="signup" class="btn btn-danger" id="submit">Register Now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery 3.7 -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap 5 Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Scripts -->
    <script src="assets/js/custom.js"></script>
    <script>
        // Client-side password match check
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            var pass = document.getElementById('password').value;
            var confirm = document.getElementById('confirmpassword').value;
            if (pass !== confirm) {
                e.preventDefault();
                alert('Password and Confirm Password do not match!');
                document.getElementById('confirmpassword').focus();
            }
        });

        // Email availability check
        function checkAvailability() {
            var email = $('#emailid').val();
            if (!email) return;
            $.ajax({
                url: 'check_availability.php',
                data: {
                    emailid: email
                },
                type: 'POST',
                success: function(data) {
                    $('#user-availability-status').html(data);
                }
            });
        }
        $('#emailid').on('blur', checkAvailability);
    </script>
</body>

</html>